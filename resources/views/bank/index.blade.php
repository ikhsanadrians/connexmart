@extends('layouts.admin')
@section('content')
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <div class="card p-8 rounded-md bg-white shadow-md">
        <div class="card-top flex justify-between items-center">
            <div class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#003034" class="bi bi-people-fill" viewBox="0 0 16 16">
                  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                </svg>
            </div>
            <div class="notif flex items-center gap-1 bg-[#003034] text-white px-3 py-1 text-xs rounded-2xl">
                32%
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                  </svg>
            </div>
        </div>
        <div class="card-bottom mt-8">
            <h1 class="font-bold text-xl">167</h1>
            <p class="text-zinc-500">Client</p>
        </div>
     </div>
     <div class="card p-8 rounded-md bg-white shadow-md">
        <div class="card-top flex justify-between items-center">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#003034" class="bi bi-bar-chart-steps" viewBox="0 0 16 16">
                    <path d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0zM2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z"/>
                  </svg>
            </div>
            <div class="notif flex items-center gap-1 bg-[#003034] text-white px-3 py-1 text-xs rounded-2xl">
                12%
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                  </svg>
            </div>
        </div>
        <div class="card-bottom mt-8">
            <h1 class="font-bold text-xl">1084</h1>
            <p class="text-zinc-500">Top Up Request</p>
        </div>
     </div>
     <div class="card p-8 rounded-md bg-white shadow-md">
        <div class="card-top flex justify-between items-center">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#003034" class="bi bi-box" viewBox="0 0 16 16">
                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
                  </svg>
            </div>
            <div class="notif flex items-center gap-1 bg-[#003034] text-white px-3 py-1 text-xs rounded-2xl">
                54%
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                  </svg>
            </div>
        </div>
        <div class="card-bottom mt-8">
            <h1 class="font-bold text-xl">126</h1>
            <p class="text-zinc-500">Transactions</p>
        </div>
     </div>
  </div>
  <div class="grid grid-cols-2 gap-4 mt-8">
    <div class="notification bg-gradient-to-r shadow-md p-6 from-[#003034] to-gray-800 h-full  rounded-md">
        <div class="wrappers flex gap-8">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="white" class="bi bi-bell-fill" viewBox="0 0 16 16">
                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
              </svg>
            <div class="notif-text text-white text-xl font-bold">
                There's 64 Notifications!
                <div class="notif-list">
                    <ul class="text-sm font-normal list-inside list-disc text-gray-300">
                        <li>
                            Fix Products!
                        </li>
                        <li>
                            Fix Top Up proceed
                        </li>
                        <li>
                            Sync Transaction With ConnexPay API
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <div class="report relative bg-gradient-to-r p-6 shadow-md from-[#003034] to-gray-800 h-full rounded-md">
        <div class="wrappers flex gap-8">
            <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="white" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z"/>
                <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z"/>
              </svg>
            <div class="report-text  text-white text-xl font-bold">
                Generate Report
                <div class="report-list text-sm font-normal text-gray-200">
                   <p>Do You Want Generate Report This Month?</p>
                </div>
            </div>
        </div>
        <div class="button absolute duration-200 hover:opacity-90 hover:shadow-slate-600 hover:scale-95 hover:shadow-md right-4 bottom-4 border-[1.5px] px-3 py-1 rounded-md cursor-pointer border-gray-500 text-white flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
              </svg>
            Generate
        </div>
    </div>
  </div>
  <div class="user-list w-full mt-8 mb-8">
    <table class="w-full">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Unique Code</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
         @foreach ( $topups as $key => $topup )
         <tr>
             <td>{{ $key + 1 }}</td>
             <td>{{ $topup->user->name }}</td>
             <td>{{ $topup->unique_code }}</td>
             <td>{{ $topup->created_at }}</td>
             <td class="flex justify-center">
                @if($topup->status == "unconfirmed")
                 <div class="bg-gradient-to-r from-red-400 font-semibold to-red-600 shadow-md w-fit px-3 py-[5px] rounded-md text-white flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                        <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2V3zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8 5.829 5.854z"/>
                      </svg>
                     Unconfirm
                 </div>
                @else
                 <div class="bg-gradient-to-r from-green-400 font-semibold to-emerald-600 shadow-md w-fit px-3 py-[5px] rounded-md text-white flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-fill-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z"/>
                      </svg>
                     Confirmed
                 </div>

                @endif
             </td>
        </tr>
         @endforeach
        </tbody>
      </table>
  </div>

@endsection
