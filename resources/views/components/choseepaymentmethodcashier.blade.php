<div
    class="chosee-paymentmethod fixed lg:top-16 bottom-0  z-50 w-full lg:w-[45%]  bg-white  h-fit lg:h-4/5 -translate-x-1/2 left-1/2 shadow-lg overflow-hidden lg:rounded-xl rounded-t-xl">
    <div class="wrappers flex items-center py-4 px-4 lg:px-8 border-b-[1.5px] gap-4">
        <div class="back">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </div>
        <h1 class="text-lg font-medium">Rp 36.000</h1>

    </div>
    <div class="hint mb-8 px-8 py-1 text-sm bg-[#303fe2]/90 text-white">
        Pilih salah satu metode pembayaran!
    </div>
    <div class="content-payment w-full lg:pb-0 pb-12 px-3 lg:px-8 ">
        <div class="cash flex justify-between w-full items-start gap-8">
            <div class="left-cash w-[20%]">
                <p class="font-semibold">Cash</p>
            </div>
            <div class="right-cash w-[80%]">
                <div class="nominals grid grid-cols-3 w-full gap-3">
                    <div class="n-1 border-slate-300 border-[1.3px] w-full px-4 py-2 rounded-md">
                        Rp 36.000
                    </div>
                    <div class="n-1 border-slate-300 border-[1.3px] w-full px-4 py-2 rounded-md">
                        Rp 40.000
                    </div>
                    <div class="n-1 border-slate-300 border-[1.3px] w-full px-4 py-2 rounded-md">
                        Rp 50.000
                    </div>
                </div>
                <div class="input-amount mt-3">
                    <input placeholder="Masukan Jumlah Cash" type="text"
                        class="product-search rounded-md px-4 py-2 w-full focus:outline-none border-slate-300 border-[1.9px]">

                </div>
            </div>
        </div>
        <hr class="mt-8">
        <div class="tenbank flex justify-between w-full items-start gap-8 mt-8">
            <div class="left-tenbank w-[20%]">
                <p class="font-semibold">E-Wallet</p>
            </div>
            <div class="right-tenbank w-[80%]">
                <div class="nominals grid grid-cols-3 w-full gap-3">
                    <div class="n-1 border-slate-300 border-[1.3px] w-full px-4 py-2 rounded-md">
                        <img src="{{ asset('images/static/tenbank2.png') }}" alt=""
                            class="bg-[#303fe2] p-2 rounded-lg">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="next absolute bottom-6 right-6 bg-[#303fe2] text-white py-2 px-4 font-medium rounded-md flex items-center gap-2">
        Konfirmasi
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
        </svg>
    </div>
</div>
