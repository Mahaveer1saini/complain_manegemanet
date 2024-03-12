@extends('Admin.layouts.app')

@section('content')

<!-- Main Content -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        
            <div class="card-header">Create State</div>
            <div class="card-body">
                <div class="container mt-5">
                    <h1>States</h1>
                    <a href="{{ route('user.states.create') }}" class="btn btn-primary mb-3">Create New State</a>
                    <ul class="list-group">
                        @forelse ($states as $state)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>{{ $state->state }}</strong>
                            <span>
                                <a href="{{ route('user.states.edit', $state->id) }}" class="btn btn-info btn-sm me-2">Edit</a>
                                <form action="{{ route('user.states.destroy', $state->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </span>
                        </li>
                        @empty
                        <li class="list-group-item">No states found.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
       </div>
</div>

@endsection


