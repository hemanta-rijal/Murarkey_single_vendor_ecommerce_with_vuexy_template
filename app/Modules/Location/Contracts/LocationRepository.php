<?php

namespace Modules\Location\Contracts;

interface LocationRepository
{

    public function getAllCountries();

    public function getAllStatesByCountryId($id);

    public function getAllCitiesByStateId($id);

    public function getCountriesWithPhoneCode();

    public function alterProductCount($type, $cityId);
}
