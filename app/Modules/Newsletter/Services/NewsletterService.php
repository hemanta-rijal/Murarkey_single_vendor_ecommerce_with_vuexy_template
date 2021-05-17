<?php


namespace Modules\Newsletter\Services;


use Modules\Newsletter\Contracts\NewsletterRepository;
use Modules\Newsletter\Contracts\NewsletterService as NewsletterServiceContract;

class NewsletterService implements NewsletterServiceContract
{

    private $newsletterRepository;

    /**
     * NewsletterService constructor.
     * @param $newsletterRepository
     */
    public function __construct(NewsletterRepository $newsletterRepository)
    {
        $this->newsletterRepository = $newsletterRepository;
    }


    public function addSubscriber($email)
    {
        $this->newsletterRepository->addSubscriber($email);
    }

    public function getSubscribers()
    {
        return $this->newsletterRepository->getSubscribers();
    }
}