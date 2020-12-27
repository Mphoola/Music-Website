<?php

namespace App;

use Illuminate\Foundation\Auth\Admin as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'last_login_at',
        'last_login_ip', 'password_changed_at'
    ];

    protected $hidden = [
        'password'
    ];


}
