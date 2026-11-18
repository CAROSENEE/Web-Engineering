<?php

namespace Database\Seeders;

use App\Models\Result;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $students = [
            ['roll' => 'CSE-22-001', 'name' => 'Samin Ahmed', 'department' => 'Computer Science', 'email' => 'samin.ahmed@example.edu', 'courses' => ['CSE101' => 88, 'MAT103' => 82, 'ENG105' => 76, 'PHY107' => 71]],
            ['roll' => 'CSE-22-002', 'name' => 'Nusrat Jahan', 'department' => 'Computer Science', 'email' => 'nusrat.jahan@example.edu', 'courses' => ['CSE101' => 92, 'MAT103' => 85, 'ENG105' => 79, 'PHY107' => 87]],
            ['roll' => 'SWE-22-003', 'name' => 'Rafi Hasan', 'department' => 'Software Engineering', 'email' => 'rafi.hasan@example.edu', 'courses' => ['SWE201' => 81, 'CSE203' => 90, 'MAT205' => 74, 'ENG207' => 68]],
            ['roll' => 'BBA-22-004', 'name' => 'Tanjila Akter', 'department' => 'Business Administration', 'email' => 'tanjila.akter@example.edu', 'courses' => ['BUS101' => 86, 'ACC103' => 78, 'ECO105' => 83, 'MGT107' => 91]],
            ['roll' => 'EEE-22-005', 'name' => 'Fahim Rahman', 'department' => 'Electrical Engineering', 'email' => 'fahim.rahman@example.edu', 'courses' => ['EEE101' => 73, 'MAT103' => 69, 'PHY105' => 80, 'CSE107' => 77]],
            ['roll' => 'CSE-22-006', 'name' => 'Maliha Chowdhury', 'department' => 'Computer Science', 'email' => 'maliha.chowdhury@example.edu', 'courses' => ['CSE101' => 96, 'MAT103' => 89, 'ENG105' => 84, 'PHY107' => 92]],
            ['roll' => 'SWE-22-007', 'name' => 'Adnan Kabir', 'department' => 'Software Engineering', 'email' => 'adnan.kabir@example.edu', 'courses' => ['SWE201' => 65, 'CSE203' => 72, 'MAT205' => 58, 'ENG207' => 63]],
            ['roll' => 'BBA-22-008', 'name' => 'Ishrat Noor', 'department' => 'Business Administration', 'email' => 'ishrat.noor@example.edu', 'courses' => ['BUS101' => 90, 'ACC103' => 87, 'ECO105' => 75, 'MGT107' => 82]],
        ];

        DB::transaction(function () use ($students) {
            foreach ($students as $data) {
                $courses = $data['courses'];
                unset($data['courses']);
                $student = Student::updateOrCreate(['roll' => $data['roll']], $data);

                foreach ($courses as $courseCode => $marks) {
                    $student->results()->updateOrCreate(
                        ['course_code' => $courseCode],
                        ['marks' => $marks, 'grade' => Result::gradeFor((float) $marks)]
                    );
                }
            }
        });
    }
}
