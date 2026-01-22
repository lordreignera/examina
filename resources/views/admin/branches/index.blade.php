@extends('layouts.admin')


@section('title', 'Branches')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title mb-0">Branch Locations</h4>
                    <a href="{{ route('admin.branches.create') }}" class="btn btn-primary btn-sm">
                        <i class="mdi mdi-plus"></i> Add New Branch
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch Name</th>
                                <th>Location</th>
                                <th>Contact</th>
                                <th>Lab Tests</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($branches as $branch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $branch->branch_name }}</strong>
                                    </td>
                                    <td>
                                        {{ $branch->location }}
                                        @if($branch->address)
                                            <br>
                                            <small class="text-muted">{{ $branch->address }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($branch->phone)
                                            <i class="mdi mdi-phone"></i> {{ $branch->phone }}<br>
                                        @endif
                                        @if($branch->email)
                                            <i class="mdi mdi-email"></i> {{ $branch->email }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $branch->lab_tests_count }} Tests</span>
                                    </td>
                                    <td>
                                        @if($branch->status === 'active')
                                            <label class="badge badge-success">Active</label>
                                        @else
                                            <label class="badge badge-danger">Inactive</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.branches.edit', $branch) }}" 
                                           class="btn btn-sm btn-primary" title="Edit">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.branches.destroy', $branch) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this branch?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="mdi mdi-delete"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="mdi mdi-information-outline"></i> No branches found. Create your first branch!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
