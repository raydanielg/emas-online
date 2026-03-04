<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Subject::query();

        if (request()->filled('q')) {
            $q = trim((string) request('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('code', 'like', "%{$q}%")
                    ->orWhere('category', 'like', "%{$q}%");
            });
        }

        if (request()->filled('category')) {
            $query->where('category', request('category'));
        }

        $subjects = $query->orderBy('code')->paginate(25)->withQueryString();

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name',
            'code' => 'required|string|max:50|unique:subjects,code',
            'category' => 'required|in:Core,Elective,Specialized',
            'description' => 'nullable|string',
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);

        return view('admin.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'code' => 'required|string|max:50|unique:subjects,code,' . $subject->id,
            'category' => 'required|in:Core,Elective,Specialized',
            'description' => 'nullable|string',
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function seed()
    {
        $subjects = [
            ['code' => '012', 'name' => 'HISTORY', 'category' => 'Core'],
            ['code' => '013', 'name' => 'GEOGRAPHY', 'category' => 'Core'],
            ['code' => '014', 'name' => 'BIBLE KNOWLEDGE', 'category' => 'Elective'],
            ['code' => '015', 'name' => 'ELIMU YA DINI YA KIISLAMU', 'category' => 'Elective'],
            ['code' => '021', 'name' => 'KISWAHILI', 'category' => 'Core'],
            ['code' => '022', 'name' => 'ENGLISH LANGUAGE', 'category' => 'Core'],
            ['code' => '023', 'name' => 'FRENCH LANGUAGE', 'category' => 'Elective'],
            ['code' => '031', 'name' => 'PHYSICS', 'category' => 'Core'],
            ['code' => '032', 'name' => 'CHEMISTRY', 'category' => 'Core'],
            ['code' => '033', 'name' => 'BIOLOGY', 'category' => 'Core'],
            ['code' => '034', 'name' => 'AGRICULTURE', 'category' => 'Elective'],
            ['code' => '035', 'name' => 'ENGINEERING SCIENCE', 'category' => 'Specialized'],
            ['code' => '042', 'name' => 'ADDITIONAL MATHEMATICS', 'category' => 'Elective'],
            ['code' => '063', 'name' => 'TYPEWRITING', 'category' => 'Specialized'],
            ['code' => '019', 'name' => 'THEATRE ARTS', 'category' => 'Elective'],
            ['code' => '026', 'name' => 'CHINESE LANGUAGE', 'category' => 'Elective'],
            ['code' => '025', 'name' => 'ARABIC LANGUAGE', 'category' => 'Elective'],
            ['code' => '016', 'name' => 'FINE ART', 'category' => 'Elective'],
            ['code' => '017', 'name' => 'MUSIC', 'category' => 'Elective'],
            ['code' => '051', 'name' => 'FOOD & NUTRITION', 'category' => 'Specialized'],
            ['code' => '018', 'name' => 'PHYSICAL EDUCATION', 'category' => 'Elective'],
            ['code' => '062', 'name' => 'BOOK-KEEPING', 'category' => 'Elective'],
            ['code' => '020', 'name' => 'SPORT STUDIES', 'category' => 'Elective'],
            ['code' => '037', 'name' => 'COMPUTER SCIENCE', 'category' => 'Elective'],
            ['code' => '065', 'name' => 'BUSINESS STUDIES', 'category' => 'Elective'],
            ['code' => '060', 'name' => 'HISTORIA YA TANZANIA NA MAADILI', 'category' => 'Core'],
            ['code' => '043', 'name' => 'MATHEMATICS', 'category' => 'Core'],
            ['code' => '398', 'name' => 'COMPUTER APPLICATION', 'category' => 'Elective'],
            ['code' => '397', 'name' => 'TECHNICAL DRAWING', 'category' => 'Specialized'],
            ['code' => '396', 'name' => 'LIFE SKILLS', 'category' => 'Core'],
            ['code' => '202', 'name' => 'FINISHING CRAFT', 'category' => 'Specialized'],
            ['code' => '203', 'name' => 'BASIC KNITTING', 'category' => 'Specialized'],
            ['code' => '231', 'name' => 'JEWELLERY', 'category' => 'Specialized'],
            ['code' => '232', 'name' => 'SALT EXTRACTION', 'category' => 'Specialized'],
            ['code' => '233', 'name' => 'GEMOLOGY (GEMSTONE CUTTING, POLISHING AND CARVING)', 'category' => 'Specialized'],
            ['code' => '261', 'name' => 'HAIR DRESSING', 'category' => 'Specialized'],
            ['code' => '262', 'name' => 'BEAUTY THERAPY', 'category' => 'Specialized'],
            ['code' => '263', 'name' => 'FITNESS AND NUTRITION', 'category' => 'Specialized'],
            ['code' => '281', 'name' => 'PACKAGING PRINTING', 'category' => 'Specialized'],
            ['code' => '282', 'name' => 'SCREEN PRINTING', 'category' => 'Specialized'],
            ['code' => '283', 'name' => 'BINDING AND PRINT FINISHING', 'category' => 'Specialized'],
            ['code' => '316', 'name' => 'BUSINESS OPERATION ASSISTANCE', 'category' => 'Specialized'],
            ['code' => '317', 'name' => 'SECRETARIAL', 'category' => 'Specialized'],
            ['code' => '318', 'name' => 'INSURANCE', 'category' => 'Specialized'],
            ['code' => '319', 'name' => 'WHOLESALE AND RETAILING', 'category' => 'Specialized'],
            ['code' => '320', 'name' => 'GEOSPATIAL TECHNOLOGY', 'category' => 'Specialized'],
            ['code' => '349', 'name' => 'TRANSPORT OPERATIONS', 'category' => 'Specialized'],
            ['code' => '350', 'name' => 'CLEARING AND FORWARDING', 'category' => 'Specialized'],
            ['code' => '402', 'name' => 'OIL SEED PROCESSING', 'category' => 'Specialized'],
            ['code' => '406', 'name' => 'WOOD PROCESSING', 'category' => 'Specialized'],
            ['code' => '407', 'name' => 'BEE KEEPING', 'category' => 'Specialized'],
            ['code' => '408', 'name' => 'FISHING AND FISH PROCESSING', 'category' => 'Specialized'],
            ['code' => '409', 'name' => 'AQUACULTURE AND FISH PROCESSING', 'category' => 'Specialized'],
            ['code' => '411', 'name' => 'SEAWEED FARMING', 'category' => 'Specialized'],
            ['code' => '486', 'name' => 'CARVING', 'category' => 'Specialized'],
            ['code' => '487', 'name' => 'DRAWING AND PAINTING', 'category' => 'Specialized'],
            ['code' => '488', 'name' => 'POTTERY AND CERAMIC', 'category' => 'Specialized'],
            ['code' => '489', 'name' => 'TEXTILE DESIGN AND SMALL-SCALE PRINTING', 'category' => 'Specialized'],
            ['code' => '490', 'name' => 'ART AND DESIGN', 'category' => 'Specialized'],
            ['code' => '802', 'name' => 'CIVIL DRAFTING', 'category' => 'Specialized'],
            ['code' => '803', 'name' => 'BOAT BUILDING', 'category' => 'Specialized'],
            ['code' => '807', 'name' => 'STEEL FIXING', 'category' => 'Specialized'],
            ['code' => '808', 'name' => 'WELL DRILLING', 'category' => 'Specialized'],
            ['code' => '809', 'name' => 'WOOD CARVING', 'category' => 'Specialized'],
            ['code' => '825', 'name' => 'BIO-ENERGY INSTALLATION', 'category' => 'Specialized'],
            ['code' => '826', 'name' => 'WIND POWER PLANTS INSTALLATION', 'category' => 'Specialized'],
            ['code' => '843', 'name' => 'ELECTRONICS REPAIR', 'category' => 'Specialized'],
            ['code' => '863', 'name' => 'AUTO-BODY REPAIR', 'category' => 'Specialized'],
            ['code' => '864', 'name' => 'MOTOR-CYCLE MECHANICS', 'category' => 'Specialized'],
            ['code' => '865', 'name' => 'AGRO-MECHANICS', 'category' => 'Specialized'],
            ['code' => '883', 'name' => 'FITTER MACHINIST', 'category' => 'Specialized'],
            ['code' => '884', 'name' => 'FITTER MECHANICS', 'category' => 'Specialized'],
            ['code' => '885', 'name' => 'GINNERY FITTING', 'category' => 'Specialized'],
            ['code' => '882', 'name' => 'REFRIGERATION AND AIR CONDITIONING', 'category' => 'Specialized'],
            ['code' => '482', 'name' => 'COSTUME AND MAKEUP DESIGNS', 'category' => 'Specialized'],
        ];

        foreach ($subjects as $subject) {
            Subject::updateOrCreate(
                ['code' => $subject['code']],
                ['name' => $subject['name'], 'category' => $subject['category']]
            );
        }

        return redirect()->back()->with('success', 'Global subjects imported successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
