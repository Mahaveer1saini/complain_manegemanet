
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
    </main>

    <footer>
        @include('Admin.layouts.footer')
    </footer>
</body>
</html>

