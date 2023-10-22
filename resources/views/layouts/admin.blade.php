<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-200">
    @include('sweetalert::alert')
    @include('components.headeradmin')

    <main class="px-0 flex">
        @include('components.sidebaradmin')
        <div class="container pl-[20rem] pt-8">
            @yield('content')
        </div>
    </main>
    <div class="backdrop hidden  bg-slate-900/70 fixed top-0 w-full h-full  z-40">
    </div>
    <script type="module" src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/admin.js')}}"></script>
</body>

</html>
