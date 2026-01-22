<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\Branch;
use Illuminate\Http\Request;

class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labTests = LabTest::with('branches')->withCount('testCategories')->latest()->get();
        $branches = Branch::where('status', 'active')->get();
        return view('admin.lab-tests.index', compact('labTests', 'branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::where('status', 'active')->get();
        return view('admin.lab-tests.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'test_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'branches' => 'required|array|min:1',
            'branches.*' => 'exists:branches,id',
        ]);

        $labTest = LabTest::create([
            'test_name' => $validated['test_name'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        // Attach selected branches
        $labTest->branches()->sync($validated['branches']);

        return redirect()->route('admin.lab-tests.index')
            ->with('success', 'Lab test created successfully!');
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
    public function edit(LabTest $labTest)
    {
        $branches = Branch::where('status', 'active')->get();
        $labTest->load('branches');
        return view('admin.lab-tests.edit', compact('labTest', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LabTest $labTest)
    {
        $validated = $request->validate([
            'test_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'branches' => 'required|array|min:1',
            'branches.*' => 'exists:branches,id',
        ]);

        $labTest->update([
            'test_name' => $validated['test_name'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ]);

        // Update branches
        $labTest->branches()->sync($validated['branches']);

        return redirect()->route('admin.lab-tests.index')
            ->with('success', 'Lab test updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LabTest $labTest)
    {
        $labTest->delete();

        return redirect()->route('admin.lab-tests.index')
            ->with('success', 'Lab test deleted successfully!');
    }
}
