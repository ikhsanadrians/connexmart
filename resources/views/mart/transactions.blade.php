@extends('layouts.admin')
@section('content')
    <div class="headers flex justify-between">
        <h1 class="text-2xl font-bold">Daftar Transaksi</h1>
    </div>
    <div class="searchandfilter flex items-center gap-3">
        <div class="search mt-2 relative flex items-center">
            <svg class="absolute left-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-search" viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
            <input type="text" placeholder="Cari Transaksi" class="pl-8 pr-4 py-2 rounded-md focus:outline-none">
        </div>
        <select name="" id="">
            <option value="">Hari Ini</option>
        </select>
    </div>
    <div class="transactions pb-12">
        @foreach ($userCheckouts as $userCheckout)
            <div
                class="card mt-2 lg:mt-3 rounded-lg @if (!$loop->last) border-b-[1.2px]  border-gray-200 @endif relative py-2 px-1 lg:px-5 bg-white shadow-sm">
                <div class="header flex items-center gap-3 my-2">
                    <div class="title">
                        @if ($userCheckout->user_id != 4)
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
                        #{{ $userCheckout->checkout_code }}
                    </div>
                    <div class="times flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                        </svg>
                        <p class="time-text">
                            {{ $userCheckout->updated_at->format('d M Y; h:m') }}
                        </p>
                    </div>
                    <div class="status">
                        @if ($userCheckout->status == 'ordered')
                            <div class="payed bg-green-500/50 text-green-800 font-medium px-3 py-1 rounded-lg">
                                Pesanan Dibayar
                            </div>
                        @elseif($userCheckout->status == 'taken')
                            @if ($userCheckout->payment_method == 'tb-2' || $userCheckout->payment_method == 'bdk')
                                <div class="taken bg-blue-500/50 text-blue-800 font-medium px-3 py-1 rounded-lg">
                                    Pesanan Diambil
                                </div>
                            @else
                                <div class="taken bg-blue-500/50 text-blue-800 font-medium px-3 py-1 rounded-lg">
                                    Pesanan Sudah Diantar
                                </div>
                            @endif
                        @else
                            <div class="taken bg-blue-500/50 text-blue-800 font-medium px-3 py-1 rounded-lg">
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
                                        <label class="text-sm font-semibold">Nama Pembeli</label>
                                        <p>{{ $userCheckout->user->name }}</p>
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="quantity">
                                        <label class="text-sm font-semibold">Jumlah Barang</label>
                                        <p class="text-center">{{ $userCheckout->total_quantity }}</p>
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="total-price">
                                        <label class="text-sm font-semibold">Total Harga</label>
                                        <p>{{ format_to_rp($userCheckout->total_price) }}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="!border-none">
                                @if ($userCheckout->user_id != 4)
                                    <td class="!border-none text-start">
                                        <div class="address">
                                            <label class="text-sm font-semibold">Alamat</label>
                                            <p>{{ $userCheckout->user->address }}</p>
                                        </div>
                                    </td>
                                    <td class="!border-none text-start">
                                        <div class="phone-number">
                                            <label class="text-sm font-semibold">No Telepon</label>
                                            <p>{{ $userCheckout->user->phone_number }}</p>
                                        </div>
                                    </td>
                                @endif
                                <td class="!border-none text-start">
                                    <div class="payment-method">
                                        <label class="text-sm font-semibold">Metode Bayar</label>
                                        @if ($userCheckout->payment_method == 'tb-1')
                                            <p>Tenizen Bank - Antar Ke Tempat</p>
                                        @elseif($userCheckout->payment_method == 'tb-2')
                                            <p>Tenizen Bank - Ambil Ke Kantin</p>
                                        @elseif($userCheckout->payment_method == 'bdk')
                                            <p>Bayar di Kantin</p>
                                        @elseif($userCheckout->payment_method == 'cod')
                                            <p>Bayar di Tempat</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="content-action pb-4">
                        <a href="{{ route('mart.transaction.detail', $userCheckout->checkout_code) }}"
                            class="show-detail text-blue-500 cursor-pointer">
                            Lihat Detail Pesanan
                        </a>
                        <div class="option mt-2 flex items-center gap-2">
                            @if ($userCheckout->status == 'ordered')
                                <div
                                    class="diambil cursor-pointer font-medium bg-gradient-to-r from-green-600 to-green-700 rounded-lg w-fit h-fit px-4 py-2 text-white">
                                    Konfirmasi
                                </div>
                                <div class="delete text-red-200 p-3 bg-red-600 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                    </svg>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
