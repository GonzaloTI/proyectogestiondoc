<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demanda extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'caso_id',
        'file_path',       
    ];
}
