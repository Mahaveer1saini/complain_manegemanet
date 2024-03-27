<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
   <!-- site metas -->
   <title>Complaint Management System</title>

   <!-- bootstrap css -->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/fevicon.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- fonts -->
   <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700&display=swap" rel="stylesheet">
 

<body>
   <!--header section start -->
   <div class="header_section">
      <div class="container-fluid ">
         <div class="row">
            <div class="col-sm-2 col-6">
               <a class="logo" href="index.php"><h1 style="font-size: 40px;color: white;">CMS</h1></a>
            </div>
            <div class="col-sm-8 col-6">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                   <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('admin.login') }}">Admin</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('user.login') }}">User Login</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{route('user.login_register')}}">User Regsitration</a>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>

         </div>
      </div>
     
   </div>
   @if($data->count())
   <div class="row">
      @foreach ($data as $product)
          <div class="col-12 col-md-6 col-lg-3 mb-4">
              <div class="card h-100">
                  <div class="card-header bg-primary text-white">
                      <h5 class="mb-0">Card Header</h5>
                  </div>
                  <div class="card-body">
                      <!-- Like and Dislike Icons -->
                    
                      <p class="mb-1"><strong>Complaint Type:</strong> {{ $product->complaint_type }}</p>
                      <p class="mb-1"><strong>State:</strong> {{ $product->state }}</p>
                      <div class="mb-2">
                          @if($product->complaint_file)
                              <img src="{{ asset('complaintdocs/' . $product->complaint_file) }}" alt="Complaint Image" class="img-fluid rounded-circle" style="max-width: 100px;">
                          @else
                              <img src="{{ asset('images/img-1.png') }}" alt="Default Image" class="img-fluid rounded-circle" style="max-width: 100px;">
                          @endif
                      </div>
                      <p class="mb-1"><strong>City:</strong> {{ $product->city }}</p>
                      <p class="mb-1"><strong>Country:</strong> {{ $product->country }}</p>
                      <p class="mb-0"><strong>Status:</strong>
                          @switch($product->status)
                              @case('')
                                  <span class="badge badge-danger">Processed Yet</span>
                                  @break
                              @case('in process')
                                  <span class="badge badge-warning">In Processing</span>
                                  @break
                              @case('closed')
                                  <span class="badge badge-success">Closed</span>
                                  @break
                              @case('pending')
                                  <span class="badge badge-info">Pending</span>
                                  @break
                          @endswitch
                      </p>
                  </div>

                  <div class="panel-footer">
                    <span class="pull-right">
                        <form action="{{ route('like.post', $product->id) }}" method="post">
                            @csrf
                            <button class="like-button {{ $product->liked() ? 'active' : '' }}">Like</button>
                        </form>
                        <form action="{{ route('unlike.post', $product->id) }}" method="post">
                            @csrf
                            <button class="dislike-button {{ $product->liked() ? '' : 'active' }}">Dislike</button>
                        </form>
                    </span>
                 </div>
              </div>
          </div>
      @endforeach
  </div>
  @endif





  



 
  
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="js/plugin.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   <!-- javascript -->
   <script src="js/owl.carousel.js"></script>
   <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>  

</html>
