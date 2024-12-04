@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">SubCategory List</h3>
                    </div>
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.sub-categories.create') }}"
                            class="btn btn-primary mb-3">Add New SubCategory</a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        @if ($subCategories->isEmpty())
                            <p>No categories found.</p>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Discount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subCategories as $subCategory)
                                        <tr>
                                            <td>{{ $subCategory->id }}</td>
                                            <td>{{ $subCategory->category->name }}</td>
                                            <td>{{ $subCategory->name }}</td>
                                            <td>
                                                <div>
                                                    <p class="m-0 p-0"><strong>Discount Type : </strong>
                                                        @if ($subCategory->type == 'number')
                                                            <span class="badge text-primary">{{ $subCategory->type }}</span>
                                                        @else
                                                            <span class="badge text-success">{{ $subCategory->type }}</span>
                                                        @endif
                                                    </p>
                                                    <p class="m-0 p-0"><strong>Discount : </strong>
                                                        {{ $subCategory->discount }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.sub-categories.show', $subCategory->id) }}"
                                                    class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('admin.sub-categories.edit', $subCategory->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.sub-categories.destroy', $subCategory->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection
