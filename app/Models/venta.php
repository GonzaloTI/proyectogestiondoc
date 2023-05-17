<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;

    protected $fillable =[
        
        'fecha',
        'monto_total',
        'forma_pago',
        'cliente_id',
        'factura_id',
       'user_id'
    ];



    public function cuota(){
        //relacion uno a muchos
        return $this->hasMany('App\Models\cuota');
    }

    public function cliente(){
        //relacion uno a muchos , la llave de venta se viene a cuotas
        //inversa
        return $this->belongsTo('App\Models\cliente');
    }


    public function factura(){
        //relacion uno a uno con factura
        //inversa
        return $this->belongsTo('App\Models\factura');
    }

    public function user(){
        //relacion uno a muchos , con user
        //inversa
        return $this->belongsTo('App\Models\User');
    }



}
