<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\School;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('school')->latest()->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    public function subscriptions()
    {
        $schools = School::withCount('students')->paginate(15);
        return view('admin.payments.subscriptions', compact('schools'));
    }

    public function approvals()
    {
        $payments = Payment::where('status', 'pending')->with('school')->latest()->paginate(15);
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Update the specified resource status.
     */
    public function updateStatus(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:successful,rejected',
        ]);

        $payment->update([
            'status' => $validated['status'],
            'paid_at' => $validated['status'] === 'successful' ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
