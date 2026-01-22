<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecimenType;
use Illuminate\Http\Request;

class SpecimenTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specimenTypes = SpecimenType::withCount('testCategories')->latest()->get();
        return view('admin.specimen-types.index', compact('specimenTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.specimen-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'specimen_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        SpecimenType::create($validated);

        return redirect()->route('admin.specimen-types.index')
            ->with('success', 'Specimen type created successfully!');
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
    public function edit(SpecimenType $specimenType)
    {
        return view('admin.specimen-types.edit', compact('specimenType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecimenType $specimenType)
    {
        $validated = $request->validate([
            'specimen_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $specimenType->update($validated);

        return redirect()->route('admin.specimen-types.index')
            ->with('success', 'Specimen type updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecimenType $specimenType)
    {
        $specimenType->delete();

        return redirect()->route('admin.specimen-types.index')
            ->with('success', 'Specimen type deleted successfully!');
    }
}
