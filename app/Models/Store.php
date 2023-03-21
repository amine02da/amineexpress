<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Store extends Model
{
    use HasFactory ,Notifiable; 
    const CREATED_AT = "created_at";  

    const UPDATED_AT = "updated_at";

    protected $connection = "mysql"; 

    public $timestamp = true;

    protected $fillable = ["id","name","slug","description","logo_image","cover_image","status"];
    public function Products(){
        return $this->hasMany(Product::class,"store_id","id");
    }



}
