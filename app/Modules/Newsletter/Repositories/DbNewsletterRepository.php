<?php

namespace Modules\Newsletter\Repositories;

use App\Models\NewsletterSubscriber;
use Modules\Newsletter\Contracts\NewsletterRepository;

class DbNewsletterRepository implements NewsletterRepository
{
    public function addSubscriber($email)
    {
        if (NewsletterSubscriber::whereEmail($email)->count() == 0) {
            return NewsletterSubscriber::create(['email' => $email]);
        }

    }

    public function getSubscribers()
    {
        return NewsletterSubscriber::when(request()->search, function ($query) {
            return $query->where('emai', 'LIKE', '%' . request()->search . '%');
        })
            ->paginate(10);
    }
}
