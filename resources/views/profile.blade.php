@extends('layouts.master')
@section('content')
    <div class="container mx-auto w-full h-full mb-16">
        <div class="account-container w-full -mt-10 h-96 bg-white pb-16 shadow-sm">
            <div class="account-info hero bg-gradient-to-r from-[#303fe2] to-blue-500 w-full h-48 px-0 lg:px-8 pt-20">
                <div class="profile flex justify-center bg-white w-full h-fit rounded-t-md pb-8">
                    <div class="profile-wrapper flex flex-col items-center w-full px-8">
                        <div
                            class="profile-pic h-16 w-16 overflow-hidden rounded-full shadow-lg border-[1.5px] border-gray-300 -mt-6">
                            <img src="{{ asset('images/static/sample2.jpg') }}" alt="profile"
                                class="object-cover h-full w-full">
                        </div>
                        <div class="profile-description mt-2 flex flex-col items-center">
                            <div class="desc-name font-semibold text-lg">
                                <p>{{ Auth::user()->name }}</p>
                            </div>
                            @if (Auth::user()->phone_number != '')
                                <div class="desc-number flex items-center gap-1">
                                    <span class="material-symbols-rounded text-blue-500">
                                        link
                                    </span>
                                    <p class="text-gray-600">081808042380</p>
                                </div>
                            @else
                                <div
                                    class="desc-add-number flex items-center gap-1 cursor-pointer hover:opacity-80 text-sm">
                                    <span class="material-symbols-rounded text-blue-500">
                                        link
                                    </span>
                                    <p class="text-gray-600">Tambah Nomor Telepon</p>
                                </div>
                            @endif
                        </div>
                        <div class="profile-points bg-gray-100 w-full h-auto mt-8 flex flex-col items-center rounded-md">
                            <div class="point-wrapper grid grid-cols-2 w-full p-3">
                                <div class="points-left space-y-3">
                                    <div class="tier space-y-1">
                                        <div class="title text-sm text-gray-600">Tier</div>
                                        <div class="tier-name flex text-gray-700 items-center gap-2">
                                            <span class="material-symbols-rounded">
                                                workspace_premium
                                            </span>
                                            <p>
                                                Silver
                                            </p>
                                        </div>
                                    </div>
                                    <div class="point space-y-1">
                                        <div class="title text-sm text-gray-600">Jumlah Poin</div>
                                        <div class="point-name flex text-gray-700 items-center gap-2">
                                            <span class="material-symbols-rounded">
                                                loyalty
                                            </span>
                                            <p>
                                                0
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="points-right space-y-3">
                                    <div class="tier space-y-1">
                                        <div class="title text-sm text-gray-600">Saldo TenizenPay</div>
                                        <div class="tier-name flex text-gray-700 items-center gap-2">
                                            <span class="material-symbols-rounded">
                                                wallet
                                            </span>
                                            <p>
                                                {{ format_to_rp(Auth::user()->wallet[0]->credit) }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="point space-y-1">
                                        <div class="title text-sm text-gray-600">Total Transaksi</div>
                                        <div class="point-name flex text-gray-700 items-center gap-2">
                                            <span class="material-symbols-rounded">
                                                receipt_long
                                            </span>
                                            <p>
                                                0
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="order-container w-full bg-white shadow-md mt-4 px-8 pb-8 py-4">
            <div class="order-wrapper">
                <div class="title text-gray-600">
                    <p>Daftar Transaksi</p>
                </div>
                <div
                    class="order-types bg-gray-100 w-full h-auto mt-4 flex flex-col items-center overflow-hidden justify-center rounded-md">
                    <div class="wrapper grid grid-cols-4 w-full h-full items-center justify-evenly">
                        <a href="{{ route('transaction', ['status=onconfirm']) }}"
                            class="not-paid cursor-pointer py-8 overflow-hidden hover:bg-gray-300 h-full flex flex-col items-center gap-3">
                            <span class="material-symbols-rounded text-[28px] lg:text-[32px] text-gray-500">
                                wallet
                            </span>
                            <p class="text-xs lg:text-sm text-gray-600">Belum Bayar</p>
                        </a>
                        <a href="{{ route('transaction', ['status=onproceed']) }}"
                            class="proses cursor-pointer py-8 overflow-hidden hover:bg-gray-300 h-full flex flex-col items-center gap-3">
                            <span class="material-symbols-rounded text-[28px] lg:text-[32px] text-gray-500">
                                deployed_code_history
                            </span>
                            <p class="text-xs lg:text-sm text-gray-600">Proses</p>
                        </a>
                        <a href="{{ route('transaction', ['status=ended']) }}"
                            class="done cursor-pointer py-8 overflow-hidden hover:bg-gray-300 h-full flex flex-col items-center gap-3">
                            <span class="material-symbols-rounded text-[28px] lg:text-[32px] text-gray-500">
                                deployed_code_update
                            </span>
                            <p class="text-xs lg:text-sm text-gray-600">Selesai</p>
                        </a>
                        <a href="{{ route('transaction', ['status=picked-up']) }}"
                            class="diambil cursor-pointer py-8 overflow-hidden hover:bg-gray-300 h-full flex flex-col items-center gap-3">
                            <span class="material-symbols-rounded text-[28px] lg:text-[32px] text-gray-500">
                                deployed_code_account
                            </span>
                            <p class="text-xs lg:text-sm text-gray-600">Diambil</p>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <div class="setting-container mt-4 w-full">
            <div class="setting-wrapper w-full flex flex-col gap-2 ">
                <div
                    class="address bg-white cursor-pointer shadow-md p-3 px-8 flex justify-between rounded-md text-gray-600 w-full">
                    <div class="address-left w-full flex items-center gap-2 r">
                        <span class="material-symbols-rounded">
                            location_on
                        </span>
                        <p>
                            Tambah Alamat
                        </p>
                    </div>
                    <div class="address-right">
                        <span class="material-symbols-rounded">
                            arrow_forward
                        </span>
                    </div>
                </div>
                <div
                    class="help bg-white cursor-pointer shadow-md p-3 px-8 flex justify-between rounded-md text-gray-600 w-full">
                    <div class="help-left w-full flex items-center gap-2 r">
                        <span class="material-symbols-rounded">
                            help
                        </span>
                        <p>
                            Pusat Bantuan
                        </p>
                    </div>
                    <div class="help-right">
                        <span class="material-symbols-rounded">
                            arrow_forward
                        </span>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit"
                        class="logout bg-[#303fe2] text-center mt-4 text-white cursor-pointer shadow-md p-3 px-8  rounded-md w-full">
                        <div class="help-left w-full flex justify-center items-center gap-2 r">
                            <span class="material-symbols-rounded">
                                logout
                            </span>
                            <p>
                                Log Out / Keluar
                            </p>
                        </div>
                    </button>
                </form>

            </div>
        </div>
    @endsection
