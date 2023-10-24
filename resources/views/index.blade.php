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
                                class="w-full mt-2 px-4 py-2 bg-gray-100 rounded-md focus:outline-none focus:border-[#003034] focus:border-2"
                                type="text" placeholder="Enter Your Username/Email">
                        </div>
                        <div class="user-password mt-4">
                            <label for="">Password</label>
                            <input type="password" id="user-password"
                                class="w-full mt-2 px-4 py-2 bg-gray-100 rounded-md focus:outline-none focus:border-[#003034] focus:border-2"
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
    <div class="success-addproduct hidden fixed z-50 w-3/5 h-3/4 bg-gray-50 -translate-x-1/2 left-1/2 shadow-lg overflow-hidden rounded-lg">
        <div class="wrappers p-6">
            <div id="close-btn-successaddproduct" class="close group absolute top-7 right-6">
                <svg class="group-hover:fill-red-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                    fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                </svg>
            </div>
            <h1 class="text-xl font-semibold">Added Successfully!</h1>
            <div class="products p-3 flex items-center gap-5 mt-4 w-full shadow-md bg-white shadow-slate-300 rounded-md overflow-hidden">
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
        </div>
    </div>
    <div class="carouse w-full h-96 rounded-lg shadow-sm overflow-hidden hidden lg:block">
        <img class="w-full h-full object-cover" src="{{ asset('images/static/caroselrevisi.png') }}" alt="carousel">
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div
            class="cnx-pay  bg-white  h-[160px] lg:h-3/4 relative  font-semibold text-xl mt-6 rounded-md border-[1.5px] border-gray-200 p-4">
            @if (Auth::user())
                <div class="title flex items-center gap-1 font-bold text-sm">
                    <p>Your</p>
                    <img src="{{ asset('images/static/connexpay.png') }}" alt="cnx-pay" class="h-5 lg:h-8">
                    <p>Balance</p>
                </div>
                @foreach (Auth::user()->wallet as $user_wallet)
                    <h1 class="balance text-5xl mt-4 font-bold text-gray-700">
                          {{ format_to_rp($user_wallet->credit) }}
                    </h1>
                @endforeach
                <div class="flex mt-4 gap-2 absolute bottom-4 right-4">
                    <a href="{{ route('topup.index')}}"
                        class="top-up flex flex-col justify-center items-center bg-gradient-to-r from-sky-400 to-blue-500 lg:p-4 p-2 text-sm text-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
                        </svg>
                        Top Up
                    </a>
                    <div
                        class="transfer flex flex-col justify-center items-center bg-gradient-to-r from-sky-400 to-blue-500 p-4 text-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                        </svg>
                        Transfer
                    </div>

                </div>
            @else
                <div class="title">
                    Login To Get Your Balance!
                </div>
            @endif


        </div>

        <div class="cnx-category h-3/4  font-semibold text-xl mt-6 rounded-md border-[1.5px] border-gray-200 p-4 bg-white">
            <div class="title flex items-center gap-1 font-bold">
                <h1>Best Category</h1>
            </div>
            <div class="product-category-list grid grid-cols-1 lg:grid-cols-3 mt-4 gap-3 h-fit">
                <div
                    class="food-1 h-3/4 rounded-md relative overflow-hidden user-select-none pointer-events-none border-gray-200 border-[1.5px]">
                    <div class="img w-full h-full overflow-hidden user-select-none pointer-events-none">
                        <img class="brightness-75 w-full h-full object-cover user-select-none pointer-events-none"
                            src="https://images.pexels.com/photos/1289256/pexels-photo-1289256.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="drink">
                    </div>
                    <div class="description mt-2 absolute z-20 bottom-5 text-white p-4 text-2xl">
                        <p>Drink</p>
                    </div>
                </div>
                <div
                    class="food-2 h-3/4  rounded-md relative user-select-none pointer-events-none overflow-hidden border-gray-200 border-[1.5px]">
                    <div class="img w-full h-full overflow-hidden user-select-none pointer-events-none">
                        <img class="brightness-75 w-full h-full object-cover user-select-none pointer-events-none"
                            src="https://images.pexels.com/photos/1582482/pexels-photo-1582482.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="drink">
                    </div>
                    <div class="description mt-2 absolute z-20 bottom-5 text-white p-4 text-2xl">
                        <p>Snack</p>
                    </div>
                </div>
                <div
                    class="food-3 h-3/4 rounded-md user-select-none pointer-events-none relative overflow-hidden border-gray-200 border-[1.5px]">
                    <div class="img w-full h-full overflow-hidden user-select-none pointer-events-none">
                        <img class="brightness-75 user-select-none pointer-events-none  w-full h-full object-cover"
                            src="https://images.pexels.com/photos/760720/pexels-photo-760720.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="drink">
                    </div>
                    <div class="description mt-2 absolute z-20 bottom-5 text-white p-4 text-2xl">
                        <p>Stationery</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="products-list-card bg-white p-6 rounded-lg border-[1.5px] border-gray-200">
        <h1 class="font-semibold text-xl">Products</h1>
        <div class="product-list grid md:grid-cols-2 grid-cols-1 lg:grid-cols-4 gap-4 mt-3">
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
                            <div class="action-right">
                                <form
                                    class=" flex items-center gap-2">
                                    <input name="quantity" id="quantity" class="w-14 py-1 px-2 mt-2 bg-gray-100 shadow-lg border-2"
                                        type="number" min="1" value="1">
                                    <input type="hidden" id="product_id" name="product_id" value="{{ $product->id }}">
                                    <button data-islogined="@php if(Auth::user()) echo "logined"; else echo "not-logined"; @endphp" id="{{ $product->id }}" type="button"
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
                </div>
            @endforeach
        </div>
    </div>


@endsection
