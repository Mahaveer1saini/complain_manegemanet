
<head>
    @include('Admin.layouts.head')
  

</head>
<body>
    <header>
        @include('Admin.layouts.header')
    </header>

    <aside>
        @include('Admin.layouts.sidebar')
    </aside>

    <main>
       
       
         @yield('content')
         @include('Admin.layouts.alert_message')
       
       
    </main>

    <footer>
        @include('Admin.layouts.footer')
    </footer>
</body>
</html>

