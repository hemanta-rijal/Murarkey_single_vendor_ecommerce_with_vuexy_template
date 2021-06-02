<?php


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