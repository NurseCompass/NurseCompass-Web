<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'file_path',
        'category',
        'is_faculty_upload',
        'target_sections', // ADDED THIS
    ];

    // This tells Laravel to convert the database JSON into a usable PHP array automatically
    protected $casts = [
        'target_sections' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}