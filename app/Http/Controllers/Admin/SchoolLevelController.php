<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolLevel;
use Illuminate\Http\Request;

class SchoolLevelController extends Controller
{
    public function index()
    {
        $levels = SchoolLevel::latest()->paginate(10);
        return view('admin.schools.levels.index', compact('levels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:school_levels,name',
            'description' => 'nullable|string',
        ]);

        SchoolLevel::create($validated);

        return redirect()->back()->with('success', 'Level added successfully.');
    }

    public function seed()
    {
        $levels = [
            ['name' => 'Primary', 'description' => 'Primary School Level (Standard 1-7)'],
            ['name' => 'O-Level', 'description' => 'Ordinary Secondary Level (Form 1-4)'],
            ['name' => 'A-Level', 'description' => 'Advanced Secondary Level (Form 5-6)'],
            ['name' => 'Both', 'description' => 'Secondary Level with both O-Level & A-Level'],
        ];

        foreach ($levels as $level) {
            SchoolLevel::updateOrCreate(['name' => $level['name']], $level);
        }

        return redirect()->back()->with('success', 'Default School Levels imported successfully.');
    }
}
