<header class="bg-slate-50 shadow-lg sticky top-0 z-30">
    <div class="py-4 px-4 flex items-center justify-between">
        <div class="title-search flex items-center gap-4">
            <div class="icon pr-4 flex-none @if (Route::is('home')) block @else lg:block hidden @endif">
                <a href="/" class="header-title flex items-center gap-2 w-full h-full">
                    <img src="{{ asset('images/static/tenizenmart.png') }}" alt="connexmart"
                        class="h-8 @if (Route::is('home')) block @else lg:block hidden @endif">
                    <p class="font-semibold text-xl text-[#303fe2] lg:block hidden">
                        TenizenMart
                    </p>
                </a>
            </div>
        </div>
        <div class="flex">
            <div class="header-menu flex items-center gap-2 mx-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#303fe2"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>
</header>
