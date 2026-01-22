<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabTest;
use App\Models\TestCategory;
use App\Models\SpecimenType;
use App\Models\TestSchedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $labTestsCount = LabTest::count();
        $testCategoriesCount = TestCategory::count();
        $ordersCount = TestSchedule::count();
        $specimenTypesCount = SpecimenType::count();
        
        $activeLabTests = LabTest::where('status', 'active')->count();
        $activeTestCategories = TestCategory::where('status', 'active')->count();
        $pendingOrders = TestSchedule::where('schedule_status', 'pending')->count();
        
        $recentOrders = TestSchedule::latest()->take(10)->get();
        $labTests = LabTest::withCount('testCategories')->get();

        return view('admin.dashboard', compact(
            'labTestsCount',
            'testCategoriesCount',
            'ordersCount',
            'specimenTypesCount',
            'activeLabTests',
            'activeTestCategories',
            'pendingOrders',
            'recentOrders',
            'labTests'
        ));
    }
}
