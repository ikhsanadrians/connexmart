<div
    class="chosee-paymentmethod hidden fixed lg:top-16 bottom-0  z-50 w-full lg:w-[45%]  bg-white  h-fit lg:h-4/5 -translate-x-1/2 left-1/2 shadow-lg overflow-hidden lg:rounded-xl rounded-t-xl">
    <div class="wrappers flex items-center justify-between py-4 px-4 lg:px-8 border-b-[1.5px] gap-4">
        <div class="back-and-title flex items-center gap-4">
            <div class="back-cpm cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </div>
            <div class="title font-medium text-[17px]">
                Metode Bayar
            </div>
        </div>
        <h1 class="order-price-info text-lg font-medium"></h1>
    </div>
    <div class="hint-content">
        <div class="hint mb-8 px-8 py-1 text-sm bg-gradient-to-r from-[#303fe2] to-blue-500 text-white">
            Pilih salah satu metode pembayaran!
        </div>
        <div class="content-payment w-full lg:pb-0 pb-12 px-3 lg:px-8 ">
            <div class="cash flex justify-between w-full items-start gap-8">
                <div class="left-cash w-[20%]">
                    <p class="font-semibold">Cash</p>
                </div>
                <div class="right-cash w-[80%]">
                    <div class="nominals rupiah-amounts grid grid-cols-3 w-full gap-3">

                    </div>
                    <div class="input-amount mt-3 relative">
                        <span class="font-semibold absolute top-3 left-3">Rp</span>
                        <input id="cash-4" placeholder="Masukan Jumlah Cash" type="text"
                            class="cash-amount-input  nominal rounded-md pl-10 pr-4 py-3 w-full focus:outline-none border-slate-300 border-[1.9px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                            class="bi bi-check-circle-fill rupiah-check hidden absolute top-[14px] right-3 text-green-600"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
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
                        <button id="tenbank"
                            class="n-4 nominal z-20 border-slate-300 border-[1.3px] w-full px-4 py-2 rounded-md">
                            <img src="{{ asset('images/static/tenbank2.png') }}" alt=""
                                class="bg-[#303fe2] p-2 rounded-lg pointer-events-none">
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="next-confirm absolute bottom-6 right-6 bg-[#303fe2] text-white py-2 px-4 font-medium rounded-md flex items-center gap-2">
            Konfirmasi
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
            </svg>
        </div>
    </div>
</div>

</div>
