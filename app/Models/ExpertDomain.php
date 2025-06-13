<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertDomain extends Model
{
    protected $table = 'expertdomain';  // matches your table name
    protected $primaryKey = 'expert_id';
    public $timestamps = false;         // no timestamps column in your table

    protected $fillable = [
        'expert_name',
        'expert_university',
        'expert_occupation',
        'expert_phoneNum',
        'expert_email',
        'domain_expertise',
        'user_id',
    ];
}
