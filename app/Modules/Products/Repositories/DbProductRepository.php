<?php

namespace Modules\Products\Repositories;

use App\Models\Product;
use App\Models\ProductHasAttribute;
use App\Models\ProductHasImage;
use App\Models\ProductHasKeyword;
use App\Models\TempProduct;
use App\Models\TempProductHasAttribute;
use App\Models\TempProductHasImage;
use App\Models\TempProductHasKeyword;
use Modules\Products\Contracts\ProductRepository;

class DbProductRepository implements ProductRepository
{
    public function create($data)
    {
        return \DB::transaction(function () use ($data) {
            $product = Product::create($data);
            $attributes = [];
            $keywords = [];
            $moqs = [];
            $images = [];

            if (isset($data['attribute'])) {
                foreach ($data['attribute'] as $attribute) {
                    $attributes[] = new ProductHasAttribute($attribute);
                }
            }

            if (isset($data['keyword'])) {
                foreach ($data['keyword'] as $keyword) {
                    $keywords[] = new ProductHasKeyword(['name' => $keyword]);
                }
            }

            //    if (isset($data['moq']))
            //        foreach ($data['moq'] as $moq)
            //            $moqs[] = new ProductHasTradeInfo($moq);

            if (isset($data['images'])) {
                foreach ($data['images'] as $image) {
                    $upload = $image->store('public/products');
                }
            }

            $images[] = new ProductHasImage(['image' => $upload]);

            $product->attributes()->saveMany($attributes);
            $product->images()->saveMany($images);
            $product->keywords()->saveMany($keywords);
//            $product->trade_infos()->saveMany($moqs);
            return $product;
        });
    }

    public function createTempProduct($data)
    {
        return \DB::transaction(/**
         * @return mixed
         */
            function () use ($data) {
                $product = TempProduct::create($data);
                $attributes = [];
                $keywords = [];
//                $moqs = [];
                $images = [];

                if (isset($data['attribute'])) {
                    foreach ($data['attribute'] as $attribute) {
                        $attributes[] = new TempProductHasAttribute($attribute);
                    }
                }

                if (isset($data['keyword'])) {
                    foreach ($data['keyword'] as $keyword) {
                        $keywords[] = new TempProductHasKeyword(['name' => $keyword]);
                    }
                }

//
                //                if (isset($data['moq']))
                //                    foreach ($data['moq'] as $moq)
                //                        $moqs[] = new TempProductHasTradeInfo($moq);

                if (isset($data['images'])) {
                    foreach ($data['images'] as $image) {
                        $images[] = new TempProductHasImage(['image' => $image]);
                    }
                }

                $product->attributes()->saveMany($attributes);
                $product->images()->saveMany($images);
                $product->keywords()->saveMany($keywords);
//                $product->trade_infos()->saveMany($moqs);

                return $product;
            });
    }

    public function getPaginated($type = null, $search = null, int $number = null, $companyId = null, $userId = null)
    {
        return Product::when($type, function ($query) use ($type) {
            return $query->whereStatus($type);
        })
            ->when($companyId, function ($query) use ($companyId) {
                return $query->where('company_id', $companyId);
            })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('seller_id', $userId);
            })
            ->when(request()->search, function ($query) {
                $query->search(request()->search);
                $query->groupBy('products.relevance');
                $query->orderBy('products.relevance', 'DESC');

            })
            ->groupBy('products.id')
            ->latest()
            ->paginate($number);
    }

    public function findById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function getTrashItems($companyId = null, $userId = null)
    {
        return Product::onlyTrashed()->when($companyId, function ($query) use ($companyId) {
            return $query->whereCompanyId($companyId);
        })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('seller_id', $userId);
            })
            ->paginate();
    }

    public function getTrashedItemById($id, $companyId = null, $userId = null)
    {
        return Product::onlyTrashed()
            ->whereId($id)
            ->when($companyId, function ($query) use ($companyId) {
                return $query->whereCompanyId($companyId);
            })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('seller_id', $userId);
            })
            ->firstOrFail();
    }

    public function getProductCountByStatus($key, $companyId = null, $userId = null)
    {
        return Product::when($companyId, function ($query) use ($companyId) {
            return $query->whereCompanyId($companyId);
        })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('seller_id', $userId);
            })
            ->whereStatus($key)->count();

    }

    public function findProductWithCompanyIdAndUserId($id, $companyId, $userId)
    {
        return Product::whereId($id)->when($companyId, function ($query) use ($companyId) {
            return $query->where('company_id', $companyId);
        })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('seller_id', $userId);
            })
            ->firstOrFail();
    }

    public function emptyTrash($companyId = null, $userId = null)
    {
        return Product::onlyTrashed()->when($companyId, function ($query) use ($companyId) {
            return $query->whereCompanyId($companyId);
        })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('seller_id', $userId);
            })
            ->forceDelete();
    }

    public function search($keywords)
    {
        return Product::onlyApproved()
            ->select(\DB::raw('DISTINCT(id)'), 'products.*')
            ->search($keywords)
            ->with(Product::$relationship)
            ->paginate(request()->per_page ? request()->per_page : 20);
    }

    public function searchByCategory($categories)
    {
        return Product::onlyApproved()
            ->whereIn('category_id', $categories)
            ->with(Product::$relationship)
            ->get();

    }

    public function searchWithCategory($search, $categories)
    {
        return Product::onlyApproved()
            ->select(\DB::raw('DISTINCT(id)'), 'products.*')
            ->whereIn('category_id', $categories)
            ->search($search)
            ->get();
    }

    public function getRecentlyAdded($number = 5)
    {
        return Product::onlyApproved()
        // ->where('auction', 0)
            ->inRandomOrder()
            ->take($number)
            ->with('images')
            ->get();
    }

    public function getFeaturedProductCount($companyId = null)
    {
        return Product::when($companyId, function ($query) use ($companyId) {
            return $query->where('company_id', $companyId);
        })
            ->where('featured', 1)
            ->count();
    }

    public function updateFeatured($value, $productId, $companyId = null)
    {
        return Product::whereId($productId)
            ->when($companyId, function ($query) use ($companyId) {
                return $query->where('company_id', $companyId);
            })
            ->update(['featured' => $value]);
    }

    //Old Concept No use
    public function transferOwnerShip($companyId, $from, $to)
    {
        return Product::where('company_id', $companyId)->where('post_by', $from)->update(['post_by' => $to]);
    }

    public function updateOutOfStock($product_id, $out_of_stock, $companyId = null, $userId = null)
    {
        return Product::where('id', $product_id)
            ->when($companyId, function ($query) use ($companyId) {
                return $query->where('company_id', $companyId);
            })
            ->when($userId, function ($query) use ($userId) {
                return $query->where('seller_id', $userId);
            })
            ->update(['out_of_stock' => $out_of_stock]);
    }

    public function removeProductSeller($companyId, $sellerId)
    {
        return Product::where('company_id', $companyId)->where('seller_id', $sellerId)->update(['seller_id' => null]);
    }

    public function findByIdAndApproved($id)
    {
        return Product::onlyApproved()->where('id', $id)->first();
    }

    public function findBySlugAndApproved($slug)
    {
        return Product::onlyApproved()->whereSlug($slug)->firstOrFail();
    }

    public function findProductsBelow1500($number = 10)
    {
        return Product::where('price', '<=', 1500)
        // ->where('auction', 0)
            ->inRandomOrder()->with('images')->take($number)->get();
    }

}
