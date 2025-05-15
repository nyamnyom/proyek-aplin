<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin')</title>
    @include('style.adminStyle')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            @include('Layout.sidebar-admin')

            <div class="col-md-10 offset-md-2 p-4 pt-2">
                @include('Layout.navbar-admin')

                <div class="container-fluid" style="overflow-y: auto; height: 79.5vh">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('script.bootstrap_js')
    @yield('scripts')
</body>
</html>