
    <!-- [ Main Content ] start -->
@extends('layouts.app')

@section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <form action="{{ route('admin.updatePassword') }}" method="POST" role="form text-left">
            @csrf
            <div class="row">
                 <div class="col-12">
                    <label class="form-label">Old Password</label>
                    <div class="input-group">
                    <input class="form-control" value="password" type="text" placeholder="Old Password" id="password" name="old_password">

                </div>
                </div>
                <div class="col-12">
                    <label class="form-label">New Password</label>
                    <div class="input-group">
                        <input class="form-control" value="" type="text" placeholder="New Password" id="password" name="password">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input class="form-control" value="" type="text" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                   <button type="submit" name="button" class="btn bg-gradient-primary m-0 ms-2" data-toggle="tooltip" data-placement="top" title="Edit Password">Edit Password</button>
                </div>
            </div>
         </form>
   </div>
</div>




@endsection

@section('customJs')

<script>
    console.log("Hello");
</script>
    
@endsection



