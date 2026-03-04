<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultDraftController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;

        $query = Result::with(['student', 'subject'])
            ->where('school_id', $schoolId)
            ->where('status', 'draft');

        $kpis = [
            'total_drafts' => (clone $query)->count(),
            'oldest_draft' => (clone $query)->oldest()->first()?->created_at,
        ];

        $drafts = $query->latest()->paginate(15);

        return view('user.results.drafts', compact('drafts', 'kpis'));
    }
}
