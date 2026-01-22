@extends('layouts.admin')

@section('title', 'Test Schedule Details - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-calendar-check"></i>
    </span> Test Schedule Details
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Test Schedules</a></li>
      <li class="breadcrumb-item active" aria-current="page">Schedule #{{ $order->id }}</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-lg-8">
    <div class="card shadow mb-4" style="border: none; border-radius: 15px;">
      <div class="card-body" style="padding: 2rem;">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="card-title mb-0" style="font-size: 1.5rem; font-weight: 600; color: #2c3e50;">
            Schedule #{{ $order->id }}
          </h4>
          <div>
            @if($order->schedule_status == 'pending')
              <span class="badge bg-warning text-dark fs-6 px-3 py-2">Pending</span>
            @elseif($order->schedule_status == 'confirmed')
              <span class="badge bg-info text-white fs-6 px-3 py-2">Confirmed</span>
            @elseif($order->schedule_status == 'completed')
              <span class="badge bg-success fs-6 px-3 py-2">Completed</span>
            @else
              <span class="badge bg-danger fs-6 px-3 py-2">Cancelled</span>
            @endif
          </div>
        </div>

        <h5 class="mb-3" style="color: #2c3e50; font-weight: 600;">Scheduled Tests</h5>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="table-light">
              <tr>
                <th>Test Category</th>
                <th>Lab Test</th>
                <th>Specimen Type</th>
                <th>Duration</th>
                <th class="text-end">Price</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->orderItems as $item)
              <tr>
                <td><strong>{{ $item->testCategory->category_name }}</strong></td>
                <td>{{ $item->testCategory->labTest->test_name }}</td>
                <td>{{ $item->testCategory->specimenType->specimen_name }}</td>
                <td>{{ $item->testCategory->test_duration }}</td>
                <td class="text-end"><strong>UGX {{ number_format($item->price, 0) }}</strong></td>
              </tr>
              @endforeach
            </tbody>
            <tfoot class="table-light">
              <tr>
                <td colspan="4" class="text-end"><strong>Total Amount:</strong></td>
                <td class="text-end"><strong style="font-size: 1.2rem; color: #2196F3;">UGX {{ number_format($order->total_amount, 0) }}</strong></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card shadow mb-4" style="border: none; border-radius: 15px;">
      <div class="card-body" style="padding: 2rem;">
        <h5 class="mb-3" style="color: #2c3e50; font-weight: 600;">Customer Information</h5>
        <div class="mb-3">
          <label class="text-muted mb-1">Name:</label>
          <p class="mb-0" style="font-weight: 500;">{{ $order->customer_name }}</p>
        </div>
        <div class="mb-3">
          <label class="text-muted mb-1">Email:</label>
          <p class="mb-0" style="font-weight: 500;">{{ $order->customer_email ?? 'Not provided' }}</p>
        </div>
        <div class="mb-3">
          <label class="text-muted mb-1">Phone:</label>
          <p class="mb-0" style="font-weight: 500;">{{ $order->customer_phone ?? 'Not provided' }}</p>
        </div>
        <div class="mb-3">
          <label class="text-muted mb-1">Scheduled On:</label>
          <p class="mb-0" style="font-weight: 500;">{{ $order->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <div class="mb-3">
          <label class="text-muted mb-1">Last Updated:</label>
          <p class="mb-0" style="font-weight: 500;">{{ $order->updated_at->format('M d, Y h:i A') }}</p>
        </div>
      </div>
    </div>

    <div class="card shadow" style="border: none; border-radius: 15px;">
      <div class="card-body" style="padding: 2rem;">
        <h5 class="mb-3" style="color: #2c3e50; font-weight: 600;">Actions</h5>
        
        <div class="d-grid gap-2">
          @if($order->schedule_status != 'confirmed')
          <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="schedule_status" value="confirmed">
            <button type="submit" class="btn btn-info w-100">
              <i class="mdi mdi-check-circle"></i> Mark as Confirmed
            </button>
          </form>
          @endif

          @if($order->schedule_status != 'completed')
          <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="schedule_status" value="completed">
            <button type="submit" class="btn btn-success w-100">
              <i class="mdi mdi-checkbox-marked-circle"></i> Mark as Completed
            </button>
          </form>
          @endif

          @if($order->schedule_status != 'cancelled')
          <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="schedule_status" value="cancelled">
            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to cancel this schedule?')">
              <i class="mdi mdi-close-circle"></i> Cancel Schedule
            </button>
          </form>
          @endif

          <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary w-100">
            <i class="mdi mdi-arrow-left"></i> Back to Schedules
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
