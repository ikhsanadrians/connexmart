<div class="mobilebtmnav lg:hidden block w-full sticky bottom-0 h-16 bg-white border-[1px] border-zinc-200 shadow-lg">
    <div class="container mx-auto flex items-center h-full justify-between px-5">
        <div
            class="home flex flex-col justify-center items-center {{ Route::is('home') ? 'text-[#303fe2]' : 'text-zinc-500' }}">
            <span class="material-symbols-rounded text-[32px]">
                home
            </span>
            <p class="text-xs">Beranda</p>
        </div>
        <div
            class="category flex flex-col justify-center items-center {{ Route::is('home') ? 'text-[#303fe2]' : 'text-zinc-500' }}">
            <span class="material-symbols-rounded text-[32px]">
                favorite
            </span>
            <p class="text-xs">Favorit</p>
        </div>
        <div class="shopping-cart flex flex-col justify-center items-center text-zinc-500">
            <span class="material-symbols-rounded text-[32px]">
                shopping_cart
            </span>
            <p class="text-xs">Keranjang</p>
        </div>
        <div class="shopping-cart flex flex-col justify-center items-center text-zinc-500">
            <span class="material-symbols-rounded text-[32px]">
                package_2
            </span>
            <p class="text-xs">Transaksi</p>
        </div>
        <div class="person flex flex-col justify-center items-center text-zinc-500">
            <span class="material-symbols-rounded text-[32px]">
                person
            </span>
            <p class="text-xs">Akun</p>
        </div>

    </div>
</div>
