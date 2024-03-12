@extends('Admin.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Category</div>

                 <div class="card-body">
                    <form action="{{ route('user.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="categoryName">Name:</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" value="{{ $category->categoryName }}" required>
                        </div>
                        <div class="form-group">
                            <label for="categoryDescription">Description:</label>
                            <textarea class="form-control" id="categoryDescription" name="categoryDescription" rows="3" required>{{ $category->categoryDescription }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
