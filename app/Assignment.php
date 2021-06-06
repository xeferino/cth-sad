<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignment_pollster';

    protected $fillable = [
        'period_id', 'pollster_id', 'route_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Canton()
    {
        return $this->hasMany('App\Canton');
    }

}
