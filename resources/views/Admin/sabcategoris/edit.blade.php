
@extends('Admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="container">
            <h1 class="my-4">Edit Subcategory</h1>
            <form action="{{ route('user.subcategories.update', $subcategory->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category ID:</label>
                    <input type="text" class="form-control" id="category_id" name="category_id" value="{{ $subcategory->category_id }}" required>
                </div>
                <div class="mb-3">
                    <label for="subcategory" class="form-label">Subcategory:</label>
                    <input type="text" class="form-control" id="subcategory" name="subcategory" value="{{ $subcategory->subcategory }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
   </div>
</div>
@endsection