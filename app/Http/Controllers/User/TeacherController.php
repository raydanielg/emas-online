<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $schoolId = auth()->user()->school_id;

        // For now, teachers are users belonging to this school who are NOT the owner (or we can filter by a role if added later)
        // Since only 'admin' and 'user' roles exist, we'll assume other users linked to this school_id are staff/teachers
        $query = User::where('school_id', $schoolId)
            ->where('id', '!=', auth()->id());

        $kpis = [
            'total_teachers' => (clone $query)->count(),
        ];

        $teachers = $query->latest()->paginate(15);

        return view('user.teachers.index', compact('teachers', 'kpis'));
    }
}
