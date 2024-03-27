
<head>
    @include('layouts.head')
  

</head>
<body>
    <header>
        @include('layouts.header')
    </header>

    <aside>
        @include('layouts.sidebar')
    </aside>

    <main>
       
       
         @yield('content')
         @include('layouts.alert_message')
       
       
    </main>

    <footer>
        @include('layouts.footer')
    </footer>
</body>
</html>

