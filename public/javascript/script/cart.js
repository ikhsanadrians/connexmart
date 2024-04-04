import rupiah from "./utils/rupiahFormater.js";

const quantities = document.querySelectorAll('.quantities')
let currentInputElement = "";
const priceElements = document.querySelectorAll('.price-products');
const checkboxCheckout = $(".checkbox-checkout")


$(document).ready(function () {
    loadCheckBoxProduct()
    // initializeTotals();
    updateTotals();
});


function loadCheckBoxProduct() {
    checkboxCheckout.on("change", function (e) {
        this.checked ? localStorage.setItem(e.target.id, "checked") : localStorage.removeItem(e.target.id)
    });

    checkboxCheckout.each((index, checkbox) => {
        let data = localStorage.getItem(checkbox.id);
        data ? checkbox.checked = true : false
    });
}


function loadModalMessage(messageText) {
    $("#modal-message").removeClass("hidden-items")
    $("#modal-text").text(messageText)
    setTimeout(() => {
        $("#modal-message").addClass("hidden-items")
    }, 2000)
}

$(".cart-decrease").on("click", function (e) {
    const decreaseWrapper = $(e.target).parent()
    const qtyInputValue = decreaseWrapper.find("input").val()
    const transactionId = decreaseWrapper.attr("data-transid")
    let qtyUpdatedValue = parseInt(qtyInputValue) - 1

    if (qtyUpdatedValue >= 1) {
        decreaseWrapper.find("input").val(qtyUpdatedValue)
        $.ajax({
            url: '/cart/quantityupdate',
            method: 'put',
            dataType: 'json',
            data: {
                "transaction_id": transactionId,
                "quantity": qtyUpdatedValue,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                loadModalMessage("Berhasil Memperbarui Produk")
            },
            error: function (error) {
                return
            }
        })
    }

})

$(".cart-increase").on("click", function (e) {
    const increaseWrapper = $(e.target).parent()
    const qtyInputValue = increaseWrapper.find("input").val()
    const transactionId = increaseWrapper.attr("data-transid")
    const maxInputValue = increaseWrapper.find("input").attr("max")

    let qtyUpdatedValue = parseInt(qtyInputValue) + 1

    if (qtyUpdatedValue <= maxInputValue) {
        increaseWrapper.find("input").val(qtyUpdatedValue)
        $.ajax({
            url: '/cart/quantityupdate',
            method: 'put',
            dataType: 'json',
            data: {
                "transaction_id": transactionId,
                "quantity": qtyUpdatedValue,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                loadModalMessage("Berhasil Memperbarui Produk")
            },
            error: function (error) {
                loadModalMessage("Kamu tidak bisa menambahkan produk karena stoknya habis.")
            }
        })
    }

})

$('.cart-input-quantity').on("input", function (e) {
    let qtyInputValue = $(e.target).val()
    let qtyInputWrapper = $(e.target).parent()
    let qtyInputParsed = qtyInputValue.replace(/[^\d]|,|\.| /g, '')
    const transactionId = qtyInputWrapper.attr("data-transid")
    const maxInputValue = $(e.target).attr("max")


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
                loadModalMessage("Berhasil Memperbarui Produk")
            },
            error: function (error) {
                loadModalMessage("Kamu tidak bisa menambahkan produk karena stoknya habis.")
            }
        })
    }


})



// function initializeTotals() {
//     const totalPricesFromStorage = localStorage.getItem('total_prices');
//     if (totalPricesFromStorage) {
//         $('#total_prices').text(totalPricesFromStorage);
//     }
// }


function calculateTotalQuantity() {
    let totalQuantity = 0;
    quantities.forEach((element) => {
        totalQuantity += parseInt(element.value);
    });
    return totalQuantity;
}


function calculateTotalPrice() {
    let totalPrice = 0;
    quantities.forEach((element, index) => {
        const quantity = parseInt(element.value);
        const price = parseFloat(priceElements[index].getAttribute('data-price')); // Get the price from the data attribute
        totalPrice += quantity * price;
    });
    return totalPrice;
}

// Function to update the total price
function updateTotals() {
    const totalQuantity = calculateTotalQuantity();
    const totalPrice = calculateTotalPrice();
    $('#product_count').text(totalQuantity);
    localStorage.setItem('total_prices', totalPrice);
    $('#total_prices').text(rupiah(totalPrice));
    $('#product-price-top').text(rupiah(totalPrice));
    $('#product-price-top').attr('data-prices', totalPrice);
}



function openModal() {
    $('.success-addproduct').removeClass('hidden-items')
    $('.backdrop').removeClass('hidden')
}

