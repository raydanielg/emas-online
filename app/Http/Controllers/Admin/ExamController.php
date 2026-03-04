<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\School;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::with(['school', 'academicYear'])->latest()->paginate(15);
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $schools = School::where('status', 'Approved')->orderBy('name')->get();
        $academicYears = AcademicYear::where('is_active', true)->orderBy('year', 'desc')->get();
        return view('admin.exams.create', compact('schools', 'academicYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Midterm,Terminal,Annual,Mock,National,Regional,Other',
            'school_id' => 'nullable|exists:schools,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'term' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        Exam::create($validated);

        return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        return view('admin.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $schools = School::where('status', 'Approved')->orderBy('name')->get();
        $academicYears = AcademicYear::all();
        return view('admin.exams.edit', compact('exam', 'schools', 'academicYears'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Midterm,Terminal,Annual,Mock,National,Regional,Other',
            'school_id' => 'nullable|exists:schools,id',
            'academic_year_id' => 'required|exists:academic_years,id',
            'term' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $exam->update($validated);

        return redirect()->route('exams.index')->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully.');
    }

    /**
     * Publish the exam results to public portal.
     */
    public function publish(Exam $exam)
    {
        $exam->update(['is_published' => !$exam->is_published]);
        $status = $exam->is_published ? 'published' : 'unpublished';
        return redirect()->back()->with('success', "Exam results {$status} successfully.");
    }
}
