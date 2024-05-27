import rupiah from "./utils/rupiahFormater.js";


$(document).ready(function () {
    calculateTotal("price");
    calculateTotal("quantity");
    loadCurrentTransIdList()
})

let orderListId = []
let transactionListId = []
let totalPrices = 0
let totalQty = 0

function loadModalMessage(messageText) {
    $("#modal-message").removeClass("hidden-items")
    $("#modal-text").text(messageText)
    setTimeout(() => {
        $("#modal-message").addClass("hidden-items")
    }, 2000)
}


function calculateTotal(type) {
    let total = 0;

    $('.input-of-quantity').each((index, element) => {
        total += type === 'price' ? parseInt(element.value * $(element).attr("data-singleprice")) : parseInt(element.value);

        if (!orderListId.includes($(element).attr("data-productid"))) orderListId.push($(element).attr("data-productid"));

    });

    if (type === 'price') {
        $(".order-price-info").text(rupiah(total));
        $(".order-price-info").attr("data-prices", total)
        totalPrices = total
    } else if (type === 'quantity') {
        $(".order-qty-info").text(total);
        totalQty = total
    }

    console.log(`Total QTY : ${totalQty} ,  Total Pric : ${totalPrices}`)
}




function orderListEmptyShow() {
    return `<div class="empty-cart flex justify-center items-center h-full">
    <div class="ecart-wrappers flex flex-col justify-center items-center gap-3">
        <svg class="fill-gray-400" xmlns="http://www.w3.org/2000/svg" width="58"
            height="58" fill="currentColor" class="bi bi-bag-x-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293z" />
        </svg>
        <div class="hint-text">
            <p class="text-center font-semibold text-slate-600">Tidak ada item ditambahkan</p>
            <p class="text-center text-slate-400 text-sm">Klik icon tambah untuk
                menambahkan</p>
        </div>
    </div>
</div>`
}


function loadCurrentTransIdList() {
    $(".input-quantity").each((index, transaction) => {
        if (!transactionListId.includes($(transaction).attr("data-transid"))) transactionListId.push($(transaction).attr("data-transid"))
    })
}

function checkIfOrderEmpty() {
    const itemList = $(".item-list")
    if (orderListId.length < 1) {
        itemList.append(orderListEmptyShow)
    } else {
        $(".empty-cart").remove()
    }
}


$(".recordsPerPage").on("change", function (event) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('show', event.target.value);
    window.location.search = urlParams.toString();
})

$(".option").each((index, option) => {
    const showParameterValue = new URLSearchParams(window.location.search).get('show');
    if (showParameterValue == option.value) option.selected = true;
});



const updateClock = () => {
    const currentTime = moment().format('HH:mm');
    $("#clock-text").text(currentTime);
};

updateClock();

setInterval(updateClock, 60000);



