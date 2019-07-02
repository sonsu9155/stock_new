<!DOCTYPE html>
<html>

<head>
    <title></title>
    @include('bsb.partials.head')
    @yield('additional_header')
    @stack('additional_header_stack')
</head>

<body class="login-page" style="background-color: #e9e9e9;">
    @yield('content')

    {!! Assets::js() !!}
    <script type="text/javascript" src="/bsb/plugins/jquery-validation/jquery.validate.js"></script>
    @yield('additional_footer')
    @stack('additional_footer_stack')
</body>

</html>
