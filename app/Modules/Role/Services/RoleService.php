<?php

namespace Modules\Role\Services;

use App\Models\Role;
use Modules\Role\Contracts\RoleRepository;
use Modules\Role\Contracts\RoleServiceRepository as RoleServiceContract;

class RoleService implements RoleServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $roleRepository;

    public function __construct(RoleRepository $repository)
    {
        $this->roleRepository = $repository;
    }

    public function getAll()
    {
        return Role::all();
    }
    public function create($data): Role
    {

        return $this->roleRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->roleRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->roleRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->roleRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->roleRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

}
