<?php

namespace App\Models\ExpertDomain;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications'; // name of the table
    protected $primaryKey = 'notification_id'; // custom primary key name

    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'from_username',
        'to_username',
        'expertPaper_id',
        'message',
        'is_read',
    ];
}
