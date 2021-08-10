<?php

namespace Modules\Users\Repositories;

use App\Models\AdminUser;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Users\Contracts\UserRepository;

class DbUserRepository implements UserRepository
{
    public function create($data)
    {
        if ($data['role'] == 'user') {
            return User::create($data);
        } else {
            $role = $data['role'];
            $data['name'] = $data['first_name'] . ' ' . $data['last_name'];
            $data['role_id'] = $data['role']->id;
            $admin_user = AdminUser::create($data);
            // sync role
            $role->users()->attach($admin_user);
            // dd($admin_user, $role, $role->permissions);
            // sync permission
            $admin_user->permissions()->attach($role->permissions);

            return $admin_user;
        }
    }

    public function createSeller($seller)
    {
        return Seller::create($seller);
    }

    public function verify($token)
    {
        return User::where(\DB::raw('MD5(email)'), $token)->update(['verified' => 1]);
    }

    public function getPaginated(int $number)
    {
        return User::when(request('search'), function ($query) {
            return $query->search(request('search'));
        })
            ->paginate($number);
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function findUserByEmail($email)
    {
        return User::whereEmail($email)->firstOrFail();
    }

    public function getUsersById($userIdList)
    {
        return User::find($userIdList);
    }

    public function getCompanyAssociates($companyId)
    {
        return User::where('role', '<>', 'main-seller')
            ->whereHas('seller', function ($query) use ($companyId) {
                return $query->where('company_id', $companyId);
            })->get();
    }

    public function searchForAssociateSellers($search)
    {
        return User::where('role', '<>', 'main-seller')
            ->where(function ($query) use ($search) {
                foreach (explode(',', $search) as $email) {
                    $query->orWhere('email', $email);
                }

                return $query;
            })
            ->with(['seller' => function ($query) {
                return $query->select('company_id');
            }])
            ->get();
    }

    public function updateRole($id, $role)
    {
        return User::where('id', $id)->update(['role' => $role]);
    }

    public function getAssociateSellers($companyId)
    {
        return User::where('role', User::AssociateSeller)
            ->whereHas('seller', function ($query) use ($companyId) {
                return $query->where('company_id', $companyId);
            })->get();
    }

    public function getTrashedItemById($id)
    {
        return User::onlyTrashed()->whereId($id)->firstOrFail();
    }

    public function getTrashItems()
    {
        return User::onlyTrashed()->paginate();
    }

}
