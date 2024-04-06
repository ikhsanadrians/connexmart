@extends('layouts.master')
@section('content')
    <div class="l-container h-full">
        <div class="container-products w-full flex h-full lg:flex-row flex-col gap-8">
            <div class="container-left cols-span-3 w-full border-b-[1.5px] pb-8">
                <div class="product-container flex lg:flex-row flex-col gap-8">
                    <div class="product-img w-full lg:w-3/4 h-[20rem] rounded-lg overflow-hidden ">
                        @if (!empty($product->photo) || File::exists(public_path($product->photo)))
                            <img src="{{ asset('images/default/mart.png') }}" alt=""
                                class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset($product->photo) }}" alt="" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div class="product-wishlist-wrappers w-full relative">
                        <div class="product-detail lg:p-0 pl-4 pr-4 w-full">
                            <div class="product-title font-semibold  w-11/12 text-lg lg:text-xl">
                                <h1>{{ $product->name }}</h1>
                            </div>
                            <div
                                class="product-sold-rating flex items-center mt-1 gap-4 text-gray-500 lg:text-base text-sm">
                                <div class="sold">
                                    Terjual <span>7</span>
                                </div>
                                <p>
                                    •
                                </p>
                                <div class="rating flex gap-2 items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-star-fill fill-yellow-500 -mt-1"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                    <p class="">
                                        4.9 ( 12 Rating )
                                    </p>
                                </div>
                            </div>
                            <div class="product-prices text-2xl lg:text-3xl font-semibold mt-2">
                                <h1 id="price_of_product" data-price="{{ $product->price }}">
                                    {{ format_to_rp($product->price) }}
                                </h1>
                            </div>
                            <hr class="mt-5 w-full">
                            <div class="product-details-title mt-4 font-semibold text-lg">
                                <h1>Deskripsi Produk</h1>
                            </div>
                            <div class="product-details mt-2 text-gray-600 text-base">
                                <table class="category-brand-detail !bg-transparent lg:text-base text-sm !shadow-none">
                                    <tr class=" !border-none text-start">
                                        <td class="!border-none w-22 !p-0">Kategori</td>
                                        <td class="!border-none pl-7 !py-1 text-[#303fe2] inline-block">
                                            {{ $product->category->name }}
                                        </td>
                                    </tr>
                                    <tr class="!border-none">
                                        <td class="!border-none w-22 text-start !p-0">Merk</td>
                                        <td class="!border-none pl-7 !py-1 text-[#303fe2] inline-block">Ranco Company</td>
                                    </tr>
                                </table>
                                <div class="description w-full">
                                    <p class="mt-4 lg:text-base text-sm">
                                        {{ request()->extended_desc ? $product->desc : Str::limit($product->desc) }}
                                    </p>
                                    @if (request()->extended_desc)
                                        <a href="{{ url()->current() }}" class="">
                                            <div
                                                class="read-more w-full cursor-pointer text-center text-[#303fe2] lg:text-base text-sm my-4 bg-[#303fe2]/5 rounded-2xl py-3">
                                                <p>
                                                    Tutup Selengkapnya
                                                </p>
                                            </div>
                                        </a>
                                    @else
                                        <a href="{{ url()->current() . '?extended_desc=true' }}" class="">
                                            <div
                                                class="read-more w-full cursor-pointer text-center text-[#303fe2] lg:text-base text-sm my-4 bg-[#303fe2]/5 rounded-2xl py-3">
                                                <p>
                                                    Selengkapnya
                                                </p>
                                            </div>
                                        </a>
                                    @endif


                                </div>

                            </div>
                        </div>
                        <div class="wishlist-button pr-4 ml-5 mt-3 absolute top-0 right-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="red"
                                class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="rating-container px-4">
                    <div class="rating-wrapper-top flex gap-12 mt-4 lg:flex-row flex-col">
                        <div class="rating-left w-full lg:w-2/5 lg:order-1 order-2">
                            <div class="rating-title">
                                <h1 class="text-lg lg:text-xl font-semibold">Review Products</h1>
                            </div>
                            <div class="rating mt-3">
                                <div class="rating-desktop lg:block hidden">
                                    <div class="flex gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                                            fill="currentColor" class="bi bi-star-fill lg:block hidden fill-yellow-500"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <h1 class="text-lg lg:text-4xl font-semibold flex gap-2 items-center">
                                            5.0 <span class="font-normal text-base text-gray-600">
                                                <p>/ 5.0</p>
                                            </span>
                                        </h1>
                                    </div>
                                </div>
                                <div class="rating-mobile lg:hidden block text-sm">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" class="bi bi-star-fill lg:hidden block fill-yellow-500"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <p class="text-slate-600">5.0 ( 12 Rating )</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="photos-buyer-filter flex justify-between items-start w-full lg:order-2 order-1">
                            <div class="photos-buyer-reviews w-full">
                                <div class="product-photos">
                                    <div class="buyer-photos-container w-full">
                                        <div class="buyer-photos-title font-semibold text-lg">
                                            Foto Dari Pembeli
                                        </div>
                                        <div class="photo-list flex items-center gap-4 py-2">
                                            <div class="photos h-16 rounded-md overflow-hidden hover:shadow-md">
                                                <img src="{{ asset('images/default/mart.png') }}" alt=""
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="photos h-16 rounded-md overflow-hidden hover:shadow-md">
                                                <img src="{{ asset('images/default/mart.png') }}" alt=""
                                                    class="w-full h-full object-cover">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="reviews mt-4 mb-9 pl-0 lg:pl-[17.5rem] w-full">
                        <div class="review-lists w-full">
                            <div class="review flex items-start w-full justify-between">
                                <div class="review-wrapper">
                                    <div class="review-star flex items-center gap-1 py-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div class="stars">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill fill-yellow-500"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </div>
                                        @endfor
                                        <div class="history-time text-slate-500 text-sm pl-2">
                                            2 Weeks ago
                                        </div>
                                    </div>
                                    <div class="reviewer-profile flex items-center gap-2">
                                        <div class="reviewer-profile-pic w-8 h-8 overflow-hidden rounded-full">
                                            <img src="{{ asset('images/static/sample1.png') }}" alt=""
                                                class="w-full h-full object-cover">
                                        </div>
                                        <p class="reviewer-username font-semibold text-sm">
                                            Ikhsan Adrians
                                        </p>
                                    </div>
                                    <div class="review-description mt-2">
                                        <p class="lg:text-base text-sm">
                                            Recommended Snack Untuk Saat Ini 👍🏻
                                        </p>
                                    </div>
                                    <div class="thanks flex items-center gap-1 mt-2 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart-fill fill-slate-400"
                                            viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                        </svg>
                                        <p class="text-sm text-slate-500">Helped Me</p>
                                    </div>

                                </div>
                                <div class="review-option">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
            @if (!Auth::check() || Auth::user()->role_id !== 4)
                <div class="container-right w-1/3 bg-white shadow-sm rounded-lg p-4 sticky top-24 h-full"></div>
            @else
                <div
                    class="container-right w-1/3 lg:block hidden bg-white border-[1.2px] border-slate-200 shadow-sm rounded-lg p-4 sticky top-24 h-full">
                    <div class="add-to-cart font-semibold">
                        Atur Jumlah
                    </div>
                    <div class="quanties-setings mt-2 flex items-center gap-3">
                        <div class="input-quantity flex border-slate-300 border-[1.3px] w-fit px-2 py-1 rounded-md">
                            <button id="decrease">
                                -
                            </button>
                            <input type="number" value="1"
                                class="input-of-quantity w-12 text-center focus:outline-none px-1" min="1"
                                id="value_quantity" max="{{ $product->stock }}"
                                data-currentstock="{{ $product->stock }}">
                            <button id="increase">
                                +
                            </button>
                        </div>
                        <p>Stok: <span class="font-semibold">{{ $product->stock }}</span></p>
                    </div>
                    <div class="subtotal mt-4 flex justify-between items-center">
                        <p class="text-sm text-gray-500">Subtotal</p>
                        <h1 class="font-semibold" id="product_price_subtotals">{{ format_to_rp($product->price) }}</h1>
                    </div>
                    <div class="add-to-cart mt-4">
                        <button data-name="{{ $product->name }}" id="{{ $product->id }}"
                            class="bg-gradient-to-r from-[#303fe2] to-blue-500 text-white py-3 px-4 text-sm w-full rounded-3xl font-semibold">
                            Tambah Ke Keranjang
                        </button>
                    </div>
                </div>
            @endif
        </div>
        <div class="container-other-products w-full h-full mt-6">
            <div class="title text-xl font-semibold pl-3">
                <h1>Produk Lain</h1>
            </div>
            <div class="product-list w-full h-full flex mt-6 overflow-x-scroll no-scrollbar gap-4">
                @foreach ($otherProducts as $otherProduct)
                    <div class="wrappers ml-3 shadow-sm rounded-md h-full bg-white">
                        <a href="{{ route('show.product', $otherProduct->slug) }}"
                            class="product-card overflow-hidden rounded-md shadow-sm  w-full hover:shadow-xl">
                            <div class="content-img overflow-hidden h-36">
                                <img src="{{ asset('images/default/mart.png') }}" alt=""
                                    class="object-cover w-full h-full">
                            </div>
                            <div class="content  p-4">
                                <h1>{{ $otherProduct->name }}</h1>
                                <p class="font-semibold text-black">{{ format_to_rp($otherProduct->price) }}</p>

                                <div class="product-action flex items-center h-full gap-2">
                                    <div class="review-star flex items-center gap-1 py-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div class="stars">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-star-fill fill-yellow-500"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                </svg>
                                            </div>
                                        @endfor
                                    </div>
                                    <p class="text-sm text-slate-600">
                                        (129)
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
