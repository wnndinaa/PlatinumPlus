<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publication';

    // Set 'username' as the primary key
    protected $primaryKey = 'publication_id';
    public $incrementing = false;        // username is not auto-incrementing
    protected $keyType = 'string';
    public $timestamps = false;      // because username is a string

    protected $fillable = [
        'publication_id',
        'publication_type',
        'publication_file',
        'publication_number',
        'publication_tittle',
        'publication_author',
        'publication_date',
        'publication_DOI',
        'username',
        'experPaper_id'
    ];
}
