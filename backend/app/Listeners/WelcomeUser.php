<?php

namespace App\Listeners;

use Mail;
use App\Mail\WelcomeEmail;
use App\Events\UserConfirmed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeUser
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
     * @param  UserConfirmed  $event
     * @return void
     */
    public function handle(UserConfirmed $event)
    {
        Mail::to($event->user)->send(new WelcomeEmail);
    }
}
