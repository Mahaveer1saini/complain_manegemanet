


@extends('admin.layouts.app')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create State</div>
                 <div class="card-body">
                    <div class="container mt-5">
                        <h1>Edit State</h1>
                        @if ($errors->any())
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('user.states.update', $state->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="state">State Name:</label>
                                <input type="text" id="state" name="state" value="{{ $state->state }}" required>
                            </div>
                            <div>
                                <label for="stateDescription">State Description:</label>
                                <textarea id="stateDescription" name="stateDescription" required>{{ $state->stateDescription }}</textarea>
                            </div>
                            <div>
                                <label for="postingDate">Posting Date:</label>
                                <input type="date" id="postingDate" name="postingDate" value="{{ $state->postingDate }}" required>
                            </div>
                            <div>
                                <label for="updationDate">Updation Date:</label>
                                <input type="date" id="updationDate" name="updationDate" value="{{ $state->updationDate }}" required>
                            </div>
                            <button type="submit">Update State</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

