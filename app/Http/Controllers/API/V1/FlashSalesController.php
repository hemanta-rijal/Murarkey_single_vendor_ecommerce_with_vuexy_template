<?php

namespace App\Http\Controllers\API\V1;


use Modules\FlashSales\Contracts\FlashSalesRepository;

class FlashSalesController extends BaseController
{
    private $flashSalesRepository;

    public function __construct(FlashSalesRepository $flashSalesRepository)
    {
        $this->flashSalesRepository = $flashSalesRepository;
    }


    public function index()
    {
        $flashSales =  $this->flashSalesRepository->getDataForApi();

        $flashSales->load('items.product.images');

        return $flashSales;
    }

    public function show($id)
    {
        $flashSale = $this->flashSalesRepository->findById($id);

        $flashSale->load('items.product.images');

        return $flashSale;
    }
}