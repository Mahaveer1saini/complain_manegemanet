@extends('Admin.layouts.app')

@section('content')

<!-- Main Content -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href=""><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
           <!-- Profile Information Section -->
            <div class="col-md-12">
                <div class="card" id="basic-info">
                    <div class="card-header">
                        <h5 class="profile-title">Profile Information</h5> <!-- Added class "profile-title" -->
                    </div>

                    <div class="card-body" style="margin-top:-30px;">
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{$users->username  }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">contact:</strong> &nbsp; {{$users->contact }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">username:</strong> &nbsp; {{$users->username }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{$users->email  }}</li>
                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; IND</li>
                            <li class="list-group-item border-0 ps-0 pb-0">
                                <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;"><i class="fab fa-facebook fa-lg" aria-hidden="true"></i></a>
                                <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;"><i class="fab fa-twitter fa-lg" aria-hidden="true"></i></a>
                                <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;"><i class="fab fa-instagram fa-lg" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
       
    </div>
</div>
@endsection

