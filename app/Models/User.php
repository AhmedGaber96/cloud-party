<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Override;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    
public function sendPasswordResetNotification($token): void
{
    // 1. Generate a SIGNED URL so Filament accepts it
    $url = URL::signedRoute('filament.admin.auth.password-reset.reset', [
        'token' => $token,
        'email' => $this->getEmailForPasswordReset(),
    ]);

    // 2. Tell the Notification to use this signed URL
    \Illuminate\Auth\Notifications\ResetPassword::createUrlUsing(function ($user, $token) use ($url) {
        return $url;
    });

    // 3. Send the notification
    parent::sendPasswordResetNotification($token);
}
public function ifsoMember()
{
    return $this->hasOne(IfsoMember::class);
}
public function assignedMembers()
{
    return $this->hasMany(IfsoMember::class, 'reviewer_id');
}

public function canAccessPanel(Panel $panel): bool
{
    return true;
}
}
