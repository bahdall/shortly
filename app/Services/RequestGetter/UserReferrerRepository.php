<?php
declare(strict_types=1);

namespace App\Services\RequestGetter;

use App\Contracts\RequestRepositoryInterface;
use App\Models\UserReferrer;

class UserReferrerRepository implements RequestRepositoryInterface
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
        /** @var UserReferrer $model */
        $model = UserReferrer::where('value', $value)->first();

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
}
