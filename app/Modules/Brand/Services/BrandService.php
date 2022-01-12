<?php

namespace Modules\Brand\Services;

use App\Models\Brand;
use Modules\Brand\Contracts\BrandRepo;
use Modules\Brand\Contracts\BrandServiceRepo as BrandServiceContract;

class BrandService implements BrandServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $brandRepository;

    public function __construct(BrandRepo $repository)
    {
        $this->brandRepository = $repository;
    }

    public function getAll()
    {
        return Brand::all();
    }
    public function getAllFeatured()
    {
        return Brand::where('featured', true)->get();
    }
    public function create($data): Brand
    {

        return $this->brandRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->brandRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->brandRepository->findById($id);
    }

    public function findBySlug($slug)
    {
        return $this->brandRepository->findBySlug($slug);
    }

    public function delete($id)
    {
        return $this->brandRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->brandRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }
    public function getBrandWithProductCount($name=null)
    {
        return $this->brandRepository->getBrandWithProductCount($name=null);
    }

    public function findBy($column, $data)
    {
        return $this->brandRepository->findBy($column, $data);
    }

}
