 <!-- [ Main Content ] start -->
    @extends('layouts.app')

    @section('content')
    
    
    <div class="pcoded-main-container">
        <div class="pcoded-content">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <!-- Table headers -->
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Complaint Number</b></td>
                                    <td>{{ $complaint->complaintNumber }}</td>
                                    <td><b>Complainant Name</b></td>
                                    <td>{{ $complaint->user->fullName }}</td>
                                    <td><b>Reg Date</b></td>
                                    <td>{{ $complaint->regDate }}</td>
                                </tr>

                                <tr>
                                    <td><b>Category</b></td>

                                    <td>{{ $complaint->subcategory }}</td>
                                    <td><b>Complaint Type</b></td>
                                    <td>{{ $complaint->complaintType }}</td>
                                </tr>

                                <tr>
                                    <td><b>State</b></td>
                                    <td>{{ $complaint->state }}</td>
                                    <td><b>Nature of Complaint</b></td>
                                    <td colspan="3">{{ $complaint->noc }}</td>
                                </tr>

                                <tr>
                                    <td><b>Complaint Details</b></td>
                                    <td colspan="5">{{ $complaint->complaintDetails }}</td>
                                </tr>

                                <tr>
                                    <td><b>File (if any)</b></td>
                                    <td colspan="5">
                                        @if ($complaint->complaintFile)
                                            <a href="../user/complaintdocs/{{ $complaint->complaintFile }}" target="_blank">View File</a>
                                        @else
                                            File NA
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Final Status</b></td>
                                    <td colspan="5">
                                        @if ($complaint->status == '')
                                            <span class="badge badge-danger">Not Processed Yet</span>
                                        @elseif ($complaint->status == 'in process')
                                            <span class="badge badge-warning">In Process</span>
                                        @elseif ($complaint->status == 'closed')
                                            <span class="badge badge-success">Closed</span>
                                        @endif
                                    </td>
                                </tr>

                                <hr>

                                {{-- @foreach ($remarks as $remark)
                                <tr>
                                    <th colspan="4">Remark</th>
                                    <th>Status</th>
                                    <th>Updation Date</th>
                                </tr>
                                <tr>
                                    <td colspan="4">{{ $remark->remark }}</td>
                                    <td>{{ $remark->sstatus }}</td>
                                    <td>{{ $remark->rdate }}</td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
    
    
    
    @endsection
    
    @section('customJs')
    
    <script>
        console.log("Hello");
    </script>
        
    @endsection
    
    
    
    
