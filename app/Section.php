<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'poll_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Poll()
    {
        return $this->hasMany('App\Poll');
    }

    public function Question()
    {
        return $this->hasMany('App\Question');
    }
}
