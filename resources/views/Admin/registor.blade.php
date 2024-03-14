<!DOCTYPE html>
<html lang="en">

<head>
    <title>CMS | User Password Recovery</title>
    <link rel="stylesheet" href="../assets/css/style.css">
   
</head>
<body>
    <div class="auth-wrapper">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="auth-content text-center">
            <h4>Complaint management system <hr /><span style="color:#fff;"> User Password Recovery</span></h4>
            <div class="card borderless">
                <div class="row align-items-center ">
                    <div class="col-md-12">
                        <form method="post" action="{{ route('admin.customer_ragister') }}">
                            @csrf
                            <div class="card-body">
                                <h4 class="mb-3 f-w-400">Register page</h4>
                                <hr>

                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                                        aria-label="Name" aria-describedby="name" class="form-control @error('email') is-invalid @enderror" value="{{ old('name') }}">
                                    @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Email Field -->
                                <div class="form-group mb-3">
                                    <input  type="email"class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="text" placeholder="Enter Your Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                {{-- //username --}}
                                <div class="form-group mb-3">
                                    <input type="username" class="form-control" placeholder="Username"class="form-control @error('contact') is-invalid @enderror"
                                        name="username" id="email" aria-label="Username"
                                        aria-describedby="username-addon" value="{{ old('username') }}">
                                    @error('username')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Contact Field -->
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control @error('contact') is-invalid @enderror" placeholder="contact" name="contact">
                                    @error('contact')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Password Field -->
                                <div class="form-group mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" id="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- Password Confirmation Field -->
                                <!-- Role Field -->
                                <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                    <option value="">Select Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <hr>
                                <button class="btn btn-block btn-primary mb-4" type="submit" name="submit">Submit</button>
                            </div>
                        </form>


                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Required Js -->
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>
</body>
</html>


