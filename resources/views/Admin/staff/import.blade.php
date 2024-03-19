@extends('backend.layouts.app')
@section('content')
    <div class="row">
        <div class="col-11 mx-auto">
            <div class="card card-default">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                            <h5 class="mb-0">
                                Import Staff Data
                            </h5>
                    </div>
                </div>
				<div class="d-flex flex-row justify-content-end mx-4">
					<div class="d-flex flex-row justify-content-between ">
						<h5 class="mb-0 ">
							<a href="/{{ config('constants.default_staff_csv') }}" class="btn btn-info">
								<i class="fas fa-download"></i> Download Sample File
							</a>
						</h5>
					</div>
				</div>
                <div class="card-body">
                    <form action="{{ route('admin.staff_management.staff.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						<label for="file" class="">Select CSV File</label>
                        <input type="file" name="file" class="form-control">
                        <br>
                        <button type="submit" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Import Staff Data">
                            Import Staff Data
                        </button>
                        <a href="{{ route('admin.staff_management.staff.index') }}" type="button" name="button"
                        class="btn btn-light">BACK TO
                        LIST</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
