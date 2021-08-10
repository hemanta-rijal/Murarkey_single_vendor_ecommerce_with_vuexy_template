<?php

namespace Modules\AdminUser\Contracts;

interface AdminUserRepository
{
    public function create($data);

    public function getPaginated(int $number);

    public function findById($id);

    public function findUserByEmail($email);

    public function getUsersById($userIdList);

    public function updateRole($id, $role);

}
