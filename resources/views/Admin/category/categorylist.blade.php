@extends('Admin.layouts.app')
@section('content')
    <div class="pcoded-main-container">
        <div class="pcoded-content">
             <a href="{{ route('user.categories.create') }}" class="btn btn-primary mb-2">Create Category</a>
               <div class="table-responsive">
                   <table class="table">
                       <thead>
                           <tr>
                               <th scope="col">ID</th>
                               <th scope="col">Name</th>
                               <th scope="col">Description</th>
                               <th scope="col">Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach ($categories as $category)
                           <tr>
                               <td>{{ $category->id }}</td>
                               <td>{{ $category->categoryName }}</td>
                               <td>{{ $category->categoryDescription }}</td>
                               <td>
                                   <a href="{{ route('user.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                   <form action="{{ route('user.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
