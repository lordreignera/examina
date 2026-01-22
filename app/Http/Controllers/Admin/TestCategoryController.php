<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestCategory;
use App\Models\LabTest;
use App\Models\SpecimenType;
use Illuminate\Http\Request;

class TestCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testCategories = TestCategory::with(['labTest', 'specimen'])->latest()->get();
        return view('admin.test-categories.index', compact('testCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $labTests = LabTest::where('status', 'active')->get();
        $specimens = SpecimenType::all();
        return view('admin.test-categories.create', compact('labTests', 'specimens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lab_test_id' => 'required|exists:lab_tests,id',
            'specimen_id' => 'required|exists:specimen_types,id',
            'category_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:255',
            'when_done' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        TestCategory::create($validated);

        return redirect()->route('admin.test-categories.index')
            ->with('success', 'Test category created successfully!');
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
    public function edit(TestCategory $testCategory)
    {
        $labTests = LabTest::all();
        $specimens = SpecimenType::all();
        return view('admin.test-categories.edit', compact('testCategory', 'labTests', 'specimens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestCategory $testCategory)
    {
        $validated = $request->validate([
            'lab_test_id' => 'required|exists:lab_tests,id',
            'specimen_id' => 'required|exists:specimen_types,id',
            'category_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:255',
            'when_done' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $testCategory->update($validated);

        return redirect()->route('admin.test-categories.index')
            ->with('success', 'Test category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestCategory $testCategory)
    {
        $testCategory->delete();

        return redirect()->route('admin.test-categories.index')
            ->with('success', 'Test category deleted successfully!');
    }
}
