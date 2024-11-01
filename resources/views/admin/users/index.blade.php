@extends('admin.layout.app')

@section('content')
    <div class="container-fluid">

        <div class="card shadow my-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Students</h4>
                    </div>
                    {{-- <div class="col-md-6 text-end">
                        <a class="btn btn-primary" href="{{ route('admin.home-page-carousel.create') }}">Add +</a>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.change-status-input').change(function() {
                var status = $(this).is(':checked') ? '1' : '0';
                var studentId = $(this).data('student-id');
                var requestData = {
                    'status': status,
                    'id': studentId,
                    '_token': "{{ csrf_token() }}",
                }
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.students.change.status') }}",
                    data: requestData,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        if (response.status == 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr);
                        console.log(xhr.responseText);
                        console.log(textStatus, errorThrown);
                        console.log(errorThrown);
                    },
                });
            });
        });
    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
