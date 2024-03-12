

@extends('admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <form action="{{ route('user.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="categoryName">Name:</label>
                <input type="text" class="form-control" id="categoryName" name="categoryName" required>
            </div>
            <div class="form-group">
                <label for="categoryDescription">Description:</label>
                <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
</div>
@endsection

