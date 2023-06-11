<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expediente extends Model
{
    use HasFactory;
    protected $fillable = [
        'asunto',
        'caso_id',
        'file_path',
        
    ];
}
