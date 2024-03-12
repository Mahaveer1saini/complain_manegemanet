
    <!-- [ Main Content ] start -->
    @extends('Admin.layouts.app')

    @section('content')
    
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <form action="{{ route('admin.adminPassword') }}" method="POST" role="form text-left">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Old Password</label>
                        <div class="input-group">
    
                        <input class="form-control" value="" type="text" placeholder="Old Password" id="password" name="old_password">
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
                    <button class="btn btn-block btn-primary mb-4"  type="submit" name="resetpwd">Reset</button>
                        <hr>
                    <p class="mb-2 text-muted"><a href="" class="btn btn-primary">Signin</a></p>
                </div>
            </form>
       </div>
    </div>
    
    
    @endsection
   
    
    
    