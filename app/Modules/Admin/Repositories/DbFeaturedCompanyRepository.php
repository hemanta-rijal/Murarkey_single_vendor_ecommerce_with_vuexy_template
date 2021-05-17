<?php


namespace Modules\Admin\Repositories;


use App\Models\FeaturedCompaniesHasProduct;
use App\Models\FeaturedCompany;
use Modules\Admin\Contracts\FeaturedCompanyRepository;

class DbFeaturedCompanyRepository implements FeaturedCompanyRepository
{
    public function create($data) : FeaturedCompany
    {
        return FeaturedCompany::create($data);
    }

    public function findById($id)
    {
        return FeaturedCompany::findOrFail($id);
    }

    public function update($id, $data)
    {
        $company = $this->findById($id);

        \DB::transaction(function () use ($company, $data) {
            $company->update($data);
            $products = [];
            if (isset($data['products']))
                foreach ($data['products'] as $product)
                    if (isset($product['product_id']))
                        $products[] = new FeaturedCompaniesHasProduct($product);
                    else
                        $this->updateFeaturedCompanyProduct($product['id'], $product['weight']);


            $company->products()->saveMany($products);

            if (isset($data['remove_item']))
                foreach ($data['remove_item'] as $item)
                    $this->deleteFeaturedCompanyProduct($item);

        });

    }

    public function deleteFeaturedCompanyProduct($id)
    {
        return FeaturedCompaniesHasProduct::whereId($id)->delete();
    }

    public function updateFeaturedCompanyProduct($id, $weight)
    {
        return FeaturedCompaniesHasProduct::whereId($id)->update(['weight' => $weight]);
    }

    public function delete($id)
    {
        return FeaturedCompany::destroy($id);
    }

    public function getPaginated($number = 15)
    {
        return FeaturedCompany::orderBy('weight', 'DESC')->paginate($number);
    }

    public function getForHomePage()
    {
        return FeaturedCompany::orderBy('weight', 'DESC')->with(
            ['products' =>
                function ($query) {
                    $query->orderBy('weight', 'DESC');
                },
                'products.product',
                'company',
                'products.product.images',
                'products.product.category'
            ]
        )
            ->get();
    }
}