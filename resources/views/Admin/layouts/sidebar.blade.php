<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<aside>
    <nav class="pcoded-navbar">
        <div class="navbar-wrapper">
            <div class="navbar-content scroll-div">
                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="{{ asset('assets/images/user/user-gear.png') }}" alt="User-Profile-Image">
                        <div class="user-details">

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
                        <label>Admin Management</label>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route("user.categories.index")}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Add Category</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route("user.subcategories.index")}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Add Subcategory</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('user.states.index')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Add State</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.userList')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Manage Users</span></a>
                    </li>

                    <li class="nav-item pcoded-menu-caption">
                        <label>User Complaints</label>
                    </li>

                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-box"></i></span><span class="pcoded-mtext">Manage Complaint</span></a>
                        <ul class="pcoded-submenu">
                            <li><a href="">All Complaints</a></li>
                            <li><a href="">Not Process Yet</a></li>
                            <li><a href="">In Process</a></li>
                            <li><a href="">Closed Complaints</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Reports</label>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">User Reports</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Complaints Report</span></a>
                    </li>
                    <li class="nav-item pcoded-menu-caption">
                        <label>Search</label>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><span class="pcoded-micon"><i class="feather icon-search"></i></span><span class="pcoded-mtext">User Search</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link"><span class="pcoded-micon"><i class="feather icon-search"></i></span><span class="pcoded-mtext">Search Complaint</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</aside>
