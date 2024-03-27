<!-- resources/views/complaints/create.blade.php -->

@extends('layouts.app')

@section('content')

<head>
  <script src="https://maps.google.com/maps/api/js?key=AIzaSyAVw_f3k-SlebCZaUjHq4AxtAJ61mB9hdQ&libraries=places" type="text/javascript"></script>
</head>

<div class="pcoded-main-container">
    <div class="pcoded-content">
        
        <div class="card">
            <div class="card-header">{{ __('Register Complaint') }}</div>

            <div class="card-body">

                @if (Session::has('success'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
                <form method="POST" action="{{ route('user.complaint.submit') }}" enctype="multipart/form-data">
                    @csrf
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
                    <div class="col-md-6">
                        <label for="country_id" class="form-label mt-4">Birth Place</label>
                        <div>
                            <input type="text" id="autocomplete" name="birth_place" class="form-control autocomplete" placeholder="Enter Your Birth Place" value="{{ old('birth_place') }}" autocomplete="off" />
                            @error('birth_place')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="city" id="city" class="form-control city">
                    <input type="hidden" name="state" id="state" class="form-control state">
                    <input type="hidden" name="country" id="country" class="form-control country">
                    <input type="hidden" name="latitude" id="latitude" class="form-control">
                    <input type="hidden" name="longitude" id="longitude" class="form-control"> 

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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var autocomplete;
        var id = 'autocomplete'; // Change from 'location' to 'autocomplete'
        autocomplete = new google.maps.places.Autocomplete(document.getElementById(id), {
            types: ['geocode']
        });
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            var addressComponents = place.address_components;
            var tehsil = extractTehsil(addressComponents);
            document.getElementById('city').value = place.address_components[0].long_name;
            document.getElementById('state').value = place.address_components[2].long_name;
            document.getElementById('country').value = place.address_components[3].long_name;
            document.getElementById('tehsil').value = tehsil;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
        });

        function extractTehsil(addressComponents) {
            // Loop through address components to find tehsil
            for (var i = 0; i < addressComponents.length; i++) {
                var component = addressComponents[i];
                if (component.types.includes('administrative_area_level_2')) {
                    return component.long_name; // Assuming tehsil is represented by administrative_area_level_2
                }
            }
            return ''; // Tehsil not found
        }
    });
</script>


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
