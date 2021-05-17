<?php
/**
 * Created by PhpStorm.
 * User: bishnubhusal
 * Date: 10/8/18
 * Time: 3:21 PM
 */

namespace App\Traits;


trait UserTypeTrait
{

    /**
     * return user type ie general or seller
     */
    public function getUserType()
    {
        $user = auth()->user();

        return $user->isSeller() ? 'seller' : 'general';
    }
}