<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function importStudents(Request $request)
    {
        // 1. Check if a file was actually uploaded
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // 2. Open the uploaded CSV file
        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');

        // 3. Skip the first row (because it usually contains headers like "Name", "Email")
        $header = fgetcsv($handle, 1000, ',');

        // 4. Loop through every single row in the CSV one by one
        while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
            
            // Map the columns to variables (Assuming Column A is Name, B is Email, etc.)
            $name           = $row[0];
            $email          = $row[1];
            $studentNumber  = $row[2];
            $birthdate      = $row[3];
            $yearLevel      = $row[4];
            $sectionName    = $row[5];

            // 5. Create the Student Account (or update it if the email already exists)
            $user = User::updateOrCreate(
                ['email' => $email], // Look for this email
                [
                    'name'           => $name,
                    'student_number' => $studentNumber,
                    'birthdate'      => $birthdate,
                    'year_level'     => $yearLevel,
                    'role'           => 'student',
                    'password'       => Hash::make($studentNumber), // Password defaults to Student Number
                ]
            );

            // 6. Check if the Section exists. If not, create it automatically!
            $section = Section::firstOrCreate([
                'name'       => $sectionName,
                'year_level' => $yearLevel,
            ]);

            // 7. Enroll the student in this section using our new Pivot Table
            if (!$user->enrolledSections()->where('section_id', $section->id)->exists()) {
                $user->enrolledSections()->attach($section->id);
            }
        }

        // Close the file when done
        fclose($handle);

        // Send the admin back to the dashboard with a success message
        return back()->with('success', 'Student list imported successfully!');
    }
}