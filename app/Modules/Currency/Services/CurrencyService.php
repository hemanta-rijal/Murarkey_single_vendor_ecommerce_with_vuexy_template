<?php

namespace Modules\Currency\Services;

use App\Models\Currency;
use Modules\Currency\Contracts\CurrencyRepository;
use Modules\Currency\Contracts\CurrencyServiceRepository as CurrencyServiceContract;

class CurrencyService implements CurrencyServiceContract
{

    const DEFAULT_PAGINATION = 10;
    private $currencyRepository;

    public function __construct(CurrencyRepository $repository)
    {
        $this->currencyRepository = $repository;
    }

    public function getAll()
    {
        return Currency::all();
    }
    public function create($data): Currency
    {

        return $this->currencyRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->currencyRepository->update($id, $data);
    }

    public function findById($id)
    {
        return $this->currencyRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->currencyRepository->delete($id);
    }

    public function getPaginated($number = null)
    {
        return $this->currencyRepository
            ->getPaginated(
                $this->getPaginationConstant($number)
            );
    }

    public function getPaginationConstant($number = null)
    {
        return $number == null ? self::DEFAULT_PAGINATION : $number;
    }

}
