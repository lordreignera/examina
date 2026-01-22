@extends('layouts.landing')

@section('title', 'Welcome - Laboratory Testing Services')

@section('content')
<div class="hero-section text-center">
    <div class="container">
        <h1 class="hero-title">Welcome to EXAMINA Laboratory Testing Services</h1>
        <p class="hero-subtitle">Schedule your laboratory tests online. Know your health status with our comprehensive test packages.</p>
        
        <!-- Branch Search/Filter Bar -->
        <div class="search-filter-container mt-4 mb-3">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <form action="{{ route('welcome') }}" method="GET" id="branchFilterForm">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-8">
                                        <label for="branchSelect" class="form-label text-start d-block fw-bold">
                                            <i class="bi bi-building"></i> Select Your Branch Location
                                        </label>
                                        <select name="branch_id" id="branchSelect" class="form-select form-select-lg" onchange="this.form.submit()">
                                            <option value="">All Branches - Show All Tests</option>
                                            @foreach($branches as $branch)
                                                <option value="{{ $branch->id }}" {{ $selectedBranchId == $branch->id ? 'selected' : '' }}>
                                                    {{ $branch->branch_name }} - {{ $branch->location }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label d-block">&nbsp;</label>
                                        @if($selectedBranchId)
                                            <a href="{{ route('welcome') }}" class="btn btn-outline-secondary btn-lg w-100">
                                                <i class="bi bi-x-circle"></i> Clear Filter
                                            </a>
                                        @else
                                            <button type="button" class="btn btn-light btn-lg w-100" disabled>
                                                <i class="bi bi-funnel"></i> Filter
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            @if($selectedBranchId)
                                <div class="alert alert-info mt-3 mb-0">
                                    <i class="bi bi-info-circle"></i> Showing tests available at <strong>{{ $branches->find($selectedBranchId)->branch_name }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="#tests" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow">
                <i class="bi bi-search"></i> Browse Available Tests
            </a>
        </div>
    </div>
</div>

<div class="container" id="tests">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h2 class="fw-bold mb-3">Our Laboratory Tests</h2>
            <p class="text-muted fs-5">
                @if($selectedBranchId)
                    Tests available at {{ $branches->find($selectedBranchId)->branch_name }}
                @else
                    Choose from our wide range of diagnostic tests
                @endif
            </p>
        </div>
    </div>

    <div class="row">
        @foreach($labTests as $labTest)
        <div class="col-md-6 col-lg-4">
            <div class="card test-card">
                <div class="test-card-header">
                    <i class="bi bi-flask"></i> {{ $labTest->test_name }}
                </div>
                <div class="card-body">
                    @if($labTest->testCategories->count() > 0)
                        <div class="test-info-summary mb-3">
                            <p class="text-muted small mb-2">{{ Str::limit($labTest->description, 100) }}</p>
                            <div class="badge bg-primary">{{ $labTest->testCategories->count() }} Test(s) Available</div>
                        </div>
                        
                        <div class="test-categories-container">
                            <!-- Show first 2 categories by default -->
                            @foreach($labTest->testCategories->take(2) as $category)
                            <div class="test-category-preview">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0 flex-grow-1 small">{{ $category->category_name }}</h6>
                                    <span class="price-badge-small ms-2">UGX {{ number_format($category->price, 0) }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="small text-muted">
                                        <i class="bi bi-droplet"></i> {{ $category->specimen->specimen_name }}
                                    </div>
                                    <button class="btn btn-add-cart btn-sm" 
                                            onclick="addToCart({{ $category->id }}, '{{ addslashes($category->category_name) }}', {{ $category->price }})">
                                        <i class="bi bi-cart-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                            @endforeach
                            
                            @if($labTest->testCategories->count() > 2)
                            <!-- Show "View All" button if more than 2 categories -->
                            <button class="btn btn-outline-primary btn-sm w-100 mt-2" type="button" 
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $labTest->id }}">
                                <i class="bi bi-chevron-down"></i> View All {{ $labTest->testCategories->count() }} Tests
                            </button>
                            
                            <!-- Collapsible section with all categories -->
                            <div class="collapse" id="collapse{{ $labTest->id }}">
                                <div class="all-categories-wrapper mt-2">
                                    <div class="category-search mb-2">
                                        <input type="text" class="form-control form-control-sm" 
                                               placeholder="Search tests..." 
                                               onkeyup="filterTests(this, {{ $labTest->id }})">
                                    </div>
                                    <div class="categories-scroll">
                                        @foreach($labTest->testCategories->skip(2) as $category)
                                        <div class="test-category-item test-item-{{ $labTest->id }}" data-test-name="{{ strtolower($category->category_name) }}">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h6 class="mb-0 flex-grow-1 small">{{ $category->category_name }}</h6>
                                                <span class="price-badge-small ms-2">UGX {{ number_format($category->price, 0) }}</span>
                                            </div>
                                            <p class="text-muted small mb-2">{{ Str::limit($category->description, 60) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="small text-muted">
                                                    <i class="bi bi-droplet"></i> {{ $category->specimen->specimen_name }}
                                                    @if($category->duration)
                                                    | <i class="bi bi-clock"></i> {{ $category->duration }}
                                                    @endif
                                                </div>
                                                <button class="btn btn-add-cart btn-sm" 
                                                        onclick="addToCart({{ $category->id }}, '{{ addslashes($category->category_name) }}', {{ $category->price }})">
                                                    <i class="bi bi-cart-plus"></i> Add
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-info-circle"></i> No test categories available yet
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($labTests->isEmpty())
    <div class="row">
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox display-1 text-muted"></i>
            <h3 class="mt-3 text-muted">No tests available at the moment</h3>
            <p class="text-muted">Please check back later</p>
        </div>
    </div>
    @endif
</div>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4 text-center mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <i class="bi bi-shield-check text-primary display-4 mb-3"></i>
                    <h5>Accurate Results</h5>
                    <p class="text-muted">State-of-the-art laboratory equipment for precise test results</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <i class="bi bi-clock-history text-primary display-4 mb-3"></i>
                    <h5>Fast Turnaround</h5>
                    <p class="text-muted">Quick processing times to get your results when you need them</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <i class="bi bi-people text-primary display-4 mb-3"></i>
                    <h5>Expert Team</h5>
                    <p class="text-muted">Experienced medical professionals handling your tests</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function filterTests(input, labTestId) {
        const filter = input.value.toLowerCase();
        const items = document.querySelectorAll('.test-item-' + labTestId);
        
        items.forEach(item => {
            const testName = item.getAttribute('data-test-name');
            if (testName.includes(filter)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
@endpush
