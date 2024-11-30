@extends('admin.layout.app')
@section('title', 'Dashboard')
@section('content')
    <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title_">Create Report</h4>
                    </div>
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.report.create') }}"
                            class="btn btn-primary mb-3">Add New Category</a></div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.report.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control" name="name" id="name" required
                                    placeholder="user name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">User Age</label>
                                <input type="number" class="form-control" name="age" id="age" required
                                    placeholder="user age">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="refer_by_doctor">User Refer By Doctor</label>
                                <input type="text" class="form-control" name="refer_by_doctor" id="refer_by_doctor"
                                    required placeholder="user Refer By Doctor">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" id="category" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @forelse ($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option value=""></option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="sub_category">Sub Category</label>
                                <select name="sub_category" id="sub_category" class="form-control" required>
                                    <option value="">-- Select Sub Category --</option>
                                    {{-- @forelse ($subCategories as $key => $sub_category)
                                        <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                    @empty
                                    @endforelse --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="test">Tests</label>
                                <select name="test[]" id="test" class="form-control" required multiple>
                                    <option value="">-- Select Test --</option>
                                    {{-- @forelse ($tests as $key => $test)
                                        <option value="{{ $test->id }}">{{ $test->name }}</option>
                                    @empty
                                    @endforelse --}}
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.report.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection

@push('scripts')
    {{-- <script>
        $("#category,#sub_category,#test").select2();
        $(document).ready(function() {
            $('#category').change(function() {
                let $this = $(this);
                let category_id = $this.val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.report.fetch.subcategory') }}",
                    data: {
                        category_id: category_id,
                        _token: "{{ csrf_token() }}"
                    },
                    // success: function(response){
                    //     console.log(response);
                    //     if(response.status == "error"){
                    //         toastr.error(response.message, "Error !");
                    //     }
                    //     else{
                    //         let data = response.data;
                    //         console.log(data);
                    //         let sub_category = $("#sub_category");
                    //         let test = $("#test");
                    //         sub_category.html(`<option value="">-- Select Sub Category --</option>`);
                    //         test.html(`<option value="">-- Select Test --</option>`);

                    //     }
                    // },
                    success: function(response) {
                        if (response.status === "success") {
                            let sub_category = $("#sub_category");
                            sub_category.html(
                                '<option value="">-- Select Sub Category --</option>'
                            ); // Clear previous options

                            // Populate subcategories
                            response.data.forEach(function(item) {
                                sub_category.append(new Option(item.name, item.id));
                            });
                        } else {
                            toastr.error(response.message, "Error !");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr, textStatus, errorThrown);
                        toastr.error(errorThrown, textStatus);
                    },
                });
                // alert(category_id);
            });

            $('#sub_category').change(function() {
                let $this = $(this);
                let sub_category_id = $this.val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.report.fetch.test') }}",
                    data: {
                        sub_category_id: sub_category_id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status === "success") {
                            let test = $("#test");
                            test.html(
                                '<option value="">-- Select Test --</option>'
                                ); // Clear previous options

                            // Populate subcategories
                            response.data.forEach(function(item) {
                                test.append(new Option(item.name, item.id));
                            });
                        } else {
                            toastr.error(response.message, "Error !");
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.log(xhr, textStatus, errorThrown);
                        toastr.error(errorThrown, textStatus);
                    },
                });
                // alert(category_id);
            });
        });
    </script> --}}
    <script>
        // Initialize select2 on the category, sub_category, and test selects
        $("#category, #sub_category, #test").select2();
        // $(document).ready(function() {


        // Handle category change
        $('#category').on('change', function() {
            let category_id = $(this).val();

            if (!category_id) {
                return; // Do nothing if no category is selected
            }

            $.ajax({
                type: "POST",
                url: "{{ route('admin.report.fetch.subcategory') }}",
                data: {
                    category_id: category_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status === "success") {
                        let sub_category = $("#sub_category");
                        sub_category.html(
                            '<option value="">-- Select Sub Category --</option>'
                        ); // Clear previous options

                        // Populate subcategories
                        response.data.forEach(function(item) {
                            sub_category.append(new Option(item.name, item.id));
                        });

                        // Reinitialize select2 for subcategory after updating options
                        sub_category.select2();
                    } else {
                        toastr.error(response.message, "Error !");
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(xhr, textStatus, errorThrown);
                    toastr.error(errorThrown, textStatus);
                }
            });
        });

        // Handle sub_category change
        $('#sub_category').on('change', function() {
            let sub_category_id = $(this).val();

            if (!sub_category_id) {
                return; // Do nothing if no sub_category is selected
            }

            $.ajax({
                type: "POST",
                url: "{{ route('admin.report.fetch.test') }}",
                data: {
                    sub_category_id: sub_category_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status === "success") {
                        let test = $("#test");
                        test.html(
                            '<option value="">-- Select Test --</option>'); // Clear previous options

                        // Populate tests
                        response.data.forEach(function(item) {
                            test.append(new Option(item.name, item.id));
                        });

                        // Reinitialize select2 for tests after updating options
                        test.select2();
                    } else {
                        toastr.error(response.message, "Error !");
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error(xhr, textStatus, errorThrown);
                    toastr.error(errorThrown, textStatus);
                }
            });
        });
        // });
    </script>
@endpush
