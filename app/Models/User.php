<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // para que laravel use la tabla default
    protected $table = 'usuarios_homebanking';
    protected $primaryKey = 'pkusuario';

    protected $fillable = [
        'pkcliente',
        'username', // DNI o el usuario
        'password_hash', // en vez de 'password'
        'ultimo_acceso',
        'intentos_fallidos',
        'bloqueado',
        'activo',
    ];

    protected $hidden = [
        'password_hash',
        'token_refresh',
    ];

    // Mapeamos el campo de contraseña para que Auth de Laravel no se confunda
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}