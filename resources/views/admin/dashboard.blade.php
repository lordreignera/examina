@extends('layouts.admin')

@section('title', 'Admin Dashboard - Lab Test System')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-home"></i>
    </span> Dashboard
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
      </li>
    </ul>
  </nav>
</div>

<div class="row mb-4">
  <div class="col-md-4 mb-4">
    <div class="card text-white shadow" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 15px; overflow: hidden;">
      <div class="card-body position-relative" style="padding: 2rem;">
        <img src="/admin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" style="opacity: 0.2;" />
        <h4 class="font-weight-normal mb-3">Lab Tests <i class="mdi mdi-flask mdi-24px float-right"></i></h4>
        <h2 class="mb-4 font-weight-bold" style="font-size: 3rem;">{{ $labTestsCount }}</h2>
        <h6 class="card-text">Main Test Categories</h6>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-4">
    <div class="card text-white shadow" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none; border-radius: 15px; overflow: hidden;">
      <div class="card-body position-relative" style="padding: 2rem;">
        <img src="/admin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" style="opacity: 0.2;" />
        <h4 class="font-weight-normal mb-3">Test Categories <i class="mdi mdi-format-list-bulleted mdi-24px float-right"></i></h4>
        <h2 class="mb-4 font-weight-bold" style="font-size: 3rem;">{{ $testCategoriesCount }}</h2>
        <h6 class="card-text">Specific Tests Available</h6>
      </div>
    </div>
  </div>
  <div class="col-md-4 mb-4">
    <div class="card text-white shadow" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none; border-radius: 15px; overflow: hidden;">
      <div class="card-body position-relative" style="padding: 2rem;">
        <img src="/admin/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" style="opacity: 0.2;" />
        <h4 class="font-weight-normal mb-3">Test Schedules <i class="mdi mdi-calendar-check mdi-24px float-right"></i></h4>
        <h2 class="mb-4 font-weight-bold" style="font-size: 3rem;">{{ $ordersCount }}</h2>
        <h6 class="card-text">Scheduled Lab Tests</h6>
      </div>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-12">
    <div class="card shadow" style="border: none; border-radius: 15px;">
      <div class="card-body" style="padding: 2rem;">
        <h4 class="card-title mb-4" style="font-size: 1.5rem; font-weight: 600; color: #2c3e50;">Recent Test Schedules</h4>
        <div class="table-responsive">
          <table class="table" id="recentOrdersTable">
            <thead>
              <tr>
                <th> Order ID </th>
                <th> Customer Name </th>
                <th> Email </th>
                <th> Phone </th>
                <th> Total Amount </th>
                <th> Status </th>
                <th> Date </th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentOrders as $order)
              <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_email }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>${{ number_format($order->total_amount, 2) }}</td>
                <td>
                  @if($order->schedule_status == 'pending')
                    <label class="badge badge-warning">Pending</label>
                  @elseif($order->schedule_status == 'confirmed')
                    <label class="badge badge-info">Confirmed</label>
                  @elseif($order->schedule_status == 'completed')
                    <label class="badge badge-success">Completed</label>
                  @else
                    <label class="badge badge-danger">Cancelled</label>
                  @endif
                </td>
                <td>{{ $order->created_at->format('M d, Y') }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center">No orders yet</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-4">
    <div class="card shadow" style="border: none; border-radius: 15px; height: 100%;">
      <div class="card-body" style="padding: 2rem;">
        <h4 class="card-title mb-4" style="font-size: 1.5rem; font-weight: 600; color: #2c3e50;">Lab Tests Overview</h4>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Lab Test</th>
                <th>Categories Count</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($labTests as $test)
              <tr>
                <td>{{ $test->test_name }}</td>
                <td>{{ $test->test_categories_count }}</td>
                <td>
                  @if($test->status == 'active')
                    <label class="badge badge-success">Active</label>
                  @else
                    <label class="badge badge-secondary">Inactive</label>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-4">
    <div class="card shadow" style="border: none; border-radius: 15px; height: 100%;">
      <div class="card-body" style="padding: 2rem;">
        <h4 class="card-title mb-4" style="font-size: 1.5rem; font-weight: 600; color: #2c3e50;">Quick Stats</h4>
        <ul class="list-group" style="border: none;">
          <a href="{{ route('admin.lab-tests.index') }}" class="text-decoration-none">
            <li class="list-group-item d-flex justify-content-between align-items-center" style="border: 1px solid #e8ecf1; border-radius: 10px; margin-bottom: 1rem; padding: 1.25rem; background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%); cursor: pointer; transition: all 0.3s;">
              <span style="font-weight: 500; color: #2c3e50;">Active Lab Tests</span>
              <span class="badge badge-pill" style="background: #667eea; padding: 0.5rem 1rem; font-size: 1rem;">{{ $activeLabTests }}</span>
            </li>
          </a>
          <a href="{{ route('admin.test-categories.index') }}" class="text-decoration-none">
            <li class="list-group-item d-flex justify-content-between align-items-center" style="border: 1px solid #e8ecf1; border-radius: 10px; margin-bottom: 1rem; padding: 1.25rem; background: linear-gradient(135deg, #f093fb15 0%, #f5576c15 100%); cursor: pointer; transition: all 0.3s;">
              <span style="font-weight: 500; color: #2c3e50;">Active Test Categories</span>
              <span class="badge badge-pill" style="background: #f5576c; padding: 0.5rem 1rem; font-size: 1rem;">{{ $activeTestCategories }}</span>
            </li>
          </a>
          <a href="{{ route('admin.specimen-types.index') }}" class="text-decoration-none">
            <li class="list-group-item d-flex justify-content-between align-items-center" style="border: 1px solid #e8ecf1; border-radius: 10px; margin-bottom: 1rem; padding: 1.25rem; background: linear-gradient(135deg, #4facfe15 0%, #00f2fe15 100%); cursor: pointer; transition: all 0.3s;">
              <span style="font-weight: 500; color: #2c3e50;">Specimen Types</span>
              <span class="badge badge-pill" style="background: #4facfe; padding: 0.5rem 1rem; font-size: 1rem;">{{ $specimenTypesCount }}</span>
            </li>
          </a>
          <a href="{{ route('admin.orders.index') }}" class="text-decoration-none">
            <li class="list-group-item d-flex justify-content-between align-items-center" style="border: 1px solid #e8ecf1; border-radius: 10px; margin-bottom: 0; padding: 1.25rem; background: linear-gradient(135deg, #ffa50015 0%, #ff634715 100%); cursor: pointer; transition: all 0.3s;">
              <span style="font-weight: 500; color: #2c3e50;">Pending Schedules</span>
              <span class="badge badge-pill" style="background: #ff6347; padding: 0.5rem 1rem; font-size: 1rem;">{{ $pendingOrders }}</span>
            </li>
          </a>
        </ul>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $(document).ready(function() {
    // Hover effects for Quick Stats links
    $('.list-group a').hover(
      function() {
        $(this).find('.list-group-item').css({
          'transform': 'translateX(5px)',
          'box-shadow': '0 5px 15px rgba(0,0,0,0.1)'
        });
      },
      function() {
        $(this).find('.list-group-item').css({
          'transform': 'translateX(0)',
          'box-shadow': 'none'
        });
      }
    );
    
    @if($recentOrders->count() > 0)
    $('#recentOrdersTable').DataTable({
      responsive: true,
      pageLength: 10,
      order: [[0, 'desc']],
      language: {
        search: "Search orders:",
        lengthMenu: "Show _MENU_ orders per page",
        info: "Showing _START_ to _END_ of _TOTAL_ orders",
        infoEmpty: "No orders available",
        infoFiltered: "(filtered from _MAX_ total orders)",
        zeroRecords: "No orders found"
      }
    });
    @endif
  });
</script>
@endpush

@endsection
