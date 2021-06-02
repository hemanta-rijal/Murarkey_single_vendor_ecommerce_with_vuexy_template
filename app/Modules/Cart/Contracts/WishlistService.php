<?php

namespace Modules\Cart\Contracts;


interface WishlistService
{

    public function getCartByUser($user);

    public function add($user, $all);

    public function delete($user, $rowId);

    public function update($user, $rowId, $data);
}