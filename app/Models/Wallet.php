<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\DetailSaldoBank;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
       "user_id",
       "norec",
       "credit",
       "debit"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detailSaldoBank(){
        return $this->hasMany(DetailSaldoBank::class);
    }

    protected static function booted(){
        static::created(function($wallet){
            $wallet->norec = generate_norec_number();
            $wallet->save();
        });
        
        static::created(function($wallet){
            $detailSaldo = DetailSaldoBank::create([
                'statusenabled' => true,
                'wallet_id' => $wallet->id,
                'keterangan' => 'PEMBUKAAN SALDO BARU:, ' . now(),
                'saldoawal' => 0,
                'saldoin' => 0,
                'saldoout' => 0,
                'saldoakhir' => 0,
            ]);
        });
    }


}
