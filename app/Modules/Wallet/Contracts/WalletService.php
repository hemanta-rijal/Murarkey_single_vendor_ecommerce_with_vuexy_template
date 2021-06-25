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

}
