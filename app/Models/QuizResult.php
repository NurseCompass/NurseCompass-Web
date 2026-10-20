<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizResult extends Model
{
    protected $fillable = [
        'user_id',
        'year_level',
        'section',
        'score',
        'total_questions',
        'academic_performance',
        'self_efficacy',
        'initiative',
        'motivation',
        'top_category',
        'prediction',
        'personalized_note'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
