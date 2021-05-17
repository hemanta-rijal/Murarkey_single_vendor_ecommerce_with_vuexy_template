<?php


namespace Modules\Admin\Repositories;


use App\Models\FeaturedCategoriesHasProduct;
use App\Models\FeaturedCategory;
use Modules\Admin\Contracts\FeaturedCategoryRepository;

class DbFeaturedCategoryRepository implements FeaturedCategoryRepository
{
    public function create($data) : FeaturedCategory
    {
        return FeaturedCategory::create($data);
    }

    public function findById($id)
    {
        return FeaturedCategory::findOrFail($id);
    }

    public function update($id, $data)
    {
        $category = $this->findById($id);

        \DB::transaction(function () use ($category, $data) {
            $category->update($data);
            $products = [];
            
            if (isset($data['products']))
                foreach ($data['products'] as $product)
                    if (isset($product['product_id']))
                        $products[] = new FeaturedCategoriesHasProduct($product);
                    else
                        $this->updateFeaturedCategoryProduct($product['id'], $product['weight']);
            
            $category->products()->saveMany($products);

            if (isset($data['remove_item']))
                foreach ($data['remove_item'] as $item)
                    $this->deleteFeaturedCategoryProduct($item);

        });

    }

    public function deleteFeaturedCategoryProduct($id)
    {
        return FeaturedCategoriesHasProduct::whereId($id)->delete();
    }

    public function updateFeaturedCategoryProduct($id, $weight)
    {
        return FeaturedCategoriesHasProduct::whereId($id)->update(['weight' => $weight]);
    }

    public function delete($id)
    {
        return FeaturedCategory::destroy($id);
    }

    public function getPaginated($number = 15)
    {
        return FeaturedCategory::orderBy('weight', 'DESC')->paginate($number);
    }

    public function getForHomePage()
    {
        return FeaturedCategory::orderBy('weight', 'DESC')->take(4)
        ->with(
            ['products' =>
                function ($query) {
                    $query->orderBy('weight', 'DESC');
                },
                'products.product',
                'category',
                'products.product.images'
            ]
        )
            ->get();
    }

}