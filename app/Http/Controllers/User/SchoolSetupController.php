<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolSetupController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();

        if ($user && $user->school_id) {
            return redirect()->route('user.dashboard');
        }

        $school = $user
            ? School::where('user_id', $user->id)->first()
            : null;

        return view('user.school.setup', compact('school'));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'registration_number' => 'required|string|max:255|unique:schools,registration_number',
            'email' => 'required|email|max:255|unique:schools,email',
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

        $validated['user_id'] = $user->id;
        $validated['status'] = 'Pending';

        $school = School::create($validated);

        $user->forceFill(['school_id' => $school->id])->save();

        return redirect()->route('user.dashboard')
            ->with('success', 'Asante! Taarifa za shule zimehifadhiwa. Usajili wako upo kwenye hatua ya uthibitisho (Pending).');
    }
}
