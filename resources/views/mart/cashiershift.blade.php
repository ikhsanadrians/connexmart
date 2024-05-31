@extends('layouts.admin')
@section('content')
    <div class="content bg-white rounded-lg">
        <div class="headers flex justify-between px-4 pt-5">
            <h1 class="text-xl font-bold">Kas/Shift Kasir</h1>
            <a href="{{ route('mart.cashier.shift.history') }}" class="text-blue-700">Lihat History Kas/Shift</a>
        </div>
        @if (!$cashierShift)
            <form method="POST" action="{{ route('mart.cashier.shift.post') }}"
                class="add-shift bg-white p-4 mt-2 rounded-md">
                @csrf
                <div class="cashier-name">
                    <label for="">Nama Kasir</label>
                    <input class="w-full rounded-md focus:outline-none focus:ring-2 ring-[#303fe2] bg-gray-100 my-2 p-3"
                        type="text" name="cashierName" id="goods" placeholder="Masukan Nama Kasir">
                </div>
                <div class="starting-cash mt-2">
                    <label for="">Jumlah Awal Kas</label>
                    <input class="w-full rounded-md focus:outline-none focus:ring-2 ring-[#303fe2] bg-gray-100 my-2 p-3"
                        type="text" name="startCash" id="goods" placeholder="Masukan Jumlah Awal Kas">
                </div>
                <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 w-full  mt-3 py-3 text-white font-semibold rounded-md">
                    Mulai Shift
                </button>
            </form>
        @else
            <div class="shift-running flex flex-col bg-white p-8 mt-2 rounded-lg">
                <div class="shift-info">
                    <h1 class="text-xl font-semibold">Perhatian! Shift Sedang Berjalan</h1>
                    <div class="cashier-shift flex items-start justify-between">
                        <div class="cashier-shift-left">
                            <div class="cashier-name mt-4">
                                <label for="">Nama Kasir</label>
                                <h1 class="font-semibold text-xl">{{ $cashierShift->cashier_name }}</h1>
                            </div>
                            <div class="cashier-starting-cash mt-4">
                                <label for="">Kas Awal</label>
                                <h1 class="font-semibold text-xl">{{ format_to_rp($cashierShift->starting_cash) }}</h1>
                            </div>
                            <div class="cashier-starting-shift mt-4">
                                <label for="">Waktu Mulai</label>
                                <h1 class="font-semibold text-xl">{{ $cashierShift->starting_shift }}</h1>
                            </div>
                            <div class="cashier-current-cash mt-4">
                                <label for="">Kas Saat Ini</label>
                                <h1 class="font-semibold text-xl">{{ format_to_rp($cashierShift->current_cash) }}</h1>
                            </div>
                        </div>
                        <div class="cashier-shift-right">
                            <div class="cashier-current-cash mt-4">
                                <label for="">Jumlah Kembalian Dikeluarkan</label>
                                <h1 class="font-semibold text-xl">{{ format_to_rp($cashierShift->refund_cash) }}</h1>
                            </div>
                            <div class="cashier-current-cash mt-4">
                                <label for="">Jumlah Barang Terjual</label>
                                <h1 class="font-semibold text-xl">{{ $cashierShift->sold_items }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('mart.cashier.shift.end') }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="shift_id" value="{{ $cashierShift->id }}">
                    <button type="submit"
                        class="bg-gradient-to-r  from-red-600 to-red-700  px-8 w-full mt-6 py-3 text-white font-semibold rounded-md">
                        Hentikan Shift
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
