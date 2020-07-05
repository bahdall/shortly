<?php
declare(strict_types=1);

namespace App\Services\RequestGetter;

use App\Contracts\RequestRepositoryInterface;
use App\Models\UserAgent;
use App\Models\UserReferrer;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class UserReferrerRepository implements RequestRepositoryInterface
{
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * UserAgentRepository constructor.
     * @param CacheInterface $cache
     */
    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @param string $value
     * @return int
     */
    public function getIdByValueOrCreate(string $value): int
    {
        $id = $this->getIdByValue($value);

        if (is_null($id)) {
            $id = $this->create($value);
        }

        return $id;
    }

    /**
     * @param string $value
     * @return int|null
     * @throws InvalidArgumentException
     */
    public function getIdByValue(string $value): ?int
    {
        $cacheKey = $this->getCacheKey($value);

        if ($this->cache->has($cacheKey)) {
            $model = $this->cache->get($cacheKey);
        } else {
            /** @var UserReferrer $model */
            $model = UserReferrer::where('value', $value)->first();
            $this->cache->set($cacheKey, $model, 60);
        }

        if (is_null($model)) {
            return null;
        }

        return $model->id;
    }

    /**
     * @param string $value
     * @return int
     */
    public function create(string $value): int
    {
        $model = new UserReferrer();
        $model->value = $value;
        $model->save();

        return $model->id;
    }

    /**
     * @param string $value
     * @return string
     */
    private function getCacheKey(string $value): string
    {
        return sha1(__CLASS__.':'.$value);
    }
}