$(document).on("click", ".add", function (event) {
    const currentUrl = "/mart/cashier/addorder"
    const itemList = $(".item-list")
    const products = $(event.currentTarget).closest(".product-card")
    const productId = products.attr("id")
    const productName = products.find(".product-name").attr("data-name")
    const productPrice = products.find(".product-price").attr("data-price")
    const productMaxQuantity = products.find(".product-price").attr("data-stock")

    $.ajax({
        url: currentUrl,
        method: "post",
        dataType: 'json',
        data: {
            "product_id": productId,
            "quantity": 1,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            const existingItem = itemList.find(`#product-${productId}`);

            if (existingItem.length) {
                const currentProductValue = parseInt(existingItem.val());
                existingItem.parent().closest(".pickup-item").find(".order-quantity-count").text(currentProductValue + 1)
                existingItem.val(currentProductValue + 1);
            } else {
                itemList.append(`
                <div class="pickup-item flex items-center justify-between border-b-[1.8px] border-slate-200 border-dashed p-4">
                    <div class="item-desc">
                        <div class="desc-name font-medium">
                            <p>${productName}</p>
                        </div>
                        <div class="desc-price text-zinc-400">
                            ${rupiah(productPrice)} x <span class="order-quantity-count">1</span>
                        </div>
                    </div>
                    <div class="item-qtycontrol">
                        <div data-transid="${response.data}" class="input-quantity flex border-slate-300 border-[1.3px] w-fit px-2 py-1 rounded-md">
                            <button class="decrease">-</button>
                            <input id="product-${productId}" type="number" data-productid="${productId}" data-singleprice="${productPrice}" value="1" class="input-of-quantity w-12 text-center focus:outline-none px-1" min="1" id="value_quantity" max="${productMaxQuantity}">
                            <button class="increase">+</button>
                        </div>
                    </div>
                </div>
                `);
            }

            loadModalMessage("Berhasil Menambahkan Produk")
            itemList.scrollTop($(".item-list")[0].scrollHeight);
            calculateTotal("price")
            calculateTotal("quantity")
            checkIfOrderEmpty()
            loadCurrentTransIdList()
        },
        error: function (error) {
            loadModalMessage(error.responseJSON.message)
        }
    });
})
function updateQuantity(transactionId, quantity, type) {
    $.ajax({
        url: '/mart/cashier/quantityupdate',
        method: 'put',
        dataType: 'json',
        data: {
            "transaction_id": transactionId,
            "quantity": quantity,
            "type": type,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            loadModalMessage(data.message);
        },
        error: function (error) {
            console.log(error)
        }
    });
}
let debounceTimer;
$(".product-search").on("input", function (event) {

    const urlParams = new URLSearchParams(window.location.search);
    let category = urlParams.get("category")

    clearTimeout(debounceTimer);
    $(".loader").removeClass("!hidden")

    const productListContainer = $(".product-list");

    debounceTimer = setTimeout(() => {
        $.ajax({
            url: '/mart/cashier/search',
            method: "post",
            dataType: "json",
            data: {
                "searchValue": event.target.value,
                "category": category,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                productListContainer.empty();

                if (response.data == "empty") {
                    $(".loader").addClass("!hidden")
                    productListContainer.append(`
                    <div id="data-notfound" class="absolute gap-4 inset-0 top-24  mx-auto my-auto w-fit h-fit">
                        <div class="flex flex-col justify-center items-center">
                           <svg xmlns="http://www.w3.org/2000/svg" width="58" height="58" fill="currentColor" class="bi bi-box-seam-fill fill-gray-400" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
                           </svg>
                           <p class="text-center font-semibold text-slate-600 mt-3">
                             Tidak Menemukan Produk!
                           </p>
                        </div>
                    </div>
                    `)
                } else {
                    $("#data-notfound").remove()
                    response.data.forEach((result) => {
                        productListContainer.append(`
                        <div id="${result.id}"
                        class="product-card p-3 rounded-lg border-[1.7px] h-fit max-h-auto border-[#303fe2]/50">
                        <div class="top-product w-full">
                            <div class="name-stock flex justify-between">
                                <div data-name="${result.name}" class="product-name">
                                    <h1 class="text-sm font-medium text-[#303fe2]">${result.name}</h1>
                                </div>
                                <div class="stock flex gap-1 items-center">
                                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10.0357 0.267853H1.46429L0.75 3.83928V7.05357H10.75V3.83928L10.0357 0.267853ZM9.76786 3.83928H7.17857C7.17857 4.21816 7.02806 4.58152 6.76015 4.84943C6.49224 5.11734 6.12888 5.26785 5.75 5.26785C5.37112 5.26785 5.00776 5.11734 4.73985 4.84943C4.47194 4.58152 4.32143 4.21816 4.32143 3.83928H1.73214L2.22321 1.20535H9.27678L9.76786 3.83928ZM7.17857 7.76785C7.17857 8.14673 7.02806 8.5101 6.76015 8.778C6.49224 9.04591 6.12888 9.19642 5.75 9.19642C5.37112 9.19642 5.00776 9.04591 4.73985 8.778C4.47194 8.5101 4.32143 8.14673 4.32143 7.76785H0.75V10.9821H10.75V7.76785H7.17857Z"
                                            fill="#6B6B6B" />
                                    </svg>
                                    <p class="text-sm">${result.stock}</p>
                                </div>
                            </div>
                            <div data-stock="${result.stock}" data-price="${result.price}"
                                class="product-price">
                                <p class="text-sm font-medium text-[#303fe2]">${rupiah(result.price)}
                                </p>
                            </div>
                        </div>
                        <div class="bottom-product flex justify-end">
                            <div class="add">
                                <svg width="176" height="20" viewBox="0 0 176 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_108_765)">
                                        <path
                                            d="M166.25 0.625C161.012 0.625 156.75 4.88675 156.75 10.125C156.75 15.3632 161.012 19.625 166.25 19.625C171.488 19.625 175.75 15.3632 175.75 10.125C175.75 4.88675 171.488 0.625 166.25 0.625ZM169.904 10.8558H166.981V13.7788C166.981 13.9727 166.904 14.1585 166.767 14.2956C166.63 14.4326 166.444 14.5096 166.25 14.5096C166.056 14.5096 165.87 14.4326 165.733 14.2956C165.596 14.1585 165.519 13.9727 165.519 13.7788V10.8558H162.596C162.402 10.8558 162.216 10.7788 162.079 10.6417C161.942 10.5047 161.865 10.3188 161.865 10.125C161.865 9.93119 161.942 9.74531 162.079 9.60827C162.216 9.47122 162.402 9.39423 162.596 9.39423H165.519V6.47115C165.519 6.27734 165.596 6.09147 165.733 5.95442C165.87 5.81738 166.056 5.74038 166.25 5.74038C166.444 5.74038 166.63 5.81738 166.767 5.95442C166.904 6.09147 166.981 6.27734 166.981 6.47115V9.39423H169.904C170.098 9.39423 170.284 9.47122 170.421 9.60827C170.558 9.74531 170.635 9.93119 170.635 10.125C170.635 10.3188 170.558 10.5047 170.421 10.6417C170.284 10.7788 170.098 10.8558 169.904 10.8558Z"
                                            fill="#303FE2" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_108_765">
                                            <rect width="175.75" height="19" fill="white"
                                                transform="translate(0 0.625)" />
                                        </clipPath>
                                    </defs>
                                </svg>

                            </div>
                        </div>
                    </div>
                        `);
                        $(".loader").addClass("!hidden")
                    });
                }


            },
            error: function (error) {
                $(".loader").addClass("!hidden")
            }
        });
        // console.log(event.target.value);
    }, 300);
});


