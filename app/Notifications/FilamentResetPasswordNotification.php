<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;

class FilamentResetPasswordNotification extends ResetPassword
{
    protected function resetUrl($notifiable): string
    {
        return URL::signedRoute('filament.admin.auth.password-reset.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Reset Password')
            ->line('You are receiving this email because we received a password reset request.')
            ->action('Reset Password', $this->resetUrl($notifiable))
            ->line('If you did not request a password reset, no further action is required.');
    }
}