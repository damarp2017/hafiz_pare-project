<?php

namespace App;

use App\Notifications\OwnerResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Owner extends Authenticable
{
    use Notifiable;

    protected $guarded = [];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new OwnerResetPasswordNotification($token));
    }
}