$(document).on("click", ".decrease", function (event) {
    const decreaseWrapper = $(event.target).parent();
    const orderQtyCount = decreaseWrapper.closest(".pickup-item").find(".order-quantity-count");
    const qtyInputValue = decreaseWrapper.find("input").val();
    const transactionId = decreaseWrapper.attr("data-transid");
    const productId = decreaseWrapper.find("input").attr("data-productid")

    let qtyUpdatedValue = parseInt(qtyInputValue) - 1;

    if (qtyUpdatedValue >= 1) {
        decreaseWrapper.find("input").val(qtyUpdatedValue);
        orderQtyCount.text(qtyUpdatedValue)
        updateQuantity(transactionId, qtyUpdatedValue, "decrease");
    } else {
        $(this).closest(".pickup-item").remove();
        updateQuantity(transactionId, qtyUpdatedValue, "delete");
        orderListId = orderListId.filter((id) => id !== productId)
        transactionListId = transactionListId.filter((id) => id !== transactionId)
        loadCurrentTransIdList()
    }

    checkIfOrderEmpty()
    calculateTotal("quantity")
    calculateTotal("price")
});



$(document).on("click", ".increase", function (e) {
    const increaseWrapper = $(e.target).parent();
    const orderQtyCount = increaseWrapper.closest(".pickup-item").find(".order-quantity-count");
    const qtyInputValue = increaseWrapper.find("input").val();
    const transactionId = increaseWrapper.attr("data-transid");

    const maxInputValue = increaseWrapper.find("input").attr("max");

    let qtyUpdatedValue = parseInt(qtyInputValue) + 1;

    if (qtyUpdatedValue <= maxInputValue) {
        increaseWrapper.find("input").val(qtyUpdatedValue);
        orderQtyCount.text(qtyUpdatedValue)
        updateQuantity(transactionId, qtyUpdatedValue, "increase");
    } else {
        loadModalMessage("Kamu tidak bisa menambahkan produk karena melebihi stok yang tersedia.");
    }
    calculateTotal("quantity")
    calculateTotal("price")
    checkIfOrderEmpty()

});


$(document).on('input', '.input-of-quantity', function (e) {
    let qtyInputValue = $(e.target).val()
    let qtyInputWrapper = $(e.target).parent()
    let qtyInputParsed = qtyInputValue.replace(/[^\d]|,|\.| /g, '')
    let qtyPickupItemInfo = qtyInputWrapper.closest(".pickup-item").find(".order-quantity-count")
    const transactionId = qtyInputWrapper.attr("data-transid")


    if (qtyInputParsed.length === 1 && qtyInputParsed[0] === '0' || qtyInputParsed === "") {
        $(e.target).val("")
        return
    }

    if (qtyInputParsed >= 1) {
        $(e.target).val(qtyInputParsed)
        $.ajax({
            url: '/mart/cashier/quantityupdate',
            method: 'put',
            dataType: 'json',
            data: {
                "transaction_id": transactionId,
                "quantity": qtyInputParsed,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                calculateTotal('quantity')
                calculateTotal('price')
                checkIfOrderEmpty()
                loadModalMessage(data.message)
                qtyPickupItemInfo.text(qtyInputParsed);
            },
            error: function (error) {
                loadModalMessage("Kamu tidak bisa menambahkan produk karena stoknya habis.")
            }
        })
    }
})

$(".clear-order").on("click", function () {
    if (orderListId.length > 0) {
        $.ajax({
            url: '/mart/cashier/clearorder',
            method: "post",
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $(".item-list").empty()
                orderListId.pop()
                checkIfOrderEmpty()
                $(".item-list").append(orderListEmptyShow)
                loadModalMessage("Berhasil menghapus semua order list")
            },
            error: function (error) {
                loadModalMessage("Tidak bisa melakukan clear order")
            }
        })
    }
});

const toggleCashierModalPayment = (option) => {
    if (checkIfOrderListEmpty()) {
        $(".chosee-paymentmethod").toggleClass("hidden", !option);
        $(".backdrop").toggleClass("hidden", !option);

        if (option) {
            const RupiahAmounts = generateCloseRupiahAmounts(totalPrices)

            RupiahAmounts.forEach((value, index) => {
                $(".rupiah-amounts").append(`<div id="cash-${index + 1}" data-cashnominal="${value}" class="n-${index + 1} nominal text-center cursor-pointer border-slate-300 border-[1.3px] w-full px-4 py-3 rounded-md">${rupiah(value)}</div>`)
            })

        } else {
            $(".rupiah-amounts").empty()
        }
    }
}


$(".proceed").on("click", function () {
    toggleCashierModalPayment(true)
})

$(".back-cpm").on("click", function () {
    toggleCashierModalPayment(false)
})

let currentPaymentMethod = ""
let currentNominals = ""

$(document).on("click", ".nominal", function (event) {
    $(".nominal").removeClass("selected-payment");
    $(".rupiah-check").addClass("hidden");

    if (!$(event.target).hasClass("cash-amount-input")) {
        $(".cash-amount-input").val("")
        $(".cash-amount-input").removeClass("ring-2")
        $(event.target).addClass("selected-payment");
        currentPaymentMethod = event.target.id
        currentNominals = $(event.target).attr("data-cashnominal")
    }

})



