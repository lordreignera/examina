@extends('layouts.admin')

@section('title', 'Create Lab Test - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-flask"></i>
    </span> Create Lab Test
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.lab-tests.index') }}">Lab Tests</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Lab Test Information</h4>
        <p class="card-description">Add a new lab test category</p>
        
        <form action="{{ route('admin.lab-tests.store') }}" method="POST" class="forms-sample">
          @csrf
          
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
                      rows="4" 
                      placeholder="Brief description of this lab test category">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label for="branches">Available at Branches <span class="text-danger">*</span></label>
            <div class="card border">
              <div class="card-body">
                @if($branches->isEmpty())
                  <p class="text-muted mb-0">
                    <i class="mdi mdi-alert"></i> No branches found. <a href="{{ route('admin.branches.create') }}">Create a branch first</a>
                  </p>
                @else
                  @foreach($branches as $branch)
                    <div class="form-check">
                      <input class="form-check-input @error('branches') is-invalid @enderror" 
                             type="checkbox" 
                             name="branches[]" 
                             value="{{ $branch->id }}" 
                             id="branch{{ $branch->id }}"
                             {{ in_array($branch->id, old('branches', [])) ? 'checked' : '' }}>
                      <label class="form-check-label" for="branch{{ $branch->id }}">
                        <strong>{{ $branch->branch_name }}</strong>
                        <br>
                        <small class="text-muted">{{ $branch->location }}</small>
                      </label>
                    </div>
                  @endforeach
                @endif
              </div>
            </div>
            @error('branches')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Select at least one branch where this test will be available</small>
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
          
          <button type="submit" class="btn btn-gradient-primary me-2">
            <i class="mdi mdi-content-save"></i> Create Lab Test
          </button>
          <a href="{{ route('admin.lab-tests.index') }}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-md-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Information</h4>
        <p class="card-description">Lab Test Guidelines</p>
        <ul class="list-star">
          <li>Lab tests are main categories (e.g., HIV Testing, Allergies)</li>
          <li>Test categories with specific prices are added separately</li>
          <li>Active lab tests are visible on the public website</li>
          <li>Test name should be clear and descriptive</li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
