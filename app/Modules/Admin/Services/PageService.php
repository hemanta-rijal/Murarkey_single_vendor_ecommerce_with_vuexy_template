<?php

namespace Modules\Admin\Services;

use App\Events\ContactFormPosted;
use App\Models\ContactUs;
use App\Models\Page;
use Modules\Admin\Contracts\PageRepository;
use Modules\Admin\Contracts\PageService as PageServiceContract;

class PageService implements PageServiceContract
{
    private $pageRepository;

    const DEFAULT_PAGINATION = 10;

    public function __construct(PageRepository $repository)
    {
        $this->pageRepository = $repository;
    }

    public function create($data): Page
    {
        return $this->pageRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->pageRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->pageRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->pageRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->pageRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function findBySlug($slug)
    {
        return $this->pageRepository->findBySlug($slug);
    }

    public function processContactForm($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = e($value);
        }

        $contactUs = $this->pageRepository->processContactForm($data);

        event(new ContactFormPosted($contactUs));
    }

    public function getContactUsList()
    {
        return ContactUs::when(request()->type, function ($query) {
            return $query->whereStatus(request()->type);
        })
            ->paginate();
    }

    public function updateContactUsStatus($id, $status)
    {
        return ContactUs::whereId($id)->update(['status' => $status]);
    }

    public function getContactUsById($id)
    {
        return ContactUs::findOrFail($id);
    }
}
