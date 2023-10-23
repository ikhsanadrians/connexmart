@extends('layouts.admin')
@section('content')
<div class="searchandfilter flex items-center gap-3">
    <div class="search mt-2 relative flex items-center">
        <svg class="absolute left-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
        <input type="text" placeholder="Search User" class="pl-8 pr-4 py-2 rounded-md focus:outline-none">
    </div>
    <div class="filter bg-[#003034] text-white mt-2 p-[11px] rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
            <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
          </svg>
    </div>
</div>
<div class="user-list w-full mt-8 mb-8">
    <table class="w-full">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Balance</th>
                <th>Expenditure</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $clients  as $key => $client)
            <tr>
                <td class="id">{{ $key + 1 }}</td>
                <td class="username-td">{{ $client->name }}</td>
                <td class="balance">{{ format_to_rp($client->wallet[0]->credit) }}</td>
                <td>
                 {{ format_to_rp($client->wallet[0]->debit ) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
