@extends('layouts.admin')
@section('content')
    <a href="{{ route('mart.goods') }}" class="back bg-blue-500 font-semibold text-white rounded-lg px-4 py-2">
        Kembali
    </a>
    <div class="headers flex justify-between mt-4">
        <h1 class="text-2xl font-bold">Tambah Produk / Barang</h1>
    </div>
    <form enctype="multipart/form-data" onkeydown="if(event.keyCode === 13) return false" action="{{ route('mart.addgoods') }}"
        method="POST" class="products-container w-full mt-5 bg-white mb-12 px-6 pt-6 pb-8 rounded-lg flex flex-col gap-3">
        @csrf
        <div class="input-name flex flex-col mt-2 space-y-2">
            <label class="font-medium" for="">Nama Produk</label>
            <input name="name" type="text" placeholder="Masukan Nama Produk"
                class="outline-none px-4 py-3 bg-gray-100 rounded-md">
        </div>
        <div class="input-barcode flex flex-col mt-2 space-y-2">
            <label class="font-medium">Nomor Barcode ( Gunakan Scanner / Manual )</label>
            <input name="barcode_number" type="text" placeholder="Masukan Nomor Barcode"
                class="outline-none px-4 py-3 bg-gray-100 rounded-md">
        </div>
        <div class="input-price flex flex-col mt-2 space-y-2">
            <label class="font-medium">Harga Produk</label>
            <input name="price" type="text" placeholder="Masukan Harga Produk, Contoh: 6500"
                class="outline-none px-4 py-3 bg-gray-100 rounded-md">
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
            <div class="input-category flex flex-col mt-2 space-y-2">
                <label class="font-medium">Pilih Kategori</label>
                <select id="category-input"
                    class="category-select-goods w-full rounded-md focus:outline-none  bg-gray-100 my-2 px-4 py-3"
                    name="category_id">
                    <option value="goods-category">Pilih Kategori Produk</option>
                    @foreach ($productcategories as $productcategory)
                        <option value="{{ $productcategory->id }}">{{ ucfirst($productcategory->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-stock flex flex-col mt-2 space-y-2">
                <label class="font-medium">Stok Produk</label>
                <input name="stock" type="text" placeholder="Masukan Stok Produk"
                    class="outline-none px-4 py-3 bg-gray-100 rounded-md">
            </div>
        </div>
        <div class="input-description flex flex-col mt-2 space-y-2">
            <label class="font-medium">Deskripsi</label>
            <textarea name="description" id="" class="w-full rounded-md focus:outline-none bg-gray-100 my-2 p-3"
                placeholder="Masukan Deskripsi"></textarea>
        </div>
        <div class="input-images">
            <label class="font-medium">Thumbnail Produk</label>
            <br>
            <div class="input-images mt-2 flex items-center w-full h-12 bg-gray-100 relative">
                <div class="img-previews h-12 w-12 hidden">
                    <img src="" alt="" id="imgPreview" class="h-full w-full object-cover">
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-image icons absolute left-3" viewBox="0 0 16 16">
                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    <path
                        d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                </svg>
                <input id="thumbnail-input" type="file" name="image" id="thumbnail-input"
                    class="w-3/4 ml-8 rounded-md flex items-center">
            </div>
        </div>
        <button type="submit"
            class="mt-2 bg-gradient-to-r text-white font-semibold rounded-lg duration-300 from-blue-600 to-blue-500 py-3 ">
            Tambah Produk
        </button>
    </form>
@endsection
