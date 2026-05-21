<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMKEU </title>

    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
       body{
    background:
        radial-gradient(circle at top left, #6f86ff 0%, transparent 35%),
        radial-gradient(circle at bottom right, #4e73df 0%, transparent 30%),
        #eef2ff;

    overflow-x: hidden;
}
    </style>
</head>

<body class="bg-gradient-primary">

    @yield('content')

    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>

</body>

</html>