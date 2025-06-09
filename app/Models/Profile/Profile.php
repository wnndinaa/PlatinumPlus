<?php

namespace App\Models\Profile;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Profile extends Authenticatable
{
    use Notifiable;

    protected $table = 'profile';

    // If you want to use username as primary key, this is okay
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';

    // If you don't want timestamps, keep this false
    public $timestamps = false;

    protected $fillable = [
        'username',
        'name',
        'ic',
        'email',
        'phonemumber',
        'role',
        'password',
    ];

    // Optional: hide password in JSON serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
