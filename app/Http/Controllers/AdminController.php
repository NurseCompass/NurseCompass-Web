<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalFaculty = User::where('role', 'faculty')->count();
        $totalSections = Section::count();

        return view('admin.dashboard', compact('totalStudents', 'totalFaculty', 'totalSections'));
    }

    public function studentsIndex()
    {
        $students = User::where('role', 'student')->with('enrolledSections')->latest()->get();
        return view('admin.students', compact('students'));
    }

    public function sectionsIndex()
    {
        $sections = Section::with('students', 'facultyMembers')->get();
        return view('admin.sections', compact('sections'));
    }

    public function facultyIndex()
    {
        $facultyMembers = User::where('role', 'faculty')->with('handledSections')->get();
        $sections = Section::all();
        return view('admin.faculty', compact('facultyMembers', 'sections'));
    }

    public function deanIndex()
    {
        $deans = User::where('role', 'department_head')->get();
        return view('admin.dean', compact('deans'));
    }

    public function importStudents(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        fgetcsv($handle, 1000, ','); // Skip header

        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $name         = $row[0];
            $email        = $row[1];
            $studentNumber = $row[2];
            $birthdate    = $row[3];
            $yearLevel    = $row[4];
            $sectionName  = $row[5];

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name'           => $name,
                    'student_number' => $studentNumber,
                    'birthdate'      => $birthdate,
                    'year_level'     => $yearLevel,
                    'role'           => 'student',
                    'password'       => Hash::make('default'),
                ]
            );

            $section = Section::firstOrCreate([
                'name'       => $sectionName,
                'year_level' => $yearLevel,
            ]);

            if (!$user->enrolledSections()->where('section_id', $section->id)->exists()) {
                $user->enrolledSections()->attach($section->id);
            }
        }

        fclose($handle);
        return back()->with('success', 'Student list imported successfully!');
    }

    public function storeSingleStudent(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'student_number' => 'required|string|max:50',
            'birthdate'      => 'required|date',
            'year_level'     => 'required|integer|min:1|max:4',
            'section_name'   => 'required|string|max:50',
        ]);

        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'student_number' => $request->student_number,
            'birthdate'      => $request->birthdate,
            'year_level'     => $request->year_level,
            'role'           => 'student',
            'password'       => Hash::make('default'),
        ]);

        $section = Section::firstOrCreate([
            'name'       => $request->section_name,
            'year_level' => $request->year_level,
        ]);

        $user->enrolledSections()->attach($section->id);

        return back()->with('success', "Student {$user->name} registered successfully!");
    }

    public function assignSectionsToFaculty(Request $request, User $faculty)
    {
        $request->validate([
            'sections' => 'nullable|array',
            'sections.*' => 'exists:sections,id',
        ]);

        $faculty->handledSections()->sync($request->sections ?? []);

        return back()->with('success', "Sections updated successfully for {$faculty->name}!");
    }
}
