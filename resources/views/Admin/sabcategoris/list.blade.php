@extends('Admin.layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="container">
            <h1 class="my-4">Subcategories</h1>
            <a href="{{ route('user.subcategories.create') }}" class="btn btn-primary mb-3">Create New Subcategory</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category ID</th>
                        <th>Subcategory</th>
                        <th>Creation Date</th>
                        <th>Updation Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                    <tr>
                        <td>{{ $subcategory->id }}</td>
                        <td>{{ $subcategory->category_id }}</td>
                        <td>{{ $subcategory->subcategory }}</td>
                        <td>{{ $subcategory->creation_date }}</td>
                        <td>{{ $subcategory->updation_date }}</td>
                        <td>
                            <a href="{{ route('user.subcategories.show', $subcategory->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('user.subcategories.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('user.subcategories.destroy', $subcategory->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </div>
</div>
@endsection