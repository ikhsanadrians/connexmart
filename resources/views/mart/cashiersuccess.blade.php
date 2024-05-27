<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/static/tenizenmart.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />
    <title>Cashier - TenizenMart</title>
    @vite('resources/css/app.css')
</head>

<body class="preload bg-[#f1f3f2]/80">
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
                        <h1 class="font-medium">Transaksi Sukses</h1>
                    </div>
                    <div class="checkout-time ml-8">
                        <label for="" class="text-zinc-500 lg:text-base text-sm">Tanggal Waktu</label>
                        <h1 class="font-medium text-base lg:text-lg">
                            {{ $checkouts->created_at->translatedFormat('l, d F Y - H:i') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container mx-auto lg:px-12 py-4">
            <div class="options mb-4 flex lg:px-0 px-3 justify-between items-center">
                <div class="option-left">
                    <a href="{{ route('cart.index') }}"
                        class="flex items-center gap-2 bg-[#303fe2] w-fit text-white py-2 px-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                        </svg>
                        <p class="lg:block hidden">
                            Kembali Ke Cashier
                        </p>
                    </a>
                </div>
                <div class="option-right flex items-center gap-2">
                    <a href="{{ route('mart.cashier.downloadreceipt', $checkouts->checkout_code) }}"
                        class="download flex items-center gap-2 bg-[#303fe2] text-white py-2 px-4 rounded-lg">
                        <p>
                            Download
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0" />
                        </svg>
                    </a>
                    <a href="{{ route('mart.cashier.printreceipt', $checkouts->checkout_code) }}"
                        class="print flex items-center gap-2 border-[#303fe2] border-[1.5px] text-[#303fe2] py-2 px-4 rounded-lg">
                        <p>
                            Print
                        </p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path
                                d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1" />
                            <path
                                d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="data-and-list flex lg:flex-row flex-col gap-3">
                <div class="checkout-data w-full lg:w-2/4 bg-white p-5 rounded-lg shadow-sm h-fit flex flex-col gap-2">
                    <div class="title font-bold">
                        DETAIL
                    </div>
                    <div class="checkout flex flex-col gap-2 mt-3">
                        <div class="checkout-code">
                            <label for="" class="text-zinc-500 lg:text-base text-sm">Kode Checkout</label>
                            <h1 class="font-medium text-base lg:text-lg">#{{ $checkouts->checkout_code }}</h1>
                        </div>
                        <hr>
                        <div class="checkout-paymentmethod">
                            <label for="" class="text-zinc-500 lg:text-base text-sm">Metode Bayar</label>
                            @if ($checkouts->payment_method == 'tb-1' || $checkouts->payment_method == 'tb-2')
                                <h1 class="font-medium text-base lg:text-lg">TenizenBank Wallet</h1>
                            @else
                                <h1 class="font-medium text-base lg:text-lg">Cash</h1>
                            @endif
                        </div>
                        <hr>
                        <div class="checkout-totalprice">
                            <label for="" class="text-zinc-500 lg:text-base text-sm">Total Harga</label>
                            <h1 class="font-medium text-base lg:text-lg">{{ format_to_rp($checkouts->total_price) }}
                            </h1>
                        </div>
                        <hr>
                        <div class="checkout-totalpay">
                            <label for="" class="text-zinc-500 lg:text-base text-sm">Uang Tunai</label>
                            <h1 class="font-medium text-base lg:text-lg">
                                {{ format_to_rp($checkouts->cash_total) }}</h1>
                        </div>
                        <hr>
                        @if ($checkouts->payment_method == 'bdk')
                            <div class="change">
                                <label for="" class="text-zinc-500 lg:text-base text-sm">Kembali</label>
                                <h1 class="font-medium text-base lg:text-lg">
                                    {{ format_to_rp($checkouts->cash_return) }}
                                </h1>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="checkout-product-list w-full bg-white p-5 rounded-lg h-fit shadow-sm flex flex-col gap-2">
                    <div class="list-products">
                        <div class="title font-bold">
                            DAFTAR PRODUK
                        </div>
                        <div class="products">
                            @foreach ($transactions as $transaction)
                                <div
                                    class="card mt-2 lg:mt-3 @if (!$loop->last) border-b-[1.2px] border-gray-200 @endif relative py-4 px-1 lg:px-5 bg-white">
                                    <div class="detailandcheckbox flex items-start gap-3">
                                        <div class="product-detail flex items-start gap-3">
                                            <div class="product-images">
                                                <div class="img h-16 w-16 rounded-lg overflow-hidden">
                                                    @if (!empty($transaction->product->photo) || File::exists(public_path($transaction->product->photo)))
                                                        <img src="{{ asset('images/default/mart.png') }}"
                                                            alt="" class="w-full h-full object-cover">
                                                    @else
                                                        <img src="{{ asset($transaction->product->photo) }}"
                                                            alt="" class="w-full h-full object-cover">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="description -mt-[1px]">
                                                <p class="text-base w-full line-clamp-3">
                                                    {{ $transaction->product->name }}</p>
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
                </div>
            </div>
        </div>
    </main>
</body>
