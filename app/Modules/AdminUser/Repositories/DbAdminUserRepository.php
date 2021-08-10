<?php

namespace Modules\AdminUser\Repositories;

use App\Models\AdminUser;
use Modules\AdminUser\Contracts\AdminUserRepository;

class DbAdminUserRepository implements AdminUserRepository
{
    public function create($data)
    {
        $role = $data['role'];
        $admin_user = AdminUser::create($data);
        // sync role
        $role->users()->attach($admin_user);
        // dd($admin_user, $role, $role->permissions);
        // sync permission
        $admin_user->permissions()->attach($role->permissions);
        return $admin_user;
    }

    public function getPaginated(int $number)
    {
        return AdminUser::when(request('search'), function ($query) {
            return $query->search(request('search'));
        })
            ->paginate($number);
    }

    public function findById($id)
    {
        return AdminUser::findOrFail($id);
    }

    public function findUserByEmail($email)
    {
        return AdminUser::whereEmail($email)->firstOrFail();
    }

    public function getUsersById($userIdList)
    {
        return AdminUser::find($userIdList);
    }

    public function updateRole($id, $role)
    {
        return AdminUser::where('id', $id)->update(['role' => $role]);
    }

}
