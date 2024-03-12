

 <!-- [ Main Content ] start -->
@extends('layouts.app')
 @section('content')
 <div class="pcoded-main-container">
    <div class="pcoded-content">

<section class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">User Profile</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('user.profile.update',$data->id ) }}"enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="form-label">Name</label>
                            <input type="text" name="name" required="required" value="{{ old('name', $user->name) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" required="required" value="{{ old('email', $user->email ) }}" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">username</label>
                            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control" >

                        </div>
                        <div class="mb-3">
                            <label for="contactno" class="form-label">Contact Number</label>
                            <input type="text" name="contact" required="required" value="{{ old('contact', $user->contact) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" required="required" class="form-control">{{ old('address', $user->address) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select name="state" required="required" class="form-control">
                                <option value="{{ old('state', $user->state) }}">{{ old('State', $user->State) }}</option>
                                @foreach($states as $state)
                                  <option value="{{ $state->stateName }}">{{ $state->stateName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" name="country" required="required" value="{{ old('country', $user->country) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" name="pincode" maxlength="6" required="required" value="{{ old('pincode', $user->pincode) }}" class="form-control">
                        </div>

                       <div class="mb-3">
                            <label for="userphoto" class="form-label">User Photo</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>

@endsection
 
 @section('customJs')
 
 <script>
     console.log("Hello");
 </script>
     
 @endsection
 