$(".cash-amount-input").on("input", function (event) {
    let inputVal = $(this).val();
    inputVal = inputVal.replace(/[^0-9]/g, '');
    inputVal = inputVal.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    $(this).val(inputVal);

    if ($(this).val().length > 0 && parseInt($(this).val().replace(/\./g, '')) >= totalPrices) {
        $(this).addClass("ring-2");
        $(".rupiah-check").removeClass("hidden")
        currentPaymentMethod = $(this).attr("id");
        currentNominals = parseInt($(this).val().replace(/\./g, ''));
    } else {
        $(this).removeClass("ring-2");
        $(".rupiah-check").addClass("hidden");
    }
})

function generateCloseRupiahAmounts(baseAmount) {
    const rupiahDenominations = [];
    for (let i = 5000; i <= 1000000; i += 5000) {
        rupiahDenominations.push(i);
    }
    const closestDenominations = rupiahDenominations.filter(denomination => denomination >= baseAmount);
    let amounts = [baseAmount];
    for (let i = 0; i < closestDenominations.length && amounts.length < 3; i++) {
        amounts.push(closestDenominations[i]);
    }
    return amounts;
}

$(".next-confirm").on("click", function () {
    const currentUrl = "/mart/cashier/proceed"
    const totalQuantity = totalQty
    const totalPrice = totalPrices

    if (currentPaymentMethod == "tenbank") {
        $.ajax({
            method: "post",
            url: currentUrl,
            dataType: "json",
            data: {
                "payment_method": "tenbank",
                "product_list": transactionListId,
                "total_price": totalPrice,
                "total_quantity": totalQuantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $(".hint-content").empty()
                addLoader()
                setTimeout(() => {
                    $("#loader").parent().remove();
                    $(".hint-content").empty()
                    $(".hint-content").append(`
                    <div class="qrcode flex flex-col justify-center items-start px-4 py-4">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="qrcode-part">
                            <div class="qrcode-img h-72 w-72">
                                <img src="data:image/png;base64,${data.qrCodeData}" class="h-full w-full object-cover">
                            </div>
                        </div>
                        <div class="hint mt-4 pr-2">
                            <h1 class="font-semibold">Pembayaran Untuk TenizenMart</h1>
                            <h1 class="text-3xl font-bold mt-2">${rupiah(data.checkoutDetail.total_price)}</h1>
                            <p class="mt-4 bg-green-300 text-green-800 p-2 text-sm rounded-lg">Gunakan Scanner pada homepage
                                TenizenMart untuk membayar
                            </p>
                        </div>
                    </div>
                </div>
                    `)
                }, 2000)

                startEventChecking(data.checkoutCode);
            },
            error: function (error) {
                console.log(error)
            }
        })
    } else {
        $.ajax({
            method: "post",
            url: currentUrl,
            dataType: "json",
            data: {
                "payment_method": "cash",
                "cash_amount": currentNominals,
                "product_list": transactionListId,
                "total_price": totalPrice,
                "total_quantity": totalQuantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $(".hint-content").empty()
                addLoader()
                setTimeout(() => {
                    window.location.href = `/mart/cashier/${data.checkoutDetail.checkout_code}/success`;
                }, 1000)

                startEventChecking(data.checkoutCode);
                console.log(data)
            },
            error: function (error) {
                console.log(error)
            }
        })
    }
})
function displaySuccessPayment(checkout) {
    return `
    <div class="success-scanning flex justify-center items-center mt-5">
        <div class="wrappers flex flex-col items-center gap-3">
            <div class="icon-check">
                <span class="material-symbols-rounded">done</span>
            </div>
            <div class="title">
                <h1 class="text-2xl font-semibold text-center">Pembayaran Berhasil</h1>
                <div class="payment-total text-center mt-6">
                    <p class="text-center text-slate-600">Jumlah</p>
                    <h1 class="font-semibold text-xl" id="payment-totalprice">${rupiah(checkout.total_price)}</h1>
                </div>
                <div class="payment-total text-center mt-4">
                    <p class="text-center text-slate-600">Dikirim Oleh</p>
                    <h1 class="font-semibold text-xl" id="payment-sender">${checkout.user_id}</h1>
                </div>
            </div>
        </div>
        <div class="button absolute bottom-8 right-8">
            <div class="detail-button cursor-pointer bg-[#303fe2] text-white px-8 py-2 rounded-lg flex items-center gap-1">
                Detail
                <span class="material-symbols-rounded">arrow_forward</span>
            </div>
        </div>
    </div>
    `;
}


