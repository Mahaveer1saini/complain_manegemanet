<!DOCTYPE html>
<html lang="en">
<head>
    <title>CMS | User Registrations</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
        @if (Session::has('success'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
        @endif
<body>
<div class="auth-wrapper">
    <div class="auth-content text-center">
        <h4>Complaint management system <hr /><span style="color:#fff;"> User Registration</span></h4>
        <hr />
        <div class="card borderless">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <form method="post" action="{{ route('user.register.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Full Name" name="name" value="" required autofocus>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <input type="email" class="form-control" placeholder="Email ID" name="Email" value="" required>
                                @error('Email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" maxlength="10" name="contact" placeholder="Contact no" value="{{ old('contact') }}" required autofocus>
                                @error('contact')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password" required><br>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-block btn-primary mb-4" type="submit" name="submit">Register</button>
                            <hr>
                        </div>
                    </form>
                    <i class="fa fa-home" aria-hidden="true"><a class="" href="{{ url('/') }}">Back Home</a></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Required Js -->
<script src="../assets/js/vendor-all.min.js"></script>
<script src="../assets/js/plugins/bootstrap.min.js"></script>
</body>
</html>
