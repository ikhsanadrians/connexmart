<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="overflow-hidden">
    <div class="cashiers-wrappers flex w-full h-full">
        <div class="cashier-control h-full w-full lg:w-[67%] px-4 py-2 relative overflow-hidden">
            <div class="left-control py-4 px-4 flex items-center justify-between">
                <div class="title-search flex w-full items-center gap-4">
                    <div class="icon flex-none @if (Route::is('home')) block @else lg:block hidden @endif">
                        <a href="{{ route('mart.index') }}" class="flex items-center gap-2">
                            <img src="{{ asset('images/static/tenizenmart.png') }}" alt="connexmart"
                                class="h-11 @if (Route::is('home')) block @else lg:block hidden @endif">
                            <div class="tenmart-icons">
                                <p class="font-semibold text-xl text-[#303fe2] lg:block hidden">
                                    TenizenMart</p>
                                <p class="font-semibold text-sm">Cashier Dashboard</p>
                            </div>
                        </a>
                    </div>
                    <div class="search w-full flex gap-2">
                        <div class="search-input w-full relative">
                            <svg class="absolute top-3 left-4" width="17" height="17" viewBox="0 0 17 17"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.13633 1C5.92268 1 4.73628 1.35989 3.72717 2.03416C2.71806 2.70843 1.93155 3.66679 1.4671 4.78806C1.00266 5.90932 0.881139 7.14313 1.11791 8.33347C1.35468 9.5238 1.93911 10.6172 2.79729 11.4754C3.65547 12.3335 4.74886 12.918 5.93919 13.1547C7.12952 13.3915 8.36333 13.27 9.4846 12.8056C10.6059 12.3411 11.5642 11.5546 12.2385 10.5455C12.9128 9.53637 13.2727 8.34998 13.2727 7.13633C13.2726 5.5089 12.626 3.94817 11.4753 2.7974C10.3245 1.64664 8.76375 1.0001 7.13633 1Z"
                                    stroke="#6B6B6B" stroke-width="2" stroke-miterlimit="10" />
                                <path d="M11.7144 11.7145L15.9999 16" stroke="#6B6B6B" stroke-width="2"
                                    stroke-miterlimit="10" stroke-linecap="round" />
                            </svg>
                            <input placeholder="Cari Produk Disini" type="text"
                                class="rounded-lg pl-10 py-2 w-full focus:outline-none border-[#303fe2]/40 border-[1.9px]">

                        </div>
                        <div class="filter bg-[#303fe2] p-2 flex items-center justify-center rounded-lg">
                            <svg width="23" height="19" viewBox="0 0 23 19" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.4074 3.45408H13.6477C13.8264 3.95908 14.1573 4.39628 14.5947 4.70549C15.0321 5.01471 15.5547 5.18075 16.0904 5.18075C16.6261 5.18075 17.1486 5.01471 17.586 4.70549C18.0235 4.39628 18.3543 3.95908 18.533 3.45408H22.1363C22.3654 3.45408 22.585 3.36308 22.747 3.2011C22.909 3.03913 23 2.81944 23 2.59037C23 2.3613 22.909 2.14162 22.747 1.97964C22.585 1.81767 22.3654 1.72667 22.1363 1.72667H18.533C18.3543 1.22167 18.0235 0.784469 17.586 0.475252C17.1486 0.166035 16.6261 0 16.0904 0C15.5547 0 15.0321 0.166035 14.5947 0.475252C14.1573 0.784469 13.8264 1.22167 13.6477 1.72667H1.4074C1.17834 1.72667 0.95865 1.81767 0.796674 1.97964C0.634698 2.14162 0.543701 2.3613 0.543701 2.59037C0.543701 2.81944 0.634698 3.03913 0.796674 3.2011C0.95865 3.36308 1.17834 3.45408 1.4074 3.45408ZM22.1363 15.5459H18.533C18.3543 15.0409 18.0235 14.6037 17.586 14.2945C17.1486 13.9853 16.6261 13.8193 16.0904 13.8193C15.5547 13.8193 15.0321 13.9853 14.5947 14.2945C14.1573 14.6037 13.8264 15.0409 13.6477 15.5459H1.4074C1.17834 15.5459 0.95865 15.6369 0.796674 15.7989C0.634698 15.9609 0.543701 16.1806 0.543701 16.4096C0.543701 16.6387 0.634698 16.8584 0.796674 17.0204C0.95865 17.1823 1.17834 17.2733 1.4074 17.2733H13.6477C13.8264 17.7783 14.1573 18.2155 14.5947 18.5247C15.0321 18.834 15.5547 19 16.0904 19C16.6261 19 17.1486 18.834 17.586 18.5247C18.0235 18.2155 18.3543 17.7783 18.533 17.2733H22.1363C22.3654 17.2733 22.585 17.1823 22.747 17.0204C22.909 16.8584 23 16.6387 23 16.4096C23 16.1806 22.909 15.9609 22.747 15.7989C22.585 15.6369 22.3654 15.5459 22.1363 15.5459ZM22.1363 8.6363H9.89599C9.71727 8.13129 9.38643 7.6941 8.94899 7.38488C8.51155 7.07566 7.98902 6.90963 7.45333 6.90963C6.91763 6.90963 6.39511 7.07566 5.95767 7.38488C5.52023 7.6941 5.18938 8.13129 5.01067 8.6363H1.4074C1.17834 8.6363 0.95865 8.72729 0.796674 8.88927C0.634698 9.05125 0.543701 9.27093 0.543701 9.5C0.543701 9.72907 0.634698 9.94876 0.796674 10.1107C0.95865 10.2727 1.17834 10.3637 1.4074 10.3637H5.01067C5.18938 10.8687 5.52023 11.3059 5.95767 11.6151C6.39511 11.9243 6.91763 12.0904 7.45333 12.0904C7.98902 12.0904 8.51155 11.9243 8.94899 11.6151C9.38643 11.3059 9.71727 10.8687 9.89599 10.3637H22.1363C22.3654 10.3637 22.585 10.2727 22.747 10.1107C22.909 9.94876 23 9.72907 23 9.5C23 9.27093 22.909 9.05125 22.747 8.88927C22.585 8.72729 22.3654 8.6363 22.1363 8.6363Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="categories px-4 flex items-center gap-10 mt-1">
                <a href="{{ route('mart.cashier') }}"
                    class="all font-medium @if (request('category') == null) border-[#303fe2] text-[#303fe2] border-b-[1.8px] @endif p-2">
                    <p>Semua Kategori</p>
                    {{ request()->route('category') }}
                </a>
                @foreach ($categories as $category)
                    <a class="font-medium @if (request('category') == $category->slug) border-[#303fe2] text-[#303fe2] border-b-[1.8px] @endif p-2"
                        href="{{ route('mart.cashier', ['category' => $category->slug]) }}">
                        <p>{{ $category->name }}</p>
                    </a>
                @endforeach
                <div class="scroll-left p-2">
                    <svg width="10" height="18" viewBox="0 0 10 18" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L9 9L1 17" fill="white" />
                        <path d="M1 1L9 9L1 17" stroke="#6B6B6B" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>
            <div class="h-[73vh] max-h-screen">
                <div
                    class="product-list cashier-prod-list grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6 px-4 overflow-y-scroll h-[80%] pb-16">
                    @foreach ($products as $product)
                        <div class="product p-3 rounded-lg border-[1.7px] h-full max-h-auto border-[#303fe2]/50">
                            <div class="top-product w-full">
                                <div class="name-stock flex justify-between">
                                    <div class="product-name">
                                        <h1 class="text-sm font-medium text-[#303fe2]">{{ $product->name }}</h1>
                                    </div>
                                    <div class="stock flex gap-1 items-center">
                                        <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.0357 0.267853H1.46429L0.75 3.83928V7.05357H10.75V3.83928L10.0357 0.267853ZM9.76786 3.83928H7.17857C7.17857 4.21816 7.02806 4.58152 6.76015 4.84943C6.49224 5.11734 6.12888 5.26785 5.75 5.26785C5.37112 5.26785 5.00776 5.11734 4.73985 4.84943C4.47194 4.58152 4.32143 4.21816 4.32143 3.83928H1.73214L2.22321 1.20535H9.27678L9.76786 3.83928ZM7.17857 7.76785C7.17857 8.14673 7.02806 8.5101 6.76015 8.778C6.49224 9.04591 6.12888 9.19642 5.75 9.19642C5.37112 9.19642 5.00776 9.04591 4.73985 8.778C4.47194 8.5101 4.32143 8.14673 4.32143 7.76785H0.75V10.9821H10.75V7.76785H7.17857Z"
                                                fill="#6B6B6B" />
                                        </svg>
                                        <p class="text-sm">{{ $product->stock }}</p>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <p class="text-sm font-medium text-[#303fe2]">{{ format_to_rp($product->price) }}
                                    </p>
                                </div>
                            </div>
                            <div class="bottom-product flex justify-end">
                                <div class="add">
                                    <svg width="176" height="20" viewBox="0 0 176 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_108_765)">
                                            <path
                                                d="M166.25 0.625C161.012 0.625 156.75 4.88675 156.75 10.125C156.75 15.3632 161.012 19.625 166.25 19.625C171.488 19.625 175.75 15.3632 175.75 10.125C175.75 4.88675 171.488 0.625 166.25 0.625ZM169.904 10.8558H166.981V13.7788C166.981 13.9727 166.904 14.1585 166.767 14.2956C166.63 14.4326 166.444 14.5096 166.25 14.5096C166.056 14.5096 165.87 14.4326 165.733 14.2956C165.596 14.1585 165.519 13.9727 165.519 13.7788V10.8558H162.596C162.402 10.8558 162.216 10.7788 162.079 10.6417C161.942 10.5047 161.865 10.3188 161.865 10.125C161.865 9.93119 161.942 9.74531 162.079 9.60827C162.216 9.47122 162.402 9.39423 162.596 9.39423H165.519V6.47115C165.519 6.27734 165.596 6.09147 165.733 5.95442C165.87 5.81738 166.056 5.74038 166.25 5.74038C166.444 5.74038 166.63 5.81738 166.767 5.95442C166.904 6.09147 166.981 6.27734 166.981 6.47115V9.39423H169.904C170.098 9.39423 170.284 9.47122 170.421 9.60827C170.558 9.74531 170.635 9.93119 170.635 10.125C170.635 10.3188 170.558 10.5047 170.421 10.6417C170.284 10.7788 170.098 10.8558 169.904 10.8558Z"
                                                fill="#303FE2" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_108_765">
                                                <rect width="175.75" height="19" fill="white"
                                                    transform="translate(0 0.625)" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="pagination-and-back  p-4">

                    <div
                        class="pagination flex flex-row justify-between w-full items-start lg:gap-0 gap-4 lg:items-center">
                        <div class="page-records flex items-center gap-4">
                            <div class="record-per-inputs relative">
                                <select name="recordsPerPage" id="recordsPerPage"
                                    class="appearance-none bg-transparent text-sm focus:outline-none border-[1.8px] border-slate-200 py-1 pl-3 pr-6 rounded-md">
                                    <option class="option" value="50">50 per Page</option>
                                    <option class="option" value="100">100 per Page</option>
                                    <option class="option" value="all">Show All</option>
                                </select>
                                <svg class="absolute right-0 top-1" width="24" height="25"
                                    viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7 10.875L12 15.875L17 10.875H7Z"
                                        fill="black" fill-opacity="0.6" />
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
                                        <path
                                            d="M4.06 8.875L5 7.935L1.94667 4.875L5 1.815L4.06 0.875L0.0599996 4.875L4.06 8.875Z"
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
                                <a href="{{ request('category') ? route('mart.cashier', ['category' => request('category'), 'page' => $nextPage]) : $products->nextPageUrl() }}"
                                    class="next-pages p-2 h-8 w-8 flex items-center justify-center border-slate-200 border-[1.8px] rounded-md opacity-50">
                                    <svg width="5" height="9" viewBox="0 0 5 9" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M0.94 0.875L0 1.815L3.05333 4.875L0 7.935L0.94 8.875L4.94 4.875L0.94 0.875Z"
                                            fill="#1A1A1A" />
                                    </svg>
                                </a>
                                <a href="/mart/cashier?page={{ $products->lastPage() }}"
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
                    <a href="{{ route('mart.index') }}" class="back text-[#303fe2] flex items-center gap-3 mt-3">
                        <svg width="10" height="18" viewBox="0 0 10 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 17L1 9L9 1" fill="white" />
                            <path d="M9 17L1 9L9 1" stroke="#303FE2" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <p class="font-medium">Kembali ke dashboard</p>
                    </a>
                </div>
            </div>


        </div>
        <div class="cashier-order border-l-[1.8px] h-screen lg:block hidden w-[33%] border-slate-200">
            <div class="numbers-clock flex items-center justify-between border-b-[1.8px]  py-6 px-3  pb-4">
                <div class="number-order font-medium">
                    <h1>Order #INV_1234567890</h1>
                </div>
                <div class="clock text-slate-400 font-normal">
                    <p id="clock-text">07.22</p>
                </div>
            </div>
            <div class="pickup flex justify-center p-4 items-center gap-2 border-b-[1.8px] border-slate-200">
                <div class="pickup-btn font-medium">
                    Pick Up
                </div>
                <svg width="18" height="10" viewBox="0 0 18 10" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 1L9 9L1 1" fill="white" />
                    <path d="M17 1L9 9L1 1" stroke="black" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </div>
            <div class="pickup-items h-[73vh]">
                <div class="item-list cashier-items-list overflow-y-auto h-[80%]">
                    @for ($i = 0; $i < 2; $i++)
                        <div
                            class="item
                    flex items-center justify-between border-b-[1.8px] border-slate-200 border-dashed p-4">
                            <div class="item-desc">
                                <div class="desc-name font-medium">
                                    <p>Hotwhelss</p>
                                </div>
                                <div class="desc-price text-zinc-400">
                                    Rp15.000
                                </div>
                            </div>
                            <div class="item-qtycontrol">
                                <div
                                    class="input-quantity flex border-slate-300 border-[1.3px] w-fit px-2 py-1 rounded-md">
                                    <button id="decrease">
                                        -
                                    </button>
                                    <input type="number" value="1"
                                        class="input-of-quantity w-12 text-center focus:outline-none px-1"
                                        min="1" id="value_quantity" max="20">
                                    <button id="increase">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
                <div class="bottom-controls stick bottom-0 w-full">
                    <div class="totalitems">
                        <div
                            class="total flex font-medium px-4 py-2 border-b-[1.8px] border-t-[1.8px] border-slate-200 justify-between">
                            <div class="item-title">
                                <p>Total</p>
                            </div>
                            <div class="item-qty">
                                <p>Rp145.000 (3)</p>
                            </div>
                        </div>
                    </div>
                    <div class="button-group-cashier mt-4 grid grid-cols-2 gap-2 px-4 pt-1 pb-3">
                        <button class="border-[1.8px] border-[#303fe2] text-[#303fe2] p-2 rounded-lg">Clear
                            Order</button>
                        <button class="bg-[#303fe2] text-white p-2 rounded-lg">Proses</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>


    <script type="module" src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/admin.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script type="module" src="{{ asset('javascript/script/cashier.js') }}"></script>
</body>

</html>
