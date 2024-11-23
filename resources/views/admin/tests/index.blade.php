@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Test List</h3>
                    </div>
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.tests.create') }}" class="btn btn-primary mb-3">Add New Test</a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        @if ($tests->isEmpty())
                            <p>No Test found.</p>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Name</th>
                                        <th>Upper Value</th>
                                        <th>Percent</th>
                                        {{-- <th>Lower Value</th> --}}
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tests as $test)
                                        <tr>
                                            <td>{{ $test->id }}</td>
                                            <td>{{ $test->category->name }}</td>
                                            <td>{{ $test->subCategory->name }}</td>
                                            <td>{{ $test->name }}</td>
                                            <td>{{ $test->upper_value }}</td>
                                            <td>{{ $test->percent }}</td>
                                            {{-- <td>{{ $test->lower_value }}</td> --}}
                                            <td>
                                                <a href="{{ route('admin.tests.show', $test->id) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('admin.tests.edit', $test->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('admin.tests.destroy', $test->id) }}" method="POST" style="display:inline;">
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
