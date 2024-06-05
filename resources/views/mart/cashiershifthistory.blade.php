@extends('layouts.admin')
@push('scripts')
    <script type="module" src="{{ asset('javascript/script/shifthistory.js') }}"></script>
@endpush
@section('content')
    <div class="content bg-white rounded-md mb-12">
        <div class="headers flex items-center gap-3 p-4 justify-between">
            <a href="{{ route('mart.cashier.shift') }}"
                class="back bg-[#303fe2] text-white px-5 font-medium py-3 hover:bg-slate-300 w-fit hover:text-[#003034] transition cursor-pointer rounded-xl flex items-center gap-2">Kembali</a>
            <h1 class="text-xl font-bold">Daftar Kas/Shift Kasir</h1>
        </div>
        <div class="searchandfilter mt-2 grid grid-cols-2 items-center gap-3 px-3 w-full">
            <div class="search-transaction relative flex items-center">
                <svg class="absolute left-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
                <input id="search-cashiershifthistory" type="text" placeholder="Cari Transaksi"
                    class="pl-8 pr-4 py-2 rounded-md bg-slate-100 border-[1.5px] border-slate-200 focus:outline-none w-full">
            </div>
            <div class="filter w-full  gap-2 flex">
                <select
                    class="select-transactions-date !py-2 pl-8 pr-4 rounded-md bg-slate-100 border-[1.5px] border-slate-200 focus:outline-none w-full"
                    name="state">
                    <option class="option-date" selected value="all">Semua Tanggal</option>
                    @foreach ($cashierShiftDates as $cashierShiftDate)
                        <option class="option-date" value="{{ format_date_slug($cashierShiftDate->formatted_date) }}">
                            {{ $cashierShiftDate->formatted_date }}
                        </option>
                    @endforeach
                </select>
                <select name="transaction_sorting" id="t_sorting"
                    class="select-transactions-sorting  px-8 pl-8 pr-4 py-2 rounded-md bg-slate-100 border-[1.5px] border-slate-200 focus:outline-none w-full">
                    <option class="option-sorting" value="newfirst">Terbaru</option>
                    <option class="option-sorting" value="oldfirst">Terlama</option>
                </select>
            </div>
        </div>
        <div class="cashiershifts pb-12 mt-6">
            @foreach ($cashierShifts as $cashierShift)
                <div
                    class="card mt-2 lg:mt-3 @if (!$loop->last) border-b-[1.2px]  border-gray-200 @endif relative py-2 px-1 lg:px-5 bg-white shadow-sm">
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
                                    <path
                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                </svg>
                                <p class="time-text">
                                    <span class="font-semibold">Awal :</span>
                                    Pukul {{ \Carbon\Carbon::parse($cashierShift->starting_shift)->format('h:i - d M Y') }}
                                </p>
                                @if ($cashierShift->status != 'current')
                                    <p class="time-text">
                                        <span class="font-semibold">Akhir :</span>
                                        Pukul {{ \Carbon\Carbon::parse($cashierShift->end_shift)->format('h:i - d M Y') }}
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
                                <a href="{{ route('mart.cashier.shift.history.detail', $cashierShift->id) }}">
                                    <div
                                        class="wrappers show-detail-history bg-gradient-to-r w-fit from-green-400 hover:opacity-80 to-green-300 p-2 text-green-700 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                    </div>
                                </a>
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
                                            <a href="{{ route('mart.cashier.shift.history.detail', $cashierShift->id) }}"
                                                class="text-blue-600">
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
        <div class="pagination-and-back px-2 py-3 mb-12">
            <div class="pagination flex flex-row justify-between w-full items-start lg:gap-0 gap-4 lg:items-center">
                <div class="page-records flex items-center gap-4">
                    <div class="record-per-inputs relative">
                        <select name="recordsPerPage" id="recordsPerPage"
                            class="recordsPerPage appearance-none bg-transparent text-sm focus:outline-none border-[1.8px] border-slate-200 py-1 pl-3 pr-6 rounded-md">
                            <option class="option" value="50">50 per Page</option>
                            <option class="option" value="100">100 per Page</option>
                            <option class="option" value="all">Show All</option>
                        </select>
                        <svg class="absolute right-0 top-1" width="24" height="25" viewBox="0 0 24 25"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7 10.875L12 15.875L17 10.875H7Z"
                                fill="black" fill-opacity="0.6" />
                        </svg>

                    </div>
                    <div class="showing-inputs text-sm lg:block hidden">
                        @if (Request::get('show') == 'all')
                            Showing All of {{ $cashierShiftCounts }} records
                        @else
                            Showing {{ $cashierShifts->firstItem() }} - {{ $cashierShifts->lastItem() }} of
                            {{ $cashierShiftCounts }}
                            records
                        @endif
                    </div>
                </div>
                @if (request('show') != 'all')
                    @php

                        $pageLimit = 3;
                        $startPage = max(1, $cashierShifts->currentPage() - floor($pageLimit / 2));
                        $endPage = min($startPage + $pageLimit - 1, $cashierShifts->lastPage());
                        $nextPage =
                            $cashierShifts->currentPage() < $cashierShifts->lastPage()
                                ? $cashierShifts->currentPage() + 1
                                : $cashierShifts->lastPage();
                        $prevPage = $cashierShifts->currentPage() > 1 ? $cashierShifts->currentPage() - 1 : 1;

                    @endphp
                    <div class="pagination-buttons flex items-center gap-2">

                        <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => '1']) : $cashierShifts->url(1) }}"
                            class="first-page p-2 h-8 w-8 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md opacity-50">
                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.7267 12.875L12.6667 11.935L9.61341 8.875L12.6667 5.815L11.7267 4.875L7.72675 8.875L11.7267 12.875Z"
                                    fill="#333333" />
                                <path
                                    d="M7.33344 12.875L8.27344 11.935L5.2201 8.875L8.27344 5.815L7.33344 4.875L3.33344 8.875L7.33344 12.875Z"
                                    fill="#333333" />
                            </svg>
                        </a>
                        <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $prevPage]) : $cashierShifts->previousPageUrl() }}"
                            class="previous-page p-2 h-8 w-8 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md opacity-50">
                            <svg width="5" height="8" viewBox="0 0 5 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.06 8.875L5 7.935L1.94667 4.875L5 1.815L4.06 0.875L0.0599996 4.875L4.06 8.875Z"
                                    fill="#1A1A1A" />
                            </svg>
                        </a>

                        @for ($page = $startPage; $page <= $endPage; $page++)
                            <div
                                class="page p-2 h-8 w-8 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md">
                                <a
                                    href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $page]) : $cashierShifts->url($page) }}">{{ $page }}</a>
                            </div>
                        @endfor
                        <a href="{{ request('category') ? route('mart.goods', ['category' => request('category'), 'page' => $nextPage]) : $cashierShifts->nextPageUrl() }}"
                            class="next-pages p-2 h-8 w-8 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md opacity-50">
                            <svg width="5" height="9" viewBox="0 0 5 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.94 0.875L0 1.815L3.05333 4.875L0 7.935L0.94 8.875L4.94 4.875L0.94 0.875Z"
                                    fill="#1A1A1A" />
                            </svg>
                        </a>
                        <a href="/mart/cashiershift/history?page={{ $cashierShifts->lastPage() }}"
                            class="last-page p-2 h-8 w-9 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md opacity-50">
                            <svg width="10" height="9" viewBox="0 0 10 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.27325 0.875L0.333252 1.815L3.38659 4.875L0.333252 7.935L1.27325 8.875L5.27325 4.875L1.27325 0.875Z"
                                    fill="#1A1A1A" />
                                <path
                                    d="M5.66656 0.875L4.72656 1.815L7.7799 4.875L4.72656 7.935L5.66656 8.875L9.66656 4.875L5.66656 0.875Z"
                                    fill="#1A1A1A" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
