<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolCategory;
use Illuminate\Http\Request;

class SchoolCategoryController extends Controller
{
    public function index()
    {
        $categories = SchoolCategory::latest()->paginate(10);
        return view('admin.schools.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:school_categories,name',
            'description' => 'nullable|string',
        ]);

        SchoolCategory::create($validated);

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function seed()
    {
        $categories = [
            ['name' => 'Government', 'description' => 'Public/Government owned schools'],
            ['name' => 'Private', 'description' => 'Private/Independently owned schools'],
            ['name' => 'Religious', 'description' => 'Faith-based schools'],
            ['name' => 'International', 'description' => 'Schools following international curriculum'],
        ];

        foreach ($categories as $category) {
            SchoolCategory::updateOrCreate(['name' => $category['name']], $category);
        }

        return redirect()->back()->with('success', 'Default School Categories imported successfully.');
    }
}
