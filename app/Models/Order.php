<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        "store_id",
        "user_id", 
        "payment_method",
        "status",
        "payment_status"
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,"order_details")->withPivot([
            
        ]);
    }

    public function addresses()
    {
        return $this->hasMany(OrderAdress::class);
    }

    public function billingAdress()
    {
        return $this->hasOne(OrderAdress::class,"order_id","id")->where("type", "=", "billing");
    }
    public function shippingAdress()
    {
        return $this->hasOne(OrderAdress::class,"order_id","id")->where("type", "=", "shipping");
    }

    //observer create number of order (yearNow+0000...)
    protected static function booted()
    {
        static::creating(function(Order $order)
        {
            // number form exemple => 20230001,20230002  
            $order->numder = Order::getNextOrderNumber();
        });
        // static::addGlobalScope("order",function(Builder $builder)
        // {
        //     $builder->where("store_id",Auth::user()->store->id);
        // });
    }

    public static function getNextOrderNumber()
    {
        $year = Carbon::now()->year;
        $number = Order::whereYear("created_at",$year)->max("numder");
        if($number)
        {
            return $number + 1;
        }
        return $year . "0001";
    } 

}
