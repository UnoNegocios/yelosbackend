<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        
        $expiresAt = now()->addDay();

        $user->sendWelcomeNotification($expiresAt);

    }
}