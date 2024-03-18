<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- fonts -->
   <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700&display=swap" rel="stylesheet">
   <!-- owl stylesheets -->
   <link rel="stylesheet" href="css/owl.carousel.min.css">
   <link rel="stylesoeet" href="css/owl.theme.default.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css">

@extends('admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">All Roles</h5>
                    </div>
                    <a href="{{ route('admin.roles.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                        type="button">+&nbsp;Add New Role</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    S. No.
                                </th>
                                <th
                                    class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Creation Date
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="text-center" style="width:50px;">
                                        <p class="text-xs font-weight-bold mb-0">{{ ++$i }}</p>
                                    </td>
                                    <td class="text-left">
                                        <p class="text-xs font-weight-bold mb-0">{{ $role->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ $role->created_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-switch d-inline-block">
                                            <input class="form-check-input updateStatus" type="checkbox"
                                                role="switch" {{ $role->status ? 'checked' : '' }}
                                                 data-id="{{ $role->id }}">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="Post">
                                            <a class="btn btn-warning btn-sm text-white"
                                                href="{{ route('admin.roles.edit', $role->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm text-white"><i
                                                    class="cursor-pointer fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $roles->links('pagination::bootstrap-5') }}
            </div>
        </div>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

           
        <script>
            $(document).ready(function() {
                $('.updateStatus').on('change', function() {
        
                    let ele = $(this);
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var id = $(this).data('id');
        
                    $.ajax({
                        url: "{{ route('admin.roles.changeStatus') }}",
                        type: 'post',
                        data: {
                            _token: _token,
                            id: id,
                            status: status,
                        },
                        success: function(result) {
                            if (result.success) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: result.success,
                                    icon: 'success',
                                })
                            } else {
                                ele.prop('checked', !status);
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            ele.prop('checked', !status);
                            Swal.fire({
                                title: 'Oops!',
                                text: 'Something went wrong. Please try again.',
                                icon: 'error',
                            })
                        }
                    });
                });
            });
        </script>
        
           
    </div>
</div>
@endsection


