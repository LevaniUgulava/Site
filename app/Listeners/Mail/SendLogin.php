<?php

namespace App\Listeners\Mail;

use App\Events\Mail\LoginRegisterEvent;
use App\Mail\Mail\LoginMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLogin
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(LoginRegisterEvent $event): void
    {
        $name = $event->name;
        Mail::to($event->user->email)->send(new LoginMail($name));
    }
}
