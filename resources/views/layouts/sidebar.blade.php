<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-content scroll-div">
            <div class="">
            <div class="main-menu-header">
                    @if($user->image)
                            <img src="{{ asset('user/' . $user->image) }}" class="img-radius" alt="User-Profile-Image">
                        @else
                            <img src="{{ asset('userimages\6e8024ec26c292f258ec30f01e0392dc.png') }}" class="img-radius" alt="User-Profile-Image">
                        @endif
                        
                    <div class="user-details">
                        <span>{{ $user->name }}</span>
                        <div id="more-details">{{ $user->Email }}<i class="fa fa-chevron-down m-l-5"></i></div>
                    </div>
                </div>
                <div class="collapse" id="nav-user-link">
                    <ul class="list-unstyled">
                        <li class="list-group-item"><a href=""><i class="feather icon-user m-r-5"></i>View Profile</a></li>
                        <li class="list-group-item"><a href=""><i class="feather icon-settings m-r-5"></i>Settings</a></li>
                        <li class="list-group-item"><a href=""><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>User Side</label>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.user_dashboard') }}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.complaint') }}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Lodge Complaint</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.complaint-history') }}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Complaint History</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
