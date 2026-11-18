<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::withCount('results')->latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create() { return view('students.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'], 'roll' => ['required', 'string', 'max:40', 'unique:students,roll'],
            'department' => ['required', 'string', 'max:100'], 'email' => ['required', 'email', 'max:255', 'unique:students,email'],
        ]);
        $student = Student::create($data);
        return redirect()->route('students.show', $student)->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load('results');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student) { return view('students.edit', compact('student')); }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'], 'roll' => ['required', 'string', 'max:40', 'unique:students,roll,' . $student->id],
            'department' => ['required', 'string', 'max:100'], 'email' => ['required', 'email', 'max:255', 'unique:students,email,' . $student->id],
        ]);
        $student->update($data);
        return redirect()->route('students.show', $student)->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student and their results deleted.');
    }
}
