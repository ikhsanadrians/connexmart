<div id="chosee-quantity"
    class="chosee-quantity-mobile hidden-items !hide-animation h-[19rem] sticky bottom-0 z-50 w-full bg-white shadow-2xl rounded-tl-3xl rounded-tr-3xl">
    <span id="loader-chooseqty" class="loader !hidden absolute left-[44%] translate-x-[50%] z-50 top-28"></span>
    <div class="wrappers relative py-8 px-3">
        <button id="closeqtyeditor" class="button-close cursor-pointer absolute top-4 right-4">
            <span class="material-symbols-rounded text-red-500">
                close
            </span>
        </button>
        <div class="product-wrapper flex items-start gap-2">
            <div class="product-img w-24 h-16 rounded-md overflow-hidden">
                @if (!empty($product->photo) || File::exists(public_path($product->photo)))
                    <img src="{{ asset('images/default/mart.png') }}" alt="" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset($product->photo) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div class="product-details flex flex-col justify-start">
                <div data-productid="{{ $product->id }}" class="product-title font-semibold">
                    {{ $product->name }}
                </div>
                <div class="product-stock text-sm text-slate-500">
                    Stok: {{ $product->stock }}
                </div>
            </div>
        </div>
        <hr class="w-full mt-8 z-40">
        <div class="quantity-editor flex items-center justify-between mt-4">
            <div class="price text-lg">
                <p data-singleprice="{{ $product->price }}" id="product_price_mobile">
                    {{ format_to_rp($product->price) }}</p>
            </div>
            <div class="quantity">
                <div class="input-quantity flex bg-[#303fe2]/5 shadow-sm w-fit px-2 py-1 rounded-md">
                    <button id="mobile-decrease">
                        -
                    </button>
                    <input type="number" value="1" class="w-12 text-center bg-transparent focus:outline-none px-1"
                        min="1" id="mobile_value_quantity" max="{{ $product->stock }}"
                        data-mbcurrentstock="{{ $product->stock }}">
                    <button id="mobile-increase" class="text-[#303fe2]">
                        +
                    </button>
                </div>
            </div>

        </div>
        <div id="{{ $product->id }}" class="mobile-add-to-cart cursor-pointer button mt-8">
            <div
                class="text-center border-[1px] text-[#303fe2] font-semibold border-[#303fe2]/40 w-full text-sm py-4 rounded-3xl">
                Tambah Ke Keranjang
            </div>
        </div>
    </div>
</div>
