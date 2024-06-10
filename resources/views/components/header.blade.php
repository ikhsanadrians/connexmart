<header class="bg-white shadow-sm sticky top-0 z-30 border-b-[1px] border-zinc-200">
    <div class="container mx-auto w-full lg:px-12 py-4 px-2 lg:flex flex-none items-center  justify-between">
        <div class="titleiconsearch flex items-center justify-between">
            <div class="page-back flex items-center justify-between">
                <a href="{{ route('home') }}"
                    class="pr-2 @if (Route::is('home')) hidden @else lg:hidden block @endif">
                    <span class="material-symbols-rounded text-[28px] mt-2 text-zinc-500">
                        arrow_back
                    </span>
                </a>
                @if (Route::is('cart.index'))
                    <p class="lg:hidden block font-medium text-zinc-700">Keranjangmu</p>
                @elseif(Route::is('checkout'))
                    <p class="lg:hidden block font-medium text-zinc-700">Checkout</p>
                @elseif(Route::is('scanner'))
                    <p class="lg:hidden block font-medium text-zinc-700">Scan Untuk Bayar</p>
                @elseif(Route::is('profile'))
                    <p class="lg:hidden block font-medium text-zinc-700">Profil</p>
                @elseif(Route::is('wishlist'))
                    <p class="lg:hidden block font-medium text-zinc-700">Favorit</p>
                @elseif(Route::is('transaction'))
                    <p class="lg:hidden block font-medium text-zinc-700">Transaksi</p>
                @endif
            </div>

            <div class="icon pr-4 flex-none @if (Route::is('home')) block @else lg:block hidden @endif">
                <a href="/" class="header-title flex items-center gap-2 w-full h-full">
                    <img src="{{ asset('images/static/tenizenmart.png') }}" alt="connexmart"
                        class="h-12 @if (Route::is('home')) block @else lg:block hidden @endif">
                    <p class="font-semibold text-lg text-[#303fe2] lg:block hidden">
                        TenizenMart</p>
                </a>
            </div>

            <a href="{{ route('search.page') }}" class="w-full">
                <div
                    class="search relative basis-full @if (Route::is('home') || Route::is('show.product')) block @else lg:block hidden @endif">
                    <div class="flex items-center w-full">
                        <svg class="absolute left-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="#9196a3" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                        <input
                            class="py-2 pl-9 pr-4 lg:w-[33rem] w-full bg-transparent focus:bg-gray-100 bg-gray-100 focus:outline-none focus:border-[1.5px] border-gray-300 border-[1.5px] rounded-lg"
                            type="text" placeholder="Kamu mau cari apa?">

                    </div>
                </div>
            </a>


            @if (Route::is('show.product'))
                <a href="{{ route('cart.index') }}">
                    <span class="material-symbols-rounded text-[#303fe2] ml-2 text-[32px] lg:hidden block">
                        shopping_cart
                    </span>
                </a>
            @elseif(Route::is('cart.index'))
                <span class="material-symbols-rounded text-[#303fe2] ml-2 text-[32px] lg:hidden block">
                    favorite
                </span>
            @else
                @if (!Route::is('scanner'))
                    <span class="material-symbols-rounded text-[#303fe2] ml-2 text-[32px] lg:hidden block">
                        notifications
                    </span>
                @endif
            @endif

        </div>

        <div class="header-charts flex items-center gap-4">
            @if (Auth::user())
                <a href="{{ Auth::user() ? route('cart.index') : '/' }}" class="carts relative lg:block hidden hover:">
                    @if (Auth::user() && count(Auth::user()->transcations) >= 1)
                        <div
                            class="pulse w-4 h-4 bg-red-500 text-white font-medium text-sm text-center flex items-center justify-center absolute -right-1 -top-1 rounded-full">
                            {{ $cart_quantity }}
                        </div>
                    @endif
                    <span class="material-symbols-rounded text-[28px] text-[#303fe2]">
                        shopping_cart
                    </span>
                </a>
            @endif
            @if (!Auth::user())
                <div class="header-menu lg:flex hidden items-center gap-4 font-semibold">
                    <button id="login-btn"
                        class="border-[1.8px] border-slate-600 py-2 px-4 rounded-lg hover:opacity-80">Login</button>
                    <button class="bg-[#303fe2] text-white py-2 px-4 rounded-lg hover:opacity-80">Sign Up</button>
                </div>
            @else
                <div class="if-logined  lg:block hidden -mt-1">
                    <div class="wrapper flex items-center gap-1">
                        <a href="{{ route('profile') }}"
                            class="user  flex items-center gap-1 w-fit h-fit px-2 py-1 hover:bg-gray-200 group duration-200 rounded-lg">
                            <span class="material-symbols-rounded text-[30px] text-[#303fe2]">
                                person
                            </span>
                            <h1 class="text-slate-600 font-medium group-hover:text-[#303fe2]">
                                {{ Str::limit(Auth::user()->name, 13) }}</h1>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</header>
