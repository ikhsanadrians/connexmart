<div
    class="mobilebtmnav lg:hidden block w-full sticky bottom-0 h-[67px] bg-white border-[1px] border-zinc-200 shadow-lg">
    @if (Route::is('show.product'))
        <div class="container mx-auto flex gap-2 items-center h-full justify-between px-3 py-2">
            <div id="open_cart" class="add-cart p-4 h-full w-fit rounded-3xl bg-[#303fe2]/5 flex items-center">
                <span class="material-symbols-rounded text-[#303fe2]">
                    shopping_cart
                </span>
            </div>
            <div id="open_cart_2"
                class="buy-now bg-gradient-to-r from-[#303fe2] to-blue-500 px-16 w-full h-full rounded-3xl flex flex-col items-center justify-center">
                <p class="text-white font-semibold text-sm">Beli Sekarang</p>
                <p class="text-sm text-white">{{ format_to_rp($product->price) }}</p>
            </div>
        </div>
    @else
        <div class="container mx-auto flex items-center h-full justify-between px-5">
            <a href="{{ route('home') }}"
                class="home flex flex-col justify-center items-center {{ Route::is('home') ? 'text-[#303fe2]' : 'text-zinc-400' }}">
                <span class="material-symbols-rounded text-[26px]">
                    home
                </span>
                <p class="text-xs">Beranda</p>
            </a>
            <a href="{{ route('wishlist') }}"
                class="category flex flex-col justify-center items-center {{ Route::is('wishlist') ? 'text-[#303fe2]' : 'text-zinc-400' }}">
                <span class="material-symbols-rounded text-[26px]">
                    favorite
                </span>
                <p class="text-xs">Favorit</p>
            </a>
            <a href="{{ route('cart.index') }}"
                class="shopping-cart flex flex-col justify-center items-center {{ Route::is('cart.index') ? 'text-[#303fe2]' : 'text-zinc-400' }}">
                <span class="material-symbols-rounded text-[26px]">
                    shopping_cart
                </span>
                <p class="text-xs">Keranjang</p>
            </a>
            <a href="{{ route('transaction') }}"
                class="shopping-cart flex flex-col justify-center items-center {{ Route::is('transaction') ? 'text-[#303fe2]' : 'text-zinc-400' }}">
                <span class="material-symbols-rounded text-[26px]">
                    package_2
                </span>
                <p class="text-xs">Transaksi</p>
            </a>
            <a href="{{ route('profile') }}"
                class="person flex flex-col justify-center items-center {{ Route::is('profile') ? 'text-[#303fe2]' : 'text-zinc-400' }}">
                <span class="material-symbols-rounded text-[26px]">
                    person
                </span>
                <p class="text-xs">Akun</p>
            </a>

        </div>
    @endif

</div>
