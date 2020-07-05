<?php
declare(strict_types=1);

namespace App\Services\RequestGetter;

use App\Contracts\RequestRepositoryInterface;

class RequestGetter
{
    /**
     * @var RequestRepositoryInterface
     */
    private $repository;

    /**
     * @param string $value
     * @return int
     */
    public function getIdByValue(string $value): int
    {
        return $this->repository->getIdByValueOrCreate($value);
    }

    public function setRepository(RequestRepositoryInterface $repository): self
    {
        $this->repository = $repository;
        return $this;
    }
}
