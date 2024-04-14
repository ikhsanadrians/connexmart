<div
    class="insertaddress hidden fixed lg:top-16 bottom-0  z-50 w-full lg:w-5/12 h-fit lg:h-4/5 bg-gray-50 -translate-x-1/2 left-1/2 shadow-lg overflow-hidden lg:rounded-xl rounded-t-xl">
    <div class="wrappers py-6 px-4 lg:px-8">
        <div id="close-btn-insertaddress" class="close group absolute top-7 right-6 cursor-pointer">
            <svg class="fill-red-500" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                class="bi bi-x-lg" viewBox="0 0 16 16">
                <path
                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
            </svg>
        </div>
        <h1 class="text-base lg:text-xl font-semibold">Alamat Pengiriman</h1>
    </div>
    <div class="content-payment w-full lg:pb-0 pb-12 px-3 lg:px-8">
        <div class="nama-penerima">
            <label for="" class="text-sm">Nama Penerima <span class="text-red-500">*</span></label>
            <input value="{{ Auth::user()->recipient_name }}" type="text" name="" id="recipient"
                class=" block py-3 pl-2 mt-2 !w-full bg-transparent focus:bg-zinc-200 focus:outline-none focus:border-[1.5px] text-sm border-gray-300 border-[1.5px] rounded-lg">
        </div>
        <div class="nomor-penerima mt-2">
            <label for="" class="text-sm">Nomor Hp Penerima <span class="text-red-500">*</span></label>
            <input value="{{ Auth::user()->phone_number }}" type="number" name="" id="recipient_phone"
                class=" block py-3 pl-2 mt-2 !w-full bg-transparent focus:bg-zinc-200 focus:outline-none focus:border-[1.5px] text-sm border-gray-300 border-[1.5px] rounded-lg">
        </div>
        <div class="address mt-2">
            <label for="" class="text-sm">Alamat <span class="text-red-500">*</span></label>
            <textarea name="" id="address" rows="4"
                class="textarea resize-x block py-3 pl-2 mt-2 !w-full bg-transparent focus:bg-zinc-200 focus:outline-none focus:border-[1.5px] text-sm border-gray-300 border-[1.5px] rounded-lg"
                placeholder="Contoh: Ruang Teori 1 lantai 1">{{ Auth::user()->address }}</textarea>
        </div>
        <button disabled
            class="btn-confirm-address w-full cursor-pointer disabled-items bg-gradient-to-r from-[#303fe2] to-blue-500 text-center p-3 text-white rounded-3xl font-medium mt-5">
            Confirm Alamat
        </button>
    </div>
</div>
