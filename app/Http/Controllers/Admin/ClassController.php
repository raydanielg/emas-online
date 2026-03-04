<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GlobalClass;
use App\Models\SchoolClass;
use App\Models\School;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = GlobalClass::latest()->paginate(15);
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:global_classes,name',
            'level' => 'required|string|in:Primary,O-Level,A-Level,Both,Secondary,College',
        ]);

        GlobalClass::create($validated);

        return redirect()->route('admin.classes.index')->with('success', 'Global Class created successfully.');
    }

    public function destroy(GlobalClass $class)
    {
        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Global Class deleted successfully.');
    }
}
