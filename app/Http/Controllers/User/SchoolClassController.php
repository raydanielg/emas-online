<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GlobalClass;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schoolId = auth()->user()->school_id;
        $classes = SchoolClass::where('school_id', $schoolId)
            ->with(['globalClass', 'teacher'])
            ->paginate(15);
            
        return view('user.classes.index', compact('classes'));
    }

    /**
     * Show the form for assigning global classes to the school.
     */
    public function assign()
    {
        $schoolId = auth()->user()->school_id;
        
        // Get classes already assigned to this school
        $assignedClassIds = SchoolClass::where('school_id', $schoolId)
            ->pluck('global_class_id')
            ->toArray();
            
        $globalClasses = GlobalClass::whereNotIn('id', $assignedClassIds)->get();
        
        return view('user.classes.assign', compact('globalClasses'));
    }

    /**
     * Store the assigned classes.
     */
    public function storeAssignment(Request $request)
    {
        $request->validate([
            'global_class_ids' => 'required|array',
            'global_class_ids.*' => 'exists:global_classes,id',
        ]);

        $schoolId = auth()->user()->school_id;

        foreach ($request->global_class_ids as $globalClassId) {
            SchoolClass::firstOrCreate([
                'school_id' => $schoolId,
                'global_class_id' => $globalClassId,
            ]);
        }

        return redirect()->route('user.classes.index')->with('success', 'Classes imported successfully for your school.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SchoolClass $class)
    {
        if ($class->school_id !== auth()->user()->school_id) {
            abort(403);
        }

        $class->delete();

        return redirect()->route('user.classes.index')->with('success', 'Class removed from your school.');
    }
}
