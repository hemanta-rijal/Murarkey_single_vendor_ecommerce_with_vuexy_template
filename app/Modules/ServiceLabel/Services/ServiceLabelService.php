<?php

namespace Modules\ServiceLabel\Services;

use App\Models\ServiceLabel;
use Modules\ServiceLabel\Contracts\ServiceLabelRepository;
use Modules\ServiceLabel\Contracts\ServiceLabelServiceRepository as ServiceLabelServiceContract;

class ServiceLabelService implements ServiceLabelServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $erviceLabelRepository;

    public function __construct(ServiceLabelRepository $repository)
    {
        $this->serviceLabelRepository = $repository;
    }

    public function getAll()
    {
        return ServiceLabel::all();
    }
    public function create($data): ServiceLabel
    {

        return $this->serviceLabelRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->serviceLabelRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->serviceLabelRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->serviceLabelRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->serviceLabelRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

}
