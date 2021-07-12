<?php

namespace Modules\Service\Services;

use App\Models\Service;
use Modules\Service\Contracts\ServiceRepository;
use Modules\Service\Contracts\ServiceService as ServiceServiceContract;

class ServiceService implements ServiceServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $ServiceRepository;

    public function __construct(ServiceRepository $repository)
    {
        $this->ServiceRepository = $repository;
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

    public function delete($id)
    {
        return $this->ServiceRepository->delete($id);
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

}
