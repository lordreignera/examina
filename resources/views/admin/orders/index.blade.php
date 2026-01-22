@extends('layouts.admin')

@section('title', 'Test Schedules - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-calendar-check"></i>
    </span> Test Schedules
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Test Schedules</li>
    </ul>
  </nav>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card shadow" style="border: none; border-radius: 15px;">
      <div class="card-body" style="padding: 2rem;">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h4 class="card-title mb-0" style="font-size: 1.5rem; font-weight: 600; color: #2c3e50;">All Test Schedules</h4>
          <div>
            <span class="badge bg-warning text-dark">{{ $orders->total() }} Total</span>
          </div>
        </div>
        
        <div class="table-responsive">
          <table class="table table-hover" id="ordersTable">
            <thead>
              <tr>
                <th>Schedule ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Scheduled Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders as $order)
              <tr>
                <td><strong>#{{ $order->id }}</strong></td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_email ?? 'N/A' }}</td>
                <td>{{ $order->customer_phone ?? 'N/A' }}</td>
                <td><strong>UGX {{ number_format($order->total_amount, 0) }}</strong></td>
                <td>
                  @if($order->schedule_status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                  @elseif($order->schedule_status == 'confirmed')
                    <span class="badge bg-info text-white">Confirmed</span>
                  @elseif($order->schedule_status == 'completed')
                    <span class="badge bg-success">Completed</span>
                  @else
                    <span class="badge bg-danger">Cancelled</span>
                  @endif
                </td>
                <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                <td>
                  <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info" title="View Details">
                    <i class="mdi mdi-eye"></i>
                  </a>
                  
                  <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="mdi mdi-pencil"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="schedule_status" value="pending">
                          <button type="submit" class="dropdown-item">
                            <i class="mdi mdi-clock-outline text-warning"></i> Mark Pending
                          </button>
                        </form>
                      </li>
                      <li>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="schedule_status" value="confirmed">
                          <button type="submit" class="dropdown-item">
                            <i class="mdi mdi-check-circle text-info"></i> Mark Confirmed
                          </button>
                        </form>
                      </li>
                      <li>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="schedule_status" value="completed">
                          <button type="submit" class="dropdown-item">
                            <i class="mdi mdi-checkbox-marked-circle text-success"></i> Mark Completed
                          </button>
                        </form>
                      </li>
                      <li>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('PUT')
                          <input type="hidden" name="schedule_status" value="cancelled">
                          <button type="submit" class="dropdown-item">
                            <i class="mdi mdi-close-circle text-danger"></i> Mark Cancelled
                          </button>
                        </form>
                      </li>
                    </ul>
                  </div>
                  
                  <button class="btn btn-sm btn-danger" onclick="deleteOrder({{ $order->id }})" title="Delete">
                    <i class="mdi mdi-delete"></i>
                  </button>
                  
                  <form id="delete-form-{{ $order->id }}" action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center py-4">
                  <i class="mdi mdi-calendar-remove mdi-48px text-muted"></i>
                  <p class="text-muted mt-2">No test schedules found</p>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        
        @if($orders->hasPages())
        <div class="mt-4">
          {{ $orders->links() }}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $(document).ready(function() {
    @if($orders->count() > 0)
    $('#ordersTable').DataTable({
      responsive: true,
      pageLength: 10,
      order: [[0, 'desc']],
      language: {
        search: "Search schedules:",
        lengthMenu: "Show _MENU_ schedules per page",
        info: "Showing _START_ to _END_ of _TOTAL_ schedules",
        infoEmpty: "No schedules available",
        infoFiltered: "(filtered from _MAX_ total schedules)",
        zeroRecords: "No schedules found"
      },
      columnDefs: [
        { orderable: false, targets: 7 }
      ]
    });
    @endif
  });

  function deleteOrder(id) {
    if (confirm('Are you sure you want to delete this test schedule? This action cannot be undone.')) {
      document.getElementById('delete-form-' + id).submit();
    }
  }
</script>
@endpush

@endsection
