<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | User login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-content text-center">
            <h4>Complaint management system</h4>
            <h5>admin Login</h5>
            <div class="card borderless">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('admin.loginStore') }}">
                            @csrf
                            <div class="card-body">
                                <h4 class="mb-3 f-w-400">Signin</h4>
                                <hr>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="" aria-label="Username" aria-describedby="username-addon">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" aria-label="Password" aria-describedby="password-addon">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);"></span>
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button class="btn btn-block btn-primary mb-4" type="submit">Signin</button>
                                <hr>
                                <p class="mb-2 text-muted">Forgot password? <a href="" class="f-w-400">Reset</a></p>
                                <div class="registration">
                                    Don't have an account yet?<br/><br/>
                                    <a class="badge badge-primary" href="{{ url('admin/admin_ragister') }}">Create an account</a>
                                </div>
                                <i class="fa fa-home" aria-hidden="true">
                                    <a class="" href="{{ url('/') }}">Back Home</a>
                                </i>
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
       
</body>
</html>
