@extends('layouts.admin')

@section('title', 'Specimen Types - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-test-tube"></i>
    </span> Specimen Types Management
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Specimen Types</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="card-title mb-0">All Specimen Types</h4>
          <a href="{{ route('admin.specimen-types.create') }}" class="btn btn-gradient-primary btn-sm">
            <i class="mdi mdi-plus"></i> Add New Specimen Type
          </a>
        </div>
        
        @if($specimenTypes->isEmpty())
          <div class="text-center py-5">
            <i class="mdi mdi-test-tube mdi-48px text-muted"></i>
            <p class="text-muted mt-3">No specimen types found. Create your first specimen type!</p>
            <a href="{{ route('admin.specimen-types.create') }}" class="btn btn-gradient-primary btn-sm">
              <i class="mdi mdi-plus"></i> Add Specimen Type
            </a>
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-hover" id="specimenTypesTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Specimen Name</th>
                  <th>Description</th>
                  <th>Used in Tests</th>
                  <th>Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($specimenTypes as $specimen)
                <tr>
                  <td>{{ $specimen->id }}</td>
                  <td><strong>{{ $specimen->specimen_name }}</strong></td>
                  <td>{{ Str::limit($specimen->description, 80) }}</td>
                  <td>
                    <span class="badge badge-info">{{ $specimen->test_categories_count }} tests</span>
                  </td>
                  <td>{{ $specimen->created_at->format('M d, Y') }}</td>
                  <td>
                    <a href="{{ route('admin.specimen-types.edit', $specimen->id) }}" class="btn btn-sm btn-gradient-info">
                      <i class="mdi mdi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.specimen-types.destroy', $specimen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this specimen type?')">
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
    $('#specimenTypesTable').DataTable({
      responsive: true,
      pageLength: 10,
      order: [[0, 'desc']],
      language: {
        search: "Search specimen types:",
        lengthMenu: "Show _MENU_ specimen types per page",
        info: "Showing _START_ to _END_ of _TOTAL_ specimen types",
        infoEmpty: "No specimen types available",
        infoFiltered: "(filtered from _MAX_ total specimen types)",
        zeroRecords: "No matching specimen types found"
      },
      columnDefs: [
        { orderable: false, targets: -1 } // Disable sorting on Actions column
      ]
    });
  });
</script>
@endpush

@endsection
