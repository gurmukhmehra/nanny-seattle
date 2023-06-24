<?php

namespace App\Listeners;

use App\Events\FriendRequestSend;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FriendRequestSendListener
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
     * @param  \App\Events\FriendRequestSend  $event
     * @return void
     */
    public function handle(FriendRequestSend $event)
    {
        //
    }
}
