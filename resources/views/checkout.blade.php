<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout TenizenMart</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body class="bg-[#f1f3f2]/50">
    <header class="bg-white sticky top-0 z-30 border-b-[1.5px] border-zinc-300">
        <div class="container mx-auto w-full px-6 py-3 lg:flex flex-none items-center  justify-between">
            <div class="icon flex items-center gap-6">
                <a href="/" class="header-title flex items-center gap-2 w-full h-full">
                    <img src="{{ asset('images/static/tenizenmart.png') }}" alt="connexmart" class="h-12">
                    <p class="font-semibold text-lg text-[#303fe2] lg:block hidden">
                        TenizenMart</p>
                </a>
                <h1 class="font-medium">Checkout</h1>
            </div>
        </div>
    </header>
    <div class="container mx-auto">
        <div class="container-cart flex h-full px-6 lg:flex-row flex-col gap-4 mb-24">
            <div class="right-checkout lg:w-4/5 w-full ">
                <div class="cart-list w-full p-4 lg:p-2 mt-1">
                    @foreach ($transactions as $transaction)
                        <div
                            class="card my-3 @if (!$loop->last) border-b-[1.2px] border-gray-200 @endif rounded-lg relative p-4 shadow-sm bg-white">
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
                                    <div class="description">
                                        <p class="text-base w-full line-clamp-3">{{ $transaction->product->name }}</p>
                                        <p class="font-medium text-sm price-products"
                                            data-price="{{ $transaction->product->price }}">
                                            {{ format_to_rp($transaction->price) }} <span
                                                class="text-sm font-normal text-zinc-500">/
                                                Produk</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="left-chekout-controls w-2/5">
                <div class="voucher-and-promo w-full mt-6 mb-4 lg:block hidden">
                    <div class="voucher-and-promo bg-white sticky top-28 rounded-xl w-full p-6 shadow-sm">
                        <p class="text-lg font-semibold">Voucher & Promo</p>
                        <p class="text-sm text-zinc-500">
                            Kamu punya Voucher atau Kode? Masukan disini
                        </p>
                        <div class="input-voucher w-full h-fit relative overflow-hidden">
                            <input
                                class="py-3 pl-2 mt-2 w-full bg-transparent focus:bg-zinc-200 focus:outline-none focus:border-[1.5px] text-sm border-gray-300 border-[1.5px] rounded-lg"
                                type="text" placeholder="Kode Promo">
                            <button class="absolute right-2 top-4 text-sm hover:bg-blue-200/20 py-1 px-3 rounded-2xl">
                                Pakai
                            </button>
                        </div>
                    </div>
                </div>
                <div class="payment-method w-full mb-4 lg:block hidden">
                    <div class="payment-method bg-white sticky top-28 rounded-xl w-full p-6 shadow-sm">
                        <p class="text-lg font-semibold">Metode Pembayaran</p>
                        <button
                            class="w-full text-sm mt-5 bg-gradient-to-r from-[#303fe2] to-blue-500 text-white py-3  col-span-3 px-4 h-full font-semibold rounded-3xl gap-1 flex items-center justify-center">Pilih
                            Metode Pembayaran</button>
                    </div>
                </div>
                <div class="payment-detail w-full mb-8 lg:block hidden">
                    <div class="payment-detail bg-white sticky top-28 rounded-xl w-full p-6 shadow-sm">
                        <p class="text-lg font-semibold">Detail Pembayaran</p>
                        <div class="detail-products mt-2">
                            <div class="total-price flex justify-between bg-[#f9f9f9] p-2">
                                <div class="label text-sm">
                                    Total harga ( 1 Produk )
                                </div>
                                <div class="value">
                                    Rp. 120.000
                                </div>
                            </div>
                            <div class="total-price flex justify-between p-2">
                                <div class="label text-sm">
                                    Ongkos Kirim
                                </div>
                                <div class="value">
                                    Rp. 2000
                                </div>
                            </div>
                        </div>
                        <hr class="mt-2">
                        <div class="total-payment mt-2 flex justify-between items-center py-2 px-1">
                            <div class="label">
                                <h1 class="font-semibold">Total Pembayaran</h1>
                            </div>
                            <div class="value font-semibold text-lg">
                                <h1>Rp. 120.000</h1>
                            </div>
                        </div>
                        <div class="payment-button mt-3">
                            <button
                                class="w-full text-sm mt-5 bg-gradient-to-r from-[#303fe2] to-blue-500 text-white py-3  col-span-3 px-4 h-full font-semibold rounded-3xl gap-1 flex items-center justify-center">
                                <span class="material-symbols-rounded">
                                    lock
                                </span>
                                Bayar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="module" src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/checkout.js') }}"></script>

    @include('components.choosepaymentmethod')
    @include('components.backdrop')
</body>

</html>
