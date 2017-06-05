<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/web/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/web/custom.css')}}">
    <script src="{{ asset('assets/js/web/jquery.min.js')}}"></script>
</head>
<body>
<div class="container">
    @yield('content')
</div>
<script src="{{asset('assets/js/web/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/web/custom.js')}}"></script>
</body>
</html>