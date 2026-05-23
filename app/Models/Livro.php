<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'nome',
        'autor',
        'id_usuario_emprestado'
    ];
    public function usuarioEmprestado()
    {
        return $this->belongsTo(User::class, 'id_usuario_emprestado');
    }
}
