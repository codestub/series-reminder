<?php

namespace App\Listeners;

use Mail;
use App\User;
use App\Mail\ConfirmEmail;
use App\Events\UserRegistration;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailConfirmation
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
     * @param  UserRegistration  $event
     * @return void
     */
    public function handle(UserRegistration $event)
    {
        Mail::to($event->user)->send(new ConfirmEmail);
    }
}
