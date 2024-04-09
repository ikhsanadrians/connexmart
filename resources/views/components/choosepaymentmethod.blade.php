<div
    class="chosee-paymentmethod hidden fixed lg:top-16 bottom-0  z-50 w-full lg:w-3/4 h-fit lg:h-4/5 bg-gray-50 -translate-x-1/2 left-1/2 shadow-lg overflow-hidden lg:rounded-xl rounded-t-xl">
    <div class="wrappers py-6 px-4 lg:px-8">
        <div id="close-btn-paymentmethod" class="close group absolute top-7 right-6 cursor-pointer">
            <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                class="bi bi-x-lg" viewBox="0 0 16 16">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
            </svg>
        </div>
        <h1 class="text-base lg:text-xl font-semibold">Metode Pembayaran</h1>
    </div>
    <div class="content-payment w-full lg:pb-0 pb-12 px-3 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-3">
        <div
            class="payment-list border-[1px] max-h-[250px] lg:h-[330px] lg:max-h-[330px] overflow-x-hidden overflow-y-auto rounded-xl border-zinc-300">
            <div
                class="tenizen-bank relative p-4 border-b-[1px] border-zinc-300 flex justify-between items-center gap-2">
                <div class="payments relative">
                    <div class="payment-name">
                        <img src="{{ asset('images/static/tenbank2.png') }}" alt=""
                            class="bg-[#303fe2] h-8 p-1 rounded-lg mb-1">
                        <p class="font-medium lg:text-base text-sm">
                            Bayar dengan TenizenBank
                        </p>
                    </div>
                    <div class="expanded-payment duration-300 hidden">
                        <div class="tenbank-cod flex items-center gap-2">
                            <div class="radio-select mt-2">
                                <input value="tb-1" id="radio-tenbank" type="radio" name="radio-group"
                                    class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            </div>
                            <div class="mt-1 text-sm text-zinc-500">
                                Antar Ke Tempat
                            </div>
                        </div>
                        <div class="tenbank-ambil flex items-center gap-2">
                            <div class="radio-select mt-2">
                                <input value="tb-2" id="radio1" type="radio" name="radio-group"
                                    class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            </div>
                            <div class="mt-1 text-sm text-zinc-500">
                                Ambil Ke Kantin
                            </div>
                        </div>
                    </div>
                </div>
                <div class="arrow extend-tenbank absolute top-4 right-4">
                    <span class="material-symbols-rounded text-[35px] cursor-pointer -mr-2 text-zinc-400">
                        expand_more
                    </span>
                </div>
            </div>
            <div class="bayar-dikantin p-4 border-b-[1px] border-zinc-300 flex justify-between items-center gap-2">
                <div class="payment-name">
                    <span class="material-symbols-rounded text-[#303fe2] text-[35px]">
                        point_of_sale
                    </span>
                    <p class="font-medium lg:text-base text-sm">
                        Bayar di Kantin
                    </p>
                </div>
                <div class="radio-select">
                    <input value="bdk" id="radio1" type="radio" name="radio-group"
                        class="form-radio h-5 w-5 text-indigo-600 transition duration-150 ease-in-out">
                </div>
            </div>
            <div class="cod p-4 flex justify-between items-center gap-2 h-fit">
                <div class="payment-name">
                    <span class="material-symbols-rounded text-[#303fe2] text-[35px]">
                        approval_delegation
                    </span>
                    <p class="font-medium lg:text-base text-sm">
                        Cash On Delivery ( COD )
                    </p>
                </div>
                <div class="radio-select">
                    <input value="cod" id="radio1" type="radio" name="radio-group"
                        class="form-radio h-5 w-5 text-indigo-600 transition duration-150 ease-in-out">
                </div>
            </div>

        </div>
        <div class="payment-selection  w-full h-full">
            <div class="payment-description w-full h-full lg:block hidden">
                <div class="tenizen-bank-desc hidden border-[1px] p-4 h-full rounded-xl border-zinc-300">
                    <div class="payment-title font-medium">
                        <h1>Bayar dengan TenizenBank</h1>
                    </div>
                    <div class="payment-icon mt-1 flex items-center gap-2">
                        <img src="{{ asset('images/static/tenbank2.png') }}" alt=""
                            class="bg-[#303fe2] h-7 p-1 rounded-lg mb-1">
                        <p class="text-sm">Bank Tenizen</p>
                    </div>
                    <hr class="mt-3">
                    <div class="rules mt-2">
                        <ul class="list-disc list-inside text-sm">
                            <li class="text-zinc-500">Pilih metode pembayaran ini untuk melakukan pembayaran dengan
                                saldo
                                TenizenBank
                            </li>
                            <li class="text-zinc-500 pt-2">
                                Pilih Metode pengambilan "Antar Ke Tempat", jika kamu ingin petugas kami mengirimkan
                                produk
                                ke tempatmu
                            </li>
                            <li class="text-zinc-500 pt-2">
                                Pilih Metode pengambilan "Ambil Ke Kantin", jika kamu ingin mengambil produk sendiri di
                                kantin
                                , dan tidak perlu membayar uang lagi
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="bayar-di-kantin-desc hidden border-[1px] p-4 h-full rounded-xl border-zinc-300">
                    <div class="payment-title font-medium">
                        <h1>Bayar di Kantin</h1>
                    </div>
                    <div class="payment-icon mt-1 flex items-center gap-2">
                        <span class="material-symbols-rounded text-[#303fe2] text-[35px]">
                            point_of_sale
                        </span>
                    </div>
                    <hr class="mt-3">
                    <div class="rules mt-2">
                        <ul class="list-disc list-inside text-sm">
                            <li class="text-zinc-500">Pilih metode pembayaran ini untuk melakukan pemesanan produk</li>
                            <li class="text-zinc-500 pt-2">
                                Petugas kami akan mempersiapkan produk yang kamu order
                            </li>
                            <li class="text-zinc-500 pt-2">
                                Apalagi petugas kami sudah selesai , kami akan memberitahukan kamu dan kamu dapat
                                mengambil
                                produk serta membayarnya di kantin
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="cod-desc hidden border-[1px] p-4 h-full rounded-xl border-zinc-300">
                    <div class="payment-title font-medium">
                        <h1>Cash On Delivery ( COD )</h1>
                    </div>
                    <div class="payment-icon mt-1 flex items-center gap-2">
                        <span class="material-symbols-rounded text-[#303fe2] text-[35px]">
                            approval_delegation
                        </span>
                    </div>
                    <hr class="mt-3">
                    <div class="rules mt-2">
                        <ul class="list-disc list-inside text-sm">
                            <li class="text-zinc-500">Pilih metode pembayaran ini untuk melakukan pemesanan produk
                                secara
                                COD</li>
                            <li class="text-zinc-500 pt-2">
                                Petugas kami akan mempersiapkan produk yang kamu order dan mengantar ke tempatmu
                            </li>
                            <li class="text-zinc-500 pt-2">
                                Apabila petugas kami sudah sampai, kamu bisa mengambil produk dan membayarnya </li>
                        </ul>
                    </div>
                </div>
            </div>
            <button disabled
                class="btn-payment-method-confirm w-full cursor-pointer disabled-items bg-gradient-to-r from-[#303fe2] to-blue-500 text-center p-3 text-white rounded-3xl font-medium mt-3">
                Pilih Metode
            </button>
        </div>

    </div>
</div>
