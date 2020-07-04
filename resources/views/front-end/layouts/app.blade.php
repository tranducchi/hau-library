<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Library bootstrap  -->
    <link rel="stylesheet" href="{{asset('/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- End -->
</head>
<body>
<div class="wrap">
    {{--    HEader--}}
        @include('front-end.layouts.header')
    <!-- End header -->
    {{--    Slide--}}
    @yield('slide')
    <!-- End slide -->
    <section id="content" class="container mt-4">
        <div id="main-content">
            @yield('content')
        </div>
    </section>
        {{-- Footer   --}}
        @include('front-end.layouts.footer')
        {{--   End footer --}}
</div>

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{asset('/js/main.js')}}"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@yield('script')

</body>
</html>
