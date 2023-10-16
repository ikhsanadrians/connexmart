@extends('layouts.master')
@section('content')
    <div class="flex w-full gap-4">
        <div class="bg-white h-3/4 w-4/6 mt-6 rounded-md p-4">
            <div class="profiles-title flex gap-2  font-semibold text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#003034" class="bi bi-person-circle"
                    viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <p>My Profile</p>
            </div>
            <div class="description py-2">
                <p class="text-base">
                    Name: {{ Auth::user()->name }}
                </p>
                <p class="text-base">
                    Joined Date : {{ Auth::user()->created_at }}
                </p>

            </div>
        </div>
        <div class="bg-white h-3/4 w-2/4 mt-6 rounded-md p-4">
            <p class="font-semibold text-xl">Mutation History</p>
            <ul>
                @foreach ($transactions as $transaction)
                    <li>[{{ $transaction->created_at }}]: {{ $transaction->product->name }} | Rp. {{ $transaction->price }}
                        | {{ $transaction->status }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
