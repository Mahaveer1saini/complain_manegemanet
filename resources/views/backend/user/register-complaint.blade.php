<!-- resources/views/complaints/create.blade.php -->

@extends('layouts.app')

@section('content')

<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="card">
            <div class="card-header">{{ __('Register Complaint') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('user.complaint.submit') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Form fields -->
                    <!-- Note: $categories, $subcategories, and $state should be passed from the controller -->
                    
                    <!-- Category field -->
                    <div class="form-group">
                        <label for="category">{{ __('Category Name') }}</label>
                        <select name="category" id="category" class="form-control" required="">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                            @endforeach
                        </select>
                        @error('category')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>

                    <!-- Subcategory field -->
                    <div class="form-group">
                        <label for="subcategory">{{ __('Subcategory Name') }}</label>
                        <select name="subcategory" id="subcategory" class="form-control" required="">
                            <option value="">Select Subcategory</option>
                            @foreach ($subcategories as $subcategoryGroup)
                                @foreach ($subcategoryGroup as $subcategory)
                                    <option value="{{ $subcategory->subcategory }}">{{ $subcategory->subcategory }}</option>
                                @endforeach
                            @endforeach
                            @error('subcategory')
                              <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>

                    <!-- Complaint Type field -->
                    <div class="form-group">
                        <label for="complaintype">{{ __('Complaint Type') }}</label>
                        <select name="complaintype" class="form-control" required="">
                            <option value="Complaint">Complaint</option>
                            <option value="General Query">General Query</option>
                        </select>
                        @error('Complaint')
                         <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- State field -->
                    <div class="form-group">
                        <label for="state">{{ __('State') }}</label>
                        <select name="state" required="required" class="form-control">
                            <option value="">Select State</option>
                            @foreach($states as $states)
                                <option value="{{ $states->state }}">{{ $states->state }}</option>
                            @endforeach
                        </select>
                        @error('state')
                         <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nature of Complaint field -->
                    <div class="form-group">
                        <label for="noc">{{ __('Nature of Complaint') }}</label>
                        <input type="text" name="noc" required="required" value="" class="form-control">
                    @error('noc')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>

                    <!-- Complaint Details field -->
                    <div class="form-group">
                        <label for="complaint_details">{{ __('Complaint Details (max 2000 words)') }}</label>
                        <textarea name="complaint_details" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
                    </div>

                    <!-- Complaint File field -->
                    <div class="form-group">
                        <label for="complaint_file">{{ __('Complaint Related Doc(if any)') }}</label>
                        <input type="file" name="complaint_file" class="form-control" value="">
                        @error('file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                     
                    <div class="form-group">
                        <label for="district">{{ __('district') }}</label>
                        <input type="text" name="district" required="required" value="" class="form-control">
                        @error('district')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tehsil">{{ __('tehsil') }}</label>
                        <input type="text" name="tehsil" required="required" value="" class="form-control">
                        @error('tehsil')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="village">{{ __('village') }}</label>
                        <input type="text" name="village" required="required" value="" class="form-control">
                        @error('village')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="word">{{ __('word') }}</label>
                        <input type="num" name="word" required="required" value="" class="form-control">
                        @error('word')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  
                    <button type="submit" class="btn btn-primary" name="submit">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('customJs')

<script>
    $(document).ready(function(){
        $('#category').on('change', function(){
            var categoryId = $(this).val();
            $.ajax({
                url: "{{ route('user.getsubcat') }}",
                type: "GET",
                data: {categoryId: categoryId},
                success:function(data){
                    $('#subcategory').html(data);
                }
            });
        });
    });
</script>

@endsection
