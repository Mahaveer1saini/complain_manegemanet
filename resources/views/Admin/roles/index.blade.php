@extends('admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div>
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 mx-4">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h5 class="mb-0">All Roles</h5>
                                </div>
                                <a href="{{ route('staff_management.roles.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
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
                                                    <form action="{{ route('staff_management.roles.destroy', $role->id) }}" method="Post">
                                                        <a class="btn btn-info btn-sm text-white" href="{{ route('staff_management.permission', $role->id) }}" title="Permission"><i class="fas fa-lock"></i></a>
                                                        <a class="btn btn-warning btn-sm text-white"
                                                            href="{{ route('staff_management.roles.edit', $role->id) }}"><i
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
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.updateStatus').on('change', function() {
                    let ele = $(this);
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    let status = $(this).prop('checked') ? 1 : 0;
                    let id = $(this).data('id');
        
                    // Debugging: Check data before sending AJAX request
                    console.log("ID:", id);
                    console.log("Status:", status);
                    console.log("_token:", _token);
        
                    $.ajax({
                        url: "{{ route('staff_management.changeStatus') }}",
                        type: 'POST',
                        data: {
                            _token: _token,
                            id: id,
                            status: status,
                        },
                        success: function(result) {
                            console.log("AJAX Success:", result);
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
                            console.log("AJAX Error:", xhr.responseText);
                            ele.prop('checked', !status);
                            Swal.fire({
                                title: 'Oops!',
                                text: 'Something went wrong. Please try again.',
                                icon: 'error',
                            })
                        }
                    });
                })
            })
        </script>
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

        <script>
            $(document).ready(function(){
                // Activate Bootstrap toasts
                $('.toast').toast('show');
            });
        </script>

    </div>
</div>
@endsection
