<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Tarefa extends Model
{


    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'prioridade',
        'estado',
        'data_vencimento',
    ];
}
