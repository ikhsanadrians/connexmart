@extends('layouts.admin')
@push('scripts')
    <script type="module" src="{{ asset('javascript/script/stockinput/stockinput.js') }}"></script>
@endpush
@section('content')
    <div class="add-crud bg-white rounded-md px-2 py-5 h-fit">
        <div class="headers px-4 flex items-center justify-between">
            <a href="{{ route('penerimaanstok.index') }}"
                class="back bg-[#303fe2] text-white px-5 font-medium py-3 hover:bg-slate-300 w-fit hover:text-[#003034] transition cursor-pointer rounded-xl flex items-center gap-2">
                Kembali
            </a>
            <h1 class="text-xl font-bold">Input Stok Penerimaan</h1>
        </div>
        <form enctype="multipart/form-data" onkeydown="if(event.keyCode === 13) return false"
            action="{{ route('mart.addgoods') }}" method="POST"
            class="products-container w-full mt-5 bg-white mb-12 px-6 pt-0 pb-8 rounded-lg flex flex-col gap-3">
            @csrf
            <div class="input-name flex flex-col mt-2 space-y-2">
                <label class="font-medium" for="">Pilih Produk</label>
                <select
                    class="select-product-to-add-stock pl-8 pr-4 outline-none px-4 !py-3 bg-gray-100 rounded-md focus:outline-none w-full"
                    name="state">
                    <option class="option-date" selected disabled>Pilih Produk Yang Ingin Ditambahan Stok</option>
                    @foreach ($dataProducts as $dataProduct)
                        <option class="option-date" value="{{ $dataProduct->id }}">
                            {{ $dataProduct->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="stok-list-container">
            </div>
            <div class="input-stock flex flex-col mt-2 space-y-2">
                <label class="font-medium">Jumlah Stok Baru</label>
                <input name="barcode_number" type="number" placeholder="Masukan Jumlah Stok Baru"
                    class="outline-none px-4 py-3 bg-gray-100 rounded-md">
            </div>

            <button type="submit"
                class="mt-2 bg-gradient-to-r text-white font-semibold rounded-lg duration-300 from-blue-600 to-blue-500 py-3 ">
                Tambah Produk
            </button>
        </form>
    </div>
@endsection
