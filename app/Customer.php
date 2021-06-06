<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'phone', 'mobile', 'city', 'province', 'address', 'gender', 'document', 'number_measurer', 'rate', 'half', 'code', 'observation',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function Route()
    {
        return $this->belongsTo('App\Route');
    }
}
