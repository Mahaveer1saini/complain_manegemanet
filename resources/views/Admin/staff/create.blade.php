@extends('backend.layouts.app')
@section('content')
<div class="row">
   <div class="col-11 mx-auto">
      <div class="card card-default">
         <div class="card-header pb-0">
            <div class="d-flex flex-row justify-content-between">
               <h5 class="mb-0">
                  Add New Staff
               </h5>
            </div>
         </div>
         <div class="card-body">
            <form action="{{ route('admin.staff_management.staff.store') }}" method="POST" enctype='multipart/form-data'>
               @csrf
               <div class="row">

                  <div class="col-md-6">
                     <label for="name" class="form-label mt-4">Name</label>
                     <input type="text" class="form-control" placeholder="Name" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                     @error('name')
                     <p class="text-danger text-xs mt-2">{{ $message }}</p>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="email" class="mt-4">Email</label>
                     <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                     @error('email')
                     <p class="text-danger text-xs mt-2">{{ $message }}</p>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="phone" class="mt-4">Phone</label>
                     <input type="tel" class="form-control integer_number_only intlinput" placeholder="Phone" name="phone" id="phone" aria-label="Phone" aria-describedby="phone-addon" value="{{ old('phone') }}">
                     @error('phone')
                     <p class="text-danger text-xs mt-2">{{ $message }}</p>
                     @enderror
                  </div>

                  <div class="col-md-6">
                     <label for="password" class="mt-4">Password</label>
                     <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon" value="">
                     @error('password')
                     <p class="text-danger text-xs mt-2">{{ $message }}</p>
                     @enderror
                  </div>

                  <div class="col-md-6">
                     <label for="gender" class="form-label mt-4">Gender</label>
                     <div>

                        <select class="form-select" id="gender" name="gender" aria-label="gender" aria-describedby="gender">
                           <option value="">Please Select Gender</option>
                           <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                           </option>
                           <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                           </option>
                           <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other
                           </option>
                        </select>
                        @error('gender')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                     </div>
                  </div>

                  <div class="col-md-6">
                     <label for="birth_date" class="form-label mt-4">Birth Date</label>
                     <div>
                        <input type="date" class="form-control" placeholder="birth_date" name="birth_date" id="birth_date" aria-label="birth_date" aria-describedby="birth_date" value="{{ old('birth_date') }}">
                     </div>
                     @error('birth_date')
                     <p class="text-danger text-xs mt-2">{{ $message }}</p>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label for="birth_time" class="form-label mt-4">Birth Time</label>
                     <div class="">
                        <input type="time" class="form-control" placeholder="Birth Time" name="birth_time" id="birth_time" aria-label="birth_time" aria-describedby="birth_time" value="{{  old('birth_time') }}">
                        @error('birth_time')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                     </div>
                  </div>
 
                  <div class="col-md-6">
                     <label for="country_id" class="form-label mt-4">Birth Place</label>
                     <div>
                        <input type="text" id="autocomplete" name="birth_place" class="form-control autocomplete" placeholder="Enter Your Birth Place" value="{{ old('birth_place') }}" autocomplete="off" />
                        @error('birth_place')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                     </div> 
                  </div>
                  <input type="hidden" name="city" id="city" class="form-control city">
                  <input type="hidden" name="state" id="state" class="form-control state">
                  <input type="hidden" name="country" id="country" class="form-control country">
                  <input type="hidden" name="latitude" id="latitude" class="form-control">
                  <input type="hidden" name="longitude" id="longitude" class="form-control">


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

                  <div class="col-md-6">
                     <label for="staff_img" class="form-label mt-4">Images</label>
                     <div class="">
                        <input type="file" class="form-control filImageInput" name="staff_img" id="staff_img" onchange="previewImage('.filImageInput', '.diplayImage')">
                        @php
                        $imagUrl = url(config('constants.default_image_path'));

                        @endphp
                        <img src="{{ $imagUrl }}" style="height: 50px; width: 50px; margin-top: 10px;" class="diplayImage">
                        @error('staff_img')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                     </div>

                  </div>

                  <div class="d-flex justify-content-end mt-4">
                     <a href="{{ route('admin.staff_management.staff.index') }}" type="button" name="button" class="btn btn-light m-0">BACK TO LIST</a>
                     <button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2" data-toggle="tooltip" data-placement="top" title="Submit">Submit</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>


@endsection