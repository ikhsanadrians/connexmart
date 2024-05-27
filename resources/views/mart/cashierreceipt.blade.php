<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            margin: 0;
            font-family: Poppins, sans-serif;
        }

        .container {
            width: 302px;
            height: 100%;
            padding: 0 8px;
            background: white;
        }

        .main-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 24px;
            height: fit-content;
        }

        .header {
            width: 100%;
            padding: 15px 0;
            border-bottom: 1px dotted #6B6B6B;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .address {
            width: 216px;
            color: black;
            font-size: 16px;
            font-weight: 300;
            word-wrap: break-word;
        }

        .logo {
            width: 55px;
            height: 57.14px;
        }

        .transaction-details {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            width: 100%;
            height: 107px;
            padding-bottom: 15px;
            border-bottom: 1px dotted #6B6B6B;
        }

        .detail-row {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .detail-title {
            color: black;
            font-size: 16px;
            font-weight: 400;
            word-wrap: break-word;
        }

        .detail-value {
            color: black;
            font-size: 16px;
            font-weight: 500;
            word-wrap: break-word;
            text-align: right;
        }

        .items {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            height: fit-content;
            width: 100%;
        }

        .items-header {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 12px;
            height: fit-content;
            padding-bottom: 15px;
            border-bottom: 1px dotted #6B6B6B;
            width: 100%;
        }

        .item-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }

        .item-title,
        .item-quantity,
        .item-price,
        .item-total {
            color: #6B6B6B;
            font-size: 15px;
            font-weight: 400;
            word-wrap: break-word;
        }

        .item-title {
            width: 130px;
        }

        .item-nominals {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .total {
            display: flex;
            flex-direction: column;
            gap: 4px;
            justify-content: flex-start;
            align-items: flex-start;
            margin-top: 10px;
            width: 100%;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
        }

        .total-title,
        .total-value {
            color: black;
            font-size: 16px;
            font-weight: 500;
            word-wrap: break-word;
        }

        .footer {
            padding-top: 45px;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
            color: black;
            font-size: 16px;
            font-weight: 300;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main-content">
            <div class="header">
                <div class="address">Jl. Mayjen Sutoyo, RT.7/RW.7, Cawang, Kec. Kramat jati, Kota Jakarta
                    Timur,<br />DKI Jakarta</div>
                <img class="logo"
                    src="https://res.cloudinary.com/dewnyzbmg/image/upload/v1716794828/osdiyl7hml4hodaoyx8a.png"
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/55x57?text=Logo+Not+Available'" />
            </div>
            <div class="transaction-details">
                <div class="detail-row">
                    <div class="detail-title">ID</div>
                    <div class="detail-value">{{ $checkouts->checkout_code }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-title">Tgl transaksi</div>
                    <div class="detail-value">{{ $checkouts->updated_at->format('d F Y | H:i') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-title">Kasir</div>
                    <div class="detail-value">Dani</div>
                </div>
                <div class="detail-row">
                    <div class="detail-title">Jenis layanan</div>
                    <div class="detail-value">Diantar</div>
                </div>
            </div>
            <div class="items">
                <div class="items-header">
                    @foreach ($transactions as $transaction)
                        <div class="item-row">
                            <div class="item-title">{{ $transaction->product->name }}</div>
                            <div class="item-nominals">
                                <div class="item-price">{{ format_to_rp($transaction->product->price) }}
                                    <span style="padding-left:3px;">
                                        {{ $transaction->quantity }}
                                    </span>
                                </div>
                                <div class="item-total">{{ format_to_rp($transaction->totalPricePerTransaction) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="total">
                    <div class="total-row">
                        <div class="total-title">Total</div>
                        <div class="total-value">{{ format_to_rp($checkouts->total_price) }}</div>
                    </div>
                    <div class="total-row">
                        <div class="total-title">Tunai</div>
                        <div class="total-value">{{ format_to_rp($checkouts->cash_total) }}</div>
                    </div>
                    <div class="total-row">
                        <div class="total-title">Kembali</div>
                        <div class="total-value">{{ format_to_rp($checkouts->cash_return) }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">LAYANAN KONSUMEN<br />tenizenmart@smkn10jkt.sch</div>
    </div>
</body>

<script>
    const href = "/mart/cashier/" + window.location.pathname.split('/')[3] + "/success";

    setTimeout(function() {
        window.print();
        window.location.href = href;
    }, 1000);
</script>

</html>
