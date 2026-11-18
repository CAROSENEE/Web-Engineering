<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function store(Request $request, Student $student)
    {
        $data = $request->validate([
            'course_code' => ['required', 'string', 'max:30'],
            'marks' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);
        $data['grade'] = Result::gradeFor((float) $data['marks']);
        $student->results()->updateOrCreate(['course_code' => $data['course_code']], $data);
        return redirect()->route('students.show', $student)->with('success', 'Result saved; grade calculated from marks.');
    }

    public function destroy(Student $student, Result $result)
    {
        abort_unless($result->student_id === $student->id, 404);
        $result->delete();
        return redirect()->route('students.show', $student)->with('success', 'Result deleted.');
    }
}
