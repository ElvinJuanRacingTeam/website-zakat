<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $fillable = [
        'user_id',
        'no_kwitansi',
        'nama',
        'alamat',
        'atas_nama',
        'zakat_fitrah_rp',
        'zakat_fitrah_kg',
        'zakat_mal',
        'infaq_shodaqoh',
        'fidya',
        'total',
        'metode_pembayaran'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {

            if (!$model->no_kwitansi) {
                $model->no_kwitansi = 'KW-' . date('YmdHis') . '-' . Str::upper(Str::random(4));
            }

        });
    }
}