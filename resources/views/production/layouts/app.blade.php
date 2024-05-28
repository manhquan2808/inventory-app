<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.min.css') }}"> --}}
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/app.css")}}">
    {{-- <link href="{{ asset('css/demo-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/example-styles.css') }}" rel="stylesheet"> --}}



    <title>Ban sản xuất</title>
</head>

<body>

    @yield('content')


    {{-- Buộc nằm trên cùng --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery.multi-select.js') }}"></script> --}}
    <script src="{{ asset('js/all.js') }}"></script>
    
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('js/datatables.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    @livewireScripts
    @stack('producing-table')

</body>

</html>
