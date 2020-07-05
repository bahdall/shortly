<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserIp
 *
 * @property int $id
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserIp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserIp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserIp query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserIp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserIp whereValue($value)
 * @mixin \Eloquent
 */
class UserIp extends Model
{
    public $timestamps = false;
}
