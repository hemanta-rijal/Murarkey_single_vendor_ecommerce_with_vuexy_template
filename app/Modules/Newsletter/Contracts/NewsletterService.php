<?php

namespace Modules\Newsletter\Contracts;

interface NewsletterService
{

    public function addSubscriber($email);

    public function getSubscribers();

    public function findById($id);

    public function delete($id);
}
