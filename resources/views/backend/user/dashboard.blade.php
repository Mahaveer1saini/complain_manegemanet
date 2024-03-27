

@extends('layouts.app')
@section('content')
    
<div class="pcoded-main-container">
    <div class="pcoded-content">
 <!-- [ Main Content ] start -->
<div class="row">
    <div class="col-md-12 col-xl-6">
        <!-- widget-success-card start -->
        <div class="card flat-card widget-primary-card">
            <div class="row-table">
                <div class="col-sm-4 card-body">
                    <i class="fas fa-file"></i>
                </div>
                <?php
                // Assuming the user is authenticated
                $user = auth()->user();
                $totcom = $user->complaints()->count();
            ?>
            <h4>{{ $totcom }}</h4>
            <h6>Total Complaints</h6>
            </div>
        </div>
        <!-- widget-success-card end -->
    </div>
    <div class="col-md-12 col-xl-6">
        <!-- widget-success-card start -->
        <div class="card flat-card bg-danger">
            <div class="row-table">
                <div class="col-sm-4 card-body">
                    <i class="fas fa-file"></i>
                </div>
                <div class="col-sm-9">

                    <h6>Pending Complaints</h6>
                </div>
            </div>
        </div>
        <!-- widget-success-card end -->
    </div>
    <div class="col-md-12 col-xl-6">
        <!-- widget-success-card start -->
        <div class="card flat-card bg-warning">
            <div class="row-table">
                <div class="col-sm-3 card-body">
                    <i class="fas fa-file"></i>
                </div>
                <div class="col-sm-9">

                    <h6>Inprocess Complaints</h6>
                </div>
            </div>
        </div>
        <!-- widget-success-card end -->
    </div>
    <div class="col-md-12 col-xl-6">
        <!-- widget-success-card start -->
        <div class="card flat-card widget-purple-card">
            <div class="row-table">
                <div class="col-sm-3 card-body">
                    <i class="fas fa-file"></i>
                </div>
                <div class="col-sm-9">

                    <h6>Closed Complaints</h6>
                </div>
            </div>
        </div>
        <!-- widget-success-card end -->
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


