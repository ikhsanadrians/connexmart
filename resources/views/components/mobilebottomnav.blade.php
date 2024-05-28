<div
    class="mobilebtmnav lg:hidden block w-full sticky bottom-0 h-[67px] bg-white border-[1px] border-zinc-200 shadow-lg">
    @if (Route::is('show.product'))
        <div class="container mx-auto flex gap-2 items-center h-full justify-between px-3 py-2">
            @if ($cashier_shifts)
                @if ($product->stock > 0)
                    <div id="open_cart"
                        class="cursor pointer add-cart p-4 h-full w-fit rounded-3xl bg-[#303fe2]/5 flex items-center">
                        <span class="material-symbols-rounded text-[#303fe2] cursor-pointer">
                            shopping_cart
                        </span>
                    </div>
                    <div id="open_cart_2"
                        class="buy-now bg-gradient-to-r from-[#303fe2] to-blue-500 px-16 w-full h-full rounded-3xl flex flex-col items-center justify-center">
                        <p class="text-white font-semibold text-sm">Beli Sekarang</p>
                        <p class="text-sm text-white">{{ format_to_rp($product->price) }}</p>
                    </div>
                @else
                    <div
                        class="buy-now cursor-not-allowed disabled-items px-16 w-full h-full rounded-3xl flex flex-col items-center justify-center">
                        <p class="font-semibold text-white">Stok Habis</p>
                    </div>
                @endif
            @else
                <button disabled
                    class="disabled bg-gradient-to-r from-[#303fe2] to-blue-500 text-white py-3 px-4 text-sm w-full rounded-3xl font-semibold">
                    Toko Sedang Tutup
                </button>
            @endif
        </div>
    @elseif(Route::is('cart.index'))
        <div class="container mx-auto grid grid-cols-7 gap-2 items-center h-full justify-between px-3 py-2">
            <div class="totals-and-checks col-span-4 flex items-center gap-2">
                <div class="checks flex flex-col items-center gap-[.8px] border-r-[1.2px] border-r-gray-400 pr-2">
                    <div class="checkbox-input flex items-center justify-center relative">
                        <input
                            class="h-5 w-5 peer shrink-0 relative checked:fill-white rounded-md border-2 border-[#303fe2] focus:outline-none checked:bg-[#303fe2] disabled:border-[1.5px] disabled:border-gray-300 appearance-none"
                            type="checkbox" name="checkproducts" id="checkallproduct">
                        <span
                            class="material-symbols-rounded pointer-events-none absolute left-0 text-[20px] text-white invisible peer-checked:visible">
                            done
                        </span>
                    </div>
                    <p class="text-xs text-center">Semua</p>
                </div>
                <div class="total">
                    <p class="text-sm">Total</p>
                    <p class="text-lg font-semibold product-price-info">{{ format_to_rp($total_prices) }}</p>
                </div>
            </div>
            <button disabled id="checkout-btn"
                class="btn-checkout disabled-items col-span-3 px-4 h-full font-semibold rounded-3xl gap-1 flex items-center justify-center">
                <p class="text-white font-semibold text-sm">Checkout (<span class="product-qty-info">0</span>)</p>
            </button>
        </div>
    @elseif(Route::is('checkout'))
        <div class="container mx-auto grid grid-cols-7 gap-2 items-center h-full justify-between px-3 py-2">
            <div class="totals-and-checks col-span-4 flex items-start gap-2">
                <div class="total">
                    <p class="text-xs">Total Pembayaran</p>
                    <p class="text-lg font-semibold product-price-info">
                        {{ format_to_rp($checkouts->total_price) }}
                    </p>
                </div>
            </div>
            <button disabled
                class="pay-btn disabled-items payment-button w-full text-sm bg-gradient-to-r from-[#303fe2] to-blue-500 text-white py-3  col-span-3 px-4 h-full font-semibold rounded-3xl gap-1 flex items-center justify-center">
                <span class="material-symbols-rounded">
                    lock
                </span>
                Bayar
            </button>
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
