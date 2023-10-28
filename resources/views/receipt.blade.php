<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            <img src="{{ asset('images/static/connexpay.png') }}" alt="logo-cnx" class="h-8">
            <div class="flex justify-between pr-12">
                <div class="transaction-detail">
                    <h1 class="text-2xl font-semibold mb-4 mt-4">Top Up Receipt</h1>
                    <h3 class="text-gray-600">Hi <b>{{ Auth::user()->name }}</b>, <br> Thank You For Using ConnexPay!</h3>
                    <p class="font-bold mt-6">Top Up Detail:</p>
                    <div class="details-transaction mt-2">
                        <div class="mb-4 border-[1.5px] border-gray-300 p-4 rounded-md">
                            <p class="text-gray-600">Nominals: <span class="text-black font-semibold">{{ format_to_rp($currentTopUp->nominals) }}</span></p>
                            <p class="text-gray-600">Unique Number: <span class="text-black font-semibold">{{ $currentTopUp->unique_code }}</span></p>
                            <p class="text-gray-600">Date: <span class="text-black font-semibold">{{ $currentTopUp->created_at }}</span></p>
                        </div>
                    </div>


                </div>
                <div class="qr-code flex flex-col justify-center text-center">
                    {{ $currentTopUp->qr_code }}
                    <p class="mt-2 text-sm text-gray-500">Show This QR code to Teller</p>
                </div>
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


    <script>
        window.print()


        function backhome(){
            window.location.href = "/"
        }
    </script>
</body>
</html>
