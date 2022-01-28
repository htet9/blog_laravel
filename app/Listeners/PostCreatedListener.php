<?php

namespace App\Listeners;

use App\Mail\PostStored;
use App\Events\PostCreatedEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostCreatedListener
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
    public function handle(PostCreatedEvent $event)
    {
        Mail::to(Auth::user()->email)->send(new PostStored($event->post));
    }
}
