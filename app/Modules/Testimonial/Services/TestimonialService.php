<?php

namespace Modules\Testimonial\Services;

use App\Models\Testimonial;
use Modules\Testimonial\Contracts\TestimonialRepository;
use Modules\Testimonial\Contracts\TestimonialService as TestimonialServiceContract;

class TestimonialService implements TestimonialServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $TestimonialRepository;

    public function __construct(TestimonialRepository $repository)
    {
        $this->TestimonialRepository = $repository;
    }

    public function getAll()
    {
        return Testimonial::all();
    }
    public function getAllFeatured()
    {
        return Testimonial::where('featured', true)->get();
    }
    public function create($data): Testimonial
    {

        return $this->TestimonialRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->TestimonialRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->TestimonialRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->TestimonialRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->TestimonialRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

}
