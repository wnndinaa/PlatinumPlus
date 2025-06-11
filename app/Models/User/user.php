<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

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
        'password',
        'gender',
        'citizenship'
    ];
}
