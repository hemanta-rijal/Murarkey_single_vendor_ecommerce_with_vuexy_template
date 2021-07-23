<?php

namespace Modules\Service\Repositories;

use App\Models\Service;
use App\Models\ServiceHasImage;
use App\Models\ServiceHasServiceLabel;
use Modules\Service\Contracts\ServiceRepository;

class DbServiceRepository implements ServiceRepository
{
    public function create($data): Service
    {
        return \DB::transaction(function () use ($data) {
            $service = Service::create($data);
            $service_labels = [];
            $service_images = [];
            if (isset($data['service_labels'])) {
                foreach ($data['service_labels'] as $label) {
                    $label_fields = explode(',', $data[$label]);
                    foreach ($label_fields as $value) {
                        $service_labels[] = new ServiceHasServiceLabel(['label_value' => $value]);
                    }
                }
                $service->labels()->saveMany($service_labels);
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
        return $this->findById($id)->update($data);
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

}
