<?php

namespace Modules\Service\Repositories;

use App\Models\ProductHasImage;
use App\Models\Service;
use App\Models\ServiceHasImage;
use App\Models\ServiceHasServiceLabel;
use App\Models\ServiceLabel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Modules\Service\Contracts\ServiceRepository;

class DbServiceRepository implements ServiceRepository
{
    public function create($data): Service
    {
        return \DB::transaction(function () use ($data) {
            /*
             * check if slug already exist if yes create new slug
             */
            $data['slug'] = $this->slugExist($data['slug']);

            $service = Service::create($data);
            $service_labels = [];
            $service_images = [];
            if (isset($data['service_labels'])) {
                foreach ($data['service_labels'] as $label) {
                    $label_fields = explode(',', $data[$label]);
                    foreach ($label_fields as $value) {
                        $serviceLabel = ServiceLabel::where('value', $label)->first();
                        $service_labels[] = new ServiceHasServiceLabel(['label_value' => $value, 'label_id' => $serviceLabel->id]);
                    }
                    $service->labels()->saveMany($service_labels);
                }
            }
            if (isset($data['featured_images'])) {
                foreach ($data['featured_images'] as $image) {
                    $upload = $image->store('public/services');
                    $service_images[] = new ServiceHasImage(['image' => $upload]);
                }
            }
            $service->images()->saveMany($service_images);
            return $service;
        });
    }

    public function findById($id)
    {
        return Service::findOrFail($id);
    }
    public function findBySlug($slug)
    {
        return Service::where('slug', $slug)->get();
    }

    public function getAll()
    {
        return Service::all();
    }
    public function getPopularServices()
    {
        return Service::where('popular', true)->get();

    }
    public function update($id, $data)
    {

        return \DB::transaction(function () use ($id, $data) {
            $service = $this->findById($id);
            if (isset($data['service_labels'])) {
                $service_labels = [];
                $service->labels()->delete();
                foreach ($data['service_labels'] as $label) {
                    $label_fields = explode(',', $data[$label]);
                    foreach ($label_fields as $value) {
                        $serviceLabel = ServiceLabel::where('value', $label)->first();
                        ServiceHasServiceLabel::create(['label_value' => $value, 'label_id' => $serviceLabel->id, 'service_id' => $id]);
                    }
                }

            }
            if (isset($data['featured_images'])) {
                $service_images = [];
                ServiceHasImage::where('service_id',$id)->delete();
                foreach ($data['featured_images'] as $image) {
                    $upload = $image->store('public/services');
                    $service_images[] = new ServiceHasImage(['image' => $upload]);
                }

                $service->images()->saveMany($service_images);
            }

            return $service->update($data);
        });
    }

    public function delete($id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated($number)
    {
        return Service::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }
    public function getMurarkeyService()
    {
        return Service::where('serviceTo', 1)->get();
    }
    public function getParlourService()
    {
        // TODO: Implement getParlorsService() method.
        return Service::where('serviceTo', 0)->get();
    }
    public function getParlourServicesNotAssignedToParlor()
    {
        $parlorServices = $this->getParlourService();
        $nonAssignedParlor = [];
        foreach ($parlorServices as $service) {
            if ($service->is_not_assigned_parlour) {
                array_push($nonAssignedParlor, $service);
            }

        }
        return $nonAssignedParlor;
    }
    public function slugExist($slug)
    {
        if (Service::where('slug', $slug)->count() > 0) {
            $row = Service::orderBy('id', 'desc')->first()->id + 1;
            return $slug . "-" . $row;
        }
        return $slug;
    }

    public function findBy($column, $data)
    {
        if (Schema::hasColumn('services', $column)) {
            return Service::where($column, $data)->first();
        }
    }

    public function getBy($column,$data){
        if (Schema::hasColumn('services', $column)) {
            return Service::where($column, $data)->get();
        }
    }

    public function deleteServiceImage($imageId){

            $image =  ServiceHasImage::where('image',$imageId)->first();

            if(File::exists(storage_path($image->image))){
                Storage::delete($image->image);
            }
            if($image->delete()){
                return true;
            }
            return false;

    }
    public function addImages($data,$product){
        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $upload = $image->store('public/services');
                $images[] = new ServiceHasImage(['image' => $upload]);
            }
            if($product->images()->saveMany($images)){
                return true;
            }
        }

        return false;
    }
    public function getByListOfCategory($array){
       return Service::whereIn('category_id',$array)->get();
    }
}
