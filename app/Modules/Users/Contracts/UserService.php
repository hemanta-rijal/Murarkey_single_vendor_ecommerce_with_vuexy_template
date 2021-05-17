<?php

namespace Modules\Users\Contracts;

interface UserService
{

    public function create($data, $permit);

    public function getPaginated($number = null);

    public function findById($id);

    public function updateByAdmin($id, $data);

    public function updateUserInfo($data);

    public function updatePassword($password, $id = null);

    public function updateSellerInfo($data, $id = null);

    public function updateCompanyInfo($data, $id = null);

    public function createSellerCompany($data, $permit, $id = null);

    public function getCompanyAssociates($companyId = null);

    public function searchForAssociateSellers($search);

    public function deleteAssociateSeller($userId, $force = false, $reason = null);

    public function deleteUserAccount($userId, $force = false, $reason = null);

    public function recoverUserAccount($id);

    public function getTrashItems();

    public function sellerTrash();
}
