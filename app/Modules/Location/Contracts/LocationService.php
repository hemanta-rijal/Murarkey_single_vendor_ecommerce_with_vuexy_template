<?php


namespace Modules\Location\Contracts;


interface LocationService
{

    public function getInfo($data);

    public function extractLocationForSearch($products);
}