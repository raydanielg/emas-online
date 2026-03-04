<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\School;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('school')->latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schools = School::all();
        return view('admin.students.create', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'admission_number' => 'required|string|unique:students,admission_number',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',
            'school_id' => 'required|exists:schools,id',
            'class_level' => 'required|string',
        ]);

        $validated['status'] = 'Active';

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $schools = School::all();
        return view('admin.students.edit', compact('student', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'admission_number' => 'required|string|unique:students,admission_number,' . $student->id,
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',
            'school_id' => 'required|exists:schools,id',
            'class_level' => 'required|string',
            'status' => 'required|in:Active,Graduated,Transferred,Suspended',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Display students filtered by school.
     */
    public function school()
    {
        $students = Student::with('school')->latest()->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show promote students form.
     */
    public function promote()
    {
        return view('admin.students.promote');
    }

    /**
     * Show import students form.
     */
    public function import()
    {
        return view('admin.students.import');
    }
}
