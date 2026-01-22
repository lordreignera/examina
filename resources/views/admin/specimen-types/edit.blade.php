@extends('layouts.admin')

@section('title', 'Edit Specimen Type - Admin')

@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-test-tube"></i>
    </span> Edit Specimen Type
  </h3>
  <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.specimen-types.index') }}">Specimen Types</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ul>
  </nav>
</div>

<div class="row">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Specimen Type: {{ $specimenType->specimen_name }}</h4>
        <p class="card-description">Update specimen type information</p>
        
        <form action="{{ route('admin.specimen-types.update', $specimenType->id) }}" method="POST" class="forms-sample">
          @csrf
          @method('PUT')
          
          <div class="form-group">
            <label for="specimen_name">Specimen Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('specimen_name') is-invalid @enderror" 
                   id="specimen_name" name="specimen_name" 
                   value="{{ old('specimen_name', $specimenType->specimen_name) }}" 
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
                      placeholder="Brief description of the specimen collection method">{{ old('description', $specimenType->description) }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          
          <button type="submit" class="btn btn-gradient-primary me-2">
            <i class="mdi mdi-content-save"></i> Update Specimen Type
          </button>
          <a href="{{ route('admin.specimen-types.index') }}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-md-4 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Usage Statistics</h4>
        <p class="card-description">This specimen type is used in {{ $specimenType->testCategories->count() }} test(s)</p>
        @if($specimenType->testCategories->count() > 0)
          <ul class="list-ticked">
            @foreach($specimenType->testCategories->take(10) as $category)
              <li>{{ $category->category_name }}</li>
            @endforeach
            @if($specimenType->testCategories->count() > 10)
              <li class="text-muted">and {{ $specimenType->testCategories->count() - 10 }} more...</li>
            @endif
          </ul>
        @else
          <p class="text-muted">Not used in any tests yet.</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
