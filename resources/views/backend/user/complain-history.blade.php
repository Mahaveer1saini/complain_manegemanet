    @include('layouts.sidebar')
     <!-- [ Header ] start -->
    @include('layouts.header')

    <div class="pcoded-main-container">
        <div class="pcoded-content">
    <div class="container mt-4">
      @if (Session::has('success'))
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {!! Session::get('success') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
       @endif

    @if (Session::has('error'))
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
     @endif
        <h5 class="mb-4">Complaint History</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Complaint No</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $cnt = 1; @endphp
                    @foreach($complaints as $complaint)
                    <tr>
                        <td>{{ $cnt++ }}</td>
                        <td>{{ $complaint->user_id }}</td>
                        <td>{{ $complaint->user->name }}</td>
                        <td>{{ $complaint->created_at }}</td>
                        <td>
                            @if($complaint->status == '')
                                <span class="badge badge-danger">Not Processed Yet</span>
                            @elseif($complaint->status == 'in process')
                                <span class="badge badge-warning">In Process</span>
                            @elseif($complaint->status == 'closed')
                                <span class="badge badge-success">Closed</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('user.complaint.details', $complaint->id) }}" class="btn btn-primary btn-sm">View Details</a>
                            <a href="{{ route('user.complaint_update', $complaint->id) }}"
                                class="btn btn-primary btn-sm">Edit</a>
                            <a><form action="{{ route('user.complaint_destroy', $complaint->id) }}" method="post">
                                    @csrf
                                    @method('get')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                               </form>
                            </a>
                        </td>
                       </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
</body>
</html>



