<?php
declare(strict_types=1);

namespace App\Services\RequestGetter;

use App\Contracts\RequestRepositoryInterface;
use App\Models\UserIp;

class UserIpRepository implements RequestRepositoryInterface
{

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
     */
    public function getIdByValue(string $value): ?int
    {
        /** @var UserIp $model */
        $model = UserIp::where('value', $value)->first();

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
        $model = new UserIp();
        $model->value = $value;
        $model->save();

        return $model->id;
    }
}
