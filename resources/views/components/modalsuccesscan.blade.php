<div id="success-scan"
    class="success-scan-mobile hidden-items !hide-animation h-1/2 fixed bottom-0 z-50 w-full bg-white shadow-2xl rounded-tl-3xl rounded-tr-3xl">
    <div class="wrappers relative px-4 py-6">
        <div class="header flex justify-between items-center">
            <div class="logo-mart flex items-center gap-1">
                <img src="{{ asset('images/static/tenizenmart.png') }}" alt="" class="h-12">
                <div class="tm flex flex-col leading-[18px]">
                    <p class="font-semibold">TenizenMart</p>
                    <p class="text-sm">Payment</p>
                </div>
            </div>
            <button id="closeqtyeditor" class="button-close cursor-pointer">
                <span class="material-symbols-rounded text-red-500">
                    close
                </span>
            </button>
        </div>
        <div class="scanner-content mt-3">
            <div class="scanner-price">
                <h1 id="transaction-price" class="text-3xl font-semibold"></h1>
            </div>
            <div class="scanner-message mt-1 text-slate-500">
                <p>
                    Pembayaran Pembelian TenizenMart
                </p>
            </div>
            <div class="scanner-code mt-2">
                <label for="" class="text-sm text-slate-500 font-medium">Kode Transaksi</label>
                <h1 id="transaction-code" class="text-xl font-semibold"></h1>
            </div>
            <div class="scanner-timestamp">
                <label for="" class="text-sm text-slate-500 font-medium">Tanggal Transaksi</label>
                <h1 id="transaction-timestamp" class="text-xl font-semibold"></h1>
            </div>
            <div class="scanner-qty">
                <label for="" class="text-sm text-slate-500 font-medium">Kuantitas</label>
                <h1 id="transaction-qty" class="text-xl font-semibold"></h1>
            </div>
        </div>
        <div class="scanner-confirm-button cursor-pointer flex justify-end mt-2">
            <div class="button bg-[#303fe2] text-white py-3 px-5 font-medium rounded-3xl flex items-center gap-1 w-fit">
                Konfirmasi
                <span class="material-symbols-rounded">
                    verified_user
                </span>
            </div>
        </div>
    </div>

</div>
