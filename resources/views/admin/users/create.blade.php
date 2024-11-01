@extends('admin.layout.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <form name="create_student" method="POST" action="{{ route('admin.students.store') }}">
            @csrf
            <!-- Basic Layout -->
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Create Student</h5> <small class="text-body float-end">Please fill all required
                                fields</small>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" id="email" placeholder="email" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password" placeholder="password" value="{{ old('password') }}">
                                @error('password')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" id="phone" placeholder="9356884112" value="{{ old('phone') }}">
                                @error('phone')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="aadhar_number">Aadhar Number</label>
                                <input type="number" class="form-control @error('aadhar_number') is-invalid @enderror"
                                    name="aadhar_number" id="aadhar_number" placeholder="635623654125"
                                    value="{{ old('aadhar_number') }}">
                                @error('aadhar_number')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="pan_number">Pan Number</label>
                                <input type="text " class="form-control @error('pan_number') is-invalid @enderror"
                                    name="pan_number" id="pan_number" placeholder="9356884112"
                                    value="{{ old('pan_number') }}">
                                @error('pan_number')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Parent Information</h5>
                            {{-- <small class="text-muted float-end">Merged input group</small> --}}
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label" for="father">Father's Name</label>
                                <input type="text" class="form-control @error('father') is-invalid @enderror"
                                    name="father" id="father" placeholder="father" value="{{ old('father') }}">
                                @error('father')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="father_phone">Father's Phone</label>
                                <input type="number" class="form-control @error('father_phone') is-invalid @enderror"
                                    name="father_phone" id="father_phone" placeholder="father_phone"
                                    value="{{ old('father_phone') }}">
                                @error('father_phone')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="father_occupation">Father's Occupation</label>
                                <input type="text"
                                    class="form-control @error('father_occupation') is-invalid @enderror"
                                    name="father_occupation" id="father_occupation" placeholder="father_occupation"
                                    value="{{ old('father_occupation') }}">
                                @error('father_occupation')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="mother">Mother's Name</label>
                                <input type="text" class="form-control @error('mother') is-invalid @enderror"
                                    name="mother" id="mother" placeholder="mother" value="{{ old('mother') }}">
                                @error('mother')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="mother_phone">Mother's Phone</label>
                                <input type="number" class="form-control @error('mother_phone') is-invalid @enderror"
                                    name="mother_phone" id="mother_phone" placeholder="mother_phone"
                                    value="{{ old('mother_phone') }}">
                                @error('mother_phone')
                                    <small class="text-danger p-1">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Other Information</h5>
                    {{-- <small class="text-muted float-end">Merged input group</small> --}}
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="student_profile_pic">
                                <div>Student Profile Pic</div>
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="https://static.vecteezy.com/system/resources/thumbnails/009/734/564/small/default-avatar-profile-icon-of-social-media-user-vector.jpg"
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
                                    <img src="https://static.vecteezy.com/system/resources/thumbnails/009/734/564/small/default-avatar-profile-icon-of-social-media-user-vector.jpg"
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
                        <textarea class="form-control" name="address" id="address" rows="5" placeholder="Enter Student Address">{{ old('address') }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Student Status</label>
                        <select name="status" id="status" class="form-control">
                            @forelse (statusEnum() as $status)
                                <option @if (old('status') == $status) selected @endif value="{{ $status }}">
                                    {{ ucfirst($status) }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
