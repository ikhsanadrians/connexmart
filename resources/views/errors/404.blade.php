<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 Not Found</title>
    <link rel="shortcut icon" href="{{ asset('images/static/cnxgroup.png') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="container w-full mx-auto flex justify-center pt-16">
        <div class="col flex flex-col items-center">
            <img src="{{ asset('images/static/tenizenmart.png') }}" alt="" class="h-16">
            <h1 class="text-2xl text-center lg:text-3xl w-4/5 font-semibold mt-8">Waduh, sepertinya kami tidak menemukan
                tujuanmu</h1>
            <p class="mt-2 text-lg lg:text-xl">Kembali ke <a href="{{ route('home') }}"
                    class="underline underline-offset-2 hover:text-2xl duration-200">Homepage</a></p>
        </div>
    </div>
</body>

</html>
