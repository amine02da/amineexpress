<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use Auth;
use DB;
use Throwable;

class CheckoutController extends Controller
{

    public function create(CartRepository $cart)
    {
        $countries = Countries::getNames("en");
        if($cart->get()->count() == 0){
            return redirect()->route("home")->with("info","your cart is empty");
        }
        return view("front.checkout",compact("cart", "countries"));
    }

    public function store(Request $request, CartRepository $cart)
    {
        // $request->validate([
            
        // ])

        $items = $cart->get()->groupBy("products.store_id");

        DB::beginTransaction();
        try{
            foreach($items as $store_id => $cart_items)
            {
                $order = Order::create([
                    "store_id"=> $store_id,
                    "user_id" => Auth::id(),
                    "payment_method" => "cod",
                ]);
                foreach($cart_items as $item)
                {
                    OrderDetails::create([
                        "order_id" => $order->id,
                        "product_id" => $item->product_id,
                        "product_name" => $item->products->name,
                        "price" => $item->products->price,
                        "quantity" => $item->quantity
                    ]);
                }
                // info user
                foreach($request->post("addr") as $type => $adresse)
                {
                    $adresse["type"] = $type;
                    $order->addresses()->create($adresse);
                }
        } 
            event("order.created",$order);
            $cart->empty();
            DB::commit();
           
            
        
    }
    catch(Throwable $e)
    {
        DB::rollBack();
        throw $e;
    }
}
}
