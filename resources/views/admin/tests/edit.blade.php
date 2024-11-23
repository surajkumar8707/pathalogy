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
                <form action="{{ route('admin.tests.update', $test->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $test->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sub_category_id" class="form-label">Select SubCategory</label>
                        <select name="sub_category_id" id="sub_category_id" class="form-select" required>
                            @foreach ($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" {{ $test->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                    {{ $subCategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Test Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $test->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="upper_value" class="form-label">Upper Value</label>
                        <input type="number" step="0.01" class="form-control" id="upper_value" name="upper_value" value="{{ $test->upper_value }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="percent" class="form-label">Percent (Optional)</label>
                        <input type="number" step="0.01" class="form-control" id="percent" name="percent" value="{{ $test->percent }}">
                    </div>
                    {{-- <div class="mb-3">
                        <label for="lower_value" class="form-label">Lower Value</label>
                        <input type="number" step="0.01" class="form-control" id="lower_value" name="lower_value" value="{{ $test->lower_value }}" required>
                    </div> --}}
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.tests.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
