<?php


namespace Modules\Location\Repositories;


use App\Models\LocationCity;
use App\Models\LocationCountry;
use App\Models\LocationState;
use Modules\Location\Contracts\LocationRepository;

class DbLocationRepository implements LocationRepository
{

    public function getAllCountries()
    {
        return LocationCountry::pluck('name', 'id');
    }

    public function getAllStatesByCountryId($id)
    {
        return LocationState::where('country_id', $id)->orderBy('name')->pluck('name', 'id');
    }

    public function getAllCitiesByStateId($id)
    {
        return LocationCity::where('state_id', $id)->orderBy('name')->pluck('name', 'id');
    }

    public function getCountriesWithPhoneCode()
    {
        return LocationCountry::all();
    }

    public function alterProductCount($type, $cityId)
    {
        return \DB::transaction(function () use ($type, $cityId) {
            LocationCity::where('id', $cityId)->{$type}('product_count');
            $stateQuery = LocationState::whereHas('cities', function ($query) use ($cityId) {
                return $query->where('location_cities.id', $cityId);
            });
            $state = $stateQuery->first();

            $stateQuery->{$type}('product_count');

            LocationCountry::where('id', $state->country_id)->{$type}('product_count');
        });
    }
}