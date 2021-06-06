<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'type', 'section_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Section()
    {
        return $this->hasMany('App\Section', 'id', 'section_id');
    }

    public function Option()
    {
        return $this->hasMany('App\Option');
    }
}
