<aside class="z-990 bg-[#303fe2] lg:block hidden w-60 min-h-screen fixed p-6 text-white">
    <div class="wrappers-menu flex flex-col gap-4">
        @if (Auth::user()->role_id == 2)
            <a href="{{ route('bank.index') }}"
                class="home hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('bank.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                </svg>
                Home
            </a>
            <a href="{{ route('bank.client') }}"
                class="home hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('bank.client')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path
                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                </svg>
                Client
            </a>
            <a href="{{ route('bank.transaction') }}"
                class="home hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('bank.transaction')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-bar-chart-steps" viewBox="0 0 16 16">
                    <path
                        d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0zM2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
                </svg>
                Transaction
            </a>
            <a href="{{ route('bank.topup') }}"
                class="home hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('bank.topup')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-wallet-fill" viewBox="0 0 16 16">
                    <path
                        d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z" />
                    <path
                        d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z" />
                </svg>
                Top Up Request
            </a>
            <a href="{{ route('bank.topup') }}"
                class="home hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('admin.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-cash-coin" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                    <path
                        d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                    <path
                        d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                </svg>
                New Top Up
            </a>
            <a href="{{ route('bank.logout') }}"
                class="transaction fixed bottom-4 hover:bg-slate-300 hover:text-[#003034] transition text-sm  px-3 py-2 flex items-center gap-3 @if (request()->routeIs('notification.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                    <path fill-rule="evenodd"
                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                </svg>
                Logout
            </a>
        @endif
        @if (Auth::user()->role_id == 1)
            <a href="{{ route('admin.index') }}"
                class="home hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('admin.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                </svg>
                Home
            </a>
            <a href="{{ route('user.index') }}"
                class="flex hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm items-center gap-3 px-3 py-2 @if (request()->routeIs('user.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path
                        d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                </svg>
                Add User
            </a>
            <a href="{{ route('entry.index') }}"
                class="flex hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm items-center gap-3 px-3 py-2 @if (request()->routeIs('entry.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-bar-chart-steps" viewBox="0 0 16 16">
                    <path
                        d="M.5 0a.5.5 0 0 1 .5.5v15a.5.5 0 0 1-1 0V.5A.5.5 0 0 1 .5 0zM2 1.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1-.5-.5v-1zm2 4a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-1z" />
                </svg>
                Entry Transaction
            </a>
            <a href="{{ route('setting.index') }}"
                class="transaction hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('setting.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path
                        d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                </svg>
                Settings
            </a>
            <a href="{{ route('notification.index') }}"
                class="transaction hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm  px-3 py-2 flex items-center gap-3 @if (request()->routeIs('notification.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                </svg>
                Notifications
            </a>
            <a href="{{ route('admin.logout') }}"
                class="transaction fixed bottom-4 hover:bg-slate-300 hover:text-[#003034] transition   rounded text-sm  px-3 py-2 flex items-center gap-3 @if (request()->routeIs('logout')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                    <path fill-rule="evenodd"
                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                </svg>
                Logout
            </a>
        @endif
        @if (Auth::user()->role_id == 3)
            <a href="{{ route('mart.index') }}"
                class="home hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('mart.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                </svg>
                Home
            </a>
            <a href="{{ route('mart.goods') }}"
                class="flex hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm items-center gap-3 px-3 py-2 @if (request()->routeIs('mart.goods')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.004-.001.274-.11a.75.75 0 0 1 .558 0l.274.11.004.001 6.971 2.789Zm-1.374.527L8 5.962 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339Z" />
                </svg>
                Produk
            </a>
            <a href="{{ route('mart.goods.category') }}"
                class="transaction hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('mart.goods.category')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg width="19" height="20" viewBox="0 0 19 20" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7.57031 9.40625H2.52344C2.16912 9.40625 1.82932 9.2655 1.57879 9.01496C1.32825 8.76443 1.1875 8.42462 1.1875 8.07031V3.02344C1.1875 2.66912 1.32825 2.32932 1.57879 2.07879C1.82932 1.82825 2.16912 1.6875 2.52344 1.6875H7.57031C7.92462 1.6875 8.26443 1.82825 8.51496 2.07879C8.7655 2.32932 8.90625 2.66912 8.90625 3.02344V8.07031C8.90625 8.42462 8.7655 8.76443 8.51496 9.01496C8.26443 9.2655 7.92462 9.40625 7.57031 9.40625ZM16.4766 9.40625H11.4297C11.0754 9.40625 10.7356 9.2655 10.485 9.01496C10.2345 8.76443 10.0938 8.42462 10.0938 8.07031V3.02344C10.0938 2.66912 10.2345 2.32932 10.485 2.07879C10.7356 1.82825 11.0754 1.6875 11.4297 1.6875H16.4766C16.8309 1.6875 17.1707 1.82825 17.4212 2.07879C17.6717 2.32932 17.8125 2.66912 17.8125 3.02344V8.07031C17.8125 8.42462 17.6717 8.76443 17.4212 9.01496C17.1707 9.2655 16.8309 9.40625 16.4766 9.40625ZM7.57031 18.3125H2.52344C2.16912 18.3125 1.82932 18.1717 1.57879 17.9212C1.32825 17.6707 1.1875 17.3309 1.1875 16.9766V11.9297C1.1875 11.5754 1.32825 11.2356 1.57879 10.985C1.82932 10.7345 2.16912 10.5938 2.52344 10.5938H7.57031C7.92462 10.5938 8.26443 10.7345 8.51496 10.985C8.7655 11.2356 8.90625 11.5754 8.90625 11.9297V16.9766C8.90625 17.3309 8.7655 17.6707 8.51496 17.9212C8.26443 18.1717 7.92462 18.3125 7.57031 18.3125ZM16.4766 18.3125H11.4297C11.0754 18.3125 10.7356 18.1717 10.485 17.9212C10.2345 17.6707 10.0938 17.3309 10.0938 16.9766V11.9297C10.0938 11.5754 10.2345 11.2356 10.485 10.985C10.7356 10.7345 11.0754 10.5938 11.4297 10.5938H16.4766C16.8309 10.5938 17.1707 10.7345 17.4212 10.985C17.6717 11.2356 17.8125 11.5754 17.8125 11.9297V16.9766C17.8125 17.3309 17.6717 17.6707 17.4212 17.9212C17.1707 18.1717 16.8309 18.3125 16.4766 18.3125Z"
                        fill="currentColor" />
                </svg>
                Kategori Produk
            </a>
            <a href="{{ route('mart.transactions') }}"
                class="flex hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm items-center gap-3 px-3 py-2 @if (request()->routeIs('mart.transactions')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg width="21" height="16" viewBox="0 0 21 16" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.75 2.45834H20M5.75 8.00001H20M5.75 13.5417H20" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M1.79167 3.25001C2.22889 3.25001 2.58333 2.89556 2.58333 2.45834C2.58333 2.02111 2.22889 1.66667 1.79167 1.66667C1.35444 1.66667 1 2.02111 1 2.45834C1 2.89556 1.35444 3.25001 1.79167 3.25001Z"
                        fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M1.79167 8.79168C2.22889 8.79168 2.58333 8.43724 2.58333 8.00001C2.58333 7.56278 2.22889 7.20834 1.79167 7.20834C1.35444 7.20834 1 7.56278 1 8.00001C1 8.43724 1.35444 8.79168 1.79167 8.79168Z"
                        fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M1.79167 14.3333C2.22889 14.3333 2.58333 13.9789 2.58333 13.5417C2.58333 13.1044 2.22889 12.75 1.79167 12.75C1.35444 12.75 1 13.1044 1 13.5417C1 13.9789 1.35444 14.3333 1.79167 14.3333Z"
                        fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                Daftar Transaksi
            </a>
            <a href="{{ route('mart.cashier') }}"
                class="flex hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm items-center gap-3 px-3 py-2 @if (request()->routeIs('entry.index')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-basket3-fill" viewBox="0 0 16 16">
                    <path
                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z" />
                </svg>
                Mode Kasir
            </a>
            <a href="{{ route('mart.cashier.shift') }}"
                class="flex hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm items-center gap-3 px-3 py-2 @if (request()->routeIs('mart.cashier.shift')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-cash-coin" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                    <path
                        d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                    <path
                        d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                </svg>
                Kas / Shift Kasir
            </a>
            <a href="{{ route('penerimaanstok.index') }}"
                class="flex hover:bg-slate-300 hover:text-[#003034] rounded transition text-sm items-center gap-3 px-3 py-2 @if (request()->routeIs('penerimaanstok.index') || request()->routeIs('penerimaanstok.create')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box2-fill" viewBox="0 0 16 16">
                    <path
                        d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zM15 4.667V5H1v-.333L1.5 4h6V1h1v3h6z" />
                </svg>
                </svg>
                Stok Produk
            </a>
            <a href="{{ route('mart.logout') }}"
                class="transaction fixed bottom-4 hover:bg-slate-300 hover:text-[#003034] transition  rounded text-sm px-3 py-2 flex items-center gap-3 @if (request()->routeIs('logout')) bg-gradient-to-r from-gray-200 to-white text-[#003034] rounded-md font-semibold @endif">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                    <path fill-rule="evenodd"
                        d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                </svg>
                Logout
            </a>
        @endif
    </div>
</aside>
