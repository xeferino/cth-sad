<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'question_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Question()
    {
        return $this->hasMany('App\Question');
    }

    public function Item()
    {
        return $this->hasMany('App\OptionItem');
    }
}
