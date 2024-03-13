@extends('Admin.layouts.app')
@section('content')
  <div class="pcoded-main-container">
        <div class="pcoded-content">
            <div class="card">
                <div class="card-header">Complaint Update</div>
                <div class="card-body">
                    <form action="{{ route('complaint.update', $complaint->id) }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="complaintNumber" class="col-md-4 col-form-label text-md-right">Complaint Number</label>
                            <div class="col-md-6">
                                <input id="complaintNumber" type="text" class="form-control" value="{{ $complaint->id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                            <div class="col-md-6">
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="in process">In Process</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="remark" class="col-md-4 col-form-label text-md-right">Remark</label>
                            <div class="col-md-6">
                                <textarea name="remark" id="remark" cols="50" rows="5" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" onclick="window.close()">Close this window</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
       </div>
  </div>

@endsection
