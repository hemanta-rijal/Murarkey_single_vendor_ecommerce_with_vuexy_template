<?php

namespace Modules\Role\Repositories;

use App\Models\Permission;
use App\Models\Role;
use Modules\Role\Contracts\RoleRepository;

class DbRoleRepository implements RoleRepository
{
    public function create($data): Role
    {
        return \DB::transaction(function () use ($data) {
            $role = Role::create($data);

            $permissions = [];
            if (isset($data['permissions'])) {
                foreach ($data['permissions'] as $key => $permission) {
                    $db_permission = Permission::where('slug', $key)->first();
                    $role->permissions()->attach($db_permission);

                }
            }
            return $role;
        });

    }

    public function findById($id)
    {
        return Role::findOrFail($id);
    }

    public function getAll()
    {
        return Role::all();
    }
    public function update($id, $data)
    {
        return \DB::transaction(function () use ($id, $data) {
            $role = $this->findById($id);
            $role->update(['name' => $data['name'], 'slug' => $data['slug']]);
            $permissions = [];
            if (isset($data['permissions'])) {
                foreach ($data['permissions'] as $key => $permission) {
                    $permissions[] = Permission::where('slug', $key)->first()->id;
                }
                $role->permissions()->sync($permissions);
                foreach ($role->users as $user) {
                    $user->permissions()->sync($permissions);
                }
            }
            return $role;
        });

        return $this->findById($id)->update($data);
    }

    public function delete($id)
    {
        $node = $this->findById($id);

        return $node->delete();
    }

    public function getPaginated($number)
    {
        return Role::when(request()->search, function ($query) {
            return $query->search(request()->search);
        })
            ->paginate($number);
    }

}