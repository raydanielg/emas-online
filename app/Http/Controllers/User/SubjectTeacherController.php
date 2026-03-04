<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SubjectTeacher;
use App\Models\SchoolClass;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubjectTeacherController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;
        $teachers = SubjectTeacher::where('school_id', $schoolId)
            ->with(['assignments.subject', 'assignments.schoolClass.globalClass'])
            ->latest()
            ->paginate(15);

        $classes = SchoolClass::where('school_id', $schoolId)->with('globalClass')->get();

        return view('user.teachers.index', compact('teachers', 'classes'));
    }

    public function getClassSubjects(Request $request)
    {
        $schoolId = auth()->user()->school_id;
        $classId = $request->class_id;

        $subjects = SchoolSubject::where('school_id', $schoolId)
            ->where('school_class_id', $classId)
            ->with('subject')
            ->get()
            ->map(function ($assignment) {
                return [
                    'id' => $assignment->id,
                    'subject_name' => $assignment->subject->name . ' (' . $assignment->subject->code . ')',
                ];
            });

        return response()->json($subjects);
    }

    public function assignSubject(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:subject_teachers,id',
            'school_subject_id' => 'required|exists:school_subjects,id',
        ]);

        $schoolId = auth()->user()->school_id;
        
        $assignment = SchoolSubject::where('id', $request->school_subject_id)
            ->where('school_id', $schoolId)
            ->firstOrFail();

        $assignment->update([
            'subject_teacher_id' => $request->teacher_id
        ]);

        return redirect()->route('user.subjects.teachers.index')->with('success', 'Mwalimu ame-assign-iwa somo kikamilifu.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'initials' => 'nullable|string|max:10',
            'school_class_ids' => 'nullable|array',
            'school_class_ids.*' => 'exists:school_classes,id',
            'school_subject_ids' => 'nullable|array',
            'school_subject_ids.*' => 'exists:school_subjects,id',
        ]);

        $schoolId = auth()->user()->school_id;

        // Auto-generate initials if not provided
        if (empty($validated['initials'])) {
            $words = explode(' ', $validated['name']);
            $initials = '';
            foreach ($words as $word) {
                if (!empty($word)) {
                    $initials .= strtoupper(substr($word, 0, 1));
                }
            }
            $validated['initials'] = substr($initials, 0, 10);
        }

        $teacher = SubjectTeacher::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'initials' => $validated['initials'],
            'school_id' => $schoolId,
        ]);

        // Assign to multiple classes and subjects if provided
        if (!empty($validated['school_subject_ids'])) {
            foreach ($validated['school_subject_ids'] as $schoolSubjectId) {
                $assignment = SchoolSubject::where('id', $schoolSubjectId)
                    ->where('school_id', $schoolId)
                    ->first();

                if ($assignment) {
                    $assignment->update([
                        'subject_teacher_id' => $teacher->id
                    ]);
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Mwalimu ameongezwa kikamilifu.'
            ]);
        }

        return redirect()->route('user.subjects.teachers.index')->with('success', 'Mwalimu ameongezwa kikamilifu.');
    }

    public function destroy(SubjectTeacher $teacher)
    {
        if ($teacher->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $teacher->delete();

        return redirect()->route('user.subjects.teachers.index')->with('success', 'Mwalimu ameondolewa kikamilifu.');
    }
}
