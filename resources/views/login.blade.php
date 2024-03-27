<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    @vite('resources/css/app.css')
</head>

<body class="bg-zinc-100">
    <header class="px-8 py-3 bg-gradient-to-r from-[#303fe2] to-blue-500 text-white shadow-md w-full">
        <div class="icons flex items-center gap-3">
            <img src="{{ asset('images/static/tenizenmart.png') }}" class="h-12 brightness-0 invert-[1]" />
            <h1 class="font-bold text-lg">TenizenMart</h1>
        </div>
    </header>
    <div class="container mx-auto flex justify-center">
        <span id="loader" class="loader hidden-items mt-12"></span>
        <div id="form-wrappers" class="form-wrappers w-full px-4 mt-8 bg-white lg:w-1/3  shadow-lg py-8 rounded-2xl">
            <div class="icons flex justify-center">
                <img src="{{ asset('images/static/tenizenmart.png') }}" class="h-14" />
            </div>
            <div class="title text-[#303fe2] text-center text-lg font-semibold mt-3">
                <h1>Masuk Ke akunmu</h1>
            </div>
            <form method="POST" action="{{ route('auth') }}"
                class="login-form flex flex-col items-center rounded-2xl mt-2 p-6">
                @csrf
                <div class="inputs w-full">
                    <div class="usernameoremailinput w-full">
                        <input name="username" required id="username-input" type="text"
                            class="bg-zinc-100 w-full outline-none focus:border-[#303fe2]  border-[1.5px]  p-4 rounded-lg "
                            placeholder="Email/username">
                    </div>
                    <div class="password-input w-full relative flex items-center">
                        <input name="password" required id="password-input" type="password"
                            class="bg-zinc-100 w-full outline-none focus:border-[#303fe2] border-[1.5px] p-4 rounded-lg mt-5"
                            placeholder="Password">
                        <svg id="showpass" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            fill="currentColor"
                            class="bi bi-eye-fill absolute right-4 bottom-5 fill-zinc-500 cursor-pointer"
                            viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                            <path
                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                        </svg>
                    </div>

                </div>
                <div class="actions mt-5 w-full">
                    <button disabled id="login-btn" type="button"
                        class="disabled bg-[#303fe2] rounded-3xl font-medium text-white w-full py-3">
                        Masuk
                    </button>
                    <div class="registerbtnn text-sm">
                        <p class="text-center text-zinc-500 mt-6">Belum Punya Akun?
                            <span><a class="text-blue-500 cursor-pointer">Buat Sekarang</a></span>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="modal-alert"
        class="modal-alert hidden-items fixed bottom-0 bg-gradient-to-r from-red-600 to-red-500 w-full p-3 gap-2">
        <div class="container mx-auto">
            <div class="alert-warning flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white"
                    class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <p class="text-white font-semibold mt-1 lg:text-base text-sm">
                    Gagal Masuk , Periksa Kembali Username Atau Password!
                </p>
            </div>
        </div>
    </div>
    <div id="modal-alert-success"
    class="modal-alert hidden-items fixed bottom-0 bg-gradient-to-r from-green-600 to-green-500 w-full p-3 gap-2">
    <div class="container mx-auto">
        <div class="alert-warning flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="white" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
              </svg>
            <p class="text-white font-semibold mt-1 lg:text-base text-sm">
                Berhasil Masuk Kembali Ke Akunmu!
            </p>
        </div>
    </div>
</div>
    <script src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('javascript/script/login.js') }}"></script>
</body>

</html>
