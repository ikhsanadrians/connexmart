<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Receipt</title>
    <style>
        @media print {
           #back-to-home {
              display: none;
           }
        }
    </style>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="bg-white max-w-full mx-auto rounded-lg shadow-md h-full">
        <div class="p-6">
            <div class="flex justify-between">
                <img src="{{ asset('images/static/connexmart.png') }}" alt="logo-cnx" class="h-8">
                <div class="qr-code flex flex-col justify-center text-center">
                    {{ $currentTransactions->qr_code }}
                </div>
            </div>

            <div class="flex justify-between pr-12">
                <div class="transaction-detail">
                    <h1 class="text-2xl font-semibold mb-4 mt-4">Cart Receipt</h1>
                    <h3 class="text-gray-600">Hi <b>{{ Auth::user()->name }}</b>, <br> Thank you for shopping at Connexmart!</h3>
                    <p class="font-bold mt-6">Cart Detail:</p>
                    <div class="details-transaction mt-2">
                        <table class="border-2">
                            <tr class="border-2">
                                <th class="border-[1.5px] border-gray-400 p-2">No</th>
                                <th class="border-[1.5px] border-gray-400 p-2">Product Name</th>
                                <th class="border-[1.5px] border-gray-400 p-2">Quantity</th>
                                <th class="border-[1.5px] border-gray-400 p-2">Price</th>
                            </tr>
                            @foreach ($currentTransactions as $key => $transaction)
                            <tr class="p-2">
                                   <td class="border-[1.5px] border-gray-400 p-2">{{ $key + 1 }}</td>
                                   <td class="border-[1.5px] border-gray-400 p-2">{{ $transaction->product->name }}</td>
                                   <td class="border-[1.5px] border-gray-400 p-2">{{ $transaction->quantity }}</td>
                                   <td class="border-[1.5px] border-gray-400 p-2">{{ format_to_rp($transaction->price) }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>


                </div>

            </div>
            <div class="total mt-4">
                <p class="text-xl font-semibold">Total : {{ format_to_rp($currentTransactions->total_prices) }}</p>
            </div>
            <div class="back flex justify-center mt-12" id="back-to-home">
                <button onclick="backhome()" class="bg-[#003034] text-white font-semibold px-4 py-2">Back To Home</button>
            </div>
            <div class="mt-28 flex justify-center">
                <div class="wrappers flex flex-col items-center">
                    <div class="cnx-icon flex items-center gap-2 font-bold">
                        <img class="h-8" src="{{ asset('images/static/cnxgroup.png') }}" alt="">
                        <p>Group</p>
                    </div>
                    <div class="address mt-2 text-sm flex flex-col items-center">
                        <p class="font-semibold">PT Koneksi Membangun Indonesia</p>
                        <p class="w-full text-center text-xs">Menara Connex, Jalan Tanjung Barat No.134 ,<br> Jakarta Selatan DKI Jakarta Indonesia</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <script src="{{ asset('javascript/lib/jquery.min.js') }}"></script>
    <script>
        window.print()

        $(document).ready(function() {
            $.ajax({
            method: 'put',
            url : '/cart/receipt/take',
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                console.log(data)
            },
            error:function(data){
                console.log(data)
            }
            })
       });


        function backhome(){
            window.location.href = "/"
        }
    </script>
</body>
</html>
