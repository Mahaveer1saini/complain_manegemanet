@extends('admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="card card-default color-palette-bo">
                    <div class="card-header">
                        <div class="d-inline-block">
                            <h6 class="font-weight-bolder mb-0 text-capitalize"> <i class="fa fa-edit"></i>
                                &nbsp; {{ $role->name }} Permissions</h6>
                        </div>
                        <div class="d-inline-block float-right font-weight-bolder mb-0 text-capitalize" style="float: right;">
                            <a href="#" onclick="window.history.go(-1); return false;" class="btn btn-primary pull-right"><i
                                    class="fa fa-reply mr5"></i> <?= trans('back') ?></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <h6 class="font-weight-bolder mb-0 text-capitalize">
                                <span class="mr5">Permission Access : </span>
                                {{ $role->name }}
                            </h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php foreach($modules as $kk => $module): ?>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h6 class="font-weight-bolder mb-0 text-capitalize">
                                                <strong class="f-16"><?= trans($module['module_name']) ?></strong>
                                            </h6>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row mb-3">
                                                <?php foreach(explode("|",$module['operation']) as $k => $operation): ?>
                                                <div class="col-md-4 pb-3">
                                                    <span class="pull-left form-check form-switch d-inline-block">
                                                        <input type='checkbox' class='form-check-input updateStatus'
                                                            data-module='<?= $module['controller_name'] ?>'
                                                            data-module_name='<?= $module['module_name'] ?>'
                                                        data-operation='<?= $operation ?>' data-role_id='<?= $role->id ?>' id='cb_<?= $kk . $k ?>'
                                                        <?php if (in_array($module['module_name'].'/'.$operation, $access)) {
                                                            echo 'checked="checked"';
                                                        } ?>
                                                        />
                                                        <label class='tgl-btn' for='cb_<?= $kk . $k ?>'></label>
                                                    </span>
                                                    <span class="mt-15 pl-3">
                                                        <?= ucwords($operation) ?>
                                                    </span>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="margin:7px 0px;" />
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @push('dashboard')
        <script>
            $(document).ready(function () {
                $('.updateStatus').on('change', function(){
                    let ele = $(this);
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var operation = $(this).data('operation');
                    var role_id = $(this).data('role_id');
                    var module_name = $(this).data('module_name');
                    $.ajax({
                        url: "{{ route('admin.roles.set_access') }}",
                        type: 'post',
                        data: {
                            _token: _token,
                            operation: operation,
                            role_id: role_id,
                            module_name: module_name,
                            status: status,
                        },
                        success: function (result) {
                            if (result.success) {
                                toastr.success('Status Updated')
                            }else{
                                toastr.error('Something went Wrong')
                            }
                        }
        
                    });
                })
            })
        
        </script>
    </div>
</div>
@endsection


