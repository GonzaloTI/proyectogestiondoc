<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class caso extends Model
{
    use HasFactory;

    protected $fillable =[
        'titulo',
        'numero',
        'corte',
        'juez_id',
        'estado',
        'tipo',
    ];

   
    public function juez(){
        return $this->belongsTo(juece::class);
    }
}
