<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    // Set 'username' as the primary key
    protected $primaryKey = 'username';
    public $incrementing = false;        // username is not auto-incrementing
    protected $keyType = 'string';
    public $timestamps = false;      // because username is a string

    protected $fillable = [
        'username',
        'name',
        'ic',
        'email',
        'phonemumber',
        'role',
        'password'
    ];
}
