<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolInfoController extends Controller
{
    public function show(Request $request)
    {
        $school = $request->user()?->school;

        return view('user.academic.school-info', compact('school'));
    }

    public function edit(Request $request)
    {
        $school = $request->user()?->school;

        return view('user.academic.school-edit', compact('school'));
    }

    public function update(Request $request)
    {
        $school = $request->user()?->school;

        if (!$school) {
            return redirect()->route('user.school.setup')
                ->with('warning', 'Tafadhali kamilisha usajili: jaza taarifa za shule yako kwanza.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:schools,registration_number,' . $school->id,
            'email' => 'required|email|max:255|unique:schools,email,' . $school->id,
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'category' => 'required|in:Government,Private',
            'level' => 'required|in:Primary,Secondary,O-Level,A-Level,Both',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('schools/logos', 'public');
        }

        $school->update($validated);

        return redirect()->route('user.academic.school.info')
            ->with('success', 'Taarifa za shule zimesasishwa kikamilifu.');
    }
}
