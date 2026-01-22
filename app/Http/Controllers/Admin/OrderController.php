<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestSchedule;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = TestSchedule::with('orderItems.testCategory.labTest')
            ->latest()
            ->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
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
        $order = TestSchedule::with('orderItems.testCategory.labTest', 'orderItems.testCategory.specimenType')
            ->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
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
        $request->validate([
            'schedule_status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $order = TestSchedule::findOrFail($id);
        $order->update([
            'schedule_status' => $request->schedule_status,
        ]);
$order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Test schedule deleted successfully.');
        return redirect()->route('admin.orders.index')
            ->with('success', 'Test schedule status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
