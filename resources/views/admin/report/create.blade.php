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
                    <div class="col-md-6 text-end"> <a href="{{ route('admin.report.create') }}" class="btn btn-primary mb-3">Add New Category</a></div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.report.generate.report') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control" name="name" id="name" required placeholder="user name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="age">User Age</label>
                                <input type="number" class="form-control" name="age" id="age" required placeholder="user age">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="refer_by_doctor">User Refer By Doctor</label>
                                <input type="text" class="form-control" name="refer_by_doctor" id="refer_by_doctor" required placeholder="user Refer By Doctor">
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
                                <select name="test" id="test[]" class="form-control" required multiple>
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

@push('styles')
<link href="
https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css
" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category').change(function(){
            let $this = $(this);
            let category_id = $this.val();
            $.ajax({
                type: "POST",
                url : "{{ route('admin.report.fetch.subcategory') }}",
                data : {
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
                success: function(response){
                    if(response.status === "success"){
                        let sub_category = $("#sub_category");
                        sub_category.html('<option value="">-- Select Sub Category --</option>'); // Clear previous options

                        // Populate subcategories
                        response.data.forEach(function(item) {
                            sub_category.append(new Option(item.name, item.id));
                        });
                    } else {
                        toastr.error(response.message, "Error !");
                    }
                },
                error: function(xhr, textStatus, errorThrown){
                    console.log(xhr, textStatus, errorThrown);
                    toastr.error(errorThrown, textStatus);
                },
            });
            // alert(category_id);
        });

        $('#sub_category').change(function(){
            let $this = $(this);
            let sub_category_id = $this.val();
            $.ajax({
                type: "POST",
                url : "{{ route('admin.report.fetch.test') }}",
                data : {
                    sub_category_id: sub_category_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    console.log(response);
                    if(response.status === "success"){
                        let test = $("#test");
                        test.html('<option value="">-- Select Test --</option>'); // Clear previous options

                        // Populate subcategories
                        response.data.forEach(function(item) {
                            test.append(new Option(item.name, item.id));
                        });
                    } else {
                        toastr.error(response.message, "Error !");
                    }
                },
                error: function(xhr, textStatus, errorThrown){
                    console.log(xhr, textStatus, errorThrown);
                    toastr.error(errorThrown, textStatus);
                },
            });
            // alert(category_id);
        });
    });
</script>
@endpush
