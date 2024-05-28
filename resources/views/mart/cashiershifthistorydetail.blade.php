@extends('layouts.admin')
@section('content')
    <div class="headers flex items-center gap-3">
        <a href="{{ route('mart.cashier.shift.history') }}"
            class="back bg-blue-600 w-fit px-3 rounded-md py-2 text-white font-semibold">Kembali</a>
        <h1 class="text-2xl font-bold">Kas/Shift Kasir {{ $cashierHistory->id }}</h1>
    </div>

    <div class="card mt-2 lg:mt-3 rounded-lg relative py-2 px-1 lg:px-5 bg-white shadow-sm">
        <div class="header flex justify-between items-center gap-3 my-2">
            <div class="header-left flex justify-between items-center gap-3">
                <div class="checkout_code text-[#303fe2] font-semibold text-[15px]">
                    Id : {{ $cashierHistory->id }}
                </div>
                <div class="title text-sm">
                    Shift Kasir
                </div>
                <div class="times flex items-center gap-1 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                    </svg>
                    <p class="time-text">
                        <span class="font-semibold">Awal :</span>
                        {{ \Carbon\Carbon::parse($cashierHistory->starting_shift)->format('h:i; d M Y') }}
                    </p>
                    @if ($cashierHistory->status != 'current')
                        <p class="time-text">
                            <span class="font-semibold">Akhir :</span>
                            {{ \Carbon\Carbon::parse($cashierHistory->end_shift)->format('h:i; d M Y') }}
                        </p>
                    @endif
                </div>
                <div class="status">
                    @if ($cashierHistory->status == 'current')
                        <p
                            class="bg-gradient-to-r from-green-500 to-emerald-600 px-3 py-1 text-white text-sm font-semibold rounded-md">
                            Sedang Berjalan
                        </p>
                    @else
                        <p
                            class="bg-gradient-to-r from-blue-500 to-blue-600 px-3 py-1 text-white text-sm font-semibold rounded-md">
                            Berakhir
                        </p>
                    @endif
                </div>
            </div>
            <div class="header-right">
                <div class="actions">
                    <button
                        class="delete-btn-goods-update bg-gradient-to-r from-red-600 to-red-400 p-2 text-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path
                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                    </button>
                </div>
            </div>

        </div>
        <hr>
        <div class="transaction-content mt-2 flex justify-between">
            <div class="content-wrappers">
                <table id="transactions" class="!shadow-none">
                    <tr class="!border-none">
                        <td class="!border-none text-start">
                            <div class="buyer">
                                <label class="text-sm font-semibold">Nama Kasir</label>
                                <p>{{ $cashierHistory->cashier_name }}</p>
                            </div>
                        </td>
                        <td class="!border-none text-start">
                            <div class="quantity">
                                <label class="text-sm font-semibold">Jumlah Barang Terjual</label>
                                <p class="text-start">{{ $cashierHistory->sold_items }}</p>
                            </div>
                        </td>
                        <td class="!border-none text-start">
                            <div class="total-price">
                                <label class="text-sm font-semibold">Kas Akhir</label>
                                {{-- <p>{{ format_to_rp($cashierHistory->cash_current) }}</p> --}}
                            </div>
                        </td>
                    </tr>
                    <tr class="!border-none">
                        <td class="!border-none text-start">
                            <div class="address">
                                <label class="text-sm font-semibold">Kas Awal</label>
                                {{-- <p>{{ format_to_rp($cashierHistory->starting_cash) }}</p> --}}
                            </div>
                        </td>
                        <td class="!border-none text-start">
                            <div class="phone-number">
                                <label class="text-sm font-semibold">Kas Keluar / Kembalian</label>
                                {{-- <p>{{ format_to_rp($cashierHistory->refund_cash) }}</p> --}}
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="text-title text-2xl font-bold mt-4">Daftar Transaksi</div>

    @foreach ($userCheckouts as $userCheckout)
        <div
            class="card mt-2 mb-8 lg:mt-3 rounded-lg @if (!$loop->last) border-b-[1.2px]  border-gray-200 @endif relative py-2 px-1 lg:px-5 bg-white shadow-sm">
            <div class="header flex items-center gap-3 my-2">
                <div class="title text-sm">
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
                <div class="checkout_code text-[#303fe2] font-semibold text-[15px]">
                    #{{ $userCheckout->checkout_code }}
                </div>
                <div class="times flex items-center gap-1 text-sm">
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
                        <div class="payed text-sm bg-green-500/50 text-green-800 font-medium px-3 py-1 rounded-lg">
                            Pesanan Dibayar
                        </div>
                    @elseif($userCheckout->status == 'taken')
                        @if ($userCheckout->payment_method == 'tb-2' || $userCheckout->payment_method == 'bdk')
                            <div class="taken bg-blue-500/50 text-sm text-blue-800 font-medium px-3 py-1 rounded-lg">
                                Pesanan Diambil
                            </div>
                        @else
                            <div class="taken bg-blue-500/50 text-sm text-blue-800 font-medium px-3 py-1 rounded-lg">
                                Pesanan Sudah Diantar
                            </div>
                        @endif
                    @else
                        <div class="taken bg-red-500/50 text-sm text-red-800 font-medium px-3 py-1 rounded-lg">
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
                                @if ($userCheckout->user_id != 4)
                                    <div class="buyer">
                                        <label class="text-sm font-semibold">Nama Pembeli</label>
                                        <p>{{ $userCheckout->user->name }}</p>
                                    </div>
                                @endif
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
                                    {{-- <p>{{ format_to_rp($userCheckout->total_price) }}</p> --}}
                                </div>
                            </td>
                            @if ($userCheckout->user_id == 4)
                                <td class="!border-none text-start">
                                    <div class="total-price">
                                        <label class="text-sm font-semibold">Total Cash</label>
                                        {{-- <p>{{ format_to_rp($userCheckout->cash_total) }}</p> --}}
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="total-price">
                                        <label class="text-sm font-semibold">Kembali</label>
                                        {{-- <p>{{ format_to_rp($userCheckout->refund_cash) }}</p> --}}
                                    </div>
                                </td>
                            @endif
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
                            @if ($userCheckout->user_id != 4)
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
                            @endif
                        </tr>
                    </table>
                </div>
                <div class="content-action pb-4">
                    <a href="{{ route('mart.transaction.detail', $userCheckout->checkout_code) }}"
                        class="show-detail text-blue-500 cursor-pointer">
                        Lihat Detail Pesanan
                    </a>
                    <div class="option mt-2 flex items-center gap-2">
                        @if ($userCheckout->status == 'ordered' && $userCheckout->user_id != 4)
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
@endsection
