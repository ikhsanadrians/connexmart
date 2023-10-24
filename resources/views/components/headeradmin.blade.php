<header class="bg-slate-50 shadow-lg sticky top-0 z-30">
    <div class="py-4 px-4 flex items-center justify-between">
        <div class="title-search flex items-center gap-4">
            <a href="/" class="header-title">
                @if(Auth::user()->role_id == 1)
                  <img src="{{ asset('images/static/connexmart.png') }}" alt="connexmart" class="h-10">
                @else
                <img src="{{ asset('images/static/connexpay.png') }}" alt="connexpay" class="h-10">
                @endif
            </a>
            <p>
                @if(Auth::user()->role_id == 1 )
                   Admin
                @elseif(Auth::user()->role_id == 2)
                   Bank
                @endif
            </p>
        </div>
        <div class="flex">
            <div class="header-menu flex items-center gap-2 mx-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#003034"
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
