<?php

namespace Modules\Users\Services;

use App\Models\Seller;
use App\Models\User;
use Modules\Companies\Contracts\CompanyRepository;
use Modules\MessageCenter\Contracts\InvitationMessageRepository;
use Modules\Products\Contracts\ProductRepository;
use Modules\Users\Contracts\UserRepository;
use Modules\Users\Contracts\UserService as UserServiceContract;

class UserService implements UserServiceContract
{
    const DEFAULT_PAGINATION = 10;

    protected $userRepository;
    protected $companyRepository;
    protected $invitationMessageRepository;
    protected $productRepository;
    protected $companyService;

    public function __construct(UserRepository $userRepository, CompanyRepository $companyRepository, InvitationMessageRepository $invitationMessageRepository, ProductRepository $productRepository, \Modules\Companies\Contracts\CompanyService $companyService)
    {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->invitationMessageRepository = $invitationMessageRepository;
        $this->productRepository = $productRepository;
        $this->companyService = $companyService;
    }

    public function create($data)
    {
        try {

            if (!isset($data['role'])) {
                $data['role'] = 'user';
            }
            $data['password'] = bcrypt($data['password']);

            return \DB::transaction(function () use ($data) {
                $user = $this->userRepository->create($data);
                return $user;
            });

        } catch (\PDOException $th) {
            return response()->json([
                'data' => [],
                'success' => false,
                'status' => 500,
                'message' => $th->get_message(),
            ]);
        }

    }

    public function verify($token)
    {
        return $this->userRepository->verify($token);
    }

    public function getPaginated($number = null)
    {
        return $this->userRepository->getPaginated($this->getPaginationConstant($number));
    }

    private function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function updateByAdmin($id, $data)
    {
        $user = $this->findById($id);

        if (empty($data['user']['password'])) {
            unset($data['user']['password']);
        } else {
            $data['user']['password'] = bcrypt($data['user']['password']);
        }

        return \DB::transaction(function () use ($user, $data) {

            if ($user->role != 'ordinary-user') {
                $user->seller->update($data['seller']);
            }

            return $user->fill($data['user'])->save();
        });
    }

    public function updateUserInfo($data, $id = null)
    {
        $user = $id ? $this->findById($id) : auth()->user();
        if ($data['email'] != $user->email) {
            $data['verified'] = false;
        }
        if ($data['phone_number'] != $user->phone_number) {
            $data['phone_number_verificaion'] = false;
        }

        return $user->fill($data)->save();
    }

    public function updatePassword($password, $id = null)
    {
        $user = $id ? $this->findById($id) : auth()->user();
        $user->password = bcrypt($password);

        return $user->save();
    }

    public function updateSellerInfo($data, $id = null)
    {
        $user = $id ? $this->findById($id) : auth()->user();

        return $user->seller->update($data);
    }

    public function updateCompanyInfo($data, $id = null)
    {
        $user = $id ? $this->findById($id) : auth()->user();

        return $user->seller->company->update($data);
    }

    public function createSellerCompany($data, $permit, $id = null)
    {
        $user = $id ? $this->findById($id) : auth()->user();

        \DB::transaction(function () use ($user, $permit, $data) {
            if ($permit) {
                $data['company']['government_business_permit'] = $permit->store('public/companies');
            }

            $data['company']['owner_id'] = $user->id;
            $company = $this->companyRepository->create($data['company']);
            //Create Seller Account
            $data['seller']['company_id'] = $company->id;
            $data['seller']['user_id'] = $user->id;
            $seller = $this->userRepository->createSeller($data['seller']);

            $user->role = User::MainSeller;
            $user->save();

            return $seller;
        });

    }

    public function getCompanyAssociates($companyId = null)
    {
        $companyId = auth()->user()->seller->company_id;

        return $this->userRepository->getCompanyAssociates($companyId);
    }

    public function searchForAssociateSellers($search)
    {
        $search = str_replace(' ', '', $search);

        $companyId = auth()->user()->seller->company_id;

        $users = $this->userRepository->searchForAssociateSellers($search);
        $invitations = $this->invitationMessageRepository->getInvitedAssociates($companyId);

        $users->map(function ($user) use ($companyId, $invitations) {
            $user->is_your_associate_seller = $user->company_id == $companyId;

            $user->invitation = $invitations->where('to', $user->id)->where('company_id', $companyId)->first();
        });

        return $users;
    }

    public function deleteAssociateSeller($userId, $force = false, $reason = null)
    {
        //transfer ownership
        //remove seller
        //change role to ordinary-user
        $user = $this->findById($userId);
        \DB::transaction(function () use ($user, $force, $reason) {
            $deleteType = $force ? 'forceDelete' : 'delete';
//            $this->productRepository->transferOwnerShip($user->seller->company_id, $user->id, $user->seller->company->owner_id);
            $seller = $user->seller()->withTrashed()->first();
            $this->productRepository->removeProductSeller($seller->company_id, $user->id);

            if (!$force && $reason) {
                $user->seller()->update(['delete_reason' => $reason]);
            }

            $user->seller()->{$deleteType}();

            $user->role = User::OrdinaryUser;

            $user->save();
        });
    }

    public function getAssociateSellers($companyId = null)
    {
        $companyId = $companyId ? $companyId : auth()->user()->seller->company_id;

        $sellers = $this->userRepository->getAssociateSellers($companyId);
        $sellers->load('seller');

        return $sellers;
    }

    public function deleteUserAccount($userId, $force = false, $reason = null)
    {
        $user = User::withTrashed()->findOrFail($userId);

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

    public function recoverUserAccount($id)
    {
        $user = $this->userRepository->getTrashedItemById($id);

        \DB::transaction(function () use ($user) {
            $user->restore();

            $user->delete_reason = null;

            $user->save();
        });

        return $user;
    }

    public function getTrashItems()
    {
        return $this->userRepository->getTrashItems();
    }

    public function sellerTrash()
    {
        return Seller::onlyTrashed()->whereNotNull('delete_reason')->whereHas('user')->with(['user', 'company'])->paginate();
    }

}
