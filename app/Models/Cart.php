<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Cart extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $fillable = ["cookie_id","user_id","product_id","quantity"];

    protected static function booted(){

        static::observe(CartObserver::class);
        
        // static::addGlobalScope("cookie_id",function(Builder $builder){
        //     $builder->where("cookie_id", "=", $this->getCookieId());
        // });

        // show the same code in cart observer class ⬇
        // static::creating(function(Cart $cart){
        //     $cart->id = Str::uuid();
        // });
    }

    public function products()
    {
        return $this->belongsTo(Product::class,"product_id")->withDefault(
            ["slug"=>"product"]
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}