<div class="mobilebtmnav lg:hidden block w-full sticky bottom-0 h-16 bg-white border-[1px] border-zinc-200 shadow-lg">
    <div class="container mx-auto flex items-center h-full justify-between px-5">
        <a href="{{ route('home') }}"
            class="home flex flex-col justify-center items-center {{ Route::is('home') ? 'text-[#303fe2]' : 'text-zinc-500' }}">
            <span class="material-symbols-rounded text-[32px]">
                home
            </span>
            <p class="text-xs">Beranda</p>
        </a>
        <a href="{{ route('wishlist')}}"
            class="category flex flex-col justify-center items-center {{ Route::is('wishlist') ? 'text-[#303fe2]' : 'text-zinc-500' }}">
            <span class="material-symbols-rounded text-[32px]">
                favorite
            </span>
            <p class="text-xs">Favorit</p>
        </a>
        <a href="{{ route('cart.index') }}" class="shopping-cart flex flex-col justify-center items-center {{ Route::is('cart.index') ? 'text-[#303fe2]' : 'text-zinc-500' }}">
            <span class="material-symbols-rounded text-[32px]">
                shopping_cart
            </span>
            <p class="text-xs">Keranjang</p>
        </a>
        <a href="{{ route('transaction') }}" class="shopping-cart flex flex-col justify-center items-center {{ Route::is('transaction') ? 'text-[#303fe2]' : 'text-zinc-500' }}">
            <span class="material-symbols-rounded text-[32px]">
                package_2
            </span>
            <p class="text-xs">Transaksi</p>
        </a>
        <a href="{{ route('profile') }}" class="person flex flex-col justify-center items-center {{ Route::is('profile') ? 'text-[#303fe2]' : 'text-zinc-500' }}">
            <span class="material-symbols-rounded text-[32px]">
                person
            </span>
            <p class="text-xs">Akun</p>
        </a>

    </div>
</div>
