@extends('admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div>
            <div class="row">
                <div class="col-11 mx-auto">
                    <div class="card card-default">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">
                                    Role Permission : {{ $role->name }}
                                </h5>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('staff_management.roles.update', $role) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                        
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <hr>
                                </div>
                            </div>
        
                            @if(!empty($menu))
                                @php
                                    $m = 0;
                                @endphp
                                @foreach($menu as $menu_value)
        
                                    @php
                                        $hide_all_create = 0;
                                        $hide_all_read = 0;
                                        $hide_all_update = 0;
                                        $hide_all_delete = 0;
                                    @endphp
        
                                    {{-- @if($menu_value->menu_name == 'Wallets')
                                        @php
                                            $hide_all_create = 0;
                                            $hide_all_read = 0;
                                            $hide_all_update = 0;
                                            $hide_all_delete = 1;
                                        @endphp
                                    @endif --}}
        
                                <div class="row">
                                    <div class="col-lg-12 col-12">
                                        <h5>{{ $menu_value->menu_label }}</h5>
                                    </div>
                                    @if(!empty($menu_value->submenus))
        
                                    @php
                                        $hide_all_create = hideCheckboxForAll($menu_value->submenus, 'show_create');
                                        $hide_all_read = hideCheckboxForAll($menu_value->submenus, 'show_read');
                                        $hide_all_update = hideCheckboxForAll($menu_value->submenus, 'show_update');
                                        $hide_all_delete = hideCheckboxForAll($menu_value->submenus, 'show_delete');
                                    @endphp
        
                                    <div class="col-lg-12 col-12">
                                        <table id="" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%" style="text-align: center;">Sl</th>
                                                    <th style="text-align: left;">Menu Name</th>
                                                    <th width="15%" style="text-align: center;">
                                                      @if($hide_all_create == 0)
                                                      Create
                                                        ( <div class="form-check form-switch d-inline-block">
                                                            <input class="form-check-input permissionCheckAllBtn" id="createall{{ $m }}" type="checkbox" role="switch" name="" data-menu_count="{{ $m }}" data-role_id="{{ $role->id }}" data-menu_id="{{ $menu_value->id }}" data-permission_type="create">
                                                            All
                                                        </div> )
                                                      @endif
                                                    </th>
                                                    <th width="15%" style="text-align: center;">
                                                      @if($hide_all_read == 0)
                                                      Read
                                                        ( <div class="form-check form-switch d-inline-block">
                                                            <input class="form-check-input permissionCheckAllBtn" id="readall{{ $m }}" type="checkbox" role="switch" data-menu_count="{{ $m }}" data-role_id="{{ $role->id }}" data-menu_id="{{ $menu_value->id }}" data-permission_type="read">
                                                            All
                                                        </div> )
                                                      @endif
                                                    </th>
                                                    <th width="15%" style="text-align: center;">
                                                      @if($hide_all_update == 0)
                                                      Update
                                                        ( <div class="form-check form-switch d-inline-block">
                                                            <input class="form-check-input permissionCheckAllBtn" id="updateall{{ $m }}" type="checkbox" role="switch" data-menu_count="{{ $m }}" data-role_id="{{ $role->id }}" data-menu_id="{{ $menu_value->id }}" data-permission_type="update">
                                                            All
                                                        </div> )
                                                      @endif
                                                    </th>
                                                    <th width="15%" style="text-align: center;">
                                                      @if($hide_all_delete == 0)
                                                      Delete
                                                        ( <div class="form-check form-switch d-inline-block">
                                                            <input class="form-check-input permissionCheckAllBtn" id="deleteall{{ $m }}" type="checkbox" role="switch" name="" data-menu_count="{{ $m }}" data-role_id="{{ $role->id }}" data-menu_id="{{ $menu_value->id }}" data-permission_type="delete">
                                                            All
                                                        </div> )
                                                      @endif
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sl = 0;
                                                @endphp
        
                                                @foreach($menu_value->submenus as $submenu_value)
                                                    @php
                                                        $check_permission = '';
        
                                                        $hide_create = 0;
                                                        $hide_read = 0;
                                                        $hide_update = 0;
                                                        $hide_delete = 0;
        
                                                        $hide_create = ($submenu_value->show_create == 1)?0:1;
                                                        $hide_read = ($submenu_value->show_read == 1)?0:1;
                                                        $hide_update = ($submenu_value->show_update == 1)?0:1;
                                                        $hide_delete = ($submenu_value->show_delete == 1)?0:1;
        
                                                        $createID = 'id=create'.$m.$sl;
                                                        $readID   = 'id=read'.$m.$sl;
                                                        $updateID = 'id=update'.$m.$sl;
                                                        $deleteID = 'id=delete'.$m.$sl;
        
                                                        $createCheck = '';
                                                        $readCheck = '';
                                                        $updateCheck = '';
                                                        $deleteCheck = '';
                                                        $check_permission_id = '';
                                                    @endphp
        
                                                                                                
        
                                                    
                                                    @if(!empty($submenu_value->check_permission))
                                                        @php
                                                            $check_permission = $submenu_value->check_permission;
        
                                                        @endphp
                                                    @endif
        
                                                    @if(!empty($check_permission))
                                                        @php
                                                            $check_permission_id = $check_permission->id;
                                                        @endphp 
                                                        @if ($check_permission->create == 1)
                                                            @php
                                                                $createCheck = 'checked';
                                                            @endphp 
                                                        @endif
                                                        @if ($check_permission->read == 1)
                                                            @php
                                                                $readCheck = 'checked';
                                                            @endphp 
                                                        @endif
                                                        @if ($check_permission->update == 1)
                                                            @php
                                                                $updateCheck = 'checked';
                                                            @endphp 
                                                        @endif
                                                        @if ($check_permission->delete == 1)
                                                            @php
                                                                $deleteCheck = 'checked';
                                                            @endphp 
                                                        @endif
                                                    @endif
        
                                                    <tr>
                                                        <td>{{ $sl+1 }}</td>
                                                        <td>
                                                            {{ $submenu_value->submenu_label }}
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if($hide_create == 0)
        
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="checkbox" name="create[{{ $m }}][{{ $sl }}][]" value="{{ $check_permission_id }}" data-role_id="{{ $role->id }}" data-menu_id="{{ $menu_value->id }}" data-submenu_id="{{ $submenu_value->id }}" data-permission_type="create" {{ $createID }} class="form-check-input permissionCheckBtn create{{$m}}" {{ $createCheck }}>
                                                            </div>
                                                            
                                                            @endif
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if($hide_read == 0)
        
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="checkbox" name="read[{{ $m }}][{{ $sl }}][]" value="{{ $check_permission_id }}" data-role_id="{{ $role->id }}" data-menu_id="{{ $menu_value->id }}" data-submenu_id="{{ $submenu_value->id }}" data-permission_type="read" {{ $readID }} class="form-check-input permissionCheckBtn read{{$m}}" {{ $readCheck }}>
                                                            </div>
                                                            
                                                            @endif
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if($hide_update == 0)
        
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="checkbox" name="update[{{ $m }}][{{ $sl }}][]" value="{{ $check_permission_id }}" data-role_id="{{ $role->id }}" data-menu_id="{{ $menu_value->id }}" data-submenu_id="{{ $submenu_value->id }}" data-permission_type="update" {{ $updateID }} class="form-check-input permissionCheckBtn update{{$m}}" {{ $updateCheck }}>
                                                            </div>
        
                                                            @endif
                                                        </td>
                                                        <td style="text-align: center;">
                                                            @if($hide_delete == 0)
        
                                                            <div class="form-check form-switch d-inline-block">
                                                                <input type="checkbox" name="delete[{{ $m }}][{{ $sl }}][]" value="{{ $check_permission_id }}" data-role_id="{{ $role->id }}" data-menu_id="{{ $menu_value->id }}" data-submenu_id="{{ $submenu_value->id }}" data-permission_type="delete" {{ $deleteID }} class="form-check-input permissionCheckBtn delete{{$m}}" {{ $deleteCheck }}>
                                                            </div>
        
                                                            @endif
                                                        </td>
                                                    </tr>
        
                                                    @php
                                                        $sl++
                                                    @endphp
                                                @endforeach
                                                <tr>
                                                    <td colspan="6"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                                @php
                                    $m++
                                @endphp
                                @endforeach
                            @endif
        
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('staff_management.roles.index') }}" type="button" name="button" class="btn btn-light m-0">BACK TO LIST</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('.permissionCheckBtn').on('change', function() {
            let ele = $(this);
            var status = $(this).prop('checked') == true ? 1 : 0;
            var role_id = $(this).data('role_id');
            var menu_id = $(this).data('menu_id');
            var submenu_id = $(this).data('submenu_id');
            var permission_type = $(this).data('permission_type');
            var check_permission_id = $(this).val();
            var update_type = 'single';

            $.ajax({
                url: "{{ route('staff_management.roles.permissionUpdate') }}",
                type: 'post',
                data: {
                    role_id: role_id,
                    menu_id: menu_id,
                    submenu_id: submenu_id,
                    permission_type: permission_type,
                    check_permission_id: check_permission_id,
                    status: status,
                    update_type: update_type,
                },
                success: function(result) {
                    if (result.status == 1) {
                        toastr.success('Permission Updated');
                    } else {
                        toastr.error('Something went Wrong');
                    }
                }
            });
        })


        $('.permissionCheckAllBtn').on('change', function() {
            let ele = $(this);
            var status = $(this).prop('checked') == true ? 1 : 0;
            var role_id = $(this).data('role_id');
            var menu_id = $(this).data('menu_id');
            var submenu_id = '';
            var permission_type = $(this).data('permission_type');
            var check_permission_id = '';
            var update_type = 'all';
            var menu_count = $(this).data('menu_count');

            $.ajax({
                url: "{{ route('staff_management.roles.permissionUpdate') }}",
                type: 'post',
                data: {
                    role_id: role_id,
                    menu_id: menu_id,
                    submenu_id: submenu_id,
                    permission_type: permission_type,
                    check_permission_id: check_permission_id,
                    status: status,
                    update_type: update_type,
                },
                success: function(result) {
                    if (result.status == 1) {
                        $("#"+permission_type+'all'+menu_count).is(":checked")
                            ? $("."+permission_type+menu_count).each(function () {
                                    $(this).prop("checked", !0);
                                })
                            : $("."+permission_type+menu_count).each(function () {
                                    $(this).prop("checked", !1);
                                });
                        toastr.success('Permission Updated');
                    } else {
                        toastr.error('Something went Wrong');
                    }
                }
            });

        })

    })

</script>
@endsection






