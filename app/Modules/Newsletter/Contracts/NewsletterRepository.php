<?php

namespace Modules\Newsletter\Contracts;

interface NewsletterRepository
{

    public function addSubscriber($email);

    public function getSubscribers();

    public function findById($id);

    public function delete($id);

}
