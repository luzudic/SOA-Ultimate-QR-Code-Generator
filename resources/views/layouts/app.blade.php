<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ @$Title }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>

    @yield('css')

</head>
<body>
<div id="app">

    @include('inc.nav')

    <main class="py-4">
        <div class="container">
            @include('inc.flash-message')
            <div class="row justify-content-center">
                @guest
                    <div class="col-md-8"> @endguest

                        @auth
                            <div class="col-md-12"> @endauth
                                <div class="card">
                                    <div class="card-header">{{ @$Title }}</div>
                                    <div class="card-body">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
    </main>

    <script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="application/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
    <script type="application/javascript">
        $(document).ready(function () {
            $('.qr-datatable').DataTable();
        });
    </script>

    @yield('js')

</div>
</body>
</html>
