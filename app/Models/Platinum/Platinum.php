<?php

namespace App\Models\Platinum;

use Illuminate\Database\Eloquent\Model;

class Platinum extends Model
{
    protected $table = 'platinum';
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'username',
        'assignedCRMP',
        // add any other fields
    ];
}
