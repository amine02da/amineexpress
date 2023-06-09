<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAdress extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "order_id",
        "type",
        "first_name",
        "last_name",
        "email",
        "phone_number",
        "street_adress",
        "city",
        "postal_code",
        "state",
        "country"
    ];

 
}
