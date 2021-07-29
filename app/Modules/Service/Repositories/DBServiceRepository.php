<?php

namespace Modules\Service\Repositories;

use App\Models\Service;
use App\Models\ServiceHasImage;
use App\Models\ServiceHasServiceLabel;
use App\Models\ServiceLabel;
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
                foreach ($data['featured_images'] as $image) {
                    // dd($image);
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

}
