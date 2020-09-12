<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\UserEvent
 *
 * @property int $user_id
 * @property int $event_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property \Illuminate\Support\Carbon|null $qrcode_verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\CompanyEvent|null $companyEvent
 * @property-read \App\User|null $user
 * @method static Builder|UserEvent newModelQuery()
 * @method static Builder|UserEvent newQuery()
 * @method static Builder|UserEvent query()
 * @method static Builder|UserEvent whereCreatedAt($value)
 * @method static Builder|UserEvent whereEmailVerifiedAt($value)
 * @method static Builder|UserEvent whereEventId($value)
 * @method static Builder|UserEvent whereQrcodeVerifiedAt($value)
 * @method static Builder|UserEvent whereToken($value)
 * @method static Builder|UserEvent whereUpdatedAt($value)
 * @method static Builder|UserEvent whereUserId($value)
 * @mixin \Eloquent
 */
class UserEvent extends Model
{
    protected $table = 'user_events';
    protected $primaryKey = ['user_id', 'event_id'];
    public $incrementing = false;
    protected $fillable = ['user_id', 'event_id', 'token', 'email_verified_at', 'qrcode_verified_at'];
    protected $dates = ['email_verified_at', 'qrcode_verified_at'];

    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->where('user_id', $this->getAttribute('user_id'))
            ->where('event_id', $this->getAttribute('event_id'));
    }

    public function companyEvent()
    {
        return $this->hasOne('App\CompanyEvent', 'id', 'event_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
