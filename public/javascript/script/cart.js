import rupiah from "./utils/rupiahFormater.js";

const quantities = document.querySelectorAll('.quantities')
let currentInputElement = "";
const priceElements = document.querySelectorAll('.price-products');

// Fungsi untuk menghitung jumlah semua nilai input

$(document).ready(function () {
    initializeTotals();
    updateTotals();
});


function initializeTotals() {
    const totalPricesFromStorage = localStorage.getItem('total_prices');
    if (totalPricesFromStorage) {
        $('#total_prices').text(totalPricesFromStorage);
    }
}


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

    console.log(productTotalPrice)
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

//addToCart Logic
// $('.add-to-cart').on('click', function (e) {
//     if ($(this).attr('data-islogined') == "logined") {
//         e.preventDefault()
//         const currentUrl = '/cart'

//         let productName = $(this).closest('.product-card').find('h1').text();
//         $('#success-product-name').text(productName)
//         openModal()
//         let productId = $(this).attr('id')
//         let productQuantity = $(this).siblings().eq(0).val()

//         $.ajax({
//             method: 'post',
//             url: currentUrl,
//             dataType: 'json',
//             data: {
//                 "product_id": productId,
//                 "quantity": productQuantity,
//                 _token: $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function (data) {
//                 $('#quantity').val(1);
//             },
//             error: function (data) {
//                 return
//             }
//         })
//     } else {
//         showLoginCard()
//     }

// });


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