function showLoginCard() {
    $('.login').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

function hideLoginCard() {
    $('.login').addClass('hidden')
    $('.backdrop').toggleClass('hidden')
    $('.login-error').addClass('hidden')
    $('#user-id').val("")
    $('#user-password').val("")
}


function openModalBalanceNotEnough() {
    $('.balance-not-enough').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

function closeModalBalanceNotEnough() {
    $('.balance-not-enough').addClass('hidden')
    $('.backdrop').addClass('hidden')
}


function closeModal() {
    $('.success-addproduct').addClass('hidden')
    $('.backdrop').addClass('hidden')
}

$('#close-btn-successaddproduct').on('click', function () {
    closeModal()
})

$('#close-btn-balancenotenough').on('click', function () {
    closeModalBalanceNotEnough()
})



quantities.forEach(element => {
    element.addEventListener('change', function (e) {
        // e.target.value = quantity
        // Memperbarui tampilan quantityAll
        updateTotals();
        $.ajax({
            method: 'put',
            url: '/cart/quantityupdate',
            dataType: 'json',
            data: {
                "transaction_id": e.target.getAttribute('data-transaction'),
                "quantity": e.target.value,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                updateTotals();
                console.log(data)
            },
            error: function (data) {
                console.log(data)
            }
        })


    });
});

//delete product in cart logic

$('.btn-delete-product').on('click', function (e) {
    const currentUrl = "/cart"
    const product = $(this);
    const currentBtnId = e.currentTarget.id

    $.ajax({
        method: 'delete',
        url: currentUrl,
        dataType: 'json',
        data: {
            "product_id": currentBtnId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            product.parent().parent().parent().remove()
            location.reload()
        },
        error: function (data) {
            console.log(data)
        }
    })


})



$('.add-to-cart').on('click', function (e) {
    const currentUrl = '/cart'
    const parentContainer = $(this).closest('.container')
    let productQuantity = parentContainer.find('.input-of-quantity').val()
    let productId = $(this).children().attr('id')
    let productName = $(this).children().attr('data-name')
    let productTotalPrice = parentContainer.find('.subtotal').children().eq(1).text()

    $.ajax({
        method: 'post',
        url: currentUrl,
        dataType: 'json',
        data: {
            "product_id": productId,
            "quantity": productQuantity,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            openModal()
            $("#dekstop-quantity-product").text(productQuantity)
            $("#dekstop-total-price").text(productTotalPrice)
        },
        error: function (error) {
            console.log(error)
        }

    })

})


//payCart Logic
$('#btn-pay').on('click', function (e) {

    const currentUrl = '/cart/pay'

    e.preventDefault()
    $.ajax({
        method: 'put',
        url: currentUrl,
        dataType: 'json',
        data: {
            total_prices: $('#product-price-top').attr('data-prices'),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            window.location.replace("/cart/receipt");
        },
        error: function (data) {
            openModalBalanceNotEnough();
        }
    })


})


//mobile cart logic

function openQuantityEditor() {
    $("#chosee-quantity").removeClass("hidden-items")
    $("#chosee-quantity").addClass("visible-items")
    $(".backdrop").removeClass("hidden")
}

function openSuccessAddToCart() {
    $("#success-addtocart").removeClass("hidden-items")
    $("#success-addtocart").addClass("visible-items")
}

function closeQuantityEditor(backdropOption) {
    $("#chosee-quantity").removeClass("visible-items").addClass("hidden-items")

    if (backdropOption) {
        $(".backdrop").addClass("hidden");
    }
}

function closeSuccessAddToCart() {
    $("#success-addtocart").removeClass("visible-items")
    $("#success-addtocart").addClass("hidden-items")
    $(".backdrop").addClass("hidden")
}


$("#open_cart").on("click", function () {
    openQuantityEditor()
})


$("#closeqtyeditor").on("click", function () {
    closeQuantityEditor(true)
})

function showQtyModalLoader(option) {
    if (option) {
        $("#loader-choseeqty").removeClass("!hidden")
    } else {
        $("#loader-choseeqty").addClass("!hidden")
    }
}

$("#closesuccessmodal").on("click", function (e) {
    closeSuccessAddToCart()
})



$(".mobile-add-to-cart").on("click", function (e) {
    const currentUrl = '/cart'
    const productId = $(this).attr('id')
    let productQuantity = $(this).siblings().eq(3).children().eq(1).children().children().eq(1).val()
    showQtyModalLoader(true)
    $.ajax({
        method: 'post',
        url: currentUrl,
        dataType: 'json',
        data: {
            "product_id": productId,
            "quantity": productQuantity,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            showQtyModalLoader(false)
            closeQuantityEditor(false)
            openSuccessAddToCart()
        },
        error: function () {
            return
        }

    })

})
