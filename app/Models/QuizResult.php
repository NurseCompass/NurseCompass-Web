<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizResult extends Model
{
    protected $fillable = ['user_id', 'year_level', 'section', 'score', 'total_questions'];

    // A result belongs to a user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}