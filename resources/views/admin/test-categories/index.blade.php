@extends('layouts.admin')

@section('title', 'Test Categories - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-format-list-bulleted"></i>
    </span> Test Categories Management
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Test Categories</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="card-title mb-0">All Test Categories</h4>
          <a href="{{ route('admin.test-categories.create') }}" class="btn btn-gradient-primary btn-sm">
            <i class="mdi mdi-plus"></i> Add New Test Category
          </a>
        </div>
        
        @if($testCategories->isEmpty())
          <div class="text-center py-5">
            <i class="mdi mdi-format-list-bulleted mdi-48px text-muted"></i>
            <p class="text-muted mt-3">No test categories found. Create your first test category!</p>
            <a href="{{ route('admin.test-categories.create') }}" class="btn btn-gradient-primary btn-sm">
              <i class="mdi mdi-plus"></i> Add Test Category
            </a>
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-hover" id="testCategoriesTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Lab Test</th>
                  <th>Specimen</th>
                  <th>Price (UGX)</th>
                  <th>Duration</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($testCategories as $category)
                <tr>
                  <td>{{ $category->id }}</td>
                  <td><strong>{{ $category->category_name }}</strong></td>
                  <td>{{ $category->labTest->test_name }}</td>
                  <td>
                    @if($category->specimen)
                      <span class="badge badge-secondary">{{ $category->specimen->specimen_name }}</span>
                    @else
                      <span class="text-muted">N/A</span>
                    @endif
                  </td>
                  <td><strong>{{ number_format($category->price, 0) }}</strong></td>
                  <td>{{ $category->duration }}</td>
                  <td>
                    @if($category->status == 'active')
                      <label class="badge badge-success">Active</label>
                    @else
                      <label class="badge badge-danger">Inactive</label>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('admin.test-categories.edit', $category->id) }}" class="btn btn-sm btn-gradient-info">
                      <i class="mdi mdi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.test-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this test category?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-gradient-danger">
                        <i class="mdi mdi-delete"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  $(document).ready(function() {
    $('#testCategoriesTable').DataTable({
      responsive: true,
      pageLength: 10,
      order: [[0, 'desc']],
      language: {
        search: "Search test categories:",
        lengthMenu: "Show _MENU_ test categories per page",
        info: "Showing _START_ to _END_ of _TOTAL_ test categories",
        infoEmpty: "No test categories available",
        infoFiltered: "(filtered from _MAX_ total test categories)",
        zeroRecords: "No matching test categories found"
      },
      columnDefs: [
        { orderable: false, targets: -1 } // Disable sorting on Actions column
      ]
    });
  });
</script>
@endpush

@endsection
