<?php

namespace App\View\Components\Dashboard;

use Auth;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{

    public $notifications;

    public $newNotifications;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count = 10)
    {
        $user = Auth::user();
        // if($user)
        // {
        $this->notifications = $user->notifications()->take($count)->get(); 
        $this->newNotifications = $user->unreadNotifications()->count();
        // }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.notifications-menu');
    }
}
