@extends('Admin.layouts.app')
 @section('content')
 <section class="pcoded-main-container">
    <div class="pcoded-content">
           <div class="card-body">
                        <h5>View and Update Users Details</h5>
                        <hr>
                        <form action="{{ route('admin.search_filter') }}" method="GET">
                          @csrf
                          <div class="border">
                              <div class="d-flex flex-row align-content-between flex-wrap">
                                  <div class="p-2 flex-fill">
                                      <input type="text" id="search" name="search" class="form-control"
                                          value="{{ !empty($filter['search']) ? $filter['search'] : '' }}"
                                          autocomplete="off"
                                          placeholder="Search By Customer Id, Name, Email, Mobile no." title="Search By Customer Id, Name, Email, Mobile no.">
                                  </div>
                                  <div class="p-2 flex-fill">
                                      <select class="form-control form-select" id="status" name="status">
                                          <option value="">Status</option>
                                          <option value="1"
                                              {{ isset($filter['status']) && $filter['status'] == 1 ? 'selected' : '' }}>
                                              Active</option>
                                          <option value="0"
                                              {{ isset($filter['status']) && $filter['status'] == 0 ? 'selected' : '' }}>
                                              Inactive</option>
                                      </select>
                                  </div>
              
                                  <div class="p-2 flex-fill">
                                      <input type="text" name="start_date" class="form-control datepicker"
                                          autocomplete="off"
                                          value="{{ !empty($filter['start_date']) ? $filter['start_date'] : '' }}"
                                          placeholder="Start Date" />
                                  </div>
                                  <div class="p-2 flex-fill">
                                      <input type="text" name="end_date" class="form-control datepicker"
                                          autocomplete="off"
                                          value="{{ !empty($filter['end_date']) ? $filter['end_date'] : '' }}"
                                          placeholder="End Date" />
                                  </div>
                                  <div class="p-2">
                                      <button type="submit" class="btn btn-primary shadow-primary mb-0 button"
                                          name="submit" data-toggle="tooltip" data-placement="top" title="Filter">Filter</button>
                                      <button type="submit" name="excel_export" value="Export"
                                          class="btn btn-primary excel_export shadow-primary mb-0 button"
                                          name="submit" data-toggle="tooltip" data-placement="top" title="Export"><i class="fas fa-file-excel"></i> Export</button>
                                      <button type="submit" name="pdf_export" value="Pdf"
                                          class="btn btn-primary pdf_export shadow-primary mb-0 button"
                                          name="submit" data-toggle="tooltip" data-placement="top" title="PDF"><i class="fas fa-file-pdf"></i> Pdf</button>
              
                                  </div>
                              </div>
                          </div>
                      </form>

                      
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table id="example" class="display nowrap table" >
                                            <thead class="col-xl-lg-12">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>UserName</th>
                                                    <th>Contact no</th>
                                                    <th>Address</th>
                                                    <th>State</th>
                                                    <th>Country</th>
                                                    <th>Pincode</th>
                                                    <th>Create_at</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user => $row)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $row->name }}</td>
                                                    <td>{{ $row->email }}</td>
                                                    <td>{{ $row->username }}</td>
                                                    <td>{{ $row->contact }}</td>
                                                    <td>{{ $row->address }}</td>
                                                    <td>{{ $row->state }}</td>
                                                    <td>{{ $row->country }}</td>
                                                    <td>{{ $row->pincode }}</td>
                                                    <td>{{ $row->created_at }}</td>
                                                    <td>
                                                        @if($row->image)
                                                        <img src="{{ asset('user/' . $row->image) }}" alt="User Image" class="rounded-circle" style="max-width:50px;">
                                                        @else
                                                        <img src="{{ asset('userimages\6e8024ec26c292f258ec30f01e0392dc.png') }}" class="rounded-circle" style="max-width:50px;">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModal{{ $row->id }}">
                                                            <button class="btn fa fa-eye text-success" id="crection_btn"></button>
                                                        </a>
                                                        <form action="{{ route('admin.users.destroy', $row->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
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
</section>
@foreach ($users as $row)
<div class="modal fade" id="myModal{{ $row->id }}" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Single row</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
          <tbody>
            <tr>
              <th scope="row">Name:</th>
              <td>{{ $row->name }}</td>
            </tr>
            <tr>
              <th scope="row">Email:</th>
              <td>{{ $row->email }}</td>
            </tr>
            <tr>
              <th scope="row">Mobile:</th>
              <td>{{ $row->contact }}</td>
            </tr>
            <tr>
              <th scope="row">Address:</th>
              <td>{{ $row->address }}</td>
            </tr>
            <tr>
              <th scope="row">Image:</th>
              <td><img src="{{ asset('user/' . $row->image) }}" alt="User Image" style="max-width: 100px;"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach
<!-- Required Js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
   <script>
         // Function to handle modal activation
            $('[data-bs-toggle="modal"]').on('click', function() {
                var targetModal = $(this).data('bs-target');
                $(targetModal).modal('show');
            });
       
    </script>


@endsection

 

