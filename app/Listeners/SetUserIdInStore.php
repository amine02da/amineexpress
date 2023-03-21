<?php

namespace App\Listeners;

use App\Models\User;
use Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetUserIdInStore
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
    public function handle($store_created)
    {
        $user = Auth::user()->id;
        if($store_created->id ){
            if($user){
                User::where("id", $user)->update([
                    "store_id" => $store_created->id
                ]);
            }
        }
    }
}
