<?php

namespace Modules\ParlourListings\Repositories;

use App\Models\ParlourListing;
use Modules\ParlourListings\Contracts\ParlourListingRepository;

class DbParlourListingRepository implements ParlourListingRepository
{
    public function getAll()
    {
        return ParlourListing::all();
    }

    public function findById($id)
    {
        return ParlourListing::findOrFail($id);
    }

    public function create($data)
    {
        return ParlourListing::create($data);
    }

    public function findBySlug($slug)
    {
        return ParlourListing::whereSlug($slug)->firstOrFail();
    }

    public function getPaginated($type = null)
    {
        return ParlourListing::when($type, function ($query) use ($type) {
            return $query->whereStatus($type);
        })
            ->when(request()->search, function ($query) {
                return $query->search(request()->search);
            })
            ->paginate();
    }

    public function getParlourListingCountByStatus($key)
    {
        return ParlourListing::whereStatus($key)->count();
    }

    public function getTrashedItemById($id)
    {
        return ParlourListing::onlyTrashed()->whereId($id)->firstOrFail();
    }

    public function getTrashItems()
    {
        return ParlourListing::onlyTrashed()->paginate();
    }

    public function search($keywords)
    {
        return ParlourListing::onlyApproved()
            ->search(implode(' ', $keywords), true, true)
            ->get();
    }

    public function findBySlugAndApproved($slug)
    {
        return ParlourListing::onlyApproved()->whereSlug($slug)->firstOrFail();
    }

    public function getFeatureListing(){
        return ParlourListing::whereFeatured(true)->get();
    }
}
