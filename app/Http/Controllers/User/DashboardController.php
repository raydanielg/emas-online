<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Result;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $school = $user?->school;

        $schoolId = $school?->id;

        $totalStudents = $schoolId ? Student::where('school_id', $schoolId)->count() : 0;
        $totalClasses = $schoolId ? SchoolClass::where('school_id', $schoolId)->count() : 0;
        $totalExams = $schoolId ? Exam::where('school_id', $schoolId)->count() : 0;

        $totalSubjects = $schoolId
            ? Result::where('school_id', $schoolId)->distinct('subject_id')->count('subject_id')
            : 0;

        $classStats = [];
        $genderChart = [
            'labels' => [],
            'male' => [],
            'female' => [],
        ];

        $overview = [
            'total_students' => $totalStudents,
            'without_dob' => 0,
            'without_middle_name' => 0,
            'completion_percent' => 0,
        ];

        if ($schoolId) {
            $byClass = Student::query()
                ->select([
                    'class_level',
                    DB::raw('COUNT(*) as total'),
                    DB::raw("SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as male"),
                    DB::raw("SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as female"),
                    DB::raw('SUM(CASE WHEN date_of_birth IS NULL THEN 1 ELSE 0 END) as without_dob'),
                    DB::raw("SUM(CASE WHEN middle_name IS NULL OR middle_name = '' THEN 1 ELSE 0 END) as without_middle_name"),
                ])
                ->where('school_id', $schoolId)
                ->groupBy('class_level')
                ->orderBy('class_level')
                ->get();

            foreach ($byClass as $row) {
                $total = (int) $row->total;
                $withoutDob = (int) $row->without_dob;
                $progress = $total > 0 ? round((($total - $withoutDob) / $total) * 100, 1) : 0;

                $classStats[] = [
                    'class_level' => $row->class_level,
                    'total' => $total,
                    'male' => (int) $row->male,
                    'female' => (int) $row->female,
                    'without_dob' => $withoutDob,
                    'without_middle_name' => (int) $row->without_middle_name,
                    'progress' => $progress,
                ];

                $genderChart['labels'][] = $row->class_level;
                $genderChart['male'][] = (int) $row->male;
                $genderChart['female'][] = (int) $row->female;
            }

            $overview['without_dob'] = Student::where('school_id', $schoolId)->whereNull('date_of_birth')->count();
            $overview['without_middle_name'] = Student::where('school_id', $schoolId)
                ->where(function ($q) {
                    $q->whereNull('middle_name')->orWhere('middle_name', '');
                })->count();

            $overview['completion_percent'] = $totalStudents > 0
                ? round((($totalStudents - $overview['without_dob']) / $totalStudents) * 100, 1)
                : 0;
        }

        return view('user.dashboard', compact(
            'school',
            'totalStudents',
            'totalClasses',
            'totalSubjects',
            'totalExams',
            'classStats',
            'genderChart',
            'overview',
        ));
    }
}
