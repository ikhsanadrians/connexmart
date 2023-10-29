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
        "desc",
        "category_id",
        "stand",
    ];

    public function transactions(){
      return $this->hasMany(Transaction::class)->withTrashed();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    protected static function booted(){
        static::creating(function($product){
            $product->slug = Str::slug($product->name);
        });
    }


}
