<?php

namespace Modules\Products\Repositories;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\ProductHasAttribute;
use App\Models\ProductHasImage;
use App\Models\ProductHasKeyword;
use App\Models\TempProduct;
use App\Models\TempProductHasAttribute;
use App\Models\TempProductHasImage;
use App\Models\TempProductHasKeyword;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Modules\Products\Contracts\ProductRepository;

class DbProductRepository implements ProductRepository
{
    public function create($data)
    {
        // dd($data);
        return \DB::transaction(function () use ($data) {
            $product = Product::create($data);
            $keywords = [];
            $images = [];
            if (isset($data['attributes'])) {
                $attr_values = $data['attr_values'];
                foreach ($data['attributes'] as $key => $attribute) {
                    $productAttribute = Attribute::where('value', $attribute)->first();
                    ProductHasAttribute::create(['product_id' => $product->id, 'attribute_id' => $productAttribute->id, 'value' => $attr_values[$key]]);
                }
            }

            if (isset($data['keyword'])) {
                foreach ($data['keyword'] as $keyword) {
                    $keywords[] = new ProductHasKeyword(['name' => $keyword]);
                }
            }
            $this->addImages($data,$product);
            $product->rel_keywords()->saveMany($keywords);
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
                if (isset($data['images'])) {
                    foreach ($data['images'] as $image) {
                        $images[] = new TempProductHasImage(['image' => $image]);
                    }
                }

                $product->attributes()->saveMany($attributes);
                $product->images()->saveMany($images);
                $product->rel_keywords()->saveMany($keywords);
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

    public function findById($id)
    {
        return Product::find($id);
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
            ->first();
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
            ->first();
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
        return Product::onlyApproved()->whereId($id)->first();
    }

    public function findBySlugAndApproved($slug)
    {
        return Product::onlyApproved()->whereSlug($slug)->first();
    }

    public function findProductsBelow1500($number = 10)
    {
        return Product::where('price', '<=', 1500)
        // ->where('auction', 0)
            ->inRandomOrder()->with('images')->take($number)->get();
    }

    public function updateProductsStock($product_id, $qty, $increment)
    {
        $product = $this->findById($product_id);
        if ($increment == true) {
            $product->update(['total_product_units' => $product->total_product_units + $qty]);
        }
        if ($increment == false) {
            if ($product->total_product_units >= $qty) {
                $product->update(['total_product_units' => $product->total_product_units - $qty]);
            }
        }
    }

    public function updateStock($id, $stock)
    {
        return Product::where('id', $id)->update(['total_product_units' => $stock]);
    }

    public function findBySlug($slug)
    {
        return Product::whereSlug($slug)->first();
    }

    public function findBy($column, $data)
    {
        if (Schema::hasColumn('products', $column)) {
            return Product::where($column, $data)->first();
        }
    }
    public function findByAttribute($attribute){
        return Product::whereHas('attributes',function ($query) use($attribute){
            $query->where('value','like','%'.$attribute.'%');
        });
    }

    public function deleteProductImage($image){
        $image =  ProductHasImage::where('image',$image)->first();

        if(File::exists(storage_path($image->image))){
            Storage::delete($image->image);
        }
        if($image->delete()){
            return true;
        }
        return false;
    }
    public function addImages($data,$product){
        if (isset($data['images'])) {
            foreach ($data['images'] as $image) {
                $upload = $image->store('public/products');
                $images[] = new ProductHasImage(['image' => $upload]);
            }
            if($product->images()->saveMany($images)){
                return true;
            }
        }

        return false;
    }

}
