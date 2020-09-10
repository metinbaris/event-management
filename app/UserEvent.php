<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
}
