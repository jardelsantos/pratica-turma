<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topico extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'conteudo',
        'ordem',
        'curso_id'
    ];
}
