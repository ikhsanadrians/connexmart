<div
    class="success-addproduct hidden-items fixed top-24 z-50 w-3/5 h-3/4 bg-gray-50 -translate-x-1/2 left-1/2 shadow-lg overflow-hidden rounded-lg">
    <div class="wrappers p-6">
        <div id="close-btn-successaddproduct" class="close group absolute top-7 right-6">
            <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                class="bi bi-x-lg" viewBox="0 0 16 16">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
            </svg>
        </div>
        <h1 class="text-lg font-semibold">Berhasil Menambahkan Produk</h1>
        <div
            class="products p-3 flex items-center gap-5 mt-4 w-full shadow-md bg-white shadow-slate-300 rounded-md overflow-hidden">
            <div class="thumbnail h-14 w-24 overflow-hidden">
                @if (!empty($product->photo) || File::exists(public_path($product->photo)))
                    <img src="{{ asset('images/default/mart.png') }}" alt="" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset($product->photo) }}" alt="" class="w-full h-full object-cover">
                @endif
            </div>
            <div class="product-detail flex items-center justify-between w-full pr-4">
                <div class="product-name flex flex-col">
                    <p class="font-semibold" id="success-product-name">{{ Str::limit($product->name, 50) }}</p>
                    <p class="quantity text-sm text-gray-500">Jumlah:<span id="dekstop-quantity-product"
                            class="pl-1 text-black"></span></p>
                    <p class="total-price text-sm text-gray-500">Total:<span id="dekstop-total-price"
                            class="pl-1 text-black"></span>
                    </p>

                </div>
                <a href="{{ route('cart.index') }}"
                    class="see-cart bg-gradient-to-r from-[#303fe2] to-blue-500 text-white py-2 px-4 text-sm font-semibold rounded-lg">
                    Lihat Keranjang
                </a>
            </div>
        </div>
        <h1 class="text-lg font-semibold mt-5">Mungkin Kamu Juga Suka</h1>
        <div class="grid grid-cols-4 mt-6 gap-3">
            @foreach ($otherProducts as $product)
                <a href="{{ route('show.product', $product->slug) }}">
                    <div class="product-card border-gray-200 overflow-hidden rounded-md shadow-md border-[1.5px] ">
                        <div class="content-img overflow-hidden h-28 w-full">
                            @if (!empty($product->photo) || File::exists(public_path($product->photo)))
                                <img src="{{ asset('images/default/mart.png') }}" alt=""
                                    class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset($product->photo) }}" alt=""
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div class="content  p-4">
                            <h1 class="text-sm">{{ $product->name }}</h1>
                            <p class="font-semibold text-black text-sm">{{ format_to_rp($product->price) }}</p>

                            <div class="product-action flex items-center justify-between h-full gap-2">
                                <div class="action-right lg:text-sm text-xs flex items-center gap-1 text-zinc-500">
                                    <div class="rating flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" class="bi bi-star-fill fill-yellow-500 -mt-[1.2px]"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        4.5
                                    </div>
                                    •
                                    <p>Terjual 14</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
