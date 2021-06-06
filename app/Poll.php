<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Section()
    {
        return $this->hasMany('App\Section');
    }

    public function Period()
    {
        return $this->belongsTo('App\PollOpen');
    }
}
