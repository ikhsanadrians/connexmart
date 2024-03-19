@extends('layouts.master')
@section('content')
    <div class="detail-container h-full">
        <div class="container-products w-full flex h-full lg:flex-row flex-col gap-8">
            <div class="container-left cols-span-3 w-full border-b-[1.5px] pb-8">
                <div class="product-container flex lg:flex-row flex-col gap-8">
                    <div class="product-img w-full lg:w-3/4 h-[20rem] rounded-lg overflow-hidden ">
                        <img src="{{ asset($product->photo) }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="product-detail w-full lg:p-0 px-6">
                        <div class="product-title font-semibold text-xl">
                            <h1>{{ $product->name }}</h1>
                        </div>
                        <div class="product-sold-rating flex items-center mt-1 gap-4 text-gray-500">
                            <div class="sold">
                                Sold <span>7</span>
                            </div>
                            <div class="rating flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-star-fill fill-yellow-500 -mt-1" viewBox="0 0 16 16">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                <p class="">
                                    4.9 ( 3k Rating )
                                </p>
                            </div>
                        </div>
                        <div class="product-prices text-3xl font-semibold mt-2">
                            <h1 id="price_of_product" data-price="{{ $product->price }}">{{ format_to_rp($product->price) }}</h1>
                        </div>
                        <div class="product-details mt-2 text-gray-600 text-base">
                            <p>
                                {{ $product->desc }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="rating-container">
                    <div class="rating-wrapper-top flex gap-12 mt-4">
                        <div class="rating-left w-2/5">
                            <div class="rating-title">
                                <h1 class="text-xl font-semibold">Review Products</h1>
                            </div>
                            <div class="rating flex gap-3 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                                    class="bi bi-star-fill fill-yellow-500" viewBox="0 0 16 16">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                <h1 class="text-4xl font-semibold flex gap-2 items-center">
                                    5.0 <span class="font-normal text-base text-gray-600">/ 5.0</span>
                                </h1>
                            </div>
                        </div>
                        <div class="photos-buyer-filter flex justify-between items-start w-full">
                            <div class="photos-buyer-reviews w-full">
                                <div class="product-photos">
                                    <div class="buyer-photos-container w-full">
                                        <div class="buyer-photos-title font-semibold text-lg">
                                            Photo from buyer
                                        </div>
                                        <div class="photo-list flex items-center gap-4 py-2">
                                            <div class="photos h-16 rounded-md overflow-hidden hover:shadow-md">
                                                <img src="{{ asset($product->photo) }}" alt=""
                                                    class="w-full h-full object-cover">
                                            </div>
                                            <div class="photos h-16 rounded-md overflow-hidden hover:shadow-md">
                                                <img src="{{ asset($product->photo) }}" alt=""
                                                    class="w-full h-full object-cover">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="filter h-fit">
                                <select name="" id=""
                                    class="px-3 bg-slate-1 py-1 rounded-md bg-white focus:outline-none border-[1.5px] border-slate-300 shadow-md">
                                    <option value="">Sort By Time</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="reviews mt-4 mb-9 pl-[17.5rem] w-full">
                        <div class="review-title font-semibold">
                            Selected Reviews
                        </div>
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
                                        <p>
                                            Recommended Snack Untuk Saat Ini 👍🏻
                                        </p>
                                    </div>
                                    <div class="thanks flex items-center gap-1 mt-2 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-heart-fill fill-slate-400" viewBox="0 0 16 16">
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
            class="container-right w-1/3 bg-white border-[1.2px] border-slate-200 shadow-sm rounded-lg p-4 sticky top-24 h-full">
                <div class="add-to-cart font-semibold">
                    Set Quantity
                </div>
                <div class="quanties-setings mt-2 flex items-center gap-3">
                    <div class="input-quantity flex border-slate-300 border-[1.3px] w-fit px-2 py-1 rounded-md">
                        <button id="decrease">
                            -
                        </button>
                        <input type="number" value="1" class="w-12 text-center focus:outline-none px-1"
                            min="1" id="value_quantity" max="{{ $product->stock }}" data-currentstock="{{ $product->stock }}">
                        <button id="increase">
                            +
                        </button>
                    </div>
                    <p>Stok: <span class="font-semibold">{{ $product->stock }}</span></p>

                </div>
                <div class="subtotal mt-4 flex justify-between items-center">
                    <p class="text-sm text-gray-500">Subtotal</p>
                    <h1 class="font-semibold" id="product_price">{{ format_to_rp($product->price) }}</h1>
                </div>
                <div class="button-add-to-cart mt-4">
                    <button id="add-to-cart" data-productid="{{ $product->id }}" class="bg-[#003034] text-white py-2 px-4 text-sm w-full rounded-md font-semibold">Add To
                        Cart</button>
                </div>
            </div>
            @endif
        </div>
        <div class="container-other-products w-full h-full mt-6">
            <div class="title text-xl font-semibold">
                <h1>Other Product</h1>
            </div>
            <div class="product-list w-full grid grid-cols-5 mt-6 lg:overflow-auto overflow-x-scroll gap-3">
                @foreach ($otherProducts as $otherProduct)
                <a href="{{ route('show.product', $otherProduct->slug)}}" class="product-card border-gray-200 overflow-hidden rounded-md shadow-sm border-[1.5px] w-full hover:shadow-xl">
                    <div class="content-img overflow-hidden h-36">
                        <img src="{{ asset($otherProduct->photo) }}" alt=""
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
                @endforeach
        </div>
    </div>


    </div>
@endsection
