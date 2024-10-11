<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TenizenMart</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <link rel="icon" type="image/png" href="{{ asset('images/static/tenizenmart.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body class="preload @if (Route::is('cart.index')) bg-[#f0f3f8]  @else bg-[#f1f3f2]/30 @endif">
    @include('components.header')
    <main class="container mx-auto lg:px-12 px-0 py-2 lg:py-8">
        @yield('content')
    </main>
    @include('components.backdrop')
    <script type="module" src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/core.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/utils/modalsMessage.js')}}"></script>
    <script type="module" src="{{ asset('javascript/script/auth.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/cart.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/topup.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/detail.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/transactionsUser.js') }}"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.4.5/mobile-detect.min.js"></script>
    <script type="module" src="{{ asset('javascript/script/scanner.js') }}"></script>
    @stack('scripts')

    @if (!Route::is('scanner'))
        @include('components.footer')
        @include('components.mobilebottomnav')
    @endif
    @if (Route::is('show.product'))
        @include('components.cartmessagemodal')
        @include('components.chooseqtymodal')
        @include('components.successaddtocart')
        @include('components.dekstopsuccessaddtocart')
    @elseif(Route::is('cart.index'))
        @include('components.cartmessagemodal')
    @endif

</body>

</html>
