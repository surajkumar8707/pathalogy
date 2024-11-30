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
                                        {{-- <div class="mb-1">
                                            <strong>Sub Category : </strong> {{ $report->subCategory->name }}
                                        </div> --}}
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <div class="form-group mb-2">
                                            <label for="showCategory">Category</label>
                                            <select class="form-select" data-report_id="{{ $report->id }}"
                                                name="showCategory[]" aria-label="Multiple select example"
                                                id="showCategory">
                                                <option disabled selected value="">-- Select Category</option>
                                                @foreach ($subCategories as $category)
                                                    <option @selected($report->subCategory->id == $category->id) value="{{ $category->id }}">
                                                        {{ $category->name }}</option>
                                                    {{-- @if (!in_array($test->id, $report_tests))
                                                    @endif --}}
                                                @endforeach
                                            </select>
                                        </div>

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
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-3">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Sub Category</th>
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
                                                <td>{{ $test->subCategory->name }}</td>
                                                <td>{{ $test->name }}</td>
                                                <td>{{ $test->upper_value }}</td>
                                                <td>{{ $test->percent ?? 'N/A' }}</td>
                                                {{-- <td>{{ $test->pivot->lower_value ?? 'N/A' }}</td> --}}
                                                {{-- <td class="editable-lower-value" data-report_testid="{{ $test->pivot->id }}">
                                                    <span class="display">{{ $test->pivot->lower_value ?? 'N/A' }}</span>
                                                    <input class="edit-input form-control d-none" type="number"
                                                        value="{{ $test->pivot->lower_value ?? '' }}">
                                                </td> --}}
                                                {{-- <td class="editable-lower-value" data-report_testid="{{ $test->pivot->id }}">
                                                    <input class="edit-input form-control d-none_" type="number"
                                                        value="{{ $test->pivot->lower_value ?? '' }}">
                                                </td> --}}
                                                <td class="editable-lower-value"
                                                    data-report_testid="{{ $test->pivot->id }}">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <input class="edit-input form-control" type="number"
                                                                value="{{ $test->pivot->lower_value ?? '' }}">
                                                        </div>
                                                        <div class="col-md-3 pt-1">
                                                            <button
                                                                class="btn btn-sm btn-primary save-lower-value-btn">Save</button>
                                                        </div>
                                                    </div>

                                                </td>

                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="6">
                                                <div class="text-right text-end">
                                                    <button class="btn btn-primary save-all-lower-value">Save All</button>
                                                </div>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
    <script>
        $('#showTests,#showCategory').select2();
        // When the "Tests" select changes

        // Handle change in the sub-category dropdown (to fetch related tests)
        $('#showCategory').on('change', function() {
            let subCategory_id = $(this).val(); // Get the selected sub-category ID

            // Ensure a sub-category is selected
            if (!subCategory_id) {
                return; // Exit if no sub-category is selected
            }

            // Make AJAX request to get tests related to the selected sub-category
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.report.fetch.test') }}', // Adjust the URL as per your routing
                data: {
                    sub_category_id: subCategory_id,
                    _token: csrfToken
                },
                success: function(response) {
                    if (response.status === 'success') {
                        let testDropdown = $('#showTests');
                        let testOptions = '<option value="">-- Select Test --</option>';

                        // Loop through tests and add them to the select dropdown
                        response.data.forEach(function(item) {
                            testOptions += `<option value="${item.id}">${item.name}</option>`;
                        });

                        // Update the tests select dropdown and reinitialize select2
                        testDropdown.html(testOptions).select2();
                    } else {
                        toastr.error(response.message, 'Error!');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.error(errorThrown, 'Error');
                }
            });
        });
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
                        <td>${newTest.sub_category.name}</td>
                        <td>${newTest.name}</td>
                        <td>${newTest.upper_value}</td>
                        <td>${newTest.percent || 'N/A'}</td>
                        <td class="editable-lower-value" data-report_testid="${newTest.report_test.id}">
                            <div class="row">
                                <div class="col-md-9">
                                    <input class="edit-input form-control" type="number" value="">
                                </div>
                                <div class="col-md-3 pt-1">
                                    <button class="btn btn-sm btn-primary save-lower-value-btn">Save</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                        `;

                        // Append the new row to the table body
                        $('table tbody').append(newRow);
                    }
                });
        });

        // Handle the saving of the "lower value"
        $('table').on('click', '.save-lower-value-btn', function() {
            const cell = $(this).closest('td');
            const input = cell.find('.edit-input');
            const report_testid = cell.data('report_testid');
            const newValue = input.val();
            const displaySpan = cell.find('.display');

            // Make AJAX request to save the updated value
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
                        displaySpan.text(response.data.lower_value); // Update the display text
                    } else {
                        toastr.error(response.message, 'Error');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('An error occurred while saving the data.');
                }
            });
        });

        // Handle the "Save All" button click
        $('table').on('click', '.save-all-lower-value', function() {
            // Initialize an array to collect the data
            let lowerValuesData = [];

            // Loop through each input field with class '.edit-input' to gather updated lower values
            $('.edit-input').each(function() {
                const input = $(this);
                const report_testid = input.closest('.editable-lower-value').data('report_testid');
                const newValue = input.val();

                // Push the data into the array
                lowerValuesData.push({
                    report_test: report_testid,
                    lower_value: newValue
                });
            });

            // If there are no values to save, show a message and return
            if (lowerValuesData.length === 0) {
                toastr.info("No changes to save.", 'Info');
                return;
            }

            // Make AJAX request to save all the updated lower values
            $.ajax({
                url: '{{ route('admin.report.save.all.lower.values') }}', // Adjust the route as per your backend
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    _token: csrfToken,
                    lower_values: lowerValuesData // Send the collected data
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message, 'Success');
                        // Optionally, update the displayed values in the table if needed
                        // lowerValuesData.forEach(function(item) {
                        //     // Update the display value in the table
                        //     $(`[data-report_testid="${item.report_test}"] .display`).text(item
                        //         .lower_value);
                        // });
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message, 'Error');
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.error(errorThrown, 'Error');
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
                        // displaySpan.removeClass('d-none');
                        // input.addClass('d-none');
                    }
                });
            }
        });

        // // Handle cancel on blur (when the input loses focus)
        // $('table').on('blur', '.edit-input', function() {
        //     const input = $(this);
        //     const displaySpan = input.siblings('.display');

        //     input.addClass('d-none');
        //     displaySpan.removeClass('d-none');
        // });

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
