<?php

namespace App\Listeners;

use App\Facades\Cart;
use App\Models\Product;
use DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle()
    {
        foreach(Cart::get() as $item){
            Product::where("id", "=", $item->product_id)
                ->update([
                    "quantity" => DB::raw("quantity - " . $item->quantity)
                ]);
        }
    }
}
