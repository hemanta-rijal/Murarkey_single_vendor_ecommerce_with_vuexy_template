<?php

namespace Modules\ParlourListings\Services;

use Modules\ParlourListings\Contracts\ParlourListing;
use Modules\ParlourListings\Contracts\ParlourListingRepository;

class ParlourListingService implements ParlourListing
{

    private $parlourListingRepository;

    public function __construct(ParlourListingRepository $parlourListingRepository)
    {
        $this->parlourListingRepository = $parlourListingRepository;
    }

    public function getAll()
    {
        return $this->parlourListingRepository->getAll();
    }
    public function getAllFeatured()
    {
        return $this->parlourListingRepository->getAllFeatured();
    }
    public function getAllActive()
    {
        return $this->parlourListingRepository->getAllActive();
    }

    public function create($data, $image)
    {
        $data['feature_image'] = $image->store('public/parlours');
        return $this->parlourListingRepository->create($data);
    }

    public function update($id, $data, $image)
    {
        if ($image) {
            $data['feature_image'] = $image->store('public/parlours');
        }
        return $this->parlourListingRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->parlourListingRepository->findById($id);
    }

    public function findBySlug($slug)
    {
        return $this->parlourListingRepository->findBySlug($slug);
    }

    public function getPaginated($type = null)
    {
        return $this->parlourListingRepository->getPaginated($type);
    }

    public function updateStatus($id, $status)
    {
        $parlourListing = $this->parlourListingRepository->findById($id);
        $parlourListing->status = $status;
        $parlourListing->save();
        event(new ParlourListingStatusUpdated($parlourListing));

        return $parlourListing;
    }

    public function delete($id, $force = null, $reason = null)
    {
        $parlourListing = ParlourListing::withTrashed()->findOrFail($id);

        \DB::transaction(function () use ($parlourListing, $force, $reason) {

            $deleteType = $force ? 'forceDelete' : 'delete';

            FeaturedCategoriesHasProduct::whereIn('product_id', $parlourListing->products_obj->pluck('id'))->delete();

            $parlourListing->products_obj()->{$deleteType}();

            if (!$force && $reason) {
                $parlourListing->delete_reason = $reason;

                $parlourListing->save();
            }

            $parlourListing->{$deleteType}();
        });

    }

    public function recover($id)
    {

    }
    public function search($keywords)
    {
        $this->parlourListingRepository->search($keywords);
    }

    public function getTrashItems()
    {
        return $this->parlourListingRepository->getTrashItems();
    }
    public function getTrashedItemById($id)
    {
        return $this->parlourListingRepository->getTrashedItemById($id);
    }

    public function findBySlugAndApproved($slug)
    {
        return $this->parlourListingRepository->findBySlugAndApproved($slug);
    }

    public function getFeatureListing()
    {
        return $this->parlourListingRepository->getFeatureListing();
    }
}
