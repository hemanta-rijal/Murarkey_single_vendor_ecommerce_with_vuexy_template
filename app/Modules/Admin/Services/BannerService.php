<?php

namespace Modules\Admin\Services;

use Modules\Admin\Contracts\BannerRepository;
use Modules\Admin\Contracts\BannerService as BannerServiceContract;

class BannerService implements BannerServiceContract
{
    private $bannerRepository;

    const DEFAULT_PAGINATION = 10;

    public function __construct(BannerRepository $repository)
    {
        $this->bannerRepository = $repository;
    }

    public function create(array $data, $image)
    {
        $data['image'] = $image->store('public/sliders');
        return $this->bannerRepository->create($data);
    }

    public function update(int $id, array $data, $image)
    {
        if ($image) {
            $data['image'] = $image->store('public/sliders');
        }

        return $this->bannerRepository->update($id, $data);
    }

    public function findById(int $id)
    {
        return $this->bannerRepository->findById($id);
    }

    public function delete(int $id)
    {
        return $this->bannerRepository->delete($id);
    }

    public function getPaginated(int $number = null)
    {
        return $this->bannerRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function findByType($type)
    {
        return $this->bannerRepository->findByType($type);
    }

    public function findAllByType($type)
    {
        return $this->bannerRepository->findAllByType($type);
    }
}
