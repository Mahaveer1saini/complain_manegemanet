<!-- resources/views/updatecomplaint.blade.php -->

@extends('Admin.layouts.app')

@section('content')
  <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Profile') }}</div>
            
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.Complaint_Update', $complaint->id) }}">
                            @csrf
                            <table class="table">
                                <tr height="50">
                                    <td><b>Complaint Number</b></td>
                                    <td></td>
                                </tr>
                                <tr height="50">
                                    <td><b>Status</b></td>
                                    <td>
                                        <select name="status" required class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="in process">In Process</option>
                                            <option value="closed">Closed</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr height="50">
                                    <td><b>Remark</b></td>
                                    <td><textarea name="remark" cols="50" rows="10" required class="form-control"></textarea></td>
                                </tr>
                                <tr height="50">
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="update" value="Submit" class="btn btn-primary"></td>
                                </tr>
                            </table>
                        </form>
                        <form method="post" action="">
                            @csrf
                            <input type="submit" class="btn btn-secondary" value="Close this window">
                        </form>
                    </div>
                </div>
            </div>
        </div>
  </div>
@endsection






































