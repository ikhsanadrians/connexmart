@extends('layouts.master')
@section('content')
    <div class="login hidden fixed z-50 w-3/5 h-3/4 bg-white -translate-x-1/2 left-1/2 shadow-lg overflow-hidden rounded-lg">
        <div class="wrappers flex h-full w-full">
            <div class="login-ilustration w-1/2 h-full">
                <img src="{{ asset('images/static/martgroup.png') }}" alt="" class="h-full w-full object-cover">
            </div>
            <div class="login-input-group relative w-1/2 p-4">
                <div id="close-btn" class="close group absolute top-4 right-4">
                    <svg class="group-hover:fill-red-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                    </svg>
                </div>
                <div class="login-header">
                    <div class="login-title font-semibold text-center text-2xl">
                        <p>Login</p>

                    </div>
                </div>
                <div class="login-error hidden text-center w-full mt-2 bg-red-200 py-2 rounded-md">
                    <p>Username or Password Incorrect!</p>
                </div>
                <div class="login-forms mt-4">
                    <form>
                        <div class="user-id">
                            <label for="">Email Or Username</label>
                            <input id="user-id"
                                class="w-full mt-2 px-4 py-3 bg-gray-100 rounded-md focus:outline-none focus:border-[#003034] focus:border-[1.2px]"
                                type="text" placeholder="Enter Your Username/Email">
                        </div>
                        <div class="user-password mt-4">
                            <label for="">Password</label>
                            <input type="password" id="user-password"
                                class="w-full mt-2 px-4 py-3 bg-gray-100 rounded-md focus:outline-none focus:border-[#003034] focus:border-[1.2px]"
                                type="text" placeholder="Enter Your Password">
                        </div>
                        <div class="user-remember flex items-center gap-2 mt-3">
                            <input type="checkbox">
                            <p>Remember Me</p>
                        </div>

                        <button id="submit-login"
                            class="w-full bg-[#003034] text-white font-semibold p-2 rounded-md mt-4">Submit</button>

                    </form>
                    <div class="user-remember flex items-center gap-2 mt-6">
                        <p>Doesn't Have An Account?</p>
                        <button class="text-blue-500">Register Here</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div
        class="success-addproduct hidden fixed z-50 w-3/5 h-3/4 bg-gray-50 -translate-x-1/2 left-1/2 shadow-lg overflow-hidden rounded-lg">
        <div class="wrappers p-6">
            <div id="close-btn-successaddproduct" class="close group absolute top-7 right-6">
                <svg class="group-hover:fill-red-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                    fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                </svg>
            </div>
            <h1 class="text-xl font-semibold">Added Successfully!</h1>
            <div
                class="products p-3 flex items-center gap-5 mt-4 w-full shadow-md bg-white shadow-slate-300 rounded-md overflow-hidden">
                <div class="thumbnail h-14 overflow-hidden">
                    <img src="{{ asset('images/static/martgroup.png') }}" alt="test" class="h-full w-full object-cover">
                </div>
                <div class="product-name flex items-center justify-between w-full pr-4">
                    <p class="text-gray-600" id="success-product-name"></p>
                    <a href="{{ route('cart.index') }}" class="see-cart bg-[#003034] text-white py-2 px-4 rounded-md">
                        See Cart
                    </a>
                </div>
            </div>
            <h1 class="text-xl font-semibold mt-5">You May Also Like</h1>
            <div class="grid grid-cols-4 mt-6 gap-3">
                @foreach ($products as $product)
                    <div class="product-card border-gray-200 overflow-hidden rounded-md shadow-md border-[1.5px] ">
                        <div class="content-img">
                            <img src="{{ asset('images/static/martgroup.png') }}" alt="">
                        </div>
                        <div class="content  p-4">
                            <h1>{{ $product->name }}</h1>
                            <p class="font-semibold text-black">{{ format_to_rp($product->price) }}</p>

                            <div class="product-action flex items-center justify-between h-full gap-2">
                                <div class="wishlist-button mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="red"
                                        class="bi bi-heart" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="carouse w-full h-96 rounded-lg shadow-sm overflow-hidden hidden lg:block">
        <img class="w-full h-full object-cover" src="{{ asset('images/static/caroselrevisi.png') }}" alt="carousel">
    </div>
    <div class="grid grid-cols-1 lg:mx-0 mx-4 lg:grid-cols-2 gap-4">
        <div
            class="cnx-pay  bg-gradient-to-r from-blue-600 to-blue-800 w-full  px-4 h-fit lg:h-full relative  font-semibold text-xl mt-6  rounded-md shadow-sm">
            @if (Auth::user())
                <div class="balance-mobile flex justify-between">
                    <div class="balance py-4">
                        <div class="title flex items-center gap-1 font-bold lg:text-base text-sm">
                            <img src="{{ asset('images/static/connexpay.png') }}" alt="cnx-pay"
                                class="h-5 lg:h-8 brightness-0 invert-[1]">
                        </div>
                        @foreach (Auth::user()->wallet as $user_wallet)
                            <h1 class="balance text-2xl lg:text-4xl mt-4 font-semibold text-white">
                                {{ format_to_rp($user_wallet->credit) }}
                            </h1>
                        @endforeach
                        <p class="text-md font-normal text-white mt-2">56.700 Poin</p>
                    </div>
                    <div class="action-mobile flex items-center gap-1 px-3 text-sm justify-center lg:hidden">
                        <a href="{{ route('topup.index') }}" class="top-up bg-blue-500 py-2 px-3 text-white rounded-lg">
                            Top Up
                        </a>
                        <div class="transfer bg-blue-500 py-2 px-3 text-white rounded-lg">
                            Transfer
                        </div>
                    </div>

                </div>

                <div class="rounded-2xl gap-2 lg:flex hidden px-4 py-4 items-center bg-white w-full">
                    <div class="flex items-center justify-evenly w-full">
                        <a href="{{ route('topup.index') }}"
                            class="top-up flex flex-col justify-center  gap-1 text-md items-center text-gray-400 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-plus-square fill-blue-500" viewBox="0 0 16 16">
                                <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                            </svg>
                            <p class="font-normal text-lg">
                                Top Up
                            </p>
                        </a>
                        <a href="{{ route('topup.index') }}"
                            class="top-up flex flex-col justify-center gap-1 text-md items-center  text-gray-400 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-arrow-up-square fill-blue-500" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z" />
                            </svg>
                            <p class="font-normal text-lg">
                                Transfer
                            </p>
                        </a>
                        <a href="{{ route('topup.index') }}"
                            class="top-up flex flex-col justify-center  text-md items-center  gap-1 text-gray-400 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-arrow-left-right fill-blue-500" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5" />
                            </svg>
                            <p class="font-normal text-lg">
                                History
                            </p>
                        </a>
                        <a href="{{ route('topup.index') }}"
                            class="top-up flex flex-col justify-center text-md items-center gap-1 text-gray-400 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-copy fill-blue-500" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z" />
                            </svg>
                            <p class="font-normal text-lg">
                                Other
                            </p>
                        </a>
                    </div>
                </div>
            @else
                <div class="title text-white p-4 relative w-full h-full">
                    Login To Get Your Balance
                    <p class="font-normal text-slate-100">To Get Your ConnexPay Account You Need Login!</p>
                    <svg class="absolute bottom-4 right-0" xmlns="http://www.w3.org/2000/svg" width="46" height="46" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                      </svg>
                </div>
            @endif


        </div>
        <div class="w-full mt-6 overflow-hidden rounded-md h-full">
            <img class="w-full h-full" src="https://www.static-src.com/siva/asset/12_2023/Ranch-des-blm-5desKolaboarasi-800x400.jpg?w=392" alt="">
        </div>
    </div>
    <div class="products-list-card rounded-lg">
        <h1 class="font-semibold text-xl">Products</h1>
        <div class="product-list grid md:grid-cols-2 grid-cols-1 lg:grid-cols-4 gap-4 mt-3">
            @foreach ($products as $product)
                <a href="{{ route('show.product',$product->slug) }}"
                    class="product-card border-gray-200 bg-white overflow-hidden h-fit rounded-md shadow-md border-[1.5px] ">
                    <div class="content-img w-full h-[170px] overflow-hidden">
                        @if ($product->photo == '')
                            <img class="w-full h-full object-cover" src="{{ asset('images/static/martgroup.png') }}"
                                alt="">
                        @else
                            <img class="w-full h-full object-cover" src="{{ asset($product->photo) }}" alt="">
                        @endif
                    </div>
                    <div class="content  p-4">
                        <h1>{{ $product->name }}</h1>
                        <p class="font-semibold text-black">{{ format_to_rp($product->price) }}</p>

                        <div class="product-action flex items-center justify-between h-full gap-2">
                            <div class="wishlist-button mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="red"
                                    class="bi bi-heart" viewBox="0 0 16 16">
                                    <path
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                </svg>
                            </div>
                            <div class="action-right">
                                <form class=" flex items-center gap-2">
                                    <input name="quantity" id="quantity-{{ $product->id }}"
                                        class="w-14 py-1 px-2 mt-2 bg-gray-100 shadow-lg border-2" type="number"
                                        min="1" value="1">
                                    <input type="hidden" id="product_id" name="product_id"
                                        value="{{ $product->id }}">
                                    <button
                                        data-islogined="@php if(Auth::user()) echo "logined"; else echo "not-logined"; @endphp"
                                        id="{{ $product->id }}" type="button"
                                        class="add-to-cart flex items-center bg-[#003034] text-white py-2 px-4 text-sm mt-2 rounded-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                        </svg>
                                        Add To Cart
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>


@endsection
