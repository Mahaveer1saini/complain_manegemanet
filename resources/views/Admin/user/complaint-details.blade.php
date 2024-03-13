@extends('Admin.layouts.app')

@section('content')
   <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Complaint Details</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="feather icon-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.all-complaint') }}">Complaints</a></li>
                                <li class="breadcrumb-item">Complaint Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ form-element ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>View Complaint Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Complainant Name</th>
                                                            <th>Category</th>
                                                            <th>Subcategory</th>
                                                            <th>Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $complaint->id }}</td>
                                                            <td>{{ $complaint->user->name }}</td>
                                                            <td>{{ $complaint->category }}</td>
                                                            <td>{{ $complaint->subcategory }}</td>
                                                            <td>{{ $complaint->complaint_type }}</td>
                                                        </tr>
                                                    </tbody>
                                                    <thead>
                                                        <tr>
                                                            <th>State</th>
                                                            <th>NOC</th>
                                                            <th>Details</th>
                                                            <th>File</th>
                                                            <th>Village</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $complaint->state }}</td>
                                                            <td>{{ $complaint->noc }}</td>
                                                            <td>{{ \Illuminate\Support\Str::limit($complaint->complaint_details, 50) }}</td>
                                                            <td>
                                                                @if($complaint->complaint_file)
                                                                    <img src="{{ asset('complaintdocs/' . $complaint->complaint_file) }}" alt="Complaint Image" class="rounded-circle" style="max-width:50px;">
                                                                @else
                                                                    <img src="{{ asset('images/img-1.png') }}" class="rounded-circle" style="max-width:50px;">
                                                                @endif
                                                            </td>
                                                            <td>{{ $complaint->village }}</td>
                                                        </tr>
                                                     </tbody>
                                                     <thead>
                                                        <tr>
                                                            <th>Tehsil</th>
                                                            <th>Word</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $complaint->tehsil }}</td>
                                                            <td>{{ $complaint->word }}</td>
                                                        </tr>
                                                     </tbody>
                                                     <thead>
                                                        <tr>
                                                            <th>Final Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                @if($complaint->status == '')
                                                                    <span class="badge badge-danger">Not Processed Yet</span>
                                                                @elseif($complaint->status == 'in process')
                                                                    <span class="badge badge-warning">In Process</span>
                                                                @elseif($complaint->status == 'closed')
                                                                    <span class="badge badge-success">Closed</span>
                                                                @endif
                                                            </td>
                                                         </tr>
                                                     </tbody>
                                                     <thead>
                                                        <tr>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                @if($complaint->status != "closed")
                                                                <a href="{{ route('admin.Complaint_Edit', ['id' => $complaint->id]) }}" title="Take Action">
                                                                    <button type="button" class="btn btn-primary">Take Action</button>
                                                                </a>
                                                                @endif
                                                            </td> 
                                                        </tr>
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
   </div>
@endsection
