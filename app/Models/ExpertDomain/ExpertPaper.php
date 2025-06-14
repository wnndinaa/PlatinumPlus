<?php

namespace App\Models\ExpertDomain;

use Illuminate\Database\Eloquent\Model;

class ExpertPaper extends Model
{
    protected $table = 'expert_paper';
    protected $primaryKey = 'expertPaper_id';
    public $incrementing = false; // Since the primary key is a string
    public $timestamps = false; // No timestamps in the migration

    protected $fillable = [
        'expertPaper_id',
        'paper_title',
        'paper_DOI',
        'paper_author',
        'paper_date',
        'expert_id',
        'username',
    ];

    // Relationship to ExpertDomain
    public function expert()
    {
        return $this->belongsTo(ExpertDomain::class, 'expert_id', 'expert_id');
    }
}
