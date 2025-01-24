<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Budget extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'id',
        'label',
        'income',
        'expense',
        'periode',
        'id_user'
    ];

    /**
     * Indikator penggunaan timestamps.
     *
     * @var bool
     */
}
