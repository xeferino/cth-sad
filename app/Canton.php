<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'description'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Route()
    {
        return $this->hasMany('App\Route');
    }

    public function Assignment()
    {
        return $this->hasMany('App\Assignment');
    }
}
