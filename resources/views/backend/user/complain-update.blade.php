@extends('layouts.app')
@section('content')
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="card">
            <div class="card-header">{{ __('Register Complaint') }}</div>

            <div class="card-body">
                <form id="complaintForm" action="{{ route('user.complaint_edit', $Complaint->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="category">{{ __('Category Name') }}</label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $Complaint->category) selected @endif>{{ $category->categoryName }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <!-- Subcategory field -->
                    <div class="form-group">
                        <label for="subcategory">{{ __('Subcategory Name') }}</label>
                        <select name="subcategory" id="subcategory" class="form-control @error('subcategory') is-invalid @enderror" required>
                            <option value="">Select Subcategory</option>
                            @foreach ($subcategories as $subcategoryGroup)
                                @foreach ($subcategoryGroup as $subcategory)
                                    <option value="{{ $subcategory->id }}" @if($subcategory->id == $Complaint->subcategory) selected @endif>
                                        {{ $subcategory->subcategory }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('subcategory')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    
                    <!-- Complaint Type field -->
                    <div class="form-group">
                        <label for="complaint_type">{{ __('complaint_type') }}</label>
                        <select name="complain_type" class="form-control @error('complain_type') is-invalid @enderror" required="">
                            <option value="Complaint_type">Complaint</option>
                            <option value="General Query">General Query</option>
                        </select>
                        @error('complain_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <!-- State field -->
                    <div class="form-group @error('title') is-invalid @enderror">
                        <label for="state">{{ __('State') }}</label>
                        <select name="state" required="required" class="form-control">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}" @if($state->state == $Complaint->state) selected @endif>{{ $state->state }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <!-- Nature of Complaint field -->
                    <div class="form-group @error('title') is-invalid @enderror">
                        <label for="noc">{{ __('Nature of Complaint') }}</label>
                        <input type="text" name="noc" required="required" value="{{ $Complaint->noc }}" class="form-control">
                        @error('noc')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <!-- Complaint Details field -->
                    <div class="form-group @error('title') is-invalid @enderror">
                        <label for="complaint_details">{{ __('Complaint Details (max 2000 words)') }}</label>
                        <textarea name="complaint_details" required="required" cols="10" rows="10" class="form-control" maxlength="2000">{{ $Complaint->complaint_details }}</textarea>
                        @error('complaint_details')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Complaint File field -->
                    <div class="form-group @error('title') is-invalid @enderror">
                        <label for="complaint_file">{{ __('Complaint Related Doc (if any)') }}</label>
                        <input type="file" name="complaint_file" class="form-control" id="complaint_file_input">
                        <span class="text-danger error-text complaint_file_error"></span>
                        <img src="{{ asset('complaintdocs/' . $Complaint->complaint_file) }}" alt="complain Image" class="rounded-circle" style="max-width:50px;">
                        @error('complaint_file')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                     
                    <div class="form-group @error('title') is-invalid @enderror">
                        <label for="district">{{ __('District') }}</label>
                        <input type="text" name="district" required="required" value="{{ $Complaint->district }}" class="form-control">
                        <span class="text-danger error-text district_error"></span>
                        @error('district')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group @error('title') is-invalid @enderror">
                        <label for="tehsil">{{ __('Tehsil') }}</label>
                        <input type="text" name="tehsil" required="required" value="{{ $Complaint->tehsil }}" class="form-control">
                        <span class="text-danger error-text tehsil_error"></span>
                        @error('tehsil')
                          <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group @error('title') is-invalid @enderror">
                        <label for="village">{{ __('Village') }}</label>
                        <input type="text" name="village" required="required" value="{{ $Complaint->village }}" class="form-control">
                        <span class="text-danger error-text village_error"></span>
                        @error('village')
                         <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                    </div>
                    
                    <div class="form-group @error('title') is-invalid @enderror">
                        <label for="word">{{ __('Word') }}</label>
                        <input type="number" name="word" required="required" value="{{ $Complaint->word }}" class="form-control">
                        <span class="text-danger error-text word_error"></span>
                        @error('word')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  
                    <button type="submit" id="submitBtn" class="btn btn-primary" name="submit">{{ __('Submit') }}</button>
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

<script>
    document.getElementById('complaint_file_input').addEventListener('change', function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('complaint_image_preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>




@endsection
