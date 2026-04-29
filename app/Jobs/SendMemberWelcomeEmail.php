<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\FilamentResetPasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\ResetPassword;

class SendMemberWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $token;

    public function __construct($user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function handle(): void
    {
        $this->user->notify(
            new FilamentResetPasswordNotification($this->token)
        );
    }
}