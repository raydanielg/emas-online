<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\School;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::with(['student', 'subject', 'school'])->latest()->paginate(15);

        return view('admin.results.index', compact('results'));
    }

    public function school()
    {
        $results = Result::with(['student', 'subject', 'school'])->latest()->paginate(15);

        return view('admin.results.index', compact('results'));
    }

    public function region()
    {
        $results = Result::with(['student', 'subject', 'school'])->latest()->paginate(15);

        return view('admin.results.index', compact('results'));
    }

    public function approvals()
    {
        $results = Result::where('status', 'draft')
            ->with(['student', 'subject', 'school'])
            ->latest()
            ->paginate(15);

        return view('admin.results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::query()->orderBy('full_name')->get();
        $subjects = Subject::query()->orderBy('name')->get();
        $schools = School::query()->orderBy('name')->get();

        return view('admin.results.create', compact('students', 'subjects', 'schools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'school_id' => 'required|exists:schools,id',
            'score' => 'required|numeric|min:0|max:100',
            'term' => 'required|string',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
        ]);

        $validated['grade'] = $this->calculateGrade($validated['score']);
        $validated['status'] = 'published';

        Result::create($validated);

        return redirect()->route('results.index')->with('success', 'Result added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Result $result)
    {
        return view('admin.results.show', compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Result $result)
    {
        $students = Student::query()->orderBy('full_name')->get();
        $subjects = Subject::query()->orderBy('name')->get();
        $schools = School::query()->orderBy('name')->get();

        return view('admin.results.edit', compact('result', 'students', 'subjects', 'schools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Result $result)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'school_id' => 'required|exists:schools,id',
            'score' => 'required|numeric|min:0|max:100',
            'term' => 'required|string',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'status' => 'required|in:draft,published,locked',
        ]);

        $validated['grade'] = $this->calculateGrade($validated['score']);

        $result->update($validated);

        return redirect()->route('results.index')->with('success', 'Result updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Result $result)
    {
        $result->delete();

        return redirect()->route('results.index')->with('success', 'Result deleted successfully.');
    }

    private function calculateGrade($score)
    {
        if ($score >= 75) return 'A';
        if ($score >= 65) return 'B';
        if ($score >= 45) return 'C';
        if ($score >= 30) return 'D';
        return 'F';
    }
}
