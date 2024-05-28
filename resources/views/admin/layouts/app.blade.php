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
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Admin</title>
</head>

<body>

    @yield('content')


    {{-- Buộc nằm trên cùng --}}
    @yield('scripts')

    {{-- <script src="{{ asset('js/dashboard.js') }}"></script>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.3.0/pusher.min.js"></script> --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
    @stack('script')
    @stack('scripts-table')
    @stack('script-employee')
    @stack('inventory-table')
    @livewireScripts
    <script defer>
        // ROLE
        const myModal = new bootstrap.Modal(document.getElementById("addRole"), {})
        $("#openModalForm").on('click', event => {
            myModal.show();
            $('#role_name').val("")
            $('#nickname').val("")

        })
        window.addEventListener('hide-form', event => {
            myModal.hide();

        })

        const myModalEdit = new bootstrap.Modal(document.getElementById("editRole"), {})
        $(".showModalEdit").on('click', event => {
            myModalEdit.show();

        })
        window.addEventListener('hide-modal-edit', event => {
            myModalEdit.hide();

        })

        const myModalDel = new bootstrap.Modal(document.getElementById("delRole"), {})
        $(".showModalDel").on('click', event => {
            myModalDel.show();

        })
    </script>
</body>

</html>
