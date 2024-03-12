
<html>
<head>
    @include('layouts.head')
</head>
<body>
    @include('layouts.header')
    <!-- Alert Toastr Message  -->
        @include('layouts.toastr') 
        @include('layouts.sidebar')
    <div id="app">
       
        <main>

            @yield('content')
            
            
            
       </main>

        <!----  Footr     -------->
        <footer class="row">
            @include('layouts.footer')
        </footer>
    </div>
</body>
</html>
