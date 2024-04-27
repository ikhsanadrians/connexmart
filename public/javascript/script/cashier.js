import rupiah from "./utils/rupiahFormater.js";

function loadModalMessage(messageText) {
    $("#modal-message").removeClass("hidden-items")
    $("#modal-text").text(messageText)
    setTimeout(() => {
        $("#modal-message").addClass("hidden-items")
    }, 2000)
}



$("#recordsPerPage").on("change", function (e) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('show', e.target.value);
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



$(".add").on('click', function (e) {
    const currentUrl = "/mart/cashier/addorder"
    const itemList = $(".item-list")
    const products = $(e.currentTarget).closest(".product-card")
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
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
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
                    <input type="number" value="1" class="input-of-quantity w-12 text-center focus:outline-none px-1" min="1" id="value_quantity" max="${productMaxQuantity}">
                    <button class="increase">+</button>
                </div>
            </div>
            </div>
            `);
            loadModalMessage("Berhasil Menambahkan Produk")
            itemList.scrollTop($(".item-list")[0].scrollHeight);
        },
        error: function (error) {
            console.log(error)
        }
    },

    )
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

$(document).on("click", ".decrease", function (e) {
    const decreaseWrapper = $(e.target).parent();
    const orderQtyCount = decreaseWrapper.closest(".pickup-item").find(".order-quantity-count");
    const qtyInputValue = decreaseWrapper.find("input").val();
    const transactionId = decreaseWrapper.attr("data-transid");
    let qtyUpdatedValue = parseInt(qtyInputValue) - 1;

    if (qtyUpdatedValue >= 1) {
        decreaseWrapper.find("input").val(qtyUpdatedValue);
        orderQtyCount.text(qtyUpdatedValue)
        updateQuantity(transactionId, qtyUpdatedValue, "decrease");
    } else {
        $(this).closest(".pickup-item").remove();
        updateQuantity(transactionId, qtyUpdatedValue, "delete");
    }
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
});


$('.cart-input-quantity').on("input", function (e) {
    let qtyInputValue = $(e.target).val()
    let qtyInputWrapper = $(e.target).parent()
    let qtyInputParsed = qtyInputValue.replace(/[^\d]|,|\.| /g, '')
    const transactionId = qtyInputWrapper.attr("data-transid")

    if (qtyInputParsed.length === 1 && qtyInputParsed[0] === '0' || qtyInputParsed === "") {
        $(e.target).val("")
        return
    }

    if (qtyInputParsed >= 1) {
        $(e.target).val(qtyInputParsed)
        $.ajax({
            url: '/cart/quantityupdate',
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
                loadModalMessage(data.message)
            },
            error: function (error) {

                loadModalMessage("Kamu tidak bisa menambahkan produk karena stoknya habis.")
            }
        })
    }
})


