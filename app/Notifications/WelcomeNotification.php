<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class WelcomeNotification extends \Spatie\WelcomeNotification\WelcomeNotification
{

    public function buildWelcomeNotificationMessage(): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hola '.$this->user->name)
            ->subject('Bienvenido a UnoCRM 🥳')
            ->line('Estás a un paso de poder usar UNOCRM, para continuar crea una contraseña para tu cuenta.')
            ->action(Lang::get('Crear contraseña'), $this->showWelcomeFormUrl);
    }

}