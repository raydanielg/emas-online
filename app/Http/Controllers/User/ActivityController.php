<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;

        // Fetch login histories for users belonging to this school
        $query = LoginHistory::whereHas('user', function ($q) use ($schoolId) {
            $q->where('school_id', $schoolId);
        })->with('user');

        $kpis = [
            'total_logs' => (clone $query)->count(),
            'last_activity' => (clone $query)->latest()->first()?->login_at,
        ];

        $activities = $query->latest('login_at')->paginate(15);

        return view('user.activities.index', compact('activities', 'kpis'));
    }
}
