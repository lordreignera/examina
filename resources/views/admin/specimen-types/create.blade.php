@extends('layouts.admin')

@section('title', 'Create Specimen Type - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-test-tube"></i>
    </span> Create Specimen Type
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.specimen-types.index') }}">Specimen Types</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Specimen Type Information</h4>
        <p class="card-description">Add a new specimen type</p>
        
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
        
        <form action="{{ route('admin.specimen-types.store') }}" method="POST" class="forms-sample">
          @csrf
          
          <div class="form-group">
            <label for="specimen_name">Specimen Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('specimen_name') is-invalid @enderror" 
                   id="specimen_name" name="specimen_name" 
                   value="{{ old('specimen_name') }}" 
                   placeholder="e.g., Blood (Serum), Urine, Skin Prick" required>
            @error('specimen_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" 
                      rows="4" 
                      placeholder="Brief description of the specimen collection method">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <button type="submit" class="btn btn-gradient-primary me-2">
            <i class="mdi mdi-content-save"></i> Create Specimen Type
          </button>
          <a href="{{ route('admin.specimen-types.index') }}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-md-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Examples</h4>
        <p class="card-description">Common specimen types</p>
        <ul class="list-star">
          <li>Blood (Serum)</li>
          <li>Blood (Plasma)</li>
          <li>Blood (Whole)</li>
          <li>Urine</li>
          <li>Saliva</li>
          <li>Skin Prick</li>
          <li>Stool Sample</li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
