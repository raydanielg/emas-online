<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;

        $baseQuery = Student::query()
            ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId));

        $kpis = [
            'total' => (clone $baseQuery)->count(),
            'male' => (clone $baseQuery)->where('gender', 'Male')->count(),
            'female' => (clone $baseQuery)->where('gender', 'Female')->count(),
            'missing_dob' => (clone $baseQuery)->whereNull('date_of_birth')->count(),
        ];

        $students = (clone $baseQuery)
            ->latest()
            ->paginate(15);

        return view('user.students.index', compact('students', 'kpis'));
    }

    public function create()
    {
        return view('user.students.create');
    }

    public function manage(Request $request)
    {
        $schoolId = auth()->user()->school_id;
        $classFilter = $request->query('class_level');

        $query = Student::where('school_id', $schoolId);

        if ($classFilter) {
            $query->where('class_level', $classFilter);
        }

        $students = $query->latest()->paginate(15);
        
        // Get unique classes for the filter dropdown
        $classes = Student::where('school_id', $schoolId)
            ->distinct()
            ->pluck('class_level');

        return view('user.students.manage', compact('students', 'classes', 'classFilter'));
    }

    public function edit(Student $student)
    {
        // Ensure student belongs to user's school
        if ($student->school_id !== auth()->user()->school_id) {
            abort(403);
        }
        return view('user.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        if ($student->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'admission_number' => 'required|string|max:255|unique:students,admission_number,' . $student->id,
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',
            'class_level' => 'required|string|max:255',
            'status' => 'required|in:Active,Graduated,Transferred,Suspended',
        ]);

        $student->update($validated);

        return redirect()->route('user.students.manage')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        if ($student->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $student->delete();

        return redirect()->route('user.students.manage')->with('success', 'Student deleted successfully.');
    }

    public function promote()
    {
        return view('user.students.promote');
    }

    public function import()
    {
        return view('user.students.import');
    }
}
