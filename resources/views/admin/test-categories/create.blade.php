@extends('layouts.admin')

@section('title', 'Create Test Category - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-format-list-bulleted"></i>
    </span> Create Test Category
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.test-categories.index') }}">Test Categories</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Test Category Information</h4>
        <p class="card-description">Add a new test category with pricing</p>
        
        @if ($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul class="mb-0 mt-2">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        
        <form action="{{ route('admin.test-categories.store') }}" method="POST" class="forms-sample">
          @csrf
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="lab_test_id">Lab Test <span class="text-danger">*</span></label>
                <select class="form-control @error('lab_test_id') is-invalid @enderror" id="lab_test_id" name="lab_test_id" required>
                  <option value="">Select Lab Test</option>
                  @foreach($labTests as $labTest)
                    <option value="{{ $labTest->id }}" {{ old('lab_test_id') == $labTest->id ? 'selected' : '' }}>
                      {{ $labTest->test_name }}
                    </option>
                  @endforeach
                </select>
                @error('lab_test_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="category_name">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('category_name') is-invalid @enderror" 
                       id="category_name" name="category_name" 
                       value="{{ old('category_name') }}" 
                       placeholder="e.g., HIV 1/2, Complete Blood Count" required>
                @error('category_name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="specimen_id">Specimen Type <span class="text-danger">*</span></label>
                <select class="form-control @error('specimen_id') is-invalid @enderror" id="specimen_id" name="specimen_id" required>
                  <option value="">Select Specimen Type</option>
                  @foreach($specimens as $specimen)
                    <option value="{{ $specimen->id }}" {{ old('specimen_id') == $specimen->id ? 'selected' : '' }}>
                      {{ $specimen->specimen_name }}
                    </option>
                  @endforeach
                </select>
                @error('specimen_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="price">Price (UGX) <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                       id="price" name="price" 
                       value="{{ old('price') }}" 
                       placeholder="e.g., 50000" 
                       step="0.01" min="0" required>
                @error('price')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" 
                      rows="3" 
                      placeholder="Brief description of this test">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                       id="duration" name="duration" 
                       value="{{ old('duration') }}" 
                       placeholder="e.g., 1-2 hours, 24 hours">
                @error('duration')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="when_done">When Done</label>
                <input type="text" class="form-control @error('when_done') is-invalid @enderror" 
                       id="when_done" name="when_done" 
                       value="{{ old('when_done') }}" 
                       placeholder="e.g., Mon-Fri, 8AM-4PM">
                @error('when_done')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="col-md-4">
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
          </div>
          
          <button type="submit" class="btn btn-gradient-primary me-2">
            <i class="mdi mdi-content-save"></i> Create Test Category
          </button>
          <a href="{{ route('admin.test-categories.index') }}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
