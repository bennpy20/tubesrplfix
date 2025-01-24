<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'username',
        'password',
        'email',
        'no_telepon',
        'role'
    ];

    /**
     * Kolom yang disembunyikan dalam array JSON.
     *
     * @var array
     */
    protected $hidden = [
        'password', // Kolom password harus disembunyikan
        'remember_token',
    ];

    /**
     * Indikator penggunaan timestamps.
     *
     * @var bool
     */
}