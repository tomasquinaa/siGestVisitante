<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogAcesso extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'logs_acesso';
    protected $fillable = [
        'descricao',
        'browser',
        'ip',
        'informacao',
        'nome_maquina',
        'name',
        'agente',
        'so',
        'user_id',
        'estado_id',
    ];

    // public function estado()
    // {
    //     return $this->belongsTo(Estado::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
