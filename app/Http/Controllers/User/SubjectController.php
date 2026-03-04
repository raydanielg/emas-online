<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\SchoolSubject;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;

        $kpis = [
            'total_subjects' => Subject::query()->count(),
            'school_subjects' => $schoolId
                ? SchoolSubject::where('school_id', $schoolId)->distinct('subject_id')->count('subject_id')
                : 0,
        ];

        $subjects = Subject::whereIn('id', function($query) use ($schoolId) {
            $query->select('subject_id')
                ->from('school_subjects')
                ->where('school_id', $schoolId);
        })
        ->orderBy('name')
        ->paginate(15);

        return view('user.subjects.index', compact('subjects', 'kpis'));
    }

    public function import()
    {
        $schoolId = auth()->user()->school_id;

        $importedSubjectIds = $schoolId
            ? SchoolSubject::where('school_id', $schoolId)->distinct()->pluck('subject_id')->toArray()
            : [];

        $subjects = Subject::query()
            ->orderBy('name')
            ->get();

        return view('user.subjects.import', compact('subjects', 'importedSubjectIds'));
    }

    public function remove(Subject $subject)
    {
        $schoolId = auth()->user()->school_id;

        SchoolSubject::where('school_id', $schoolId)
            ->where('subject_id', $subject->id)
            ->delete();

        return redirect()->route('user.subjects.index')->with('success', 'Subject removed from your school list.');
    }

    public function storeImport(Request $request)
    {
        $schoolId = auth()->user()->school_id;

        $validated = $request->validate([
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        DB::transaction(function () use ($schoolId, $validated) {
            foreach ($validated['subject_ids'] as $subjectId) {
                SchoolSubject::firstOrCreate([
                    'school_id' => $schoolId,
                    'subject_id' => $subjectId,
                    'school_class_id' => null,
                ]);
            }
        });

        return redirect()->route('user.subjects.index')->with('success', 'Subjects imported successfully. You can now assign them to classes.');
    }

    public function assign()
    {
        $schoolId = auth()->user()->school_id;
        
        $classes = SchoolClass::where('school_id', $schoolId)->with('globalClass')->get();
        $importedSubjectIds = SchoolSubject::where('school_id', $schoolId)
            ->distinct()
            ->pluck('subject_id');

        $subjects = Subject::query()
            ->whereIn('id', $importedSubjectIds)
            ->orderBy('name')
            ->get();
        
        $assignedSubjects = SchoolSubject::where('school_id', $schoolId)->get();

        return view('user.subjects.assign', compact('classes', 'subjects', 'assignedSubjects'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'subject_ids' => 'required|array',
            'subject_ids.*' => 'exists:subjects,id',
        ]);

        $schoolId = auth()->user()->school_id;
        $classId = $request->school_class_id;

        // Verify class belongs to school
        $class = SchoolClass::where('id', $classId)->where('school_id', $schoolId)->firstOrFail();

        // Sync subjects for this class
        // First remove existing assignments for this specific class
        SchoolSubject::where('school_id', $schoolId)
            ->where('school_class_id', $classId)
            ->delete();

        // Add new
        foreach ($request->subject_ids as $subjectId) {
            SchoolSubject::create([
                'school_id' => $schoolId,
                'subject_id' => $subjectId,
                'school_class_id' => $classId,
            ]);
        }

        return redirect()->route('user.subjects.assign')->with('success', 'Subjects assigned to class successfully.');
    }

    public function removeSingleAssignment(Request $request)
    {
        $schoolId = auth()->user()->school_id;
        $assignmentId = $request->assignment_id;

        $assignment = SchoolSubject::where('id', $assignmentId)
            ->where('school_id', $schoolId)
            ->firstOrFail();

        $subjectName = $assignment->subject->name;
        $assignment->delete();

        return redirect()->route('user.subjects.assign')->with('success', "Somo la {$subjectName} limeondolewa kwenye darasa husika.");
    }
}
