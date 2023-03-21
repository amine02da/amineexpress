<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsFrontController extends Controller
{
    //show products with custom filter
    public function index()
    {
         return "all products";
    }

    //show details of product
    public function show(Product $product)
    {
        return view("front.products.show",compact("product"));
    }
}
