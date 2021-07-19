<?php
namespace Modules\Faq\Services;

use Modules\Faq\Contracts\FaqRepository;
use Modules\Faq\Contracts\FaqServiceRepository;

class FaqServices implements FaqServiceRepository
{
    protected $faqRepository;
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }
    public function getAll()
    {
        return $this->faqRepository->getAll();
    }
    public function create($data)
    {
        return $this->faqRepository->create($data);
    }
    public function findById($id)
    {
        return $this->faqRepository->findById($id);
    }
    public function delete($id)
    {
        return $this->faqRepository->delete($id);
    }
    public function update($id, $data)
    {
        return $this->faqRepository->update($id, $data);
    }
}
