<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\CompanyEvent
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyEvent whereUrl($value)
 * @mixin \Eloquent
 */
class CompanyEvent extends Model
{
    protected $table = 'company_events';
    protected $fillable = ['id','name',''];
    protected $dates = [
        'start',
        'end',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_events', 'event_id', 'user_id');
    }
}
