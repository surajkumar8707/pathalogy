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
                                    <div class="col-md-4">
                                        <strong>User name : </strong> {{ $report->name }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>User Age : </strong> {{ $report->age }}
                                    </div>
                                    <div class="col-md-4">
                                        <strong>Refer By Doctor : </strong> {{ $report->refer_by_doctor }}
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>User name : </strong> {{ $report->name }}
                                </div>
                                <div class="col-md-4">
                                    <strong>User Age : </strong> {{ $report->age }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Refer By Doctor : </strong> {{ $report->refer_by_doctor }}
                                </div>
                            </div> --}}
                            </div>
                            <table class="table table-bordered table-striped">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@push('scripts')
    <!-- Script -->
    <script>
        $(document).ready(function() {
            const csrfToken = '{{ csrf_token() }}';

            // Handle double-click to edit
            $('.editable-lower-value').on('dblclick', function() {
                const cell = $(this);
                const displaySpan = cell.find('.display');
                const input = cell.find('.edit-input');

                displaySpan.addClass('d-none');
                input.removeClass('d-none').focus();
            });

            // Handle save on Enter
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
        });
    </script>
@endpush
