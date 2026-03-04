<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Subject;
use Illuminate\Http\Request;

class PublicResourcesController extends Controller
{
    /**
     * Display the public resources page.
     */
    public function index(Request $request)
    {
        $query = Resource::with('subject');

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has('subject') && $request->subject != '') {
            $query->where('subject_id', $request->subject);
        }

        $resources = $query->latest()->paginate(12);
        $subjects = Subject::orderBy('name')->get();
        $types = ['Lesson Plan', 'Past Paper', 'Syllabus', 'E-Learning'];

        return view('public.resources.index', compact('resources', 'subjects', 'types'));
    }
}
