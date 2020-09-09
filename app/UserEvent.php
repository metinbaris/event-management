<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    protected $table = 'user_events';
    protected $fillable = ['user_id', 'event_id', 'token', 'email_verified_at', 'qrcode_verified_at'];
    protected $primaryKey = ['user_id', 'event_id'];
    public $incrementing = false;
}
