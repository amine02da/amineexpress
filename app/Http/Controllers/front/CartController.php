<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
// use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use App;

class CartController extends Controller
{
    protected $cart;
    public function  __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $repository = new CartModelRepository(); stocke this objt in service container (in service provider)
        // $repository = App::make("cart");
        $items =$this->cart;
        return view("front.cart",compact("items"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CartRepository $cart,Request $request)
    {
        $request->validate([
            "product_id"=>["required","int","exists:products,id"],
            "quantity" => ["nullable","int","min:1"]
        ]);
        
        $product = Product::findOrFail($request->post("product_id"));
        // $repository = new CartModelRepository();
        $cart->add($product,$request->post("quantity"));
        return redirect()->route("cart.index")->with("success", "Product added to cart!");
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "quantity" => ["required","int","min:1"]
        ]);
        // $repository = new CartModelRepository();
        // $product = Product::findOrFail($id);
        $this->cart->update($id,$request->post("quantity"));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartRepository $cart,$id)
    {
        // $repository = new CartModelRepository();
        $cart->delete($id);

    }
}