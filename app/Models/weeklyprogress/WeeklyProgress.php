<?php

namespace App\Models\weeklyprogress;

use Illuminate\Database\Eloquent\Model;

class WeeklyProgress extends Model
{
    // Specify the table name if it doesn't match Laravel's default (plural snake_case)
    protected $table = 'weeklyprogress';

    // If your table does NOT have an auto-incrementing ID
    public $incrementing = false;

    // If your primary key is not "id", define it
    protected $primaryKey = 'id';

    // Define which fields are fillable (used in mass assignment)
    protected $fillable = [
        'id',
        'username',
        'startDate',
        'endDate',
        'progressinfo',
        'feedback',
    ];


    // Laravel will automatically use created_at and updated_at
    public $timestamps = true;
}
