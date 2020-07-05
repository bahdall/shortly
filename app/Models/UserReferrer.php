<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserReferrer
 *
 * @property int $id
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReferrer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReferrer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserReferrer query()
 * @mixin \Eloquent
 */
class UserReferrer extends Model
{
    public $timestamps = false;
}
