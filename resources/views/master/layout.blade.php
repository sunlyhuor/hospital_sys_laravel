<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <script src="{{ asset('js/tailwindcss.js') }}"></script>
    <script src="{{asset('js/flowbit.js')}}"></script>
    {{-- <script src="{{asset('css/fontawsome.css')}}"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield("css")
    @yield("js")
</head>
<body>
    <section>
        @yield("header")
        <section class="min-[0px]:w-11/12 lg:w-10/12 mx-auto" >
            @yield('content')
        </section>
        @yield("footer")
    </section>
    @yield("js_custom")
</body>
</html>