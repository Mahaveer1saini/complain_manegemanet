@extends('backend.layouts.app')
@section('content')
    <div> 
        <div class="row">
            <div class="col-12">
                <div class="mb-4 mx-4"> 
                    <div class="card filter_card" style="margin-bottom:20px;">
                        <div class="card-header">
                            <i class="fa fa-filter"></i> Filter
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.staff_management.staff.index') }}" method="GET">
                                @csrf
                                <div class="border">
                                    <div class="d-flex flex-row align-content-between flex-wrap">
                                        <div class="p-2 flex-fill">
                                            <input type="text" id="search" name="search" class="form-control"
                                                value="{{ !empty($filter['search']) ? $filter['search'] : '' }}"
                                                autocomplete="off"
                                                placeholder="Search By Staff Id, Name, Email, Mobile no." title="Search By Staff Id, Name, Email, Mobile no.">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                                <h5 class="mb-0">All Staff</h5>
                            <div>
                                <a class="btn btn-outline-info btn-sm mb-0" href="{{ route('admin.staff_management.staff.importView') }}"> <i
                                        class="fas fa-upload"></i> Import</a>
                                <a href="{{ route('admin.staff_management.staff.create') }}" class="btn bg-gradient-primary btn-sm mb-0"
                                    type="button">+&nbsp; Add New
                                    Staff</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive ">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            S. No.
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            @sortablelink('staff_uni_id', 'Staff Id')
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            @sortablelink('user.name', 'Staff Name')
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            @sortablelink('user.phone', 'Phone')
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            @sortablelink('user.email', 'Email')
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            @sortablelink('user.role_name', 'Role Name')
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">

                                            @sortablelink('user.created_at', 'Created')
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>

                                        <th
                                            class="text-end text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $staff)
                                        <tr>
                                            <td class="text-center" style="width:50px;">
                                                <p class="text-xs font-weight-bold mb-0">{{ ++$i }}</p>
                                            </td>
                                            <td class="">
                                                <p class="text-xs font-weight-bold mb-0 user_info"
                                                    data-user_uni_id="{{ $staff->staff_uni_id }}">
                                                    {{ $staff->staff_uni_id }}
                                                </p>

                                            </td>
                                            <td class="">
                                                <p class="text-xs font-weight-bold mb-0">{{ $staff->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $staff->phone }}</p>
                                            </td>
                                            <td class="">
                                                <p class="text-xs font-weight-bold mb-0">{{ $staff->email }}</p>
                                            </td>
                                            <td class="">
                                                <p class="text-xs font-weight-bold mb-0">{{ $staff->role_name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ !empty($staff->created_at) ? prettyDateFormat($staff->created_at, 'datetime') : '' }}
                                                </p>
                                            </td> 

                                            <td class="text-center">
                                                <div class="form-check form-switch d-inline-block">
                                                    <input class="form-check-input updateStatus" type="checkbox"
                                                        role="switch" {{ $staff->user->status ? 'checked' : '' }}
                                                        data-id="{{ $staff->staff_uni_id }}">
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <a class="btn btn-warning btn-sm text-white" title="Edit"
                                                    data-toggle="tooltip"
                                                    href="{{ route('admin.staff_management.staff.edit', $staff->id) }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a class="btn btn-info btn-sm text-white" title="view"
                                                    data-toggle="tooltip"
                                                    href="{{ route('admin.staff_management.staff.show', $staff->id) }}"><i
                                                       class="fas fa-light fa-eye"></i></a>
                                                        
                                                <form
                                                    action="{{ route('admin.staff_management.staff.trash', $staff->staff_uni_id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm text-white delete_confirm"
                                                        style="margin-left: 10px" title="trash" data-toggle="tooltip"><i
                                                            class="cursor-pointer fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @if (Auth::user()->role_id == 1)
                                                    <form action="{{ route('admin.staff_management.staff.destroy', $staff->id) }}"
                                                        method="Post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm text-white delete_confirm"
                                                            style="margin-left: 10px" title="Permament Delete"
                                                            data-toggle="tooltip"><i
                                                                class="cursor-pointer fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $staffs->appends($filter)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>





    @push('dashboard')
        <script>
            $(document).ready(function() {
                $('.updateStatus').on('change', function() {
                    let ele = $(this);
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('admin.staff_management.staff.changeStatus') }}",
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
                })
            })
        </script>
    @endpush
@endsection
