@extends('layouts.admin')
@push('scripts') 
<script type="module" src="{{ asset('javascript/script/bank.js') }}"></script>
@endpush
@section('content')
<div class="crud-content bg-white rounded-lg">
    <div class="content-top p-4">
        <div class="headers flex justify-between items-center">
            <a href="{{ route('bank.topup') }}"
            class="back bg-[#303fe2] text-white px-5 font-medium py-3 hover:bg-slate-300 w-fit hover:text-[#003034] transition cursor-pointer rounded-xl flex items-center gap-2">
            Kembali
            </a>
            <h1 class="text-xl font-bold">New Top Up</h1>
        </div>
    </div>
    <div class="top-up-container w-full mt-2 mb-2 px-4">
        <form
            method="POST"
            action="{{ route('bank.newtopuppost') }}"
            class="products-container w-full mt-5 bg-white mb-12 px-6 pt-0 pb-8 rounded-lg flex flex-col gap-3">
            @csrf
            <div class="input-name flex flex-col mt-2 space-y-2">
                <label class="font-medium" for="">Pilih Nasabah</label>
                <select
                    class="select-user-to-add-balance pl-8 pr-4 outline-none px-4 !py-3 bg-gray-100 rounded-md focus:outline-none w-full"
                    name="selected_nasabah">
                    <option class="option-product-to-add-stock-example" selected disabled>Pilih Nasabah Yang Ingin Di Top Up saldonya</option>
                    @foreach ($users as $user)
                        <option class="option-date" value="{{ $user->id }}">
                          No: {{ $user->id }} | {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-name flex flex-col mt-2 space-y-2">
                <label class="font-medium" for="">Nominal</label>
                <input name="nominals" type="number" placeholder="Masukan Nominal"
                    class="outline-none px-4 py-3 bg-gray-100 rounded-md">
            </div>
            <button type="submit"
                class="mt-2 bg-gradient-to-r text-white font-semibold rounded-lg duration-300 from-blue-600 to-blue-500 py-3 ">
                Konfirmasi
            </button>
        </form>
    </div>
</div>

<script src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
@endsection