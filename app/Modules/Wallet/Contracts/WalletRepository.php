<?php

namespace Modules\Wallet\Contracts;

interface WalletRepository
{
    public function findById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
