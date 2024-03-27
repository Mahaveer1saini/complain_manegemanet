<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | User login</title>
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
            <h4>Complaint management system</h4>
            <h5>User Login</h5>
            <div class="card borderless">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('user.login.store') }}">
                            @csrf
                            <div class="card-body">
                                <h4 class="mb-3 f-w-400">Signin</h4>
                                <hr>
                                <div class="form-group mb-3">
                                    <input type="email" name="email" id="email" class="form-control" required placeholder="Enter Register Email ID">
                                </div>
                                <div class="form-group mb-4">
                                    <input type="password" name="password" class="form-control" required placeholder="Enter Password">
                                </div>
                                <button class="btn btn-block btn-primary mb-4" type="submit">Signin</button>
                                <hr>
                                <p class="mb-2 text-muted">Forgot password? <a href="" class="f-w-400">Reset</a></p>
                                <div class="registration">
                                    Don't have an account yet?<br/><br/>
                                    <a class="badge badge-primary" href="{{ route('user.login_register') }}">Create an account</a>
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
