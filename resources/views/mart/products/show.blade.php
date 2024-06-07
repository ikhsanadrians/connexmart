@extends('layouts.admin')
@section('content')
    <a href="{{ route('mart.goods') }}" class="back bg-blue-500 font-semibold text-white rounded-lg px-4 py-2">
        Kembali
    </a>
    <div class="headers flex justify-between mt-4">
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
        <div class="action flex items-center gap-2">
            <a href="{{ route('mart.editgoods', $product->slug) }}"
                class="bg-gradient-to-r from-yellow-600 to-yellow-400 p-2 text-white rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-pen-fill" viewBox="0 0 16 16">
                    <path
                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                </svg>
            </a>
            <button type="submit"
                    class="delete-btn-goods bg-gradient-to-r from-red-600 to-red-400 p-2 text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                        class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path
                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                    </svg>
            </button>
        </div>
    </div>
    <div class="products-container w-full mt-5 bg-white mb-12 rounded-lg flex flex-col gap-3 overflow-hidden">
        <div class="product-thumbnail w-full h-[280px]">
            @if (!empty($product->photo) && File::exists(public_path($product->photo)))
                <img class="w-full h-full object-cover" src="{{ asset($product->photo) }}" alt="">
            @else
                <img class="w-full h-full object-cover" src="{{ asset('images/default/mart.png') }}" alt="">
            @endif
        </div>
        <div class="product-description px-6 pt-6 pb-8">
            <div class="input-name flex flex-col mt-2 space-y-2">
                <label class="font-medium" for="">Nama Produk</label>
                <h1 class="text-xl font-semibold">
                    {{ $product->name }}
                </h1>
            </div>
            <div class="input-barcode flex flex-col mt-2 space-y-2">
                <label class="font-medium">Nomor Barcode</label>
                <h1 class="text-xl font-semibold">#{{ $product->barcode_number }}</h1>
            </div>
            <div class="input-price flex flex-col mt-2 space-y-2">
                <label class="font-medium">Harga Produk</label>
                <h1 class="text-xl font-semibold">{{ format_to_rp($product->price) }}</h1>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <div class="input-category flex flex-col mt-2 space-y-2">
                    <label class="font-medium">Kategori</label>
                    <h1 class="text-xl font-semibold">{{ $product->category->name }}</h1>

                </div>
                <div class="input-stock flex flex-col mt-2 space-y-2">
                    <label class="font-medium">Stok Produk</label>
                    <h1 class="text-xl font-semibold">{{ $product->stock }}</h1>
                </div>
            </div>
            <div class="input-stock flex flex-col mt-2 space-y-2">
                <label class="font-medium">Jumlah Produk Terjual</label>
                <h1 class="text-xl font-semibold">{{ $product->quantity_sold }}</h1>
            </div>
            <div class="input-description flex flex-col mt-2 space-y-2">
                <label class="font-medium">Deskripsi</label>
                <h1 class="text-xl font-semibold">{{ $product->desc }}</h1>
            </div>
        </div>
    </div>
@endsection
