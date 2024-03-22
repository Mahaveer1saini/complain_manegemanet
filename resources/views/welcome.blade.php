<!DOCTYPE html>
<html lang="en">


<!-- card.html  21 Nov 2019 03:54:26 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="fornt_theme/assets/css/app.min.css">
  <link rel="stylesheet" href="fornt_theme/assets/bundles/chocolat/dist/css/chocolat.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="fornt_theme/assets/css/style.css">
  <link rel="stylesheet" href="fornt_theme/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="fornt_theme/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
               aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav">
                  <li class="nav-item active">
                     <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.login') }}">Admin</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('user.login') }}">User Login</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{route('user.login_register')}}">User Regsitration</a>
                  </li>
              </ul>
            </div>
         </nav>
      </div>
        <div class="main-content">
        <section class="section">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>complanit</h4>
                  </div>
                  <div class="card-body">
                    <p>Card <code>.card-primary</code></p>
                  </div>
                </div>
            </div>
        </section>
       
      </div>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="fornt_theme/assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="fornt_theme/assets/bundles/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="fornt_theme/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="fornt_theme/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="fornt_theme/assets/js/custom.js"></script>
</body>


<!-- card.html  21 Nov 2019 03:54:30 GMT -->
</html>