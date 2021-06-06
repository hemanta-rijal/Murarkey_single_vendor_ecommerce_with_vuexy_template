<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\flashSale\FlashSaleResource;
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
        // $flashSales = $this->flashSalesRepository->getDataForApi();
        $flashSales = $this->flashSalesRepository->getAll();

        $flashSales->load('items.product.images');
        return FlashSaleResource::collection($flashSales);
    }

    public function show($id)
    {
        $flashSale = $this->flashSalesRepository->findById($id);

        $flashSale->load('items.product.images');

        return new FlashSaleResource($flashSale);
        // return $flashSale;
    }
}
