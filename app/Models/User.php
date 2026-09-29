<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Section;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'student_number',
        'birthdate',
        'year_level',
        'role',
        // Notice 'section' has been removed from here!
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * FOR STUDENTS: Get the sections the student is enrolled in.
     * This uses the pivot table to support irregular students.
     */
    public function enrolledSections()
    {
        return $this->belongsToMany(Section::class, 'section_user', 'user_id', 'section_id')->withTimestamps();
    }

    /**
     * FOR FACULTY: Get the sections the faculty member teaches.
     * This links directly to the faculty_id column on the sections table.
     */
    public function taughtSections()
    {
        return $this->hasMany(Section::class, 'faculty_id');
    }

    /**
     * Check if the user has a specific role.
     * (Fixes the BadMethodCallException error on login/routing)
     */
    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return strtolower(trim($this->role)) === strtolower(trim($role));
    }

    public function handledSections()
    {
        return $this->belongsToMany(Section::class, 'faculty_section', 'user_id', 'section_id')->withTimestamps();
    }
}
