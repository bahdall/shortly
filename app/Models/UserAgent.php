<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserAgent
 *
 * @property int $id
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAgent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAgent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAgent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAgent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAgent whereValue($value)
 * @mixin \Eloquent
 */
class UserAgent extends Model
{
    public $timestamps = false;
}
