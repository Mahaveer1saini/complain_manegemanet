@extends('admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="card card-default">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">
                            Edit Role
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('staff_management.roles.update', $role) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <div class="">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ $role->name }}">
                            @error('name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('staff_management.roles.index') }}" type="button" name="button" class="btn btn-light m-0">BACK TO LIST</a>
                        <button type="submit" data-toggle="tooltip" data-placement="top" title="Create Role" name="button" class="btn bg-gradient-primary m-0 ms-2">CREATE ROLE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection




