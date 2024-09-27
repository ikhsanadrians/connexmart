<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        "name",
        "slug",
        "price",
        "stock" ,
        "photo",
        "barcode_number",
        "quantity_sold",
        "desc",
        "category_id",
        "merk_id",
        "stand",
    ];

    public function transactions(){
      return $this->hasMany(Transaction::class)->withTrashed();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function merk(){
        return $this->belongsTo(Merk::class);
    }


    public function stokProduk(){
        return $this->hasMany(StokProduk::class);
    }

    protected static function booted(){
        static::creating(function($product){
            $product->slug = Str::slug($product->name);
        });
        static::created(function($product){
            $stokProduk = StokProduk::create([
                'statusenabled' => true,
                'product_id' => $product->id,
                'keterangan' => 'STOK AWAL PRODUK BARU:, ' . now(),
                'stokawal' => 0,
                'qtyin' => 0,
                'qtyout' => 0,
                'stok_akhir' => 0,
            ]);

            $product->stock = $stokProduk->stok_akhir;
            $product->save();
        });
    }


}