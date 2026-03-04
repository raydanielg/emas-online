<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::latest()->paginate(10);
        return view('admin.schools.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:schools,registration_number',
            'email' => 'required|email|unique:schools,email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'category' => 'required|in:Government,Private',
            'level' => 'required|in:Primary,Secondary,O-Level,A-Level,Both',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('schools/logos', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'Pending';

        School::create($validated);

        return redirect()->route('schools.index')->with('success', 'School registered successfully and is awaiting approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        $stats = [
            'total_students' => $school->students()->count(),
            'total_teachers' => $school->users()->role('user')->count(),
            'male_students' => $school->students()->where('gender', 'Male')->count(),
            'female_students' => $school->students()->where('gender', 'Female')->count(),
            'total_classes' => $school->classes()->count(),
        ];

        return view('admin.schools.show', compact('school', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        return view('admin.schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:schools,registration_number,' . $school->id,
            'email' => 'required|email|unique:schools,email,' . $school->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'category' => 'required|in:Government,Private',
            'level' => 'required|in:Primary,Secondary,O-Level,A-Level,Both',
            'status' => 'required|in:Pending,Approved,Rejected',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('schools/logos', 'public');
        }

        $school->update($validated);

        return redirect()->route('schools.index')->with('success', 'School updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
    }

    public function pending()
    {
        $schools = School::where('status', 'Pending')->latest()->paginate(10);
        return view('admin.schools.index', compact('schools'));
    }

    public function approved()
    {
        $schools = School::where('status', 'Approved')->latest()->paginate(10);
        return view('admin.schools.index', compact('schools'));
    }

    public function rejected()
    {
        $schools = School::where('status', 'Rejected')->latest()->paginate(10);
        return view('admin.schools.index', compact('schools'));
    }

    public function rankings()
    {
        return view('admin.schools.rankings');
    }

    public function quickApprove(School $school)
    {
        if ($school->status !== 'Approved') {
            $school->status = 'Approved';
            $school->save();
        }

        $owner = $school->user;
        if ($owner && !$owner->school_id) {
            $owner->forceFill(['school_id' => $school->id])->save();
        }

        return redirect()->back()->with('success', 'School approved successfully.');
    }
}
