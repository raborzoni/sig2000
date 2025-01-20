<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Campos que podem ser preenchidos em massa (mass assignment)
    protected $fillable = [
        'name',
        'description',
    ];

    // Campos que devem ser ocultos ao serializar o modelo (opcional)
    protected $hidden = [
        // Exemplo: 'password', 'remember_token', etc.
    ];

    // Campos que devem ser convertidos para tipos nativos (opcional)
    protected $casts = [
        // Exemplo: 'is_admin' => 'boolean',
    ];
}
