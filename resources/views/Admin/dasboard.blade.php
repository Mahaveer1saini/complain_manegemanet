

@extends('Admin.layouts.app')
@section('content')
    
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
        <div class="row">
            <!-- Total Users Card -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card widget-primary-card">
                    <div class="row">
                        <div class="col-3 card-body">
                            <i class="feather icon-users"></i>
                        </div>
                        <div class="col-9">

                            <a href=""><h3>{{ $all_user }} Total Users</h3></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Categories Card -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card bg-warning">
                    <div class="row">
                        <div class="col-3 card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-9">
                            <h4>{{$all_categories}}</h4>
                            <a href=""><h6>Total Category</h6></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Subcategories Card -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card widget-purple-card">
                    <div class="row">
                        <div class="col-3 card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-9">
                            <h4>{{$all_subcategories}}</h4>
                            <a href=""><h6>Total Subcategory</h6></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total States Card -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card bg-primary">
                    <div class="row">
                        <div class="col-3 card-body">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="col-9">
                            <h4>{{$all_state}}</h4>
                            <a href=""><h6>Total State</h6></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Complaints Card -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card widget-purple-card">
                    <div class="row">
                        <div class="col-3 card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-9">
                            <h4>{{$all_Complaint}}</h4>
                            <a href=""><h6>Total Complaints</h6></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Complaints Card -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card bg-danger">
                    <div class="row">
                        <div class="col-3 card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-9">
                            <h4>{{$paddingComplaintCount}}</h4>
                            <a href=""><h6>Pending Complaints</h6></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inprocess Complaints Card -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card bg-warning">
                    <div class="row">
                        <div class="col-3 card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-9">
                            <h4>{{$processComplaintCount}}</h4>
                            <a href=""><h6>Inprocess Complaints</h6></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Closed Complaints Card -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card widget-purple-card">
                    <div class="row">
                        <div class="col-3 card-body">
                            <i class="fas fa-file"></i>
                        </div>
                        <div class="col-9">
                            <h4>{{$closedComplaintCount}}</h4>
                            <a href=""><h6>Closed Complaints</h6></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets\js\vendor-all.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>

<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>


<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-main.js"></script>
@endsection