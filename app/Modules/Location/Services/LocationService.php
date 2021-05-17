<?php


namespace Modules\Location\Services;


use App\Models\LocationCity;
use Modules\Location\Contracts\LocationRepository;
use Modules\Location\Contracts\LocationService as LocationServiceContract;

class LocationService implements LocationServiceContract
{
    protected $locationRepository;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function getInfo($data)
    {
        switch ($data['type']) {
            case 'get-countries':
                return ['result' => $this->locationRepository->getAllCountries()];
                break;
            case 'get-states':
                return ['result' => $this->locationRepository->getAllStatesByCountryId($data['id'])];
                break;
            case 'get-cities':
                return ['result' => $this->locationRepository->getAllCitiesByStateId($data['id'])];
                break;
        }
    }

    public function getCountriesWithPhoneCode()
    {
        $data = [];
        $countries = $this->locationRepository->getCountriesWithPhoneCode();
        foreach ($countries as $country) {
            $data[$country->phonecode] = $country->name . " ( +{$country->phonecode})";
        }

        return $data;
    }

    public function getAllCountries()
    {
        return $this->locationRepository->getAllCountries();
    }

    public function extractLocationForSearch($companies)
    {
        $ids = $companies->pluck('city')->toArray();
        $ids = array_replace($ids,array_fill_keys(array_keys($ids, null),''));
        $citiesCount = array_count_values($ids);

        $cities = LocationCity::whereIn('id', array_keys($citiesCount))->get();

        $cities->load('state.country');

        $states = collect([]);
        $countries = collect([]);

        $cities->map(function ($city) use ($states, &$citiesCount) {
            $city->_count = $citiesCount[$city->id];
            $states->where('id', $city->state_id)->first() ?: $states->push($city->state);
            $state = $states->where('id', $city->state_id)->first();
            $state->new_cities = $state->new_cities ?: [];
            $cities = $state->new_cities;
            array_push($cities, $city);
            $state->new_cities = $cities;
        });

        $states->map(function ($state) use ($countries) {
            $state->new_cities = collect($state->new_cities);
            $state->_count = $state->new_cities->sum('_count');
            $countries->where('id', $state->country_id)->first() ?: $countries->push($state->country);
            $country = $countries->where('id', $state->country_id)->first();
            $country->new_states = $country->new_states ?: [];
            $states = $country->new_states;
            array_push($states, $state);
            $country->new_states = $states;
        });

        $countries->map(function ($country) {
            $country->new_states = collect($country->new_states);
            $country->_count = $country->new_states->sum('_count');
        });

        return $countries;
    }
}