<!DOCTYPE html>
<html>
    <head>
        @include('admin.layouts.header')
    </head>
    <body class="theme-red">
        @include('admin.layouts.topbar')

        @include('admin.layouts.sidebar')

        @yield('content')

        @include('admin.layouts.footer')
    </body>
</html>