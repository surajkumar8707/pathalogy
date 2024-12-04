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
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.sub-categories.create') }}"
                            class="btn btn-primary mb-3">Add New SubCategory</a></div>
                </div>
            </div>
            <div class="card-body">
                {{-- @dd($subCategory) --}}
                <form action="{{ route('admin.sub-categories.update', $subCategory->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">SubCategory Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $subCategory->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Select discount type</label>
                        <select name="type" id="type" class="form-control" required
                            value="{{ $subCategory->type }}">
                            <option @selected($subCategory->type == 'percent') value="percent">Percent</option>
                            <option @selected($subCategory->type == 'number') value="number">Number</option>
                        </select>
                        @error('type')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                        {{-- <input type="text" class="form-control" id="name" name="name" required> --}}
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">SubCategory discount</label>
                        <input type="number" class="form-control" id="discount" name="discount" required
                            value="{{ $subCategory->discount }}">
                        @error('discount')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
