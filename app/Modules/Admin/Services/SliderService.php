<?php

namespace Modules\Admin\Services;

use Modules\Admin\Contracts\SliderRepository;
use Modules\Admin\Contracts\SliderService as SliderServiceContract;

class SliderService implements SliderServiceContract
{
    private $sliderRepository;

    const DEFAULT_PAGINATION = 10;

    public function __construct(SliderRepository $repository)
    {
        $this->sliderRepository = $repository;
    }

    public function create(array $data, $image)
    {
        $data['image'] = $image->store('public/sliders');
        return $this->sliderRepository->create($data);
    }

    public function update(int $id, array $data, $image)
    {
        if ($image) {
            $data['image'] = $image->store('public/sliders');
        }

        return $this->sliderRepository->update($id, $data);
    }

    public function findById(int $id)
    {
        return $this->sliderRepository->findById($id);
    }

    public function delete(int $id)
    {
        return $this->sliderRepository->delete($id);
    }

    public function getPaginated(int $number = null)
    {
        return $this->sliderRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function getSlides()
    {
        return $this->sliderRepository->getSlides();
    }
}
