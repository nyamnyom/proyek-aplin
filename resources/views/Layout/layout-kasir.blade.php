<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Kasir')</title>
    @include('style.kasirStyle')
    @yield('styles')
</head>
<body>
    <div class="container-fluid" style="height: 100vh; overflow: hidden;">
        <div class="row">
            @include('Layout.sidebar-kasir')
            <div class="col-md-10 px-0">
                @include('Layout.navbar-kasir')
                @yield('content')
            </div>
        </div>
    </div>

    @include('script.bootstrap_js')
    @yield('scripts')
</body>
</html>