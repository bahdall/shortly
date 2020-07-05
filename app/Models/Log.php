<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Log
 *
 * @property int $id
 * @property int $link_id
 * @property int $token_id
 * @property int $user_agent_id
 * @property int $user_ip_id
 * @property int $referrer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereLinkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereReferrerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereTokenId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereUserAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereUserIpId($value)
 * @mixin \Eloquent
 */
class Log extends Model
{
    //
}
