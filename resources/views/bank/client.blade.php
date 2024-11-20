@extends('layouts.admin')
@section('content')
    <div class="crud-content bg-white rounded-lg">
        <div class="content-top p-4">
            <div class="headers flex justify-between items-center">
               <h1 class="text-xl font-bold">Daftar Nasabah</h1>
            </div>
            <div class="searchandfilter grid grid-cols-7 items-center gap-3 mt-4">
                <div class="search relative flex items-center w-full col-span-3">
                    <svg class="absolute left-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                    <input id="search_products" type="text" placeholder="Cari Top Up ID"
                        class="pl-8 pr-4 py-2 rounded-md bg-slate-100 border-[1.5px] border-slate-200 focus:outline-none w-full">
                </div>
                {{-- <select name="category" id="p_category"
                    class="select-category col-span-2 py-2 px-3 rounded-md bg-slate-100 border-[1.5px] border-slate-200">
                    <option class="option-status" value="all">Semua Kategori</option>
                    @foreach ($productcategories as $productcategory)
                        <option class="option-status" value="{{ $productcategory->slug }}">{{ $productcategory->name }}
                        </option>
                    @endforeach
                </select> --}}
                <select name="transaction_sorting" id="t_sorting"
                    class="select-transactions-sorting py-2 px-8 rounded-md bg-slate-100 col-span-2 border-[1.5px] border-slate-200">
                    <option class="option-sorting" value="newfirst">Terbaru</option>
                    <option class="option-sorting" value="oldfirst">Terlama</option>
                </select>
            </div>
        </div>

        <div class="products-list w-full mt-2 mb-2 px-4">
            <table class="w-full !shadow-none">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Nasabah</th>
                        <th>Nama Nasabah</th>
                        <th>Jumlah Saldo</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="product-container">
                    @foreach ($clients as $key => $client)
                        <tr>
                            <td class="topup-id" data-productid="{{ $client->id }}">
                                @if (!Request::get('show'))
                                    {{ $clients->firstItem() + $key }}
                                @else
                                    {{ $key + 1 }}
                                @endif
                            </td>
                            <td class="topup-td">{{ $client->wallet->norec }}</td>
                            <td class="topup-td">{{ $client->name }}</td>
                            <td class="topup-td">{{ format_to_rp($client->wallet->credit) }}</td>
                            <td class="topup-td">Aktif
                            </td>
                            <td>
                                <div class="action-wrappers flex items-center gap-2 justify-center">
                                    <a
                                        class="bg-green-400/60 text-green-600 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                    </a>
                                    <button class="delete-btn-goods bg-red-400/60 text-red-500/70 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                        </svg>
                                    </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                        <svg class="absolute right-0 top-1" width="24" height="25" viewBox="0 0 24 25" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7 10.875L12 15.875L17 10.875H7Z"
                                fill="black" fill-opacity="0.6" />
                        </svg>

                    </div>
                    <div class="showing-inputs text-sm lg:block hidden">
                        @if (Request::get('show') == 'all')
                            Showing All of {{ $counts_clients }} records
                        @else
                            Showing {{ $clients->firstItem() }} - {{ $clients->lastItem() }} of {{ $counts_clients }}
                            records
                        @endif
                    </div>
                </div>
                @if (request('show') != 'all')
                    @php

                        $pageLimit = 3;
                        $startPage = max(1, $clients->currentPage() - floor($pageLimit / 2));
                        $endPage = min($startPage + $pageLimit - 1, $clients->lastPage());
                        $nextPage =
                            $clients->currentPage() < $clients->lastPage()
                                ? $clients->currentPage() + 1
                                : $clients->lastPage();
                        $prevPage = $clients->currentPage() > 1 ? $clients->currentPage() - 1 : 1;

                    @endphp
                    <div class="pagination-buttons flex items-center gap-2">

                        <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => '1']) : $clients->url(1) }}"
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
                        <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $prevPage]) : $clients->previousPageUrl() }}"
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
                                    href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $page]) : $clients->url($page) }}">{{ $page }}</a>
                            </div>
                        @endfor
                        <a href="{{ request('category') ? route('mart.goods', ['category' => request('category'), 'page' => $nextPage]) : $clients->nextPageUrl() }}"
                            class="next-pages p-2 h-8 w-8 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md opacity-50">
                            <svg width="5" height="9" viewBox="0 0 5 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.94 0.875L0 1.815L3.05333 4.875L0 7.935L0.94 8.875L4.94 4.875L0.94 0.875Z"
                                    fill="#1A1A1A" />
                            </svg>
                        </a>
                        <a href="/mart/products?page={{ $clients->lastPage() }}"
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

    <script src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
@endsection