function addLoader() {
    $(".hint-content").append(`<div class="flex justify-center items-center"><span id="loader" class="loader hidden-items mt-12"></span></div>`)
}


function checkIfOrderListEmpty() {
    if (orderListId.length === 0) {
        loadModalMessage("Tidak Dapat Memproses, Orderlist mu Kosong");
        return false;
    }
    return true;
}



function startEventChecking(code) {
    const currentUrl = `/mart/cashier/stream/${code}`;
    let eventSource = new EventSource(currentUrl);

    eventSource.onmessage = function (event) {
        try {
            let checkout = JSON.parse(event.data);

            if (checkout.status == "ordered") {
                loadModalMessage("Scan Berhasil");
                $(".hint-content").empty()
                addLoader()
                setTimeout(() => {
                    $("#loader").parent().remove();
                    $(".hint-content").append(displaySuccessPayment(checkout))
                }, 2000);
                eventSource.close();
                window.location.href = `/mart/cashier/${checkout.checkout_code}/success`
            }
        } catch (error) {
            return;
        }
    };
}


//scanner logic
let barcode = ""
let interval;

$(document).on("keydown", (event) => {
    if (interval)
        clearInterval(interval)

    if (event.code == "Enter") {
        if (barcode)
            AddToListBarcode(barcode)
        barcode = ''
        return
    }

    if (event.code != "Shift")
        barcode += event.key
    interval = setInterval(() => barcode = '', 20)

})

function AddToListBarcode(scannedBarcode) {
    console.log(scannedBarcode)
    const currentUrl = "/mart/cashier/barcode/check"
    const itemList = $(".item-list");

    $.ajax({
        url: currentUrl,
        method: "post",
        dataType: 'json',
        data: {
            "barcode": scannedBarcode,
            "quantity": 1,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            const existingItem = itemList.find(`#product-${response.data.id}`);

            if (existingItem.length) {
                const currentProductValue = parseInt(existingItem.val());
                existingItem.parent().closest(".pickup-item").find(".order-quantity-count").text(currentProductValue + 1)
                existingItem.val(currentProductValue + 1);
            } else {
                itemList.append(`
                <div class="pickup-item flex items-center justify-between border-b-[1.8px] border-slate-200 border-dashed p-4">
                    <div class="item-desc">
                        <div class="desc-name font-medium">
                            <p>${response.data.name}</p>
                        </div>
                        <div class="desc-price text-zinc-400">
                            ${rupiah(response.data.price)} x <span class="order-quantity-count">1</span>
                        </div>
                    </div>
                    <div class="item-qtycontrol">
                        <div data-transid="${response.trans_id}" class="input-quantity flex border-slate-300 border-[1.3px] w-fit px-2 py-1 rounded-md">
                            <button class="decrease">-</button>
                            <input id="product-${response.data.id}" type="number" data-productid="${response.data.id}" data-singleprice="${response.data.price}" value="1" class="input-of-quantity w-12 text-center focus:outline-none px-1" min="1" id="value_quantity" max="${response.data.stock}">
                            <button class="increase">+</button>
                        </div>
                    </div>
                </div>
                `);
            }

            loadModalMessage("Berhasil Menambahkan Produk")
            itemList.scrollTop($(".item-list")[0].scrollHeight);
            calculateTotal("price")
            calculateTotal("quantity")
            checkIfOrderEmpty()
            loadCurrentTransIdList()
        },
        error: function (error) {
            loadModalMessage(error.responseJSON.message)
        }
    });
}
