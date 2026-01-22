<?php

namespace App\Http\Controllers;

use App\Models\TestCategory;
use App\Models\TestSchedule;
use App\Models\TestScheduleItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'schedule_date' => 'required|date|after_or_equal:today',
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'nullable|string|max:20',
            'cart_items' => 'required|json',
        ]);

        $cartItems = json_decode($request->cart_items, true);
        
        if (empty($cartItems)) {
            return back()->with('error', 'Please select at least one test to schedule!');
        }

        // Calculate total
        $totalAmount = 0;
        $validItems = [];
        
        foreach ($cartItems as $item) {
            $testCategory = TestCategory::find($item['id']);
            if ($testCategory) {
                $totalAmount += $testCategory->price;
                $validItems[] = [
                    'test_category' => $testCategory,
                    'price' => $testCategory->price,
                ];
            }
        }

        // Create test schedule
        $order = TestSchedule::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'schedule_date' => $request->schedule_date,
            'total_amount' => $totalAmount,
            'schedule_status' => 'pending',
        ]);

        // Create schedule items
        foreach ($validItems as $item) {
            TestScheduleItem::create([
                'test_schedule_id' => $order->id,
                'test_category_id' => $item['test_category']->id,
                'test_name' => $item['test_category']->category_name,
                'price' => $item['price'],
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Test scheduled successfully! Schedule ID: #' . $order->id . ' for ' . date('M d, Y', strtotime($request->schedule_date)));
    }
}
