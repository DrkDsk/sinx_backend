<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    private string $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = config('app.frontend_url') . "/reset-password?token=$this->token&email=$notifiable->email";
        $actionText = "Restablecer contraseña";
        $troubleClicking = trans('passwords.trouble_clicking', [
            'actionText' => $actionText,
        ]);

        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->markdown('vendor.notifications.email', [
                'greeting' => 'Hola',
                'salutation' => 'Saludos, el equipo de SinX',
                'actionText' => $actionText,
                'introLines' => [
                    'Estás recibiendo este correo porque solicitaste un restablecimiento de contraseña.',
                ],
                'outroLines' => [
                    'Si no solicitaste este cambio, ignora este correo.'
                ],
                'displayableActionUrl' => $url,
                'troubleClicking' => $troubleClicking,
                'actionUrl' => $url,
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
