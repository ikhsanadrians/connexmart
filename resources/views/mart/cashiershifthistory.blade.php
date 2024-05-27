@extends('layouts.admin')
@section('content')
    <div class="headers flex items-center gap-3">
        <a href="{{ route('mart.cashier.shift') }}"
            class="back bg-blue-600 w-fit px-3 rounded-md py-2 text-white font-semibold">Kembali</a>
        <h1 class="text-2xl font-bold">Daftar Kas/Shift Kasir</h1>
    </div>
    <div class="transactions pb-12">
        @foreach ($cashierShifts as $cashierShift)
            <div
                class="card mt-2 lg:mt-3 rounded-lg @if (!$loop->last) border-b-[1.2px]  border-gray-200 @endif relative py-2 px-1 lg:px-5 bg-white shadow-sm">
                <div class="header flex justify-between items-center gap-3 my-2">
                    <div class="header-left flex justify-between items-center gap-3">
                        <div class="checkout_code text-[#303fe2] font-semibold text-[15px]">
                            Id : {{ $cashierShift->id }}
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
                                {{ \Carbon\Carbon::parse($cashierShift->starting_shift)->format('h:i; d M Y') }}
                            </p>
                            @if ($cashierShift->status != 'current')
                                <p class="time-text">
                                    <span class="font-semibold">Akhir :</span>
                                    {{ \Carbon\Carbon::parse($cashierShift->end_shift)->format('h:i; d M Y') }}
                                </p>
                            @endif
                        </div>
                        <div class="status">
                            @if ($cashierShift->status == 'current')
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
                                        <p>{{ $cashierShift->cashier_name }}</p>
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="quantity">
                                        <label class="text-sm font-semibold">Jumlah Barang Terjual</label>
                                        <p class="text-start">{{ $cashierShift->sold_items }}</p>
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="total-price">
                                        <label class="text-sm font-semibold">Kas Akhir</label>
                                        <p>{{ format_to_rp($cashierShift->current_cash) }}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr class="!border-none">
                                <td class="!border-none text-start">
                                    <div class="address">
                                        <label class="text-sm font-semibold">Kas Awal</label>
                                        <p>{{ format_to_rp($cashierShift->starting_cash) }}</p>
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="phone-number">
                                        <label class="text-sm font-semibold">Kas Keluar / Kembalian</label>
                                        <p>{{ format_to_rp($cashierShift->refund_cash) }}</p>
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="transactions">
                                        <label class="text-sm font-semibold">Daftar Transaksi</label>
                                        <a href="" class="text-blue-600">
                                            <p class="text-sm">
                                                Lihat Daftar Transaksi
                                            </p>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
