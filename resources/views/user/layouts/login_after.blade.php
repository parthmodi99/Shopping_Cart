<!doctype html>
<html lang="en">

<head>
    <style>
        .active{
            font-weight: 700;
        }

        .active a{
            color: black

        }

        .error{
            color: red;
        }
    </style>
    @include('user.layouts.include.css')
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
    </script>
    <title> @yield("title")</title>
    @yield('style')
</head>

<body>
    @include('user.layouts.include.topmenu')
    <main>
        @yield('content')
    </main>

</body>

@include('user.layouts.include.script')
@yield('script')

</html>
