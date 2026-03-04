<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\School;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicResultsController extends Controller
{
    /**
     * Step 1: Show available academic years.
     */
    public function index()
    {
        $years = Result::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        return view('public.results.index', compact('years'));
    }

    /**
     * Step 2: Show schools that have results for a specific year.
     */
    public function showSchools($year)
    {
        $schools = School::whereHas('results', function ($query) use ($year) {
            $query->where('year', $year)->where('status', 'published');
        })->get();

        return view('public.results.schools', compact('schools', 'year'));
    }

    /**
     * Step 3: Show exams conducted by a school in a specific year.
     */
    public function showExams($year, School $school)
    {
        $exams = Exam::whereHas('results', function ($query) use ($year, $school) {
            $query->where('year', $year)
                  ->where('school_id', $school->id)
                  ->where('status', 'published');
        })->distinct()->get();

        return view('public.results.exams', compact('exams', 'year', 'school'));
    }

    /**
     * Step 4: Show the actual results for the selected year, school, and exam.
     */
    public function viewResults($year, School $school, Exam $exam)
    {
        $results = Result::with(['student', 'subject'])
            ->where('year', $year)
            ->where('school_id', $school->id)
            ->where('exam_id', $exam->id)
            ->where('status', 'published')
            ->get();

        return view('public.results.view', compact('results', 'year', 'school', 'exam'));
    }
}
