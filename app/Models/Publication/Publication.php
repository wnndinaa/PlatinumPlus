<?php

namespace App\Models\Publication;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publication';

    // Primary key is publication_id (and it IS auto-incrementing)
    protected $primaryKey = 'publication_id';
    public $incrementing = true;
    protected $keyType = 'int'; // Change to 'string' only if it's a string

    public $timestamps = false; // No created_at, updated_at

    protected $fillable = [
        'publication_type',
        'publication_file',
        'publication_title',
        'publication_author',
        'publication_date',
        'publication_DOI',
        'username'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class, 'username', 'username');
    }
}
