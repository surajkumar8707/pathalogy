@extends('admin.layout.app')
@section('title', 'App Settings Page')

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Settings</h3>
            </div>
            <div class="card-body">
                <!-- Always show the form, even if no settings are found -->
                <form class="mb-5" action="{{ route('admin.report.setting.update', $setting->id ?? 0) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="pathalogy_name">Pathalogy Name:</label>
                                <input type="text" name="pathalogy_name" class="form-control"
                                    placeholder="Enter Pathalogy Name"
                                    value="{{ old('pathalogy_name', $setting->pathalogy_name ?? '') }}" />
                                @error('pathalogy_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="address">Address:</label>
                                <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                    value="{{ old('address', $setting->address ?? '') }}" />
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email"
                                    value="{{ old('email', $setting->email ?? '') }}" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="phones">Phones:</label>
                                <input type="text" name="phones" class="form-control" placeholder="Enter Phones"
                                    value="{{ old('phones', $setting->phones ?? '') }}" />
                                @error('phones')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="working_hour">Working Hour:</label>
                                <input type="text" name="working_hour" class="form-control"
                                    placeholder="Enter Working Hour"
                                    value="{{ old('working_hour', $setting->working_hour ?? '') }}" />
                                @error('working_hour')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="discount">Discount:</label>
                                <input type="number" name="discount" class="form-control" placeholder="Enter Discount"
                                    value="{{ old('discount', $setting->discount ?? '') }}" />
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="interpretation">Interpretation:</label>
                                <input type="text" name="interpretation" class="form-control"
                                    placeholder="Enter Interpretation"
                                    value="{{ old('interpretation', $setting->interpretation ?? '') }}" />
                                @error('interpretation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-1">
                        <button type="submit" class="btn btn-primary my-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
