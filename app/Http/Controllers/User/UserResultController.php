<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class UserResultController extends Controller
{
    public function latest()
    {
        $schoolId = auth()->user()->school_id;

        $query = Result::with(['student', 'subject', 'exam'])
            ->where('school_id', $schoolId);

        $kpis = [
            'total_results' => (clone $query)->count(),
            'last_upload' => (clone $query)->latest()->first()?->created_at,
        ];

        $results = $query->latest()->paginate(15);

        return view('user.results.latest', compact('results', 'kpis'));
    }
}
