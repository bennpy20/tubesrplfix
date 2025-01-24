<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
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
        'amount',
        'jenis',
        'note',
        'date',
        'id_dompet',
        'id_user'
    ];

    /**
     * Indikator penggunaan timestamps.
     *
     * @var bool
     */
}