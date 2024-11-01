@extends('admin.layout.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <form name="edit_student" method="POST" action="{{ route('admin.students.update', $student->id) }}">
            @csrf
            @method('PUT') <!-- Add this to specify the HTTP method -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Edit Student</h5>
                            <small class="text-body float-end">Please fill all required fields</small>
                        </div>
                        <div class="card-body">

                            <!-- Student Information -->
                            @foreach (['name', 'email', 'password', 'phone', 'aadhar_number', 'pan_number'] as $field)
                                <div class="mb-3">
                                    <label class="form-label"
                                        for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}
                                        @if ($field !== 'password')
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <input type="{{ $field === 'password' ? 'password' : 'text' }}"
                                        class="form-control @error($field) is-invalid @enderror" name="{{ $field }}"
                                        id="{{ $field }}" placeholder="{{ ucfirst($field) }}"
                                        value="{{ $field !== 'password' ? old($field, $student->{$field}) : '' }}">
                                    @error($field)
                                        <small class="text-danger p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-xl">
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Parent Information</h5>
                        </div>
                        <div class="card-body">

                            <!-- Parent Information -->
                            @foreach (['father', 'father_phone', 'father_occupation', 'mother', 'mother_phone'] as $field)
                                <div class="mb-3">
                                    <label class="form-label"
                                        for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                    <input type="text" class="form-control @error($field) is-invalid @enderror"
                                        name="{{ $field }}" id="{{ $field }}"
                                        placeholder="{{ ucfirst($field) }}" value="{{ old($field, $student->{$field}) }}">
                                    @error($field)
                                        <small class="text-danger p-1">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Other Information</h5>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="student_profile_pic">
                                <div>Student Profile Pic</div>
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset($student->profile_picture ?? 'default/path/to/avatar.jpg') }}"
                                        alt="user-avatar" class="d-block rounded account-avatar" height="100"
                                        width="100" />
                                    <div class="button-wrapper">
                                        <label class="btn btn-primary me-2 mb-4 upload-btn" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" />
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="student_sign_pic">
                                <div>Student Sign Pic</div>
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ asset($student->signature_picture ?? 'default/path/to/signature.jpg') }}"
                                        alt="user-avatar" class="d-block rounded account-avatar" height="100"
                                        width="100" />
                                    <div class="button-wrapper">
                                        <label class="btn btn-primary me-2 mb-4 upload-btn" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" />
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button>
                                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="address">Student Address</label>
                        <textarea class="form-control" name="address" id="address" rows="5" placeholder="Enter Student Address">{{ old('address', $student->address) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Student Status</label>
                        <select name="status" id="status" class="form-control">
                            @foreach (statusEnum() as $status)
                                <option @if (old('status', $student->status) == $status) selected @endif value="{{ $status }}">
                                    {{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
