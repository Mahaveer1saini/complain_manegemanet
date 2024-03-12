

@extends('Admin.layouts.app')

@section('content')

<!-- Main Content -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="card">
            <div class="card-header">Create State</div>
             <div class="card-body">
                <form action="{{ route('user.states.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="state" class="form-label">State Name:</label>
                        <input type="text" id="state" name="state" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="stateDescription" class="form-label">State Description:</label>
                        <textarea id="stateDescription" name="stateDescription" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="postingDate" class="form-label">Posting Date:</label>
                        <input type="date" id="postingDate" name="postingDate" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="updationDate" class="form-label">Updation Date:</label>
                        <input type="date" id="updationDate" name="updationDate" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Create State</button>
                </form>
            </div>
        </div>
            
    </div>
</div>

@endsection
