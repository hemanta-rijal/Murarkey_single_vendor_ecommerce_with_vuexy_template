<?php

namespace Modules\AdminUser\Contracts;

interface AdminUserService
{

    public function create($data);

    public function getPaginated($number = null);

    public function findById($id);

    public function updateByAdmin($id, $data);

    public function updateUserInfo($data);

    public function updatePassword($password, $id = null);

    public function deleteUserAccount($userId, $force = false, $reason = null);
}
