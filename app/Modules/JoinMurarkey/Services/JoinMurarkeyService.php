<?php

namespace Modules\JoinMurarkey\Services;

use App\Models\JoinMurarkey;
use Modules\JoinMurarkey\Contracts\JoinMurarkeyRepository;
use Modules\JoinMurarkey\Contracts\JoinMurarkeyService as JoinMurarkeyContract;

class JoinMurarkeyService implements JoinMurarkeyContract
{

    const DEFAULT_PAGINATION = 10;
    private $JoinMurarkeyRepository;

    public function __construct(JoinMurarkeyRepository $repository)
    {
        $this->JoinMurarkeyRepository = $repository;
    }

    public function getAll()
    {
        return JoinMurarkey::all();
    }
    public function getAllFeatured()
    {
        return JoinMurarkey::where('featured', true)->get();
    }
    public function create($data): JoinMurarkey
    {

        return $this->JoinMurarkeyRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->JoinMurarkeyRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->JoinMurarkeyRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->JoinMurarkeyRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->JoinMurarkeyRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

}
