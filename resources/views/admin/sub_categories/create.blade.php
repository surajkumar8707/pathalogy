@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">SubCategory create</h3>
                    </div>
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary mb-3">Add New SubCategory</a></div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sub-categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">SubCategory Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
