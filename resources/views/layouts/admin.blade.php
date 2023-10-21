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
    @include('components.headeradmin')

    <main class="px-0 flex">
        @include('components.sidebaradmin')
        <div class="container pl-[20rem] pt-8">
            @yield('content')
        </div>
    </main>
</body>

</html>
