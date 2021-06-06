<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionItem extends Model
{
    protected $table = 'options_items';

    protected $fillable = [
        'name', 'option_id',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Option()
    {
        return $this->hasMany('App\Option');
    }

}
