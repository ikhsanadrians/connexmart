<div id="success-addtocart"
    class="success-addtocart-mobile hidden-items !hide-animation h-[19rem] sticky bottom-0 z-50 w-full bg-white shadow-2xl rounded-tl-3xl rounded-tr-3xl">
    <div class="wrappers relative py-8 px-3">
        <button id="closesuccessmodal" class="button-close cursor-pointer absolute top-4 right-4">
            <span class="material-symbols-rounded text-red-500">
                close
            </span>
        </button>
        <div class="product-wrapper flex flex-col items-start gap-2 w-full">
            <h1 class="font-semibold">Berhasil Menambahkan Produk</h1>
            <hr class="w-full my-2">
            <div class="flex justify-start gap-2 mt-3">
                <div class="product-img w-24 h-16 rounded-md overflow-hidden">
                    @if (!empty($product->photo) || File::exists(public_path($product->photo)))
                        <img src="{{ asset('images/default/mart.png') }}" alt=""
                            class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset($product->photo) }}" alt="" class="w-full h-full object-cover">
                    @endif
                </div>
                <div class="product-details justify-start">
                    <div data-productid="{{ $product->id }}" class="product-title font-semibold">
                        {{ $product->name }}
                    </div>
                    <div class="product-quantity-wrappers text-sm flex items-center text-slate-500">
                        <span class="pr-1">Jumlah:</span>
                        <p id="product-quantity-success"></p>
                    </div>
                    <div class="product-totals-wrappers text-sm flex items-center text-slate-500">
                        <span class="pr-1">Total:</span>
                        <p id="product-price-success"></p>
                    </div>
                </div>
            </div>
            <a href="{{ route('cart.index') }}"
                class="cart-check mt-8 bg-[#303fe2] text-center text-white w-full  py-4 rounded-3xl">
                Lihat Keranjang
            </a>

        </div>
    </div>


</div>
