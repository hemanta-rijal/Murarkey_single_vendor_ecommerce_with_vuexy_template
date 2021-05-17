<?php

namespace Modules\Admin\Services;

use App\Models\Meta;
use Modules\Admin\Contracts\MetaRepository;
use Modules\Admin\Contracts\MetaService as MetaServiceContract;

class MetaService implements MetaServiceContract
{
    private $metaRepository;

    const DEFAULT_PAGINATION = 10;

    public function __construct(MetaRepository $repository)
    {
        $this->metaRepository = $repository;
    }

    public function create(array $data): Meta
    {
        return $this->metaRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->metaRepository->update($id, $data);
    }

    public function findById(int $id)
    {
        return $this->metaRepository->findById($id);
    }

    public function delete(int $id)
    {
        return $this->metaRepository->delete($id);
    }

    public function getPaginated(int $number = null)
    {
        return $this->metaRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

    public function findByKey($key)
    {
        return $this->metaRepository->findByKey($key);
    }

    public function updateSiteSettings($data, $logo = null)
    {
        if ($logo) {
            $data['logo'] = $logo->store('public/logo');
        }
        foreach ($data as $key => $value) {
            $this->metaRepository->updateValue($key, $value);
        }

    }
}
