<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TenizenMart</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,1,0" />

    <link rel="icon" type="image/png" href="{{ asset('images/static/tenizenmart.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>

<body>
    <main class="container mx-auto lg:px-12 px-3 py-6 lg:py-8">
        <div class="search-container">
            <div class="search-header flex justify-between items-center gap-3 w-full">
                <div class="back mt-1">
                    <a href="javascript:history.back()" class="back">
                        <span class="material-symbols-rounded text-[27px] text-zinc-500">
                            arrow_back
                        </span>
                    </a>
                </div>
                <div class="search-inputs w-full relative">
                    <input id="search-products"
                        class="py-2 px-4 w-full bg-transparent focus:bg-gray-100 bg-gray-100 focus:outline-none focus:border-[1.5px] border-gray-300 border-[1.5px] rounded-lg"
                        type="text" placeholder="Kamu mau cari apa?">
                    <div
                        class="search-button cursor-pointer
                          absolute right-2 top-1 rounded-xl text-white bg-[#303fe2] w-8 h-8 flex items-center justify-center">
                        <span class="material-symbols-rounded text-[18px]">
                            search
                        </span>
                    </div>

                </div>
                <div class="voice-reg mt-1">
                    <span class="material-symbols-rounded text-[#303fe2] text-[27px]">
                        mic
                    </span>
                </div>
            </div>
            <div class="search-list-container">
                <div class="populer-search">
                    <div class="populer-title mt-4 flex items-center gap-1 font-medium text-gray-600">
                        <span class="material-symbols-rounded">
                            whatshot
                        </span>
                        <p class="mt-[2px] text-sm">
                            Pencarian Populer
                        </p>
                    </div>
                    <div class="populer-list flex mt-3 gap-x-3 gap-y-2 flex-wrap">
                        @foreach ($populerSearchs as $populerSearch)
                            <a href="{{ route('show.product', $populerSearch->slug) }}"
                                class="p-list text-sm bg-gray-100 px-3 py-1 rounded-md cursor-pointer duration-200 hover:bg-[#303fe2] hover:text-white font-medium text-gray-600">
                                {{ $populerSearch->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="search-list mt-3">
                </div>
            </div>
        </div>
    </main>
    <script type="module" src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script type="module" src="{{ asset('javascript/script/search.js') }}"></script>
</body>

</html>
