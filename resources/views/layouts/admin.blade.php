<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-200">
    @include('sweetalert::alert')
    @include('components.headeradmin')

    <main class="px-0 flex">
        @include('components.sidebaradmin')
        <div class="container w-full flex pl-[16rem] justify-center pt-8">
            <div class="wrappers w-4/5">
                @yield('content')
            </div>
        </div>
    </main>
    <div class="backdrop hidden  bg-slate-900/70 fixed top-0 w-full h-full  z-40">
    </div>
    <script type="module" src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/admin.js')}}"></script>
</body>

</html>
