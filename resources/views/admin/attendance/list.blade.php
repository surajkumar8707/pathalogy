@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student Attandance</h3>
            </div>
            <div class="card-body">
                {{-- <div class="row">
                    <div class="col-md-12">

                        @if ($bookings->isEmpty())
                            <p>No bookings found.</p>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Room</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Arrival</th>
                                        <th>Departure</th>
                                        <th>Booked At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $key => $booking)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $booking->room->name ?? 'N/A' }}</td> <!-- Room relationship -->
                                            <td>{{ $booking->name }}</td>
                                            <td>{{ $booking->email }}</td>
                                            <td>{{ $booking->phone }}</td>
                                            <td>{{ $booking->city }}</td>
                                            <td>{{ date('d M, Y', strtotime($booking->arrival)) }}</td>
                                            <td>{{ date('d M, Y', strtotime($booking->departure)) }}</td>
                                            <td>{{ date('d M, Y H:i', strtotime($booking->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div> --}}

                <div class="row my-2">
                    <div class="col-sm-6 my-1">
                        <input type="search" class="form-control" name="search_student" id="search_student"
                            placeholder="Search student">
                    </div>
                    <div class="col-sm-6 my-1">
                        <input type="date" class="form-control check-another-attendance" max="{{ date('Y-m-d') }}"
                            value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="student-table">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white">#</th>
                                <th class="bg-primary text-white">Student Detail</th>
                                <th class="bg-primary text-white">Is Present?</th>
                            </tr>
                        </thead>
                        <tbody id="student-tbody">
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <p>
                                            <span>{{ $user->name }}</span> <br>
                                            <span><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span> <br>
                                            <span><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></span>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input save-attandance"
                                                data-student_id="{{ $user->id }}" type="checkbox"
                                                id="attandance-{{ $user->id }}" value="{{ $user->id }}"
                                                @if (in_array($user->id, $attendances)) checked @endif>
                                            {{-- <label class="form-check-label" for="attandance-{{ $user->id }}">Checked
                                                switch
                                                checkbox input</label> --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <th class="small bg-secondary text-center" colspan="3">Student not found</th>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@push('scripts')
    {{-- <script>
        $(document).ready(function() {});

        $(".check-another-attendance").on("change", function() {
            let searchDate = $(this).val();
            // alert(searchDate);
            $.ajax({
                type: "GET",
                url: "{{ route('admin.attendances.list') }}",
                data: {
                    'date': searchDate,
                },
                beforeSend: function(xhr, status) {

                },
                complete: function(xhr, status) {

                },
                // success: function(result, status, xhr) {
                //     console.log(result);
                //     console.log(status);
                //     console.log(xhr);
                //     if (result.status == 'success') {

                //     } else {
                //         toastr.error(result.message, 'Error !');
                //     }
                // },
                success: function(result) {
                    if (result.status == 'success') {
                        // Clear existing rows in the tbody
                        $('#student-tbody').empty();

                        // Get attendances and users from the result
                        let attendances = result.data.attendances;
                        let users = result.data.users;

                        // Map the users and their attendance status
                        users.forEach((user, index) => {
                            let isPresent = attendances.includes(user.id) ? 'checked' : '';

                            // Create a new row
                            let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>
                                <p>
                                    <span>${user.name}</span> <br>
                                    <span>${user.email}</span>
                                </p>
                            </td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input save-attandance"
                                           data-student_id="${user.id}" type="checkbox"
                                           id="attandance-${user.id}" value="${user.id}"
                                           ${isPresent}>
                                </div>
                            </td>
                        </tr>
                    `;

                            // Append the new row to the tbody
                            $('#student-tbody').append(row);
                        });
                    } else {
                        toastr.error(result.message, 'Error !');
                    }
                },
                error: function(xhr, status, error) {
                    // console.log(xhr, status, error);
                    toastr.error(error +
                        ', Please Refresh the page and try again or try after some time',
                        'Error !');
                },
            });
        });
        $(".save-attandance").on("change", function() {
            let student_id = $(this).val();
            let isPresent = ($(this).prop('checked') == true) ? 1 : 0;
            let searchDate = $('.check-another-attendance').val();
            // alert(isPresent)
            if (student_id) {
                let url = "{{ route('admin.attendances.save.attendance') }}";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        'student_id': student_id,
                        'isPresent': isPresent,
                        'searchDate': searchDate,
                        '_token': "{{ csrf_token() }}",
                    },
                    beforeSend: function(xhr, status) {

                    },
                    complete: function(xhr, status) {

                    },
                    success: function(result, status, xhr) {
                        // console.log(result);
                        // console.log(status);
                        // console.log(xhr);
                        if (result.status == 'success') {

                        } else {
                            toastr.error(result.message, 'Error !');
                        }
                    },
                    error: function(xhr, status, error) {
                        // console.log(xhr, status, error);
                        toastr.error(error +
                            ', Please Refresh the page and try again or try after some time',
                            'Error !');
                    },
                });
                // alert(url);
            }
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            // Search functionality
            $("#search_student").on("keyup", function() {
                let searchTerm = $(this).val().toLowerCase();
                $("#student-tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });

            // Event delegation for attendance save checkboxes
            $(document).on("change", ".save-attandance", function() {
                let student_id = $(this).val();
                let isPresent = ($(this).prop('checked') == true) ? 1 : 0;
                let searchDate = $('.check-another-attendance').val();

                if (student_id) {
                    let url = "{{ route('admin.attendances.save.attendance') }}";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            'student_id': student_id,
                            'isPresent': isPresent,
                            'searchDate': searchDate,
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function(result) {
                            if (result.status == 'success') {
                                // Optionally, show a success message
                            } else {
                                toastr.error(result.message, 'Error !');
                            }
                        },
                        error: function(xhr, status, error) {
                            toastr.error(error +
                                ', Please Refresh the page and try again or try after some time',
                                'Error !');
                        },
                    });
                }
            });
        });

        // Date change event remains the same
        $(".check-another-attendance").on("change", function() {
            let searchDate = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('admin.attendances.list') }}",
                data: {
                    'date': searchDate,
                },
                success: function(result) {
                    if (result.status == 'success') {
                        // Clear existing rows in the tbody
                        $('#student-tbody').empty();

                        // Get attendances and users from the result
                        let attendances = result.data.attendances;
                        let users = result.data.users;

                        // Map the users and their attendance status
                        users.forEach((user, index) => {
                            let isPresent = attendances.includes(user.id) ? 'checked' : '';

                            // Create a new row
                            let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>
                                <p>
                                    <span>${user.name}</span> <br>
                                    <span>${user.email}</span>
                                </p>
                            </td>
                            <td>
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input save-attandance"
                                           data-student_id="${user.id}" type="checkbox"
                                           id="attandance-${user.id}" value="${user.id}"
                                           ${isPresent}>
                                </div>
                            </td>
                        </tr>
                    `;

                            // Append the new row to the tbody
                            $('#student-tbody').append(row);
                        });
                    } else {
                        toastr.error(result.message, 'Error !');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error(error +
                        ', Please Refresh the page and try again or try after some time', 'Error !');
                },
            });
        });
    </script>
@endpush
