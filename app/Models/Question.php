<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = ['year_level', 'section', 'question_text'];

    // This allows you to call $question->options
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }
}