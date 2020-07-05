<?php
declare(strict_types=1);

namespace App\Contracts;

interface RequestRepositoryInterface
{
    /**
     * @param string $value
     * @return int
     */
    public function getIdByValueOrCreate(string $value): int;

    /**
     * @param string $value
     * @return int
     */
    public function getIdByValue(string $value): ?int;

    /**
     * @param string $value
     * @return int
     */
    public function create(string $value): int;
}
