<?php

namespace App\Notifications;

use Illuminate\Notifications\{Notification, Messages\MailMessage};

class CustomResetPassword extends Notification
{
    public string $token;
    public string $url;

    public function __construct($token, $url)
    {
        $this->token = $token;
        $this->url   = $url;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $this->url)
            ->line('If you did not request a password reset, no further action is required.');
    }
}
