@extends('layouts.master')
@section('content')
    <div class="container mx-auto mb-64">
        <div class="title text-2xl font-semibold lg:block hidden">
            <h1>Transaksi</h1>
        </div>
        <div class="type-of-transactions mt-4 lg:mt-10 text-gray-600 flex gap-12 border-b-2">
            <a class="t-1 text-[#303fe2] border-b-[2px] border-[#303fe2] pb-5 px-8">
                Belanja
            </a>
            <a class="t-2">
                TenizenBank
            </a>
        </div>
        <div class="transaction-status-search mt-4 lg:px-0 px-4">
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
            <div class="search">

            </div>
        </div>
        <div class="transactions mt-5">
            <div
                class="card mt-2 lg:mt-5 rounded-lg  border-b-[1.2px]  border-gray-200  relative py-4 px-3 lg:px-5 bg-white shadow-sm">
                <div class="transaction-content ">
                    <div class="status text-sm font-medium">
                        Dalam Proses
                    </div>
                    <hr class="my-1">
                    <div class="wrappers flex items-center justify-between mt-2">
                        <div class="content-wrappers flex items-center gap-4">
                            <div class="buyer">
                                <label class="text-xs lg:text-sm font-semibold">Nama Pembeli</label>
                                <p>Hendri</p>
                            </div>
                            <div class="quantity">
                                <label class="text-xs lg:text-sm font-semibold">Jumlah Barang</label>
                                <p class="text-center">12</p>
                            </div>
                            <div class="total-price">
                                <label class="text-xs lg:text-sm font-semibold">Total Harga</label>
                                <p>14.000</p>
                            </div>
                        </div>
                        <div class="content-action pb-4">
                            <a href="" class="show-detail text-blue-500 cursor-pointer">
                                <span class="material-symbols-rounded">
                                    arrow_forward
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
