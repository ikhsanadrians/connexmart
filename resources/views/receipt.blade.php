<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="bg-white max-w-md mx-auto p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Receipt</h1>
        <img src="{{ asset('images/static/connexmart.png') }}" alt="tomy">

        <div class="mb-4">
            <p class="text-gray-600">Unique Number: <span class="text-black font-semibold">{{ $currentTopUp->unique_code }}</span></p>
            <p class="text-gray-600">Date: <span class="text-black font-semibold">{{ $currentTopUp->created_at }}</span></p>
        </div>

        <div class="mb-4">
            <h2 class="text-lg font-semibold">Items</h2>
            <ul class="list-disc list-inside">
                <li>Product A - $10.00</li>
                <li>Product B - $15.00</li>
                <li>Product C - $20.00</li>
            </ul>
        </div>

        <div class="mb-4">
            <p class="text-gray-600">Subtotal: <span class="text-black font-semibold">$45.00</span></p>
            <p class="text-gray-600">Tax (10%): <span class="text-black font-semibold">$4.50</span></p>
            <p class="text-gray-600">Total: <span class="text-black font-semibold">$49.50</span></p>
        </div>

        <div class="mt-4">
            <p class="text-gray-600">Payment Method: <span class="text-black font-semibold">Credit Card</span></p>
        </div>
    </div>

    <script>
        window.print()
    </script>
</body>
</html>
