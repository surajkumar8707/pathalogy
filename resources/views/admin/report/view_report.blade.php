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

                        @if (!$report)
                            <p>Report not found.</p>
                        @else
                            <div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="mb-1">
                                            <strong>User name : </strong> {{ $report->name }}
                                        </div>
                                        <div class="mb-1">
                                            <strong>User Age : </strong> {{ $report->age }}
                                        </div>
                                        <div class="mb-1">
                                            <strong>Refer By Doctor : </strong> {{ $report->refer_by_doctor }}
                                        </div>
                                        <div class="mb-1">
                                            <strong>Category : </strong> {{ $report->category->name }}
                                        </div>
                                        <div class="mb-1">
                                            <strong>Sub Category : </strong> {{ $report->subCategory->name }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="showTests">Tests</label>
                                            <select class="form-select" data-report_id="{{ $report->id }}" multiple_
                                                name="showTests[]" aria-label="Multiple select example" id="showTests">
                                                <option disabled selected value="">-- Select Tests</option>
                                                @foreach ($tests as $test)
                                                    @if (!in_array($test->id, $report_tests))
                                                        <option value="{{ $test->id }}">
                                                            {{ $test->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped mb-3">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Test</th>
                                        <th>Upper Value</th>
                                        <th>Percent</th>
                                        <th>Lower value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($report->tests as $test)
                                        {{-- @dd($test->toArray(), $test->pivot->report_id, $test->pivot->lower_value) --}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $test->name }}</td>
                                            <td>{{ $test->upper_value }}</td>
                                            <td>{{ $test->percent ?? 'N/A' }}</td>
                                            {{-- <td>{{ $test->pivot->lower_value ?? 'N/A' }}</td> --}}
                                            {{-- <td class="editable-lower-value" data-report_testid="{{ $test->pivot->id }}">
                                                <span class="display">{{ $test->pivot->lower_value ?? 'N/A' }}</span>
                                                <input class="edit-input form-control d-none" type="number"
                                                    value="{{ $test->pivot->lower_value ?? '' }}">
                                            </td> --}}
                                            <td class="editable-lower-value" data-report_testid="{{ $test->pivot->id }}">
                                                <span class="display">{{ $test->pivot->lower_value ?? 'N/A' }}</span>
                                                <input class="edit-input form-control d-none" type="number"
                                                    value="{{ $test->pivot->lower_value ?? '' }}">
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a href="{{ route('admin.report.generate.report', $report->id) }}"
                                    class="btn btn-outline-primary">Generate Report</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@push('scripts')
    {{-- <!-- Script -->
    <script>
        $('#showTests').select2();
        // $("#showTests").on('change', function() {
        //     let $this = $(this);
        //     let new_test_id = $this.val();
        //     let current_ids = $this.data('current_id');

        //     let headers: {
        //         'X-CSRF-TOKEN': csrfToken
        //     };
        //     ajaxRequest();
        // });

        $("#showTests").on('change', function() {
            let $this = $(this);
            let test_id = $this.val();
            let report_id = $this.data('report_id');

            let headers = {
                'X-CSRF-TOKEN': csrfToken
            };

            let data = {
                _token: csrfToken, // or however you're sending your data
                test_id: test_id, // or however you're sending your data
                report_id: report_id
            };

            // console.log(data);


            // return false;

            // Use the ajaxRequest function and pass a callback to handle the response
            ajaxRequest("{{ route('admin.report.save.single.test') }}", data, 'POST', headers, function(response) {
                // Handle the response here
                console.log('Response from server:', response);
                // if (response.status === 'success') {
                //     // Process the success case
                // } else {
                //     // Handle the error case
                // }
                if (response.status === 'success') {
                    // On success, append the new test record to the table
                    let newTest = response.data; // Assuming the new test data is in response.data

                    // Create the new row HTML dynamically
                    let newRow = `
                        <tr>
                            <td>${newTest.id}</td>
                            <td>${newTest.name}</td>
                            <td>${newTest.upper_value}</td>
                            <td>${newTest.percent || 'N/A'}</td>
                            <td class="editable-lower-value" data-report_testid="${newTest.id}">
                                <span class="display">N/A</span>
                                <input class="edit-input form-control d-none" type="number" value="">
                            </td>
                        </tr>
                    `;

                    // Append the new row to the table body
                    $('table tbody').append(newRow);

                    // Optional: You can also display a success message using toastr
                    toastr.success('Test added to the report successfully!', 'Success!');
                }
            });
        });

        $('.edit-input').on('keypress', function(event) {
            if (event.key === 'Enter') {
                const input = $(this);
                const cell = input.closest('.editable-lower-value');
                const report_testid = cell.data('report_testid');
                // const testId = cell.data('test-id');
                const newValue = input.val();
                const displaySpan = cell.find('.display');

                // AJAX request to save the updated value
                $.ajax({
                    url: '{{ route('admin.report.update.lower.value') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        _token: csrfToken,
                        report_test: report_testid,
                        lower_value: newValue
                    },
                    success: function(response) {
                        console.log(response);

                        if (response.status == 'success') {
                            toastr.success(response.message, 'Success !', );
                            displaySpan.text(response.data.lower_value);
                        } else {
                            toastr.error(response.message, 'Error !', );
                        }

                        // if (response.success) {
                        //     displaySpan.text(newValue);
                        // } else {
                        //     alert('Error: ' + response.message);
                        // }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('An error occurred while saving the data.');
                    },
                    complete: function() {
                        displaySpan.removeClass('d-none');
                        input.addClass('d-none');
                    }
                });
            }
        });

        // Handle cancel on blur
        $('.edit-input').on('blur', function() {
            const input = $(this);
            const displaySpan = input.siblings('.display');

            input.addClass('d-none');
            displaySpan.removeClass('d-none');
        });

        $('.editable-lower-value').on('dblclick', function() {
            const cell = $(this);
            const displaySpan = cell.find('.display');
            const input = cell.find('.edit-input');

            displaySpan.addClass('d-none');
            input.removeClass('d-none').focus();
        });

        // $("#showTests").on('change', function() {
        //     let $this = $(this);
        //     let selectedOptions = $this.find('option:selected');

        //     selectedOptions.each(function() {
        //         let test_id = $(this).val(); // Value of the selected option
        //         let current_id = $(this).data('current_id'); // Data attribute of the selected option

        //         alert('Selected Test ID: ' + test_id);
        //         alert('Current ID: ' + current_id);
        //     });
        // });
        $(document).ready(function() {

        });
    </script> --}}

    <script>
        $('#showTests').select2();
        // When the "Tests" select changes
        $("#showTests").on('change', function() {
            let $this = $(this);
            let test_ids = $this.val(); // Get selected test IDs
            let report_id = $this.data('report_id'); // Get the report ID

            let headers = {
                'X-CSRF-TOKEN': csrfToken
            };

            let data = {
                _token: csrfToken,
                test_id: test_ids, // Pass selected test IDs
                report_id: report_id
            };

            // Make AJAX request to save the selected tests
            ajaxRequest("{{ route('admin.report.save.single.test') }}", data, 'POST', headers,
                function(response) {
                    if (response.status === 'success') {
                        let newTest = response
                            .data; // Assuming the new test data is in response.data

                        // Create the new row HTML dynamically
                        let newRow = `
                            <tr>
                                <td>${newTest.id}</td>
                                <td>${newTest.name}</td>
                                <td>${newTest.upper_value}</td>
                                <td>${newTest.percent || 'N/A'}</td>
                                <td class="editable-lower-value" data-report_testid="${newTest.report_test.id}">
                                    <span class="display">N/A</span>
                                    <input class="edit-input form-control d-none" type="number" value="">
                                </td>
                            </tr>
                        `;

                        // Append the new row to the table body
                        $('table tbody').append(newRow);
                    }
                });
        });

        // Delegate the 'dblclick' event to the 'editable-lower-value' cells
        $('table').on('dblclick', '.editable-lower-value', function() {
            const cell = $(this);
            const displaySpan = cell.find('.display');
            const input = cell.find('.edit-input');

            displaySpan.addClass('d-none');
            input.removeClass('d-none').focus();
        });

        // Handle 'Enter' key press to save the new value
        $('table').on('keypress', '.edit-input', function(event) {
            if (event.key === 'Enter') {
                const input = $(this);
                const cell = input.closest('.editable-lower-value');
                const report_testid = cell.data('report_testid');
                const newValue = input.val();
                const displaySpan = cell.find('.display');

                // AJAX request to save the updated value
                $.ajax({
                    url: '{{ route('admin.report.update.lower.value') }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        _token: csrfToken,
                        report_test: report_testid,
                        lower_value: newValue
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            toastr.success(response.message, 'Success');
                            displaySpan.text(response.data.lower_value);
                        } else {
                            toastr.error(response.message, 'Error');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('An error occurred while saving the data.');
                    },
                    complete: function() {
                        displaySpan.removeClass('d-none');
                        input.addClass('d-none');
                    }
                });
            }
        });

        // Handle cancel on blur (when the input loses focus)
        $('table').on('blur', '.edit-input', function() {
            const input = $(this);
            const displaySpan = input.siblings('.display');

            input.addClass('d-none');
            displaySpan.removeClass('d-none');
        });

        // (Optional) Handle cancel on Escape key press
        $('table').on('keydown', '.edit-input', function(event) {
            if (event.key === 'Escape') {
                const input = $(this);
                const displaySpan = input.siblings('.display');

                input.addClass('d-none');
                displaySpan.removeClass('d-none');
            }
        });
        $(document).ready(function() {});
    </script>
@endpush
