@extends('layouts.master')
@push('scripts') 
   <script type="module" src="{{ asset('javascript/script/search.js') }}"></script>  
@endpush
@section('content')
<div class="search-query-header lg:p-0 p-4">
    <div class="title">
        Hasil Untuk "<span class="font-semibold">{{ $query }}<span>"
    </div>
</div>
<div class="search-query-content flex lg:flex-row flex-col lg:px-0 px-4 pt-4 gap-x-3">
     <div class="content-filter w-full lg:w-[20%] bg-white border-[1.2px] border-slate-200 shadow-sm rounded-lg p-4 h-fit">
        <div class="filter-products-title font-semibold mb-3">
            Urutkan
        </div>
        <div class="filter-lists flex flex-col gap-y-2">
            <div class="relevant filter text-gray-600 flex gap-2">
                <div class="filter-input flex items-center justify-center relative">
                    <input class="filter-checkout h-5 w-5 peer shrink-0 relative checked:fill-white rounded-md border-2 border-[#303fe2] focus:outline-none checked:bg-[#303fe2] disabled:border-[1.5px] disabled:border-gray-300 appearance-none"
                        type="radio" name="checkfilter" id="check-relevant">
                    <span
                        class="material-symbols-rounded pointer-events-none absolute left-0 text-[20px] text-white invisible peer-checked:visible">
                        done
                    </span>
                </div>
                <label for="sort-name">Paling Sesuai</label>
            </div>
            <div class="base-on-rating filter text-gray-600 flex gap-2">
                <div class="filter-input flex items-center justify-center relative">
                    <input class="filter-checkout h-5 w-5 peer shrink-0 relative checked:fill-white rounded-md border-2 border-[#303fe2] focus:outline-none checked:bg-[#303fe2] disabled:border-[1.5px] disabled:border-gray-300 appearance-none"
                        type="radio" name="checkfilter" id="check-rating">
                    <span
                        class="material-symbols-rounded pointer-events-none absolute left-0 text-[20px] text-white invisible peer-checked:visible">
                        done
                    </span>
                </div>
                <label for="sort-name">Ulasan</label>
            </div>
            <div class="newest filter text-gray-600 flex gap-2">
                <div class="filter-input flex items-center justify-center relative">
                    <input class="filter-checkout h-5 w-5 peer shrink-0 relative checked:fill-white rounded-md border-2 border-[#303fe2] focus:outline-none checked:bg-[#303fe2] disabled:border-[1.5px] disabled:border-gray-300 appearance-none"
                        type="radio" name="checkfilter" id="check-newest">
                    <span
                        class="material-symbols-rounded pointer-events-none absolute left-0 text-[20px] text-white invisible peer-checked:visible">
                        done
                    </span>
                </div>
                <label for="sort-name">Terbaru</label>
            </div>
            <div class="price-highest filter text-gray-600 flex gap-2">
                <div class="filter-input flex items-center justify-center relative">
                    <input class="filter-checkout h-5 w-5 peer shrink-0 relative checked:fill-white rounded-md border-2 border-[#303fe2] focus:outline-none checked:bg-[#303fe2] disabled:border-[1.5px] disabled:border-gray-300 appearance-none"
                        type="radio" name="checkfilter" id="check-pricehighest">
                    <span
                        class="material-symbols-rounded pointer-events-none absolute left-0 text-[20px] text-white invisible peer-checked:visible">
                        done
                    </span>
                </div>
                <label for="sort-name">Harga Tertinggi</label>
            </div>
            <div class="price-lowest filter text-gray-600 flex gap-2">
                <div class="filter-input flex items-center justify-center relative">
                    <input class="filter-checkout h-5 w-5 peer shrink-0 relative checked:fill-white rounded-md border-2 border-[#303fe2] focus:outline-none checked:bg-[#303fe2] disabled:border-[1.5px] disabled:border-gray-300 appearance-none"
                        type="radio" name="checkfilter" id="check-pricelowest">
                    <span
                        class="material-symbols-rounded pointer-events-none absolute left-0 text-[20px] text-white invisible peer-checked:visible">
                        done
                    </span>
                </div>
                <label for="sort-name">Harga Terendah</label>
            </div>
        </div>
     </div>
     <div class="content-products w-full lg:w-[80%] grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-5">
        @foreach ($searchValues as $searchValue)
        <a href="{{ route('show.product', $searchValue->slug) }}"
            class="searchValue-card border-gray-200 bg-white overflow-hidden h-auto rounded-md shadow-sm hover:shadow-md border-[1.5px] ">
            <div class="content-img w-full h-[170px] overflow-hidden">
                @if (!empty($searchValue->photo) && File::exists(public_path($searchValue->photo)))
                    <img src="{{ asset($searchValue->photo) }}" alt="" class="w-full h-full object-cover">
                @else
                    <img src="{{ asset('images/default/mart.png') }}" alt=""
                        class="w-full h-full object-cover">
                @endif
            </div>
            <div class="content  p-4">
                @if (!Auth::check() || Auth::user()->role_id !== 4)
                    <h1 class="lg:text-base text-sm">{{ $searchValue->name }}</h1>
                    <p class="font-semibold text-black">{{ format_to_rp($searchValue->price) }}</p>
                @else
                    <h1 class="lg:text-base text-sm">{{ $searchValue->name }}</h1>
                    <p class="font-semibold text-black">{{ format_to_rp($searchValue->price) }}</p>
                    <div class="searchValue-action w-full h-full gap-2 mt-3">
                        <div class="action-right lg:text-base text-xs flex items-center gap-1 text-zinc-500">
                            <div class="rating flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                    fill="currentColor" class="bi bi-star-fill fill-yellow-500 -mt-[1.2px]"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                </svg>
                                4.5
                            </div>
                            •
                            <p>Terjual {{ $searchValue->quantity_sold }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </a>

        @endforeach
     </div>
</div>


@endsection