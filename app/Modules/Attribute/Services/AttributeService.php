<?php

namespace Modules\Attribute\Services;

use App\Models\Attribute;
use Modules\Attribute\Contracts\AttributeRepository;
use Modules\Attribute\Contracts\AttributeServiceRepository as AttributeServiceContract;

class AttributeService implements AttributeServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $attributeRepository;

    public function __construct(AttributeRepository $repository)
    {
        $this->attributeRepository = $repository;
    }

    public function getAll()
    {
        return Attribute::all();
    }
    public function create($data): Attribute
    {
        
        return $this->attributeRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->attributeRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->attributeRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->attributeRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->attributeRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }


}
