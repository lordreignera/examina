<?php

namespace App\Http\Controllers;

use App\Models\LabTest;
use App\Models\Branch;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::where('status', 'active')->get();
        $selectedBranchId = $request->get('branch_id');

        // Get lab tests based on branch selection
        $labTestsQuery = LabTest::with(['testCategories' => function($query) {
                $query->where('price', '>', 0) // Only get priced tests (not parent categories)
                      ->with('specimenType')
                      ->orderBy('level')
                      ->orderBy('category_name');
            }])
            ->where('status', 'active');

        // Filter by branch if selected
        if ($selectedBranchId) {
            $labTestsQuery->whereHas('branches', function($query) use ($selectedBranchId) {
                $query->where('branches.id', $selectedBranchId);
            });
        }

        $labTests = $labTestsQuery->get();

        return view('welcome', compact('labTests', 'branches', 'selectedBranchId'));
    }
}
