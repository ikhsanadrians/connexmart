$(document).ready(function () {
    $('.select-transactions-date').select2();
    resetParamIfDoSearch()
});


function dateToSlug(format) {
    return format.replace(/(\d{1,2}) (\w+) (\d{4})/, function (match, day, month, year) {
        return `${day}_${month.toLowerCase()}_${year}`;
    });
}

$(".select-transactions-date").on("change", function (event) {
    let currentValue = event.target.value;

    const urlParams = new URLSearchParams(window.location.search);

    currentValue == "all" ? urlParams.delete('date') : urlParams.set('date', dateToSlug(currentValue))

    window.location.search = urlParams.toString();
});




$(".select-transactions-status").on("change", function (event) {
    let currentValue = event.target.value
    const urlParams = new URLSearchParams(window.location.search)
    currentValue == "all" ? urlParams.delete('status') : urlParams.set('status', currentValue)

    window.location.search = urlParams.toString()
})


$(".select-transactions-sorting").on("change", function (event) {
    let currentValue = event.target.value
    const urlParams = new URLSearchParams(window.location.search)
    currentValue == "newfirst" ? urlParams.delete("sort") : urlParams.set("sort", currentValue)

    window.location.search = urlParams.toString()

})


$(".option-sorting").each((index, option) => {
    const dateParameterValue = new URLSearchParams(window.location.search).get("sort")
    if (dateParameterValue == option.value) option.selected = true
})


$(".option-date").each((index, option) => {
    const dateParameterValue = new URLSearchParams(window.location.search).get("date")
    if (dateParameterValue == option.value) option.selected = true
})

$(".option-status").each((index, option) => {
    const statusParameterValue = new URLSearchParams(window.location.search).get("status")
    if (statusParameterValue == option.value) option.selected = true
})


function resetParamIfDoSearch() {
    $("#search-transactions").on("click", function () {
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search)

        if (params.has("status") || params.has("date") || params.has("sort")) {
            window.location.href = "/mart/transactions"
        }
    });
}


function checkoutStatusStyle(status) {
    let style;

    if (status == 'ordered') {
        style = `<div class="payed text-sm bg-green-500/50 text-green-800 font-medium px-3 py-1 rounded-lg">
       Pesanan Dibayar</div>`
    } else if (status == "taken") {
        style = `<div class="taken bg-blue-500/50 text-sm text-blue-800 font-medium px-3 py-1 rounded-lg">
        Pesanan Diambil
    </div>`
    } else {
        style = `<div class="taken bg-red-500/50 text-sm text-red-800 font-medium px-3 py-1 rounded-lg">
        Pesanan Dibatalkan
    </div>`
    }

    return style;
}



let debounceTimer;
$("#search-transactions").on("input", function (event) {
    const currentUrl = "transaction/search"
    clearTimeout(debounceTimer)

    const transactionsContainer = $(".transactions");

    debounceTimer = setTimeout(() => {
        $.ajax({
            url: currentUrl,
            method: "post",
            dataType: 'json',
            data: {
                "searchValue": event.target.value,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                transactionsContainer.empty()

                if (response.data == "empty") {
                    transactionsContainer.append(`
                    <div class="not-found-transactions flex flex-col items-center justify-center w-full mt-28">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                        class="bi bi-list-columns-reverse" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M0 .5A.5.5 0 0 1 .5 0h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 .5m4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10A.5.5 0 0 1 4 .5m-4 2A.5.5 0 0 1 .5 2h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 4h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 6h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m-4 2A.5.5 0 0 1 .5 8h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m-4 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m4 0a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                    </svg>
                    <h1 class="text-2xl font-semibold mt-4">Tidak Menemukan Transaksi</h1>
                </div>
                    `)
                } else {
                    $(".not-found-transactions").remove()
                    response.data.forEach((result) => {
                        transactionsContainer.append(`
                        <div
                        class="card mt-2 lg:mt-3 rounded-lg @if (!$loop->last) border-b-[1.2px]  border-gray-200 @endif relative py-2 px-1 lg:px-5 bg-white shadow-sm">
                        <div class="header flex items-center gap-3 my-2">
                            <div class="title text-sm">
                               ${result.user_id != 4 ? '<h1 class="font-semibold">Transaksi Pembelian</h1>' : '<h1 class="font-semibold">Transaksi Kasir</h1>'}
                            </div >
                            <div class="checkout_code text-[#303fe2] font-semibold text-[15px]">
                                #${result.checkout_code}
                            </div>
                            <div class="times flex items-center gap-1 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-clock" viewBox="0 0 16 16">
                                    <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                </svg>
                                <p class="time-text">
                                    ${result.updated_at}
                                </p>
                            </div>
                            <div class="status">
                               ${checkoutStatusStyle(result.status)}
                            </div>
            <hr>
                <div class="transaction-content mt-2 flex justify-between">
                    <div class="content-wrappers">
                        <table id="transactions" class="!shadow-none">
                            <tr class="!border-none">
                                <td class="!border-none text-start">
                                ${result.user_id !== 4 ? '<div class="buyer"><label class="text-sm font-semibold">Nama Pembeli</label><p>' + result.user_id + '</p></div>' : ''}
                                </td>
                                <td class="!border-none text-start">
                                    <div class="quantity">
                                        <label class="text-sm font-semibold">Jumlah Barang</label>
                                        <p class="text-center">${result.total_quantity}</p>
                                    </div>
                                </td>
                                <td class="!border-none text-start">
                                    <div class="total-price">
                                        <label class="text-sm font-semibold">Total Harga</label>
                                        <p></p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="content-action pb-4">
                        <a href="{{ route('mart.transaction.detail', $userCheckout->checkout_code) }}"
                            class="show-detail text-blue-500 cursor-pointer">
                            Lihat Detail Pesanan
                        </a>
                        <div class="option mt-2 flex items-center gap-2">
                        </div>
                    </div>
                </div>
            </div>
                        `)

                    });
                }

            },
            error: function (error) {
                return
            }
        });
    }, 300)

})

$(".recordsPerPage").on("change", function (event) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('show', event.target.value);
    if (event.target.value === 'all') {
        urlParams.delete('page');
    }
    window.location.search = urlParams.toString();
})


$(".option").each((index, option) => {
    const showParameterValue = new URLSearchParams(window.location.search).get('show');
    if (showParameterValue == option.value) option.selected = true;
});
