<?php

namespace App\Models\draftThesis;

use Illuminate\Database\Eloquent\Model;

class draftThesis extends Model
{
    // Manually define the table name since it's not the default plural form
    protected $table = 'draftthesis';

    // Specify that the primary key is 'id' (string, not auto-increment)
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Fields that can be mass assigned
    protected $fillable = [
        'id',
        'username',
        'title',
        'thesislink',
        'description',
        'number',
        'startDate',
        'enddate',
        'totalpage',
        'prepdays',
        'feedback',
    ];

    //`created_at` and `updated_at` timestamps:
    public $timestamps = true;
}
