@extends('layouts.admin')
@section('content')
    <a href="{{ route('bank.topup') }}" class="back bg-blue-500 font-semibold text-white rounded-lg px-4 py-2">
        Kembali
    </a>
    <div class="headers flex justify-between mt-4">
        <div class="action flex items-center gap-2">

        </div>
    </div>
    <div class="products-container w-full mt-5 bg-white mb-12 rounded-lg flex flex-col gap-3 overflow-hidden">
        <div class="product-description px-6 pt-6 pb-8">
            <h1 class="text-2xl font-bold">Request Top Up dengan Kode: {{ $topup->unique_code }}</h1>

            <div class="input-name flex flex-col mt-2 space-y-2">
                <label class="font-medium" for="">Kode Unik</label>
                <h1 class="text-xl font-semibold">
                    #{{ $topup->unique_code }}
                </h1>
            </div>
            <div class="input-barcode flex flex-col mt-2 space-y-2">
                <label class="font-medium">Nominal Top Up</label>
                <h1 class="text-xl font-semibold">{{ format_to_rp($topup->nominals) }}</h1>
            </div>
            <div class="input-price flex flex-col mt-2 space-y-2">
                <label class="font-medium">Nama Nasabah</label>
                <h1 class="text-xl font-semibold">{{ $topup->user->name }}</h1>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <div class="input-category flex flex-col mt-2 space-y-2">
                    <label class="font-medium">Status</label>
                    @if ($topup->status == 'unconfirmed')
                        <p class="bg-yellow-200 text-yellow-600 px-2 py-1 rounded-lg w-fit">
                            Belum Dikonfirmasi
                        </p>
                    @elseif($topup->status == 'confirmed')
                        <p class="bg-green-200 text-green-600 px-2 py-1 rounded-lg w-fit">
                            Sudah Dikonfirmasi
                        </p>
                    @elseif($topup->status == 'rejected')
                        <p class="bg-red-200 text-red-600 px-2 py-1 rounded-lg w-full">
                            Ditolak
                        </p>
                    @endif
                </div>
                <div class="input-stock flex flex-col mt-2 space-y-2">
                    <label class="font-medium">Saldo Nasabah Saat Ini:</label>
                    <h1 class="text-xl font-semibold">{{ format_to_rp($topup->wallet->credit) }}</h1>
                </div>
            </div>
        </div>
        @if ($topup->status == 'unconfirmed')
            <form action="{{ route('bank.topupconfirm') }}" method="POST" class="self-end m-8">
                @csrf
                <input type="hidden" name="unique_code" value="{{ $topup->unique_code }}">
                <input type="hidden" name="user_id" value="{{ $topup->user->id }}">
                <input type="hidden" name="nominals" value="{{ $topup->nominals }}">
                <button type="submit"
                    class="add-products bg-[#303fe2] text-white px-5 w-fit font-medium py-3 hover:bg-slate-300 hover:text-[#003034] transition cursor-pointer rounded-xl flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check2-all" viewBox="0 0 16 16">
                        <path
                            d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0" />
                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708" />
                    </svg>
                    Konfirmasi
                </button>
            </form>
        @elseif($topup->status == 'confirmed')
            <div class="self-end m-8">
                <button disabled
                    class="add-products bg-green-500 text-white px-5 w-fit font-medium py-3 rounded-xl flex items-center gap-2">
                    Sudah Dikonfirmasi
                </button>
            </div>
        @elseif($topup->status == 'rejected')
            <div class="self-end m-8">
                <button disabled
                    class="add-products bg-red-500 text-white px-5 w-fit font-medium py-3 rounded-xl flex items-center gap-2">
                    Ditolak
                </button>
            </div>
        @endif
    </div>
@endsection
