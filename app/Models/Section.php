<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year_level',
        'faculty_id',
    ];

    /**
     * Get the faculty member assigned to this section.
     */
    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_id');
    }

    /**
     * Get the students enrolled in this section.
     */
    public function students()
    {
        return $this->belongsToMany(User::class, 'section_user', 'section_id', 'user_id')->withTimestamps();
    }

    public function facultyMembers()
    {
        return $this->belongsToMany(User::class, 'faculty_section', 'section_id', 'user_id')->withTimestamps();
    }
}
