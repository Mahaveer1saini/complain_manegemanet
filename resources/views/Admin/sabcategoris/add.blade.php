@extends('Admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <h1>Create Subcategory</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('user.subcategories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="subcategory">Subcategory Name</label>
                <input class="form-control" type="text" name="subcategory" id="subcategory">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
   </div>
</div>
@endsection
