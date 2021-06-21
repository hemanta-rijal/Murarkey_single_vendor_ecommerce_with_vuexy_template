<?php

namespace Modules\Users\Contracts;

interface UserRepository
{
    public function create($data);

    public function createSeller($seller);

    public function getPaginated(int $number);

    public function findById($id);

    public function findUserByEmail($email);

    public function getUsersById($userIdList);

    public function getCompanyAssociates($companyId);

    public function searchForAssociateSellers($search);

    public function updateRole($id, $role);

    public function getAssociateSellers($companyId);

    public function getTrashedItemById($id);

    public function getTrashItems();

}
