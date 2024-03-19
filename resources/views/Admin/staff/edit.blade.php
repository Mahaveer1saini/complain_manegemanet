@extends('backend.layouts.app')
@section('content')
    <div>
        <div class="row">
            <div class="col-11 mx-auto">
                <div class="card card-default">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <h5 class="mb-0">
                                Edit Staff
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.staff_management.staff.update', $staff) }}" method="POST"
                            enctype='multipart/form-data'>
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label mt-4">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name" aria-label="Name" aria-describedby="name"
                                        value="{{ $staff->user->name }}">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="mt-4">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        id="email" aria-label="Email" aria-describedby="email-addon"
                                        value="{{ $staff->user->email }}">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="mt-4">Phone</label>
                                    <input type="text" class="form-control integer_number_only intlinput"
                                        placeholder="Phone" name="phone" id="phone" aria-label="Phone"
                                        aria-describedby="phone-addon" value="{{ $staff->user->phone }}">
                                    @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="mt-4">Password <small>(Leave it blank, if you don't want to change the password)</small></label>
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon" value="">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                 </div>

                                <div class="col-md-6">
                                    <label for="gender" class="mt-4">Gender</label>
                                    <select class="form-control" id="gender" name="gender" aria-label="gender"
                                        aria-describedby="gender">
                                        <option>Please Select Gender</option>
                                        <option value="male"
                                            {{ old('gender', $staff->gender) == 'male' ? 'selected' : '' }}>
                                            Male
                                        </option>
                                        <option value="female"
                                            {{ old('gender', $staff->gender) == 'female' ? 'selected' : '' }}>
                                            Female
                                        </option>
                                        <option value="other"
                                            {{ old('gender', $staff->gender) == 'other' ? 'selected' : '' }}>
                                            Other
                                        </option>
                                    </select>
                                    @error('gender')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="birth_date" class="form-label mt-4">Birth Date</label>
                                    <input type="date" class="form-control" placeholder="birth_date" name="birth_date"
                                        id="birth_date" aria-label="birth_date" aria-describedby="birth_date"
                                        value="{{ $staff->birth_date }}">
                                    @error('birth_date')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="birth_time" class="form-label mt-4">Birth Time</label>
                                    <input type="time" class="form-control" placeholder="Birth Time" name="birth_time"
                                        id="birth_time" aria-label="birth_time" aria-describedby="birth_time"
                                        value="{{ $staff->birth_time }}">
                                    @error('birth_time')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="country_id" class="form-label mt-4">Birth Place</label>
                                    <input type="text" id="autocomplete" name="birth_place"
                                        class="form-control autocomplete" placeholder="Enter Your Birth Place"
                                        autocomplete="off"
                                        value="{{ $staff->city . ' ' . $staff->state . ' ' . $staff->country }}" />
                                    @error('birth_place')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <input type="hidden" name="city" id="city" class="form-control city"
                                    value="{{ $staff->city }}">
                                <input type="hidden" name="state" id="state" class="form-control state"
                                    value="{{ $staff->state }}">
                                <input type="hidden" name="country" id="country" class="form-control country"
                                    value="{{ $staff->country }}">
                                <input type="hidden" name="latitude" id="latitude" class="form-control"
                                    value="{{ $staff->latitude }}">
                                <input type="hidden" name="longitude" id="longitude" class="form-control"
                                    value="{{ $staff->longitude }}">


                                <div class="col-md-6">
                                    <label for="role_id" class="mt-4">Role</label>
                                    <select class="form-select select2" name="role_id" id="role_id"
                                        aria-label="role_id" aria-describedby="role_id">
                
                                        @foreach ($role_list as $role)
                                            <option value="{{ $role->id }}"
                                                {{ collect(old('role_id'))->contains($role->id) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                
                                    </select>
                                    @error('role_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- <div class="col-md-6">
                                        <label for="staff_img" class="form-label mt-4">Images</label>
                                        <div class="">
                                            <input type="file" class="form-control filImageInput"
                                                placeholder="staff_img" name="staff_img" id="staff_img"
                                                aria-label="staff_img" aria-describedby="staff_img"
                                                onchange="previewImage('.filImageInput', '.diplayImage')">
                                            @php
                                                $imgPath = public_path(config('constants.staff_image_path') . $staff->staff_img);
                                                if (!empty($staff->staff_img) && file_exists($imgPath)) {
                                                    $imagUrl = url(config('constants.staff_image_path') . $staff->staff_img);
                                                } else {
                                                    $imagUrl = url(config('constants.default_image_path'));
                                                }
                                            @endphp


                                            <img src="{{ $imagUrl }}" style="height: 50px; width: 50px;"
                                                class="diplayImage">
                                            @error('staff_img')
        <p class="text-danger text-xs mt-2">{{ $message }}</p>
    @enderror
                                        </div>
                                    </div>  -->

                                <div class="col-md-6">
                                    <label for="staff_img" class="form-label mt-4">Astrologer Images</label>
                                    <input type="file" class="form-control" placeholder="Images" name="staff_img"
                                        id="staff_img" aria-label="staff_img" aria-describedby="staff_img">
                                    <div class="avatar mt-4">
                                        <img class="w-100 border-radius-sm shadow-sm"
                                            src="{{ ImageShow(
                                                config('constants.staff_image_path'),
                                                $staff->staff_img,
                                                'icon',
                                                config('constants.default_staff_image_path'),
                                            ) }}"
                                            class="diplayImage">
                                    </div>
                                    @error('staff_img')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <a href="{{ route('admin.staff_management.staff.index') }}" type="button"
                                        name="button" class="btn btn-light m-0">BACK TO LIST</a>
                                    <button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2"
                                        data-toggle="tooltip" data-placement="top" title="Edit">Edit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
