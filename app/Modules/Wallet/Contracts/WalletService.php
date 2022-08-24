<?php

namespace Modules\Wallet\Contracts;

interface WalletService
{
    public function findById($id);
    public function getAll();
    public function getAllByUserId($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function getPaginated($number=null);
    public function getPaginationConstant();
    public function setWalletRequest($user_id,$amount,$paymentMethod,$transaction_type,$description,$status);
    public function getWalletAmountByUser($user_id);
    public function checkTransactionPayable($user,$amount);


}
