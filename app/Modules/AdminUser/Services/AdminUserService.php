<?php

namespace Modules\AdminUser\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\AdminUser\Contracts\AdminUserRepository;
use Modules\AdminUser\Contracts\AdminUserService as AdminUserServiceContract;
use Modules\Role\Services\RoleService;
use PDOException;

class AdminUserService implements AdminUserServiceContract
{
    const DEFAULT_PAGINATION = 10;

    protected $adminRepository;
    protected $roleService;

    public function __construct(AdminUserRepository $adminRepository, RoleService $roleService)
    {
        $this->adminRepository = $adminRepository;
        $this->roleService = $roleService;
    }

    public function create($data)
    {
        try {

            $data['role'] = $this->roleService->findById($data['role_id']);
            $data['password'] = bcrypt($data['password']);

            return \DB::transaction(function () use ($data) {
                $user = $this->adminRepository->create($data);
                return $user;
            });

        } catch (\PDOException $th) {
            return response()->json([
                'data' => [],
                'success' => false,
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }

    }

    public function getPaginated($number = null)
    {
        return $this->adminRepository->getPaginated($this->getPaginationConstant($number));
    }

    private function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function findById($id)
    {
        return $this->adminRepository->findById($id);
    }

    public function updateByAdmin($id, $data)
    {
        $user = $this->findById($id);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }
        $data['role'] = $this->roleService->findById($data['role_id']);

        return \DB::transaction(function () use ($user, $data) {
            $data['role'] = $this->roleService->findById($data['role_id']);
            $user->permissions()->sync($data['role']->permissions);
            return $user->fill($data)->save();
        });
    }

    public function updateUserInfo($data, $id = null)
    {
        $user = $id ? $this->adminRepository->findById($id) : Auth::guard('web')->user();
        dd($user);
        if ($data['email'] !== $user->email) {
            $user->fill($data)->save();
            Auth::guard('web')->logout();
            flash('User details updated successfully ')->success();
            Session()->flash('success', 'User details updated successfully ');
            return $user;
        }

        Session()->flash('success', 'User details updated successfully');
        $user = $user->fill($data)->save();
        //send verify email with notification and redirect

    }

    public function updatePassword($password, $id = null)
    {
        $user = $id ? $this->findById($id) : Auth::guard('web')->user();
        $user->password = bcrypt($password);

        return $user->save();
    }

    public function deleteUserAccount($userId, $force = false, $reason = null)
    {
        $user = $userId ? $this->adminRepository->findById($userId) : Auth::guard('web')->user();
        \DB::transaction(function () use ($user, $force, $reason) {
            // $deleteType = $force ? 'forceDelete' : 'delete';
            // if (!$force) {
            //     $user->delete_reason = $reason;
            //     $user->save();
            // }
            // $user->{$deleteType}();

            return $user->delete();
        });
    }

    public function deleteBulkUsers($userIds, $force = false, $reason = null)
    {
        $users = User::withTrashed()->findOrFail($userIds);
        return users;

        \DB::transaction(function () use ($user, $force, $reason) {
            $deleteType = $force ? 'forceDelete' : 'delete';

            switch ($user->role) {
                case User::OrdinaryUser:
                    break;
                case User::AssociateSeller:
                    $this->deleteAssociateSeller($user->id, $force);
                    break;
                case User::MainSeller:
                    $this->companyService->delete($user->seller->company_id, $force);
                    break;
            }

            if (!$force) {
                $user->role = User::OrdinaryUser;
                $user->delete_reason = $reason;
                $user->save();
            }

            $user->{$deleteType}();

        });
    }

}
