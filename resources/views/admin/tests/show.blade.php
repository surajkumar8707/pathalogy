@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Test Edit</h3>
                    </div>
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.tests.create') }}" class="btn btn-primary mb-3">Add New Test</a></div>
                </div>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $test->id }}</p>
                <p><strong>Category:</strong> {{ $test->category->name }}</p>
                <p><strong>SubCategory:</strong> {{ $test->subCategory->name }}</p>
                <p><strong>Name:</strong> {{ $test->name }}</p>
                <p><strong>Upper Value:</strong> {{ $test->upper_value }}</p>
                <p><strong>Lower Value:</strong> {{ $test->lower_value }}</p>
                <p><strong>Percent:</strong> {{ $test->percent ?? 'N/A' }}</p>
                <a href="{{ route('admin.tests.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
