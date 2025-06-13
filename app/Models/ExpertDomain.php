<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertDomain extends Model
{
    protected $table = 'expert_domain';  // matches your table name
    protected $primaryKey = 'expert_id';
    public $incrementing = false;
    public $timestamps = false;  // no timestamps column in your table

    protected $fillable = [
        'expert_id',
        'expert_name',
        'expert_university',
        'expert_occupation',
        'expert_phoneNum',
        'expert_email',
        'domain_expertise',
        'username',
    ];
}
