@extends('backend.layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
        <div class="container-fluid py-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="text-white opacity-8" href="javascript:;">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Staff Profile Overview
                    </li>
                </ol>
                <h6 class="text-white font-weight-bolder ms-2">Staff Profile Overview</h6>
            </nav> 
        </div>
    </nav>

    <div class="container fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('../../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>

        <div class="card card-body shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">
                <div class="avatar avatar-xl position-relative">
                    <td class="text-center">
                        @php
                            $imgPath = public_path(config('constants.staff_image_path') . $staffdata->staff_image);
                            if (!empty($staffdata->staff_image) && file_exists($imgPath)) {
                            $imagUrl = url(config('constants.staff_image_path') . $staffdata->staff_image);
                            } else {
                            $imagUrl = url(config('constants.default_staff_image_path'));
                            }
                        @endphp
                        <img src="{{ $imagUrl }}" style="height: 50px; width: 50px;">
                    </td>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <td class="text-center">
                            <p class="text-xs font-weight-bold mb-0">
                                {{ !empty($staffdata->name) ? $staffdata->name : ''}}
                            </p>
                        </td>
                        <p class="mb-1 font-weight-bold text-sm">
                            {{ !empty($staffdata->user->name) ? $staffdata->name : ''  }}<br>
                            {{ !empty($staffdata->staff_uni_id) ? $staffdata->staff_uni_id : '' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="row my-4 mx-2">
        <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
            <div class="card">
                <div class="row text-sm my-4 p-3">
                    <div class="col-xl-12 mt-3">
                        <h5>Profile Detail</h5>
                    </div>
                    <div class="col-xl-6"><strong class="text-dark">Full
                            Name:</strong>&nbsp;
                        {{ !empty($staffdata->name) ? $staffdata->name : '' }}
                    </div>
                    <div class="col-xl-6"><strong class="text-dark">Gender:</strong>&nbsp;
                        {{ !empty($staffdata->gender) ? $staffdata->gender : '' }}
                    </div>
                    <div class="col-xl-6"><strong class="text-dark">Mobile:</strong>
                        &nbsp; {{ !empty($staffdata->phone) ? $staffdata->phone : '' }}
                    </div>
                    <div class="col-xl-6"><strong class="text-dark">Email:</strong>
                        &nbsp; {{ !empty($staffdata->email) ? $staffdata->email : '' }}
                    </div>
                    <div class="col-xl-12 mt-3">
                        <h5>Staff Information</h5>
                    </div>
                    <div class="col-xl-6"><strong class="text-dark">Birth Date:</strong>
                        &nbsp; {{ !empty($staffdata->birth_date) ? $staffdata->birth_date : '' }}
                    </div>
                    <div class="col-xl-6"><strong class="text-dark">Birth Time:</strong>
                        &nbsp; {{ !empty($staffdata->birth_time) ? $staffdata->birth_time : '' }}
                    </div>
                    <div class="col-xl-6"><strong class="text-dark">Birth Place:</strong>
                        &nbsp; {{ !empty($staffdata->birth_place) ? $staffdata->birth_place : '' }}
                    </div>
                    <div class="col-xl-6"><strong class="text-dark">Role:</strong>
                        &nbsp; {{ !empty($staffdata->role_name) ? $staffdata->role_name : '' }}  
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
