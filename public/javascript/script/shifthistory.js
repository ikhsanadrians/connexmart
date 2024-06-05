const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    }).format(number).replace(/,00$/, '');
}

$(document).ready(function () {
    $('.select-transactions-date').select2();
    resetParamIfDoSearch()
});


function dateToSlug(format) {
    return format.replace(/(\d{1,2}) (\w+) (\d{4})/, function (match, day, month, year) {
        return `${day}_${month.toLowerCase()}_${year}`;
    });
}


function resetParamIfDoSearch() {
    $("#search-cashiershifthistory").on("click", function () {
        const url = new URL(window.location.href);
        const params = new URLSearchParams(url.search)

        if (params.has("status") || params.has("date") || params.has("sort")) {
            window.location.href = "/mart/cashiershift/history"
        }
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



function checkIfStatusEnd(result) {
    if (result.status == "ended") {
        return `<p class="time-text">
                 <span class="font-semibold">Akhir :</span>
                 ${result.end_shift}
                  </p>`
    } else {
        return ``;
    }
}

function checkCurrentStatus(result) {
    let show = null
    if (result.status == "current") {
        show = `<p class="bg-gradient-to-r from-green-500 to-emerald-600 px-3 py-1 text-white text-sm font-semibold rounded-md">Sedang Berjalan</p>`
    } else {
        show = `<p class="bg-gradient-to-r from-blue-500 to-blue-600 px-3 py-1 text-white text-sm font-semibold rounded-md">Berakhir</p>`
    }

    return show
}




let debounceTimer;
$("#search-cashiershifthistory").on("input", function (event) {
    const currentUrl = "history/search"
    clearTimeout(debounceTimer)

    const cashierShiftContainer = $(".cashiershifts");

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
                cashierShiftContainer.empty()

                if (response.data == "empty") {
                    cashierShiftContainer.append(`
                    <div class="not-found-transactions flex flex-col items-center justify-center w-full mt-28">
                      <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-basket-fill" viewBox="0 0 16 16">
                         <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0z"/>
                      </svg>
                    <h1 class="text-2xl font-semibold mt-4">Tidak Menemukan Shift Cashier</h1>
                </div>
                    `)
                } else {
                    $(".not-found-transactions").remove()
                    response.data.forEach((result) => {
                        cashierShiftContainer.append(`
                        <div class="card rounded-lg relative py-2 px-1 lg:px-5 bg-white shadow-sm">
                        <div class="header flex justify-between items-center gap-3 my-2">
                            <div class="header-left flex justify-between items-center gap-3">
                                <div class="checkout_code text-[#303fe2] font-semibold text-[15px]">
                                    Id : ${result.id}
                                </div>
                                <div class="title text-sm">
                                    Shift Kasir
                                </div>
                                <div class="times flex items-center gap-1 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-clock" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                                    </svg>
                                    <p class="time-text">
                                        <span class="font-semibold">Awal :</span>
                                        ${result.starting_shift}
                                    </p>
                                    ${checkIfStatusEnd(result)}

                                </div>
                                <div class="status">
                                   ${checkCurrentStatus(result)}
                                </div>
                            </div>
                            <div class="header-right">
                                <div class="actions">
                                  <a href="/mart/cashiershift/history/${result.id}">
                                    <div
                                      class="wrappers show-detail-history bg-gradient-to-r w-fit from-green-400 hover:opacity-80 to-green-300 p-2 text-green-700 rounded-md">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                      </svg>
                                    </div>
                                  </a>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="transaction-content mt-2 flex justify-between">
                            <div class="content-wrappers">
                                <table id="transactions" class="!shadow-none">
                                    <tr class="!border-none">
                                        <td class="!border-none text-start">
                                            <div class="buyer">
                                                <label class="text-sm font-semibold">Nama Kasir</label>
                                                <p>${result.cashier_name}</p>
                                            </div>
                                        </td>
                                        <td class="!border-none text-start">
                                            <div class="quantity">
                                                <label class="text-sm font-semibold">Jumlah Barang Terjual</label>
                                                <p class="text-start">${result.sold_items}</p>
                                            </div>
                                        </td>
                                        <td class="!border-none text-start">
                                            <div class="total-price">
                                                <label class="text-sm font-semibold">Kas Akhir</label>
                                                <p>${rupiah(result.current_cash)}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="!border-none">
                                        <td class="!border-none text-start">
                                            <div class="address">
                                                <label class="text-sm font-semibold">Kas Awal</label>
                                                <p>${rupiah(result.starting_cash)}</p>
                                            </div>
                                        </td>
                                        <td class="!border-none text-start">
                                            <div class="phone-number">
                                                <label class="text-sm font-semibold">Kas Keluar / Kembalian</label>
                                                <p>${rupiah(result.refund_cash)}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
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
