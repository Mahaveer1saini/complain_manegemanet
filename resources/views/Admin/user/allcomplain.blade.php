@extends('Admin.layouts.app')

@section('content')
  <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Manage Users</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.all-complaint') }}">All Complaints</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          <div class="row">
               <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>View All Complaints</h5>
                            <hr>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>S.No</th>
                                                            <th>User ID</th>
                                                            <th>Category</th>
                                                            <th>Subcategory</th>
                                                            <th>Complaint Type</th>
                                                            <th>State</th>
                                                            <th>NOC</th>
                                                            <th>Complaint Details</th>
                                                            <th>Complaint File</th>
                                                            <th>Village</th>
                                                            <th>Tehsil</th>
                                                            <th>Word</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($allComplaint as $allComplaint)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $allComplaint->user_id }}</td>
                                                                <td>{{ $allComplaint->category }}</td>
                                                                <td>{{ $allComplaint->subcategory }}</td>
                                                                <td>{{ $allComplaint->complaint_type }}</td>
                                                                <td>{{ $allComplaint->state }}</td>
                                                                <td>{{ $allComplaint->noc }}</td>
                                                                <td>
                                                                    {{ \Illuminate\Support\Str::limit($allComplaint->complaint_details, 5) }} <!-- Change 50 to your desired character limit -->
                                                                </td>
                                                                <td>
                                                                
                                                                    @if($allComplaint->complaint_file)
                                                                    <img src="{{ asset('complaintdocs/' . $allComplaint->complaint_file) }}" alt="complain Image" class="rounded-circle" style="max-width:50px;">

                                                                    @else
                                                                    <img src="{{ asset('images\img-1.png') }}" class="rounded-circle" style="max-width:50px;">
                                                                    @endif
                                                                   
                                                                </td>
                                                                <td>{{\Illuminate\Support\Str::limit( $allComplaint->village,5)}}</td>
                                                                <td>{{\Illuminate\Support\Str::limit( $allComplaint->tehsil,5)}}</td>
                                                                <td>{{ $allComplaint->word }}</td>
                                                                <td>
                                                                    @if($allComplaint->status == '')
                                                                        <span class="badge badge-danger">Processed Yet</span>
                                                                    @elseif($allComplaint->status == 'in process')
                                                                        <span class="badge badge-warning">In Processing</span>
                                                                    @elseif($allComplaint->status == 'closed')
                                                                        <span class="badge badge-success">Closed</span>
                                                                    @elseif($allComplaint->status == 'padding')
                                                                        <span class="badge badge-info">Padding</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ route('admin.Complaint_detail', ['id' => $allComplaint->id]) }}" class="btn btn-primary">View Details</a> 
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
         </div>
  </div>

@endsection