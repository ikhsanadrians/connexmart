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

<body class="preload bg-[#f1f3f2]/80">
    <header class="bg-white sticky top-0 z-30 border-b-[1.5px] h-[70px] flex items-center border-zinc-300">
        <div class="container mx-auto w-full px-3  lg:px-12 py-3 lg:flex flex-none items-center  justify-between">
            <div class="icon flex items-center gap-6">
                <a href="/" class="header-title items-center gap-2 w-full h-full lg:flex hidden">
                    <img src="{{ asset('images/static/tenizenmart.png') }}" alt="connexmart"
                        class="h-12 lg:block hidden">
                    <p class="font-semibold text-lg text-[#303fe2]">
                        TenizenMart</p>
                </a>
                <div class="checkout-title flex items-center">
                    <a href="{{ route('cart.index') }}" class="pr-2">
                        <span class="material-symbols-rounded text-[28px] mt-2 text-zinc-500 lg:hidden block">
                            arrow_back
                        </span>
                    </a>
                    <div class="title mt-1">
                        <h1 class="font-medium">Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container mx-auto">
        <div class="container-cart flex h-full justify-center mt-8">
            <div class="success-box flex flex-col justify-center items-center gap-3">
                <div
                    class="icon-check bg-gradient-to-r from-[#303fe2] to-blue-500 h-16 w-16 text-center flex items-center justify-center rounded-full">
                    <span class="material-symbols-rounded text-[50px] text-white font-bold">
                        done
                    </span>
                </div>
                <div class="message-list text-center">
                    <div class="message text-2xl font-medium">
                        <h1>
                            Pesananmu Terkonfirmasi
                        </h1>
                    </div>
                    <div class="message-detail text-zinc-500 lg:text-base text-sm">
                        <p>Terima kasih atas orderanmu, tunggu proses selanjutnya</p>
                    </div>

                </div>
                <div class="button-actions mt-4 flex flex-col items-center">
                    <div class="back-to-home">
                        <a href="" class="bg-[#303fe2] text-white py-2 px-5 rounded-lg">
                            Kembali Ke Homepage
                        </a>
                    </div>
                    <div class="chosee-detail mt-6">
                        <a href="{{ route('checkout.success', ['checkout_code' => $checkouts->checkout_code, 'detail' => 'show']) }}"
                            class="border-[#303fe2] text-[#303fe2] py-2 px-5 rounded-lg">
                            Lihat Detail Pesanan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/core.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/checkout.js') }}"></script>
    @include('components.choosepaymentmethod')
    @include('components.insertaddress')
    @include('components.backdrop')
    @include('components.cartmessagemodal')
</body>

</html>
