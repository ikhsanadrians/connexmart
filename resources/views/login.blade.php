<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-zinc-100">
    <header class="px-8 py-4 bg-[#303fe2] text-white w-full">
        <h1 class="font-bold">TenizenMart</h1>
     </header>
    <div class="container mx-auto flex justify-center">
             <div class="form-wrappers w-full px-4 mt-8 bg-white lg:w-1/3  shadow-lg py-8 rounded-2xl">
                 <div class="title text-[#303fe2] text-center text-lg font-semibold">
                     <h1>Masuk Ke akunmu</h1>
                 </div>
                 <div class="login-form flex flex-col items-center rounded-2xl mt-2 p-6">
                     <div class="inputs">
                         <input type="text" class="bg-zinc-100 outline-none focus:outline-[#303fe2] p-4 rounded-lg w-full" placeholder="Email/username">
                         <input type="password" class="bg-zinc-100 outline-none focus:outline-[#303fe2] p-4 rounded-lg w-full mt-5" placeholder="Password">
                     </div>
                     <div class="actions mt-5 lg:w-1/3 w-full">
                         <button type="submit" class="bg-[#303fe2] rounded-3xl font-medium text-white w-full py-3">
                             Masuk
                         </button>
                         <p class="">Belum Punya Akun?</p>
                     </div>
                 </div>
        </div>
     
    </div>

</body>
</html>
