<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallecaso extends Model
{
    use HasFactory;
    protected $fillable =[
        'caso_id',
        'rol',
        'vista_id',
        'abogado_id',
    ];

    public function vista(){
        //relacion uno a uno
        return $this->hasOne('App\Models\vista');
    }
    public function abogado(){
        //relacion uno a uno
        return $this->hasOne('App\Models\abogado');
    }
}
