<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'code', 'custormer_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Custormer()
    {
        return $this->hasMany('App\Customer');
    }

    public function Canton()
    {
        return $this->hasMany('App\Canton', 'id', 'canton_id');
    }
}
