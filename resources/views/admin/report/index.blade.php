@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="card-title">Report List</h3>
                    </div>
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.report.create') }}"
                            class="btn btn-primary mb-3">Add Report</a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        @if ($reports->isEmpty())
                            <p>No categories found.</p>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>User Details</th>
                                        <th>Refer By Doctor</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->category->name }}</td>
                                            <td>{{ $report->subCategory->name }}</td>
                                            <td>
                                                <div>
                                                    <strong>Name : </strong> {{ $report->name }} <br>
                                                    <strong>Age : </strong> {{ $report->age }} <br>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $report->refer_by_doctor }}
                                            </td>
                                            <td>
                                                <form
                                                    onsubmit="if(!confirm('Are You sure want to delete ?')){ return false; }"
                                                    method="POST"
                                                    action="{{ route('admin.report.destroy', $report->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('admin.report.view.report', $report->id) }}"
                                                        class="btn btn-info btn-sm">View</a>
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
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
