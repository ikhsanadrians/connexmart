@extends('layouts.master')
@section('content')

   <div class="login hidden fixed z-50 w-3/5 h-3/4 bg-white -translate-x-1/2 left-1/2 shadow-lg overflow-hidden rounded-lg">
      <div class="wrappers flex h-full w-full">
        <div class="login-ilustration w-1/2 h-full">
            <img src="{{ asset('images/static/martgroup.png')}}" alt="" class="h-full w-full object-cover">
        </div>
        <div class="login-input-group relative w-1/2 p-4">
            <div id="close-btn" class="close group absolute top-4 right-4">
                <svg class="group-hover:fill-red-500" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                  </svg>
            </div>
            <div class="login-header">
                <div class="login-title font-semibold text-center text-2xl">
                    <p>Login</p>
                </div>
            </div>
            <div class="login-error hidden text-center w-full mt-2 bg-red-200 py-2 rounded-md">
                <p>Username or Password Incorrect!</p>
            </div>
            <div class="login-forms mt-4">
                <form>
                    <div class="user-id">
                        <label for="">Email Or Username</label>
                        <input id="user-id" class="w-full mt-2 px-4 py-2 bg-gray-100 rounded-md focus:outline-none focus:border-[#003034] focus:border-2" type="text" placeholder="Enter Your Username/Email">
                    </div>
                    <div class="user-password mt-4">
                        <label for="">Password</label>
                        <input type="password" id="user-password" class="w-full mt-2 px-4 py-2 bg-gray-100 rounded-md focus:outline-none focus:border-[#003034] focus:border-2" type="text" placeholder="Enter Your Password">
                    </div>
                    <div class="user-remember flex items-center gap-2 mt-3">
                        <input type="checkbox">
                        <p>Remember Me</p>
                    </div>

                    <button id="submit-login" class="w-full bg-[#003034] text-white font-semibold p-2 rounded-md mt-4">Submit</button>

                </form>
                <div class="user-remember flex items-center gap-2 mt-6">
                    <p>Doesn't Have An Account?</p>
                    <button class="text-blue-500">Register Here</button>
                </div>
            </div>

        </div>
      </div>

   </div>
   <div class="carouse w-full h-96 rounded-lg shadow-sm overflow-hidden object-cover">
     <img class="w-full h-full object-cover" src="{{ asset('images/static/caroselrevisi.png')}}" alt="carousel">
   </div>
   <div class="grid grid-cols-2 gap-4">
    <div class="cnx-pay h-3/4  font-semibold text-xl mt-6 rounded-md border-[1.5px] border-gray-200 p-4">
        <div class="title flex items-center gap-1 font-bold">
           <p>Your</p>
           <img src="{{ asset('images/static/connexpay.png') }}" alt="cnx-pay" class="h-8">
           <p>Balance</p>
        </div>
        <h1 class="balance text-4xl mt-4 font-bold text-gray-700">
           Rp.156.000
        </h1>
      </div>
      <div class="cnx-category h-3/4  font-semibold text-xl mt-6 rounded-md border-[1.5px] border-gray-200 p-4">
        <div class="title flex items-center gap-1 font-bold">
           <h1>Best Category</h1>
        </div>
        <div class="product-category-list grid grid-cols-3 mt-4 gap-3 h-fit">
            <div class="food-1 h-3/4 rounded-md relative overflow-hidden user-select-none pointer-events-none border-gray-200 border-[1.5px]">
                <div class="img w-full h-full overflow-hidden user-select-none pointer-events-none">
                    <img class="brightness-75 w-full h-full object-cover user-select-none pointer-events-none" src="https://images.pexels.com/photos/1289256/pexels-photo-1289256.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="drink">
                </div>
                <div class="description mt-2 absolute z-20 bottom-5 text-white p-4 text-2xl">
                    <p>Drink</p>
                </div>
            </div>
            <div class="food-2 h-3/4  rounded-md relative user-select-none pointer-events-none overflow-hidden border-gray-200 border-[1.5px]">
                <div class="img w-full h-full overflow-hidden user-select-none pointer-events-none">
                    <img class="brightness-75 w-full h-full object-cover user-select-none pointer-events-none" src="https://images.pexels.com/photos/1582482/pexels-photo-1582482.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="drink">
                </div>
                <div class="description mt-2 absolute z-20 bottom-5 text-white p-4 text-2xl">
                    <p>Snack</p>
                </div>
            </div>
            <div class="food-3 h-3/4 rounded-md user-select-none pointer-events-none relative overflow-hidden border-gray-200 border-[1.5px]">
                <div class="img w-full h-full overflow-hidden user-select-none pointer-events-none">
                    <img class="brightness-75 user-select-none pointer-events-none  w-full h-full object-cover" src="https://images.pexels.com/photos/760720/pexels-photo-760720.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="drink">
                </div>
                <div class="description mt-2 absolute z-20 bottom-5 text-white p-4 text-2xl">
                    <p>Stationery</p>
                </div>
            </div>
        </div>

      </div>
   </div>


@endsection
