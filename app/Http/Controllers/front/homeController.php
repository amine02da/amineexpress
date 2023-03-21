<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        
        $products = Product::active()->limit(8)->latest()->get();
        return view("front.home",compact("products"));
    }


    
}
