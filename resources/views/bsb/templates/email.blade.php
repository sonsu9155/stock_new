<!DOCTYPE html>
<html>
<body class="login-page">
    {!! Assets::add('default')->css() !!}
    <style type="text/css">
        .login-page {
            max-width: 600px;
        }
    </style>
    @yield('content')
    {!! Assets::add('default')->js() !!}
</body>

</html>
