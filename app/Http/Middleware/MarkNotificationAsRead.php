<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $notification_id = $request->query("notification_id"); //get idNotification from url

        if($notification_id) // check if exist
        {
            $user = $request->user(); //get auth user from request
            if($user) //check if user exist
            {
                $notification = $user->unreadNotifications()->find($notification_id); //find the notification by id
                if($notification) //check if notification exist
                {
                    $notification->markAsRead(); //mark as readable
                }
            }
        }
        return $next($request);
    }
}
