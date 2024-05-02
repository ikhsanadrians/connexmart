<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/static/tenizenmart.png') }}">
    <title>Cashier - TenizenMart</title>
    @vite('resources/css/app.css')
</head>

<body class="preload overflow-hidden  bg-[#f1f3f2]/80">
    <header class="bg-white sticky top-0 z-30 border-b-[1.5px] h-[70px] flex items-center border-zinc-300">
        <div class="container mx-auto w-full px-3  lg:px-12 py-3 lg:flex flex-none items-center  justify-between">
            <div class="icon flex items-center gap-6">
                <a href="{{ route('mart.index') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/static/tenizenmart.png') }}" alt="connexmart"
                        class="h-11 @if (Route::is('home')) block @else lg:block hidden @endif">
                    <div class="tenmart-icons">
                        <p class="font-semibold text-xl text-[#303fe2] lg:block hidden">
                            TenizenMart</p>
                        <p class="font-semibold text-sm">Cashier Dashboard</p>
                    </div>
                </a>

                <div class="checkout-title flex items-center">
                    <a href="{{ route('cart.index') }}" class="pr-2">

                    </a>
                    <div class="title mt-1">
                        <h1 class="font-medium">Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>


</body>
