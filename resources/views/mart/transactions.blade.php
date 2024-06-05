 @extends('layouts.admin')
 @push('scripts')
     <script type="module" src="{{ asset('javascript/script/transactions.js') }}"></script>
 @endpush
 @section('content')
     <div class="transactions bg-white rounded-lg">
         <div class="top-transactions p-4">
             <div class="headers flex justify-between">
                 <div class="title">
                     <h1 class="text-xl font-bold">Daftar Transaksi</h1>
                 </div>
             </div>
             <div class="searchandfilter mt-4 flex items-center gap-3">
                 <div class="search-transaction relative flex items-center">
                     <svg class="absolute left-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                         fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                         <path
                             d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                     </svg>
                     <input id="search-transactions" type="text" placeholder="Cari Transaksi"
                         class="pl-8 pr-4 py-2 rounded-md focus:outline-none  bg-slate-100 border-[1.5px] border-slate-200">
                 </div>
                 <div class="scanner bg-[#303fe2] text-white p-3 rounded-md flex items-center gap-2">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                         <path
                             d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z" />
                         <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z" />
                         <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z" />
                         <path
                             d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z" />
                         <path d="M12 9h2V8h-2z" />
                     </svg>
                 </div>
                 <div class="filter w-full grid grid-cols-3 gap-2">
                     <select class="select-transactions-date !py-2 !bg-slate-100 !border-[1.5px] !border-slate-200"
                         name="state">
                         <option class="option-date" selected value="all">Semua Tanggal</option>
                         @foreach ($userCheckoutsDate as $userCheckoutDate)
                             <option class="option-date" value="{{ format_date_slug($userCheckoutDate->formatted_date) }}">
                                 {{ $userCheckoutDate->formatted_date }}
                             </option>
                         @endforeach
                     </select>
                     <select name="transaction_status" id="t_status"
                         class="select-transactions-status py-2 px-3 rounded-md bg-slate-100 border-[1.5px] border-slate-200">
                         <option class="option-status" value="all">Semua Status</option>
                         <option class="option-status" value="ordered">Dibayar</option>
                         <option class="option-status" value="taken">Diambil</option>
                         <option class="option-status" value="canceled">Dibatalkan</option>
                     </select>
                     <select name="transaction_sorting" id="t_sorting"
                         class="select-transactions-sorting py-2 px-8 rounded-md bg-slate-100 border-[1.5px] border-slate-200">
                         <option class="option-sorting" value="newfirst">Terbaru</option>
                         <option class="option-sorting" value="oldfirst">Terlama</option>
                     </select>
                 </div>
                 <div class="download flex items-center gap-2 bg-[#303fe2] text-white p-3 rounded-lg">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16">
                         <path
                             d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0" />
                     </svg>
                 </div>
                 <div class="export-to-excel rounded-lg bg-[#303fe2] text-white p-3">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-file-earmark-spreadsheet-fill" viewBox="0 0 16 16">
                         <path d="M6 12v-2h3v2z" />
                         <path
                             d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M3 9h10v1h-3v2h3v1h-3v2H9v-2H6v2H5v-2H3v-1h2v-2H3z" />
                     </svg>
                 </div>
             </div>
         </div>
         <div class="transactions mb-6 border-t-[1px]">
             @foreach ($userCheckouts as $userCheckout)
                 <div
                     class="card hover:shadow-md mt-2 lg:mt-3 @if (!$loop->last) border-b-[1.2px]  border-gray-200 @endif relative py-2 px-1 lg:px-5 bg-white shadow-sm">
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
                                     <div
                                         class="taken bg-blue-500/50 text-sm text-blue-800 font-medium px-3 py-1 rounded-lg">
                                         Pesanan Diambil
                                     </div>
                                 @else
                                     <div
                                         class="taken bg-blue-500/50 text-sm text-blue-800 font-medium px-3 py-1 rounded-lg">
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
                                             <p>{{ format_to_rp($userCheckout->total_price) }}</p>
                                         </div>
                                     </td>
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
                             <div class="option mt-3 flex justify-end">
                                 @if ($userCheckout->status == 'ordered' && $userCheckout->user_id != 4)
                                     <a href="{{ route('mart.transaction.detail', $userCheckout->checkout_code) }}"
                                         class="diambil cursor-pointer font-medium bg-gradient-to-r from-green-600 to-green-700 rounded-lg w-fit h-fit px-4 py-2 text-white">
                                         Konfirmasi
                                     </a>
                                 @endif

                             </div>
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
                             Showing All of {{ $count_userCheckouts }} records
                         @else
                             Showing {{ $userCheckouts->firstItem() }} - {{ $userCheckouts->lastItem() }} of
                             {{ $count_userCheckouts }}
                             records
                         @endif
                     </div>
                 </div>
                 @if (request('show') != 'all')
                     @php

                         $pageLimit = 3;
                         $startPage = max(1, $userCheckouts->currentPage() - floor($pageLimit / 2));
                         $endPage = min($startPage + $pageLimit - 1, $userCheckouts->lastPage());
                         $nextPage =
                             $userCheckouts->currentPage() < $userCheckouts->lastPage()
                                 ? $userCheckouts->currentPage() + 1
                                 : $userCheckouts->lastPage();
                         $prevPage = $userCheckouts->currentPage() > 1 ? $userCheckouts->currentPage() - 1 : 1;

                     @endphp
                     <div class="pagination-buttons flex items-center gap-2">

                         <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => '1']) : $userCheckouts->url(1) }}"
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
                         <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $prevPage]) : $userCheckouts->previousPageUrl() }}"
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
                                     href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $page]) : $userCheckouts->url($page) }}">{{ $page }}</a>
                             </div>
                         @endfor
                         <a href="{{ request('category') ? route('mart.goods', ['category' => request('category'), 'page' => $nextPage]) : $userCheckouts->nextPageUrl() }}"
                             class="next-pages p-2 h-8 w-8 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md opacity-50">
                             <svg width="5" height="9" viewBox="0 0 5 9" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path d="M0.94 0.875L0 1.815L3.05333 4.875L0 7.935L0.94 8.875L4.94 4.875L0.94 0.875Z"
                                     fill="#1A1A1A" />
                             </svg>
                         </a>
                         <a href="/mart/transactions?page={{ $userCheckouts->lastPage() }}"
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
