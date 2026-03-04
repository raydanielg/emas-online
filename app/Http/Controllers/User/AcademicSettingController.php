<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicSettingController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;

        $this->ensureDefaultTerms($schoolId);
        $this->ensureDefaultAcademicYears($schoolId);

        $academicYears = AcademicYear::query()
            ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId))
            ->orderByDesc('name')
            ->get();

        $currentAcademicYear = $academicYears->firstWhere('is_current', true);

        $terms = Term::query()
            ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId))
            ->whereIn('name', ['Term 1', 'Term 2'])
            ->orderBy('name')
            ->get();

        $currentTerm = $terms->firstWhere('is_current', true);

        return view('user.academic.index', compact('academicYears', 'currentAcademicYear', 'terms', 'currentTerm'));
    }

    public function updateCurrentYear(Request $request)
    {
        $schoolId = auth()->user()->school_id;

        $this->ensureDefaultAcademicYears($schoolId);

        $validated = $request->validate([
            'academic_year_id' => 'required|integer|exists:academic_years,id',
            'confirm' => 'accepted',
        ]);

        $targetYear = AcademicYear::query()
            ->where('id', $validated['academic_year_id'])
            ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId))
            ->firstOrFail();

        DB::transaction(function () use ($schoolId, $targetYear) {
            AcademicYear::query()
                ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId))
                ->update(['is_current' => false]);

            $targetYear->update(['is_current' => true]);
        });

        return redirect()->route('user.academic.settings')->with('success', 'Current academic year updated successfully.');
    }

    public function updateCurrentTerm(Request $request)
    {
        $schoolId = auth()->user()->school_id;

        $this->ensureDefaultTerms($schoolId);

        $validated = $request->validate([
            'term_id' => 'required|integer|exists:terms,id',
            'confirm_term' => 'accepted',
        ]);

        $targetTerm = Term::query()
            ->where('id', $validated['term_id'])
            ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId))
            ->whereIn('name', ['Term 1', 'Term 2'])
            ->firstOrFail();

        DB::transaction(function () use ($schoolId, $targetTerm) {
            Term::query()
                ->when($schoolId, fn ($q) => $q->where('school_id', $schoolId))
                ->update(['is_current' => false]);

            $targetTerm->update(['is_current' => true]);
        });

        return redirect()->route('user.academic.settings')->with('success', 'Current term updated successfully.');
    }

    private function ensureDefaultTerms($schoolId): void
    {
        if (!$schoolId) {
            return;
        }

        Term::firstOrCreate(['school_id' => $schoolId, 'name' => 'Term 1']);
        Term::firstOrCreate(['school_id' => $schoolId, 'name' => 'Term 2']);
    }

    private function ensureDefaultAcademicYears($schoolId): void
    {
        if (!$schoolId) {
            return;
        }

        $yearNow = (int) date('Y');

        $defaults = [
            (string) ($yearNow - 1),
            (string) $yearNow,
            (string) ($yearNow + 1),
        ];

        foreach ($defaults as $yearName) {
            AcademicYear::firstOrCreate([
                'school_id' => $schoolId,
                'name' => $yearName,
            ], [
                'is_current' => false,
            ]);
        }

        $hasCurrent = AcademicYear::query()
            ->where('school_id', $schoolId)
            ->where('is_current', true)
            ->exists();

        if (!$hasCurrent) {
            AcademicYear::query()
                ->where('school_id', $schoolId)
                ->where('name', (string) $yearNow)
                ->update(['is_current' => true]);
        }
    }
}
