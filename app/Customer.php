<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'tb_clientes';

    protected $primaryKey = 'idcliente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'documento', 'nombres', 'apellidos', 'telefono', 'direccion', 'email', 'tipo cliente', 'razon social', 'giro', 'comuna', 'region', 'ciudad'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
