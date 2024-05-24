@extends('layouts.admin')
@section('content')
    <div class="headers flex justify-between">
        <h1 class="text-2xl font-bold">Tambah Produk / Barang</h1>
        <a href="{{ route('mart.addgoodsview') }}"
            class="add-products bg-[#303fe2] text-white px-5 py-4 hover:bg-slate-300 hover:text-[#003034] transition cursor-pointer rounded-lg flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-fill"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001 6.971 2.789Zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
            </svg>
        </a>
    </div>
    <div class="searchandfilter flex items-center gap-3">
        <div class="search relative flex items-center">
            <svg class="absolute left-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
            <input type="text" placeholder="Cari Barang" class="pl-8 pr-4 py-2 rounded-md focus:outline-none">
        </div>
        <div
            class="filter bg-[#303fe2] text-white p-[11px] rounded-md hover:bg-slate-300 hover:text-[#003034] transition cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path
                    d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z" />
            </svg>
        </div>
        <div class="filter w-full grid grid-cols-3 gap-2">
            <select name="category" id="p_category" class="select-category py-2 px-3 rounded-md">
                <option class="option-status" value="all">Semua Kategori</option>
                @foreach ($productcategories as $productcategory)
                    <option class="option-status" value="ordered">{{ $productcategory->name }}</option>
                @endforeach
            </select>
            <select name="transaction_sorting" id="t_sorting" class="select-transactions-sorting py-2 px-8 rounded-md">
                <option class="option-sorting" value="newfirst">Terbaru</option>
                <option class="option-sorting" value="oldfirst">Terlama</option>
            </select>
        </div>
    </div>
    <div class="products-list w-full mt-8 mb-8">
        <table class="w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Thumbnail</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <td class="product-id" data-productid="{{ $product->id }}">{{ $products->firstItem() + $key }}</td>
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
                        <td class="price-td" data-price="{{ $product->price }}">{{ format_to_rp($product->price) }}</td>
                        <td class="product-stock">{{ $product->stock }}</td>
                        <td data-categoryid="{{ $product->category->id }}" class="product-category">
                            {{ $product->category->name }}</td>
                        <td>
                            <div class="action-wrappers flex items-center gap-2 justify-center">
                                <a href="{{ route('mart.editgoods', $product->slug) }}"
                                    class="bg-gradient-to-r from-yellow-600 to-yellow-400 p-2 text-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path
                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                    </svg>
                                </a>
                                <form action="{{ route('mart.deletegoods') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                        class="delete-btn-goods-update bg-gradient-to-r from-red-600 to-red-400 p-2 text-white rounded-md">
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
    <div class="pagination-and-back  py-4 mb-12">
        <div class="pagination flex flex-row justify-between w-full items-start lg:gap-0 gap-4 lg:items-center">
            <div class="page-records flex items-center gap-4">
                <div class="record-per-inputs relative">
                    <select name="recordsPerPage" id="recordsPerPage"
                        class="appearance-none bg-transparent text-sm focus:outline-none border-[1.8px] border-slate-200 py-1 pl-3 pr-6 rounded-md">
                        <option class="option" value="50">50 per Page</option>
                        <option class="option" value="100">100 per Page</option>
                        <option class="option" value="all">Show All</option>
                    </select>
                    <svg class="absolute right-0 top-1" width="24" height="25" viewBox="0 0 24 25"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 10.875L12 15.875L17 10.875H7Z" fill="black"
                            fill-opacity="0.6" />
                    </svg>

                </div>
                <div class="showing-inputs text-sm lg:block hidden">
                    Showing 1-24 of {{ $count_products }} records
                </div>
            </div>
            @if (request('show') != 'all')
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
            @endif
        </div>
    </div>
@endsection
