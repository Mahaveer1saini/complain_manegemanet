<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS|| Complaint History</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>


<header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        <a href="{{ route('user.user_dashboard') }}" class="b-brand">
            <!-- ========   change your logo hear   ============ -->
            <strong>Complaint Management</strong>
        </a>
        <a href="#!" class="mob-toggler">
            <i class="feather icon-more-vertical"></i>
        </a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown drp-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="feather icon-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                        @if($user->image)
                            <img src="{{ asset('user/' . $user->image) }}" class="img-radius" alt="User-Profile-Image">
                        @else
                            <img src="{{ asset('images/user/user.png') }}" class="img-radius" alt="User-Profile-Image">
                        @endif
                            <span>{{ Auth::user()->name }}</span>
                            <a href="{{ route('user.logout') }}" class="dud-logout" title="Logout">
                                <i class="feather icon-log-out"></i>
                            </a>
                        </div>
                        <ul class="pro-body">
                            <li><a href="{{ route('user.profile', ['id' => auth()->id()]) }}" class="dropdown-item"><i class="feather icon-user"></i> Profile</a></li>
                            <li><a href="{{ route('user.change_password') }}" class="dropdown-item"><i class="feather icon-mail"></i> Settings</a></li>
                            <li><a href="{{ route('user.logout') }}" class="dropdown-item"><i class="feather icon-lock"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
