<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vista extends Model
{
    use HasFactory;
    protected $fillable =[
        'ci',
        'nombre',
        'a_paterno',
        'a_materno',
        'sexo',
        'telefono',
        'direccion',
        'estado'
       
    ];
    
    public function user(){

            return $this->hasOne('App\Models\User');

    }
}
