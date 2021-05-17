<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/4/18
 * Time: 8:53 AM
 */

namespace Modules\Cart\Contracts;


interface WishlistService
{

    public function getCartByUser($user);

    public function add($user, $all);

    public function delete($user, $rowId);

    public function update($user, $rowId, $data);
}