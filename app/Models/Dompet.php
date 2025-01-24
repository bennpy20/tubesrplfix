<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dompet extends Model
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
        'current_amount',
        'id_user',
    ];

    /**
     * Indikator penggunaan timestamps.
     *
     * @var bool
     */
}