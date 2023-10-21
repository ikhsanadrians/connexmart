<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto flex justify-center mt-8">

        <div class="login-forms mt-4 w-1/3 bg-white p-8">
            <div class="admin flex items-center gap-3 font-bold mb-5">
                <img class="h-5" src="{{ asset('images/static/cnxgroup.png') }}" alt="">
                <p>Admin</p>
            </div>

            <form method="POST" action="{{ route('admin.auth.proceed') }}" class="mb-8">
                @csrf
                <div class="user-id">
                    <label for="">Email Or Username</label>
                    <input name="username" id="user-id"
                        class="w-full mt-2 px-4 py-2 bg-gray-100 rounded-md focus:outline-none focus:border-[#003034] focus:border-2"
                        type="text" placeholder="Enter Your Username/Email">
                </div>
                <div class="user-password mt-4">
                    <label for="">Password</label>
                    <input name="password" type="password" id="user-password"
                        class="w-full mt-2 px-4 py-2 bg-gray-100 rounded-md focus:outline-none focus:border-[#003034] focus:border-2"
                        type="text" placeholder="Enter Your Password">
                </div>
                <div class="user-remember flex items-center gap-2 mt-3">
                    <input type="checkbox">
                    <p>Remember Me</p>
                </div>

                <button type="submit" id="submit-login"
                    class="w-full bg-[#003034] text-white font-semibold p-2 rounded-md mt-4">Login</button>
            </form>
        </div>
    </div>

</body>
</html>
