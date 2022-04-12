<?php

namespace Modules\Service\Services;

use App\Models\Service;
use Modules\Service\Contracts\ServiceRepository;
use Modules\Service\Contracts\ServiceService as ServiceServiceContract;
use Modules\ServiceCategories\Contracts\ServiceCategoryRepository;

class ServiceService implements ServiceServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $ServiceRepository;
    private $serviceCategoryRepository;

    public function __construct(ServiceRepository $repository, ServiceCategoryRepository $serviceCategoryRepository)
    {
        $this->ServiceRepository = $repository;
        $this->serviceCategoryRepository = $serviceCategoryRepository;
    }

    public function getAll()
    {
        return Service::all();
    }

    public function getTree()
    {
        return $this->ServiceRepository->getTree();
    }

    public function getPopularServices()
    {
        return $this->ServiceRepository->getPopularServices();
    }

    public function create($data): Service
    {
        return $this->ServiceRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->ServiceRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->ServiceRepository->findById($id);
    }

    public function findBySlug($slug)
    {
        return $this->ServiceRepository->findBySlug($slug);
    }

    public function delete($id)
    {
        return $this->ServiceRepository->delete($id);
    }

    public function getMurarkeyService()
    {
        return $this->ServiceRepository->getMurarkeyService();
    }

    public function getParlourService()
    {
        return $this->ServiceRepository->getParlourService();
    }

    /*
     *  services which serviceTo =1 but not in parlor_has_service table
     */
    public function getParlourServicesNotAssignedToParlor()
    {
        return $this->ServiceRepository->getParlourServicesNotAssignedToParlor();
    }

    public function getPaginated($number = null)
    {
        return $this->ServiceRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function findBy($column, $data)
    {
        return $this->ServiceRepository->findBy($column, $data);
    }

    public function getBy($column, $data)
    {
        return $this->ServiceRepository->getBy($column, $data);
    }

    public function deleteServiceImage($image_id)
    {
        return $this->ServiceRepository->deleteServiceImage($image_id);
    }

    public function addImages($data, $service)
    {
        return $this->ServiceRepository->addImages($data, $service);
    }

    public function getThirdLevelOfCategoryByFirstLevel($category)
    {
        $second_level = $this->getTree();
    }

    public function searchBar()
    {
        $request = request();
        $masterQuery = Service::when($request->has('parentCategory'), function ($query) use ($request) {
            $category = $this->serviceCategoryRepository->findBySlug($request->get('parentCategory'));
            if ($category) {
                $second_level_category = array_values($this->serviceCategoryRepository->getChildren($category->id)->pluck('id')->toArray());
                $third_level_category = array_values($this->serviceCategoryRepository->getChildCategoryByParentCategoryLists($second_level_category)->pluck('id')->toArray());
                return $query->whereIn('category_id', $third_level_category);
            }
        })->when($request->has('search'), function ($query) use ($request) {
            return $query->where('title', 'like', '%' . $request->get('search') . '%');
        })->when($request->has('serviceTo'),function ($query)use($request){
            $service_to = $request->get('serviceTo')=='murarkey'?1:0;
            return $query->where('serviceTo',$service_to);
        });
        return $masterQuery->paginate($request->per_page ? $request->per_page : 12);
    }

}
