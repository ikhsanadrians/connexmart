@extends('layouts.master')
@section('content')
    <div class="scanner flex flex-col justify-center  overflow-y-hidden h-full pb-16">
        <div class="preview flex justify-center relative overflow-hidden">
            <div class="video-preview overflow-hidden h-[26rem]">
                <video id="preview" class="object-cover"></video>
            </div>
            <div class="scan-effect scan absolute h-48 opacity-30 overflow-hidden">
                <img src="{{ asset("images/static/scaneffect2.png")}}">
            </div>
            <div class="tenbank-icon absolute bottom-8">
                <img class="h-14" src="{{ asset("images/static/tenbank2.png")}}" alt="">
            </div>
        </div>
        <div class="scanner-option flex justify-center gap-4 h-fit py-4 overflow-y-hidden mt-3">
           <div class="camera-option p-4 h-fit bg-white  shadow-md rounded-lg flex flex-col gap-2 justify-center items-center w-fit">
            <span class="material-symbols-rounded text-[#303fe2] text-[35px]">
                cameraswitch
                </span>
            <p class="text-center text-sm font-medium">Ubah Posisi Kamera</p>
           </div>
           <div class="type-code p-4 h-fit  shadow-md gap-2 rounded-lg flex flex-col justify-center items-center w-fit  bg-white">
            <span class="material-symbols-rounded text-[#303fe2] text-[35px]">
                pin
                </span>
            <p class="text-center text-sm font-medium">Ketik Kode Manual</p>
           </div>
        </div>

        <p class="text-center mt-2 text-slate-300 absolute bottom-4 left-5">TenizenBank Scanner V 0.1</p>
    </div>
    @include('components.modalsuccesscan')
@endsection
