<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSaldoBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'statusenabled',
        'keterangan',
        'wallet_id',
        'saldoawal',
        'saldoin',
        'saldoout',
        'saldoakhir',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    
}
