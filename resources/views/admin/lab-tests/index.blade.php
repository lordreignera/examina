@extends('layouts.admin')

@section('title', 'Lab Tests - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-flask"></i>
    </span> Lab Tests Management
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Lab Tests</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="card-title mb-0">All Lab Tests</h4>
          <button type="button" class="btn btn-gradient-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addLabTestModal">
            <i class="mdi mdi-plus"></i> Add New Lab Test
          </button>
        </div>
        
        @if($labTests->isEmpty())
          <div class="text-center py-5">
            <i class="mdi mdi-flask mdi-48px text-muted"></i>
            <p class="text-muted mt-3">No lab tests found. Create your first lab test!</p>
            <a href="{{ route('admin.lab-tests.create') }}" class="btn btn-gradient-primary btn-sm">
              <i class="mdi mdi-plus"></i> Add Lab Test
            </a>
          </div>
        @else
          <div class="table-responsive">
            <table class="table table-hover" id="labTestsTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Test Name</th>
                  <th>Description</th>
                  <th>Branches</th>
                  <th>Categories</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($labTests as $labTest)
                <tr>
                  <td>{{ $labTest->id }}</td>
                  <td><strong>{{ $labTest->test_name }}</strong></td>
                  <td>{{ Str::limit($labTest->description, 60) }}</td>
                  <td>
                    @if($labTest->branches->count() > 0)
                      @foreach($labTest->branches as $branch)
                        <span class="badge badge-primary" style="font-size: 0.75rem;">{{ $branch->branch_name }}</span>
                      @endforeach
                    @else
                      <span class="text-muted">No branches</span>
                    @endif
                  </td>
                  <td>
                    <span class="badge badge-info">{{ $labTest->test_categories_count }} categories</span>
                  </td>
                  <td>
                    @if($labTest->status == 'active')
                      <label class="badge badge-success">Active</label>
                    @else
                      <label class="badge badge-danger">Inactive</label>
                    @endif
                  </td>
                  <td>{{ $labTest->created_at->format('M d, Y') }}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-gradient-info" 
                            onclick="editLabTest({{ $labTest->id }}, '{{ addslashes($labTest->test_name) }}', '{{ addslashes($labTest->description) }}', '{{ $labTest->status }}')">
                      <i class="mdi mdi-pencil"></i>
                    </button>
                    <form action="{{ route('admin.lab-tests.destroy', $labTest->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this lab test? All associated test categories will also be deleted.')">
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

<!-- Add Lab Test Modal -->
<div class="modal fade" id="addLabTestModal" tabindex="-1" aria-labelledby="addLabTestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addLabTestModalLabel">
          <i class="mdi mdi-flask text-primary"></i> Add New Lab Test
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.lab-tests.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="test_name">Test Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('test_name') is-invalid @enderror" 
                   id="test_name" name="test_name" 
                   value="{{ old('test_name') }}" 
                   placeholder="e.g., HIV Testing, Blood Tests" required>
            @error('test_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" 
                      rows="3" 
                      placeholder="Brief description of this lab test category">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="branches">Available at Branches <span class="text-danger">*</span></label>
            <div class="card border">
              <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                @if(isset($branches) && $branches->count() > 0)
                  @foreach($branches as $branch)
                    <div class="form-check">
                      <input class="form-check-input @error('branches') is-invalid @enderror" 
                             type="checkbox" 
                             name="branches[]" 
                             value="{{ $branch->id }}" 
                             id="modal_branch{{ $branch->id }}"
                             {{ in_array($branch->id, old('branches', [])) ? 'checked' : '' }}>
                      <label class="form-check-label" for="modal_branch{{ $branch->id }}">
                        <strong>{{ $branch->branch_name }}</strong>
                        <br>
                        <small class="text-muted">{{ $branch->location }}</small>
                      </label>
                    </div>
                  @endforeach
                @else
                  <p class="text-muted mb-0 small">
                    <i class="mdi mdi-alert"></i> No branches found. <a href="{{ route('admin.branches.create') }}" target="_blank">Create a branch first</a>
                  </p>
                @endif
              </div>
            </div>
            @error('branches')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Select at least one branch</small>
          </div>

          <div class="form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
              <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Create Lab Test
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Lab Test Modal -->
<div class="modal fade" id="editLabTestModal" tabindex="-1" aria-labelledby="editLabTestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editLabTestModalLabel">
          <i class="mdi mdi-pencil text-info"></i> Edit Lab Test
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editLabTestForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_test_name">Test Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="edit_test_name" name="test_name" required>
          </div>
          
          <div class="form-group">
            <label for="edit_description">Description</label>
            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
          </div>
          
          <div class="form-group">
            <label for="edit_status">Status <span class="text-danger">*</span></label>
            <select class="form-control" id="edit_status" name="status" required>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gradient-info">
            <i class="mdi mdi-content-save"></i> Update Lab Test
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {
    $('#labTestsTable').DataTable({
      responsive: true,
      pageLength: 10,
      order: [[0, 'desc']],
      language: {
        search: "Search lab tests:",
        lengthMenu: "Show _MENU_ lab tests per page",
        info: "Showing _START_ to _END_ of _TOTAL_ lab tests",
        infoEmpty: "No lab tests available",
        infoFiltered: "(filtered from _MAX_ total lab tests)",
        zeroRecords: "No matching lab tests found"
      },
      columnDefs: [
        { orderable: false, targets: -1 } // Disable sorting on Actions column
      ]
    });
  });
  
  function editLabTest(id, name, description, status) {
    document.getElementById('editLabTestForm').action = '/admin/lab-tests/' + id;
    document.getElementById('edit_test_name').value = name;
    document.getElementById('edit_description').value = description || '';
    document.getElementById('edit_status').value = status;
    
    var editModal = new bootstrap.Modal(document.getElementById('editLabTestModal'));
    editModal.show();
  }
  
  @if($errors->any())
    var addModal = new bootstrap.Modal(document.getElementById('addLabTestModal'));
    addModal.show();
  @endif
</script>
@endpush
