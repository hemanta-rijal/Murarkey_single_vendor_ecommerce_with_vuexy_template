<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 11/2/18
 * Time: 1:37 PM
 */

namespace Modules\FlashSales\Repositories;

use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use Modules\FlashSales\Contracts\FlashSalesRepository;

class DbFlashSalesRepository implements FlashSalesRepository
{
    public function delete($id)
    {
        FlashSale::destroy($id);
    }

    public function update($id, $data)
    {
        $flashSale = $this->findById($id);

        \DB::transaction(function () use ($flashSale, $data) {
            $flashSale->fill($data);

            $products = [];

            if (isset($data['products'])) {
                foreach ($data['products'] as $product) {
                    if (!isset($product['id'])) {
                        $products[] = new FlashSaleItem($product);
                    } else {
                        $this->updateFlashSalesItem($product);
                    }
                }
            }

            $flashSale->items()->saveMany($products);

            if (isset($data['remove_item'])) {
                foreach ($data['remove_item'] as $item) {
                    $this->deleteFlashItem($item);
                }
            }

            $flashSale->save();

        });
    }

    public function findById($id)
    {
        return FlashSale::findOrFail($id);
    }

    public function create($data)
    {
        FlashSale::create($data);
    }

    public function getPaginated($number = 15)
    {
        return FlashSale::latest()->paginate($number);
    }

    private function updateFlashSalesItem($item)
    {
        $itemObj = FlashSaleItem::findOrFail($item['id']);

        $itemObj->fill($item);
        $itemObj->save();
    }

    private function deleteFlashItem($item)
    {
        FlashSaleItem::destroy($item);
    }

    public function getAll()
    {
        return FlashSale::where('published', true)->orderBy('weight', 'asc')->get();
    }

    public function getDataForApi()
    {
        return FlashSale::where('start_time', '<=', \Carbon\Carbon::now())->where('end_time', '>=', \Carbon\Carbon::now())->where('published', 1)->orderBy('weight', 'DESC')->get();
    }

}
