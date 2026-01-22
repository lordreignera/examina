@extends('layouts.admin')

@section('title', 'Edit Lab Test - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-flask"></i>
    </span> Edit Lab Test
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.lab-tests.index') }}">Lab Tests</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Lab Test: {{ $labTest->test_name }}</h4>
        <p class="card-description">Update lab test information</p>
        
        <form action="{{ route('admin.lab-tests.update', $labTest->id) }}" method="POST" class="forms-sample">
          @csrf
          @method('PUT')
          
          <div class="form-group">
            <label for="test_name">Test Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('test_name') is-invalid @enderror" 
                   id="test_name" name="test_name" 
                   value="{{ old('test_name', $labTest->test_name) }}" 
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
                      placeholder="Brief description of this lab test category">{{ old('description', $labTest->description) }}</textarea>
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
                             {{ in_array($branch->id, old('branches', $labTest->branches->pluck('id')->toArray())) ? 'checked' : '' }}>
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
              <option value="active" {{ old('status', $labTest->status) == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ old('status', $labTest->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <button type="submit" class="btn btn-gradient-primary me-2">
            <i class="mdi mdi-content-save"></i> Update Lab Test
          </button>
          <a href="{{ route('admin.lab-tests.index') }}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-md-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Test Categories</h4>
        <p class="card-description">{{ $labTest->testCategories->count() }} categories under this test</p>
        @if($labTest->testCategories->count() > 0)
          <ul class="list-ticked">
            @foreach($labTest->testCategories as $category)
              <li>{{ $category->category_name }} - UGX {{ number_format($category->price, 0) }}</li>
            @endforeach
          </ul>
        @else
          <p class="text-muted">No test categories yet.</p>
        @endif
        <a href="{{ route('admin.test-categories.create') }}" class="btn btn-sm btn-gradient-info mt-2">
          <i class="mdi mdi-plus"></i> Add Test Category
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
