@extends('layouts.admin')
@section('content')

    <div class="transactions pb-12 bg-white mb-8 rounded-md">
        <div class="headers flex justify-between p-4 border-b-2">
            <a href="javascript:history.back()"
                class="flex items-center gap-2 bg-[#303fe2] w-fit text-white py-2 px-4 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
                <p class="lg:block hidden">
                    Kembali
                </p>
            </a>
            <div class="option-right flex items-center gap-2">
                <div class="download flex items-center gap-2 bg-[#303fe2] text-white py-2 px-4 rounded-lg">
                    <p>
                        Download
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                        <path
                            d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0" />
                    </svg>
                </div>
                <a href="{{ route('mart.cashier.printreceipt', $userCheckouts->checkout_code) }}"
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
        <div class="card mt-2 lg:mt-3 relative py-2 px-1 lg:px-5 ">
            <div class="header flex items-center gap-3 my-2">
                <div class="title">
                    @if ($userCheckouts->user_id != 4)
                        <h1 class="font-semibold">
                            Transaksi Pembelian
                        </h1>
                    @else
                        <h1 class="font-semibold">
                            Transaksi Kasir
                        </h1>
                    @endif
                </div>
                <div class="checkout_code text-[#303fe2] font-semibold">
                    #{{ $userCheckouts->checkout_code }}
                </div>
                <div class="times flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                    </svg>
                    <p class="time-text">
                        {{ $userCheckouts->updated_at->format('d M Y; h:m') }}
                    </p>
                </div>
                <div class="status">
                    @if ($userCheckouts->status == 'ordered')
                        <div class="payed bg-green-500/50 text-green-800 font-medium px-3 py-1 rounded-lg">
                            Pesanan Dibayar
                        </div>
                    @elseif($userCheckouts->status == 'taken')
                        @if ($userCheckouts->payment_method == 'tb-2' || $userCheckouts->payment_method == 'bdk')
                            <div class="taken bg-blue-500/50 text-blue-800 font-medium px-3 py-1 rounded-lg">
                                Pesanan Diambil
                            </div>
                        @else
                            <div class="taken bg-blue-500/50 text-blue-800 font-medium px-3 py-1 rounded-lg">
                                Pesanan Sudah Diantar
                            </div>
                        @endif
                    @elseif($userCheckouts->status == 'not_paid')
                        <div
                            class="not-payed-yet text-sm bg-yellow-500/50 text-yellow-800 font-medium px-3 py-1 rounded-lg">
                            Pesanan Belum Dibayar
                        </div>
                    @else
                        <div class="taken bg-red-500/50 text-red-800 font-medium px-3 py-1 rounded-lg">
                            Pesanan Dibatalkan
                        </div>
                    @endif

                </div>
            </div>
            <hr>
            <div class="transaction-content mt-2 flex justify-between">
                <div class="content-wrappers">
                    <table id="transactions" class="!shadow-none">
                        <tr class="!border-none">
                            <td class="!border-none text-start">
                                <div class="buyer">
                                    @if ($userCheckouts->user_id != 4)
                                        <label class="text-sm font-semibold">Nama Pembeli</label>
                                        <p>{{ $userCheckouts->user->name }}</p>
                                    @else
                                        <label class="text-sm font-semibold">Nama Kasir</label>
                                        <p>{{ $userCheckouts->cashier_name }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="!border-none text-start">
                                <div class="quantity">
                                    <label class="text-sm font-semibold">Jumlah Barang</label>
                                    <p class="text-center">{{ $userCheckouts->total_quantity }}</p>
                                </div>
                            </td>
                            <td class="!border-none text-start">
                                <div class="total-price">
                                    <label class="text-sm font-semibold">Total Harga</label>
                                    <p>{{ format_to_rp($userCheckouts->total_price) }}</p>
                                </div>
                            </td>
                            <td class="!border-none text-start">
                                <div class="total-price">
                                    <label class="text-sm font-semibold">Jumlah Cash</label>
                                    <p>{{ format_to_rp($userCheckouts->cash_total ?? $userCheckouts->total_price) }}</p>
                                </div>
                            </td>
                            @if ($userCheckouts->user_id == 4)
                                <td class="!border-none text-start">
                                    <div class="total-price">
                                        <label class="text-sm font-semibold">Kembali</label>
                                        <p>{{ format_to_rp($userCheckouts->refund_cash) }}</p>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        <tr class="!border-none">
                            @if ($userCheckouts->user_id != 4)
                                <td class="!border-none text-start">
                                    <div class="address">
                                        <label class="text-sm font-semibold">Alamat</label>
                                        <p>{{ $userCheckouts->user->address }}</p>
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="phone-number">
                                        <label class="text-sm font-semibold">No Telepon</label>
                                        <p>{{ $userCheckouts->user->phone_number }}</p>
                                    </div>
                                </td>
                            @endif
                            <td class="!border-none text-start">
                                <div class="payment-method">
                                    <label class="text-sm font-semibold">Metode Bayar</label>
                                    @if ($userCheckouts->payment_method == 'tb-1')
                                        <p>Tenizen Bank - Antar Ke Tempat</p>
                                    @elseif($userCheckouts->payment_method == 'tb-2')
                                        <p>Tenizen Bank - Ambil Ke Kantin</p>
                                    @elseif($userCheckouts->payment_method == 'bdk')
                                        <p>Bayar di Kantin</p>
                                    @elseif($userCheckouts->payment_method == 'cod')
                                        <p>Bayar di Tempat ( COD )</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="content-action pb-4">
                    <div class="option mt-2 flex items-center gap-2">
                        @if (($userCheckouts->status == 'ordered' || $userCheckouts->status == 'not_paid') && $userCheckouts->user_id != 4)
                            <a href=""
                                class="diambil cursor-pointer font-medium flex items-center gap-1 hover:opacity-80 bg-gradient-to-r  from-green-600 to-green-700 rounded-lg w-fit h-fit px-8 py-2 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                </svg>
                                Konfirmasi
                            </a>
                            <div class="delete text-red-200 p-3 bg-red-600 cursor-pointer hover:opacity-80 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                </svg>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="products-list mt-4">
                <div class="product-title px-2 font-semibold">
                    Daftar Produk Dibeli
                </div>
                <hr class="my-2">
                @foreach ($transactions as $transaction)
                    <div
                        class="card mt-2 @if (!$loop->last) border-b-[1.2px] border-gray-200 @endif relative py-4 px-3 bg-gray-100/60">
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
@endsection
