<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Token
 *
 * @property int $id
 * @property string $token
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Token extends Model
{
    //
}
