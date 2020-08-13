<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyEvent extends Model
{
    protected $table = 'company_events';
    protected $dates = [
        'start',
        'end',
    ];
}
