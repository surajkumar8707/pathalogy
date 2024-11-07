@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">SubCategory Edit</h3>
                    </div>
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary mb-3">Add New SubCategory</a></div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $subCategory->id }}</p>
                <p><strong>Category:</strong> {{ $subCategory->category->name }}</p>
                <p><strong>Name:</strong> {{ $subCategory->name }}</p>
                <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
