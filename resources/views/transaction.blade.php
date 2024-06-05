@extends('layouts.master')
@section('content')
    <div class="container mx-auto mb-64">
        <div class="title text-2xl font-semibold lg:block hidden">
            <h1>Transaksi</h1>
        </div>
        <div class="type-of-transactions mt-4 lg:mt-10 text-gray-600 flex gap-12 border-b-2">
            <a class="t-1 cursor-pointer text-[#303fe2] border-b-[2px] border-[#303fe2] pb-5 px-8">
                Belanja
            </a>
            <a class="t-2 cursor-pointer">
                TenizenBank
            </a>
        </div>
        <div class="transaction-status-search mt-4 lg:pl-0 pl-4 pr-4 lg:pr-0 flex-nowrap overflow-auto overflow-y-hidden">
            <div class="status flex items-center gap-5">
                <div class="onproceed cursor-pointer bg-[#303fe2] px-5 py-1 rounded-md text-white">
                    Proses
                </div>
                <div class="ended cursor-pointer bg-gray-200 px-5 py-1 rounded-md text-[#303fe2]">
                    Selesai
                </div>
                <div class="picked-up cursor-pointer bg-gray-200 px-5 py-1 rounded-md text-[#303fe2]">
                    Diambil
                </div>
                <div class="cancel cursor-pointer bg-gray-200 px-5 py-1 rounded-md text-[#303fe2]">
                    Batal
                </div>
            </div>
        </div>
        @if (count($transactions))
            <div class="transactions mt-5">
                @foreach ($transactions as $transaction)
                    <div
                        class="card mt-2 lg:mt-5 rounded-lg  border-b-[1.2px]  border-gray-200  relative py-4 px-3 lg:px-5 bg-white shadow-sm">
                        <div class="transaction-content ">
                            <div class="status text-sm font-medium text-center text-gray-300">
                                @if ($transaction->status == 'ordered')
                                    Dalam Proses
                                @elseif($transaction->status == 'taken')
                                    Selesai
                                @elseif($transaction->status == 'cancelled')
                                    Dibatalkan
                                @endif
                            </div>
                            <hr class="my-1">
                            <div class="wrappers flex items-center justify-between mt-2">
                                <div class="content-wrappers flex items-center gap-4">
                                    <div class="buyer">
                                        <label class="text-xs lg:text-sm font-semibold">Kode Pemesanan</label>
                                        <p>#{{ $transaction->checkout_code }}</p>
                                    </div>
                                    <div class="quantity">
                                        <label class="text-xs lg:text-sm font-semibold">Jumlah Barang</label>
                                        <p class="text-center">{{ $transaction->total_quantity }}</p>
                                    </div>
                                    <div class="total-price">
                                        <label class="text-xs lg:text-sm font-semibold">Total Harga</label>
                                        <p>{{ format_to_rp($transaction->total_price) }}</p>
                                    </div>
                                </div>
                                <div class="content-action pb-4">
                                    <a href="{{ url("cart/checkout/{$transaction->checkout_code}/success?detail=show") }}"
                                        class="show-detail text-blue-500 cursor-pointer">
                                        <span class="material-symbols-rounded">
                                            arrow_forward
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="transactions-empty mt-32 flex justify-center flex-col gap-4 items-center">
                <span class="material-symbols-rounded text-[60px] text-gray-600">
                    contract_delete
                </span>
                <p class="text-center text-gray-600">Tidak ada transaksi Saat Ini</p>
            </div>
        @endif
    </div>
@endsection
