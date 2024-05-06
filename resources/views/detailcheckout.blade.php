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
                    <a href="{{ route('home') }}" class="pr-2">
                        <span class="material-symbols-rounded text-[28px] mt-2 text-zinc-500 lg:hidden block">
                            arrow_back
                        </span>
                    </a>
                    <div class="title mt-1 flex gap-1">
                        <h1 class="font-medium">Checkout</h1>
                        <p>#{{ $checkouts->checkout_code }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container mx-auto">
        <div class="container-cart flex h-full lg:px-12 lg:flex-row flex-col gap-4">
            <div class="right-checkout lg:w-4/5 w-full">
                <div class="address w-full mt-2 lg:mt-6 px-0 lg:px-2">
                    <div class="bg-white rounded-xl w-full p-6 shadow-sm">
                        <p class="text-base lg:text-lg font-semibold">Alamat Pengiriman</p>
                        <div class="address-detail flex items-start justify-between mt-3">
                            <div data-address="@if (Auth::user()->recipient_name) filled @else null @endif"
                                id="address-box"
                                class="detail-wrappers @if (Auth::user()->recipient_name) block @else hidden @endif">
                                <div class="detail-name flex items-center">
                                    <p id="recipient_name" class="font-semibold">
                                        {{ Auth::user()->recipient_name ?? '' }}</p>
                                    <span class="mx-1">|</span>
                                    <p id="recipient_phonenumber">{{ Auth::user()->phone_number ?? '' }}</p>
                                </div>
                                <div id="recipient_address" class="detail-address">
                                    <p>
                                        {{ Auth::user()->address ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cart-list w-full lg:p-2 mt-1">
                    @foreach ($transactions as $transaction)
                        <div
                            class="card mt-2 lg:mt-3 @if (!$loop->last) border-b-[1.2px] border-gray-200 @endif rounded-lg relative py-4 px-5 shadow-sm bg-white">
                            <div class="detailandcheckbox flex items-start gap-3">
                                <div class="product-detail flex items-start gap-3">
                                    <div class="product-images">
                                        <div class="img h-16 w-16 rounded-lg overflow-hidden">
                                            @if (!empty($transaction->product->photo) || File::exists(public_path($transaction->product->photo)))
                                                <img src="{{ asset('images/default/mart.png') }}" alt=""
                                                    class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ asset($transaction->product->photo) }}" alt=""
                                                    class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="description -mt-[1px]">
                                        <p class="text-base w-full line-clamp-3">{{ $transaction->product->name }}</p>
                                        <p class="text-sm price-products font-normal text-zinc-500"
                                            data-price="{{ $transaction->product->price }}">
                                            {{ format_to_rp($transaction->product->price) }} <span
                                                class="text-sm font-normal text-zinc-500">x
                                                {{ $transaction->quantity }}</span></p>
                                        <p class="font-semibold">
                                            {{ format_to_rp($transaction->totalPricePerTransaction) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="left-chekout-controls w-full lg:w-2/5">
                <div class="payment-method w-full mb-4 lg:mt-6">
                    <div id="payment-method-box"
                        data-latestpaymentmethod="{{ Auth::user()->latest_paymentmethod ?? '' }}"
                        data-paymentmethod="null"
                        class="payment-method bg-white sticky top-28 rounded-xl w-full p-6 shadow-sm">
                        <p class="text-base lg:text-lg font-semibold">Metode Pembayaran</p>
                        @if ($checkouts->payment_method == 'tb-1')
                            <div class="tenizen-bank-method mt-5 flex items-start justify-between">
                                <div class="payment-name flex gap-2 items-center">
                                    <img src="{{ asset('images/static/tenbank2.png') }}" alt=""
                                        class="bg-[#303fe2] h-8 p-1 rounded-lg mb-1">
                                    <div class="payment-detail -mt-1">
                                        <p class="font-medium text-sm">Transfer dengan TenizenBank</p>
                                        <p id="tenbank-options" class="text-sm text-zinc-500"></p>
                                    </div>
                                </div>
                            </div>
                        @elseif($checkouts->payment_method == 'tb-2')
                            <div class="tenizen-bank-method mt-5 flex items-start justify-between">
                                <div class="payment-name flex gap-2 items-center">
                                    <img src="{{ asset('images/static/tenbank2.png') }}" alt=""
                                        class="bg-[#303fe2] h-8 p-1 rounded-lg mb-1">
                                    <div class="payment-detail -mt-1">
                                        <p class="font-medium text-sm">Transfer dengan TenizenBank</p>
                                        <p id="tenbank-options" class="text-sm text-zinc-500"></p>
                                    </div>
                                </div>
                            </div>
                        @elseif($checkouts->payment_method == 'bdk')
                            <div class="bayar-di-kantin-method mt-5 flex items-start justify-between">
                                <div class="payment-name flex gap-2 items-center">
                                    <span class="material-symbols-rounded text-[#303fe2] text-[35px]">
                                        point_of_sale
                                    </span>
                                    <div class="payment-detail -mt-1">
                                        <p class="font-medium text-sm">Bayar di Kantin</p>
                                        <p class="text-sm text-zinc-500">Ambil Sendiri</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($checkouts->payment_method == 'cod')
                            <div class="cod-method mt-5 flex items-start justify-between">
                                <div class="payment-name flex gap-2 items-center">
                                    <span class="material-symbols-rounded text-[#303fe2] text-[35px] -mt-2">
                                        approval_delegation
                                    </span>
                                    <div class="payment-detail">
                                        <p class="font-medium text-sm">Cash On Delivery ( COD )</p>
                                        <p class="text-sm text-zinc-500">Antar Ke Tempat</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <button id="choose-payment-method-btn"
                            class="w-full text-sm mt-5 bg-gradient-to-r from-[#303fe2] to-blue-500 text-white py-3  col-span-3 px-4 h-full font-semibold rounded-3xl gap-1 text-center">Pilih
                            Metode Pembayaran</button>
                    </div>
                </div>
                <div class="payment-detail w-full mb-8">
                    <div class="payment-detail bg-white sticky top-28 rounded-xl w-full p-6 shadow-sm">
                        <p class="text-base lg:text-lg font-semibold">Detail Pembayaran</p>
                        <div class="detail-products mt-2">
                            <div class="total-price flex justify-between bg-[#f9f9f9] p-2">
                                <div class="label text-sm">
                                    Total harga ( <span>{{ $checkouts->total_quantity }}</span> Produk )
                                </div>
                                <div class="value lg:text-base text-sm">
                                    {{ format_to_rp($checkouts->total_price) }}
                                </div>
                            </div>
                            <div class="total-price flex justify-between p-2">
                                <div class="label text-sm">
                                    Ongkos Kirim
                                </div>
                                <div class="value lg:text-base text-sm">
                                    Rp. 2000
                                </div>
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="total-payment mt-2 flex justify-between items-center py-2 px-1">
                            <div class="label">
                                <h1 class="font-semibold">Total Pembayaran</h1>
                            </div>
                            <div class="value font-semibold text-base lg:text-lg">
                                <h1>{{ format_to_rp($checkouts->total_price) }}</h1>
                            </div>
                        </div>
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
