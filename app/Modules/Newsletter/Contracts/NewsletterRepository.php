<?php


namespace Modules\Newsletter\Contracts;


interface NewsletterRepository
{

    public function addSubscriber($email);

    public function getSubscribers();
}