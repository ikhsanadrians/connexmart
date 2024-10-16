@extends('layouts.admin')
@push('scripts')
@endpush
@section('content')
    <div class="crud-content bg-white rounded-lg">
        <div class="content-top p-4">
            <div class="headers flex justify-between items-center">
                <h1 class="text-xl font-bold">Stok Barang / Penerimaan</h1>
                <div class="tombol-stok flex gap-3">
                    {{-- <a href="{{ route('mart.addgoodsview') }}"
                        class="add-products bg-[#303fe2] text-white px-5 font-medium py-3 hover:bg-slate-300 hover:text-[#003034] transition cursor-pointer rounded-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2z" />
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                        </svg>
                        Import Excel
                    </a> --}}

                    <a href="{{ route('penerimaanstok.create') }}"
                        class="add-products bg-[#303fe2] text-white px-5 font-medium py-3 hover:bg-slate-300 hover:text-[#003034] transition cursor-pointer rounded-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                        </svg>
                        Stok
                    </a>
                </div>
            </div>
            <div class="searchandfilter flex flex-col gap-3 mt-4">
                <div class="top-column grid-cols-3 grid gap-x-3">
                    <div class="search relative flex items-center w-full">
                        <svg class="absolute left-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                        <input id="search_products" type="text" placeholder="Cari Stok Barang"
                            class="pl-8 pr-4 py-2 rounded-md bg-slate-100 border-[1.5px] border-slate-200 focus:outline-none w-full">
                    </div>
                    <select name="category" id="p_category"
                        class="select-category py-2 px-3 rounded-md bg-slate-100 border-[1.5px] border-slate-200">
                        <option class="option-status" disabled selected value="all">Jenis Stok</option>
                        <option value="">Barang Keluar</option>
                        <option value="">Barang Masuk</option>
                    </select>
                    <select name="transaction_sorting" id="t_sorting"
                        class="select-transactions-sorting py-2 px-8 rounded-md bg-slate-100 border-[1.5px] border-slate-200">
                        <option class="option-status" disabled selected value="all">Sort By</option>
                        <option class="option-sorting" value="newfirst">Terbaru</option>
                        <option class="option-sorting" value="oldfirst">Terlama</option>
                    </select>
                </div>
                <div class="date-and-export flex justify-between w-full">
                    <div class="date-and-search flex items-center gap-2">
                        <select name="tanggal" id="tanggal"
                            class="select-category py-2 px-3 rounded-md bg-slate-100 border-[1.5px] w-80 border-slate-200">
                            <option class="option-status" disabled selected value="all">Tanggal</option>
                            <option value="">Barang Keluar</option>
                            <option value="">Barang Masuk</option>
                        </select>
                        <div
                            class="search-btn  bg-[#303fe2] text-white px-3 w-fit font-medium py-3 hover:bg-slate-300 hover:text-[#003034] transition cursor-pointer rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </div>
                    </div>

                    <a href="{{ route('mart.addgoodsview') }}"
                        class="add-products bg-[#303fe2] text-white px-5 font-medium py-3 hover:bg-slate-300 hover:text-[#003034] transition cursor-pointer rounded-xl flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                            <path d="M6 12v-2h3v2z" />
                            <path
                                d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                        </svg>
                        Export Excel
                    </a>
                </div>



            </div>

        </div>

        <div class="products-list w-full mt-2 mb-2">
            <table class="w-full !shadow-none">
                <thead>
                    <tr>
                        <th>Transaksi ID</th>
                        <th>Keterangan</th>
                        <th>Stok Awal</th>
                        <th>QTY IN</th>
                        <th>QTY OUT</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody class="product-container">
                    {{-- @foreach ($products as $key => $product)
                        <tr>
                            <td class="product-id" data-productid="{{ $product->id }}">
                                @if (!Request::get('show'))
                                    {{ $products->firstItem() + $key }}
                                @else
                                    {{ $key + 1 }}
                                @endif
                            </td>
                            <td class="product-thumbnail flex justify-center border-none"
                                data-thumbnail="{{ $product->photo }}">
                                <div class="thumbnail overflow-hidden h-12 w-16">
                                    @if (!empty($product->photo) && File::exists(public_path($product->photo)))
                                        <img class="w-full h-full object-cover" src="{{ asset($product->photo) }}"
                                            alt="">
                                    @else
                                        <img class="w-full h-full object-cover" src="{{ asset('images/default/mart.png') }}"
                                            alt="">
                                    @endif
                                </div>
                            </td>
                            <td class="product-td" data-description="{{ $product->desc }}">{{ $product->name }}</td>
                            <td class="price-td" data-price="{{ $product->price }}">{{ format_to_rp($product->price) }}
                            </td>
                            <td class="product-stock">{{ $product->stock }}</td>
                            <td data-categoryid="{{ $product->category->id }}" class="product-category">
                                {{ $product->category->name }}</td>
                            <td>
                                <div class="action-wrappers flex items-center gap-2 justify-center">
                                    <a href="{{ route('mart.detailgoods', $product->slug) }}"
                                        class="bg-green-400/60 text-green-600 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('mart.editgoods', $product->slug) }}"
                                        class="bg-yellow-400/60 text-yellow-600/70 p-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                            fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path
                                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                        </svg>
                                    </a>
                                   <button id="{{ $product->id }}" class="delete-btn-goods bg-red-400/60 text-red-500/70 p-2 rounded-md">
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
                    @endforeach --}}
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
                        {{-- @if (Request::get('show') == 'all')
                            Showing All of {{ $count_products }} records
                        @else
                            Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $count_products }}
                            records
                        @endif --}}
                    </div>
                </div>
                {{-- @if (request('show') != 'all')
                    @php

                        $pageLimit = 3;
                        $startPage = max(1, $products->currentPage() - floor($pageLimit / 2));
                        $endPage = min($startPage + $pageLimit - 1, $products->lastPage());
                        $nextPage =
                            $products->currentPage() < $products->lastPage()
                                ? $products->currentPage() + 1
                                : $products->lastPage();
                        $prevPage = $products->currentPage() > 1 ? $products->currentPage() - 1 : 1;

                    @endphp
                    <div class="pagination-buttons flex items-center gap-2">

                        <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => '1']) : $products->url(1) }}"
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
                        <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $prevPage]) : $products->previousPageUrl() }}"
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
                                    href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $page]) : $products->url($page) }}">{{ $page }}</a>
                            </div>
                        @endfor
                        <a href="{{ request('category') ? route('mart.goods', ['category' => request('category'), 'page' => $nextPage]) : $products->nextPageUrl() }}"
                            class="next-pages p-2 h-8 w-8 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md opacity-50">
                            <svg width="5" height="9" viewBox="0 0 5 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.94 0.875L0 1.815L3.05333 4.875L0 7.935L0.94 8.875L4.94 4.875L0.94 0.875Z"
                                    fill="#1A1A1A" />
                            </svg>
                        </a>
                        <a href="/mart/products?page={{ $products->lastPage() }}"
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
                @endif --}}
            </div>
        </div>
    </div>

    <script src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
@endsection
