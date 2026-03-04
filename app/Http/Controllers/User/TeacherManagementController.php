<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SubjectTeacher;
use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\Term;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherManagementController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;
        $teachers = SubjectTeacher::where('school_id', $schoolId)
            ->with(['assignments.subject', 'assignments.schoolClass.globalClass'])
            ->latest()
            ->paginate(15);

        return view('user.teachers.index', compact('teachers'));
    }

    public function assignSubjects()
    {
        $schoolId = auth()->user()->school_id;
        $teachers = SubjectTeacher::where('school_id', $schoolId)
            ->with(['assignments.subject', 'assignments.schoolClass.globalClass'])
            ->latest()
            ->get();
        
        $classes = SchoolClass::where('school_id', $schoolId)->with('globalClass')->get();

        return view('user.teachers.assign_subjects', compact('teachers', 'classes'));
    }

    public function assignClasses()
    {
        $schoolId = auth()->user()->school_id;
        $teachers = SubjectTeacher::where('school_id', $schoolId)->get();
        $classes = SchoolClass::where('school_id', $schoolId)
            ->with(['globalClass', 'teacher'])
            ->get();

        return view('user.teachers.assign_classes', compact('teachers', 'classes'));
    }

    public function storeClassAssignment(Request $request)
    {
        $validated = $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'teacher_id' => 'required|exists:subject_teachers,id',
        ]);

        $class = SchoolClass::where('id', $validated['school_class_id'])
            ->where('school_id', auth()->user()->school_id)
            ->firstOrFail();

        $class->update(['teacher_id' => $validated['teacher_id']]);

        return redirect()->back()->with('success', 'Mwalimu wa darasa amepangwa kikamilifu.');
    }

    /**
     * Store multi-subject assignments for a teacher.
     */
    public function storeAssignment(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:subject_teachers,id',
            'school_subject_ids' => 'required|array',
            'school_subject_ids.*' => 'exists:school_subjects,id',
        ]);

        $schoolId = auth()->user()->school_id;

        // Reset previous assignments for these specific subjects if they belong to this school
        SchoolSubject::whereIn('id', $validated['school_subject_ids'])
            ->where('school_id', $schoolId)
            ->update(['subject_teacher_id' => $validated['teacher_id']]);

        return redirect()->back()->with('success', 'Masomo yameunganishwa na mwalimu kikamilifu.');
    }

    public function performance(Request $request)
    {
        $schoolId = auth()->user()->school_id;
        
        $years = AcademicYear::where('school_id', $schoolId)->orderBy('name', 'desc')->get();
        $terms = Term::where('school_id', $schoolId)->get();

        $selectedYear = $request->get('year', $years->firstWhere('is_current', true)->name ?? date('Y'));
        $selectedTerm = $request->get('term', $terms->firstWhere('is_current', true)->name ?? 'Term 1');

        // Performance logic: Get average scores per teacher
        $teacherPerformance = SubjectTeacher::where('subject_teachers.school_id', $schoolId)
            ->leftJoin('school_subjects', 'subject_teachers.id', '=', 'school_subjects.subject_teacher_id')
            ->leftJoin('results', function($join) use ($selectedYear, $selectedTerm) {
                $join->on('school_subjects.subject_id', '=', 'results.subject_id')
                     ->on('school_subjects.school_class_id', '=', 'results.school_id') // This is a bit simplified, usually results link to a specific class instance
                     ->where('results.year', $selectedYear)
                     ->where('results.term', $selectedTerm);
            })
            ->select(
                'subject_teachers.id',
                'subject_teachers.name',
                'subject_teachers.initials',
                DB::raw('AVG(results.score) as average_score'),
                DB::raw('COUNT(results.id) as total_results')
            )
            ->groupBy('subject_teachers.id', 'subject_teachers.name', 'subject_teachers.initials')
            ->get();

        return view('user.teachers.performance', compact('teacherPerformance', 'years', 'terms', 'selectedYear', 'selectedTerm'));
    }
}
