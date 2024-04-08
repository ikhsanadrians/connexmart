import rupiah from "./utils/rupiahFormater.js";

const quantities = document.querySelectorAll('.quantities')
let currentInputElement = "";
const priceElements = document.querySelectorAll('.price-products');
let checkboxCheckout = $(".checkbox-checkout")


$(document).ready(function () {
    loadCheckBoxProduct()
    checkboxAllProduct()
    checkIfCheckboxAll()
    calculateTotal('quantity')
    calculateTotal('price')
});

function calculateTotal(type) {
    let total = 0;

    $('.cart-input-quantity').each((index, element) => {
        const isDataSelected = $(element).attr("data-selected");
        if (isDataSelected == "1") {
            total += type === 'price' ? parseInt(element.value * $(element).attr("data-singleprice")) : parseInt(element.value);
        }
    });

    if (type === 'price') {
        $(".product-price-info").text(rupiah(total));
    } else if (type === 'quantity') {
        $(".product-qty-info").text(total);
    }
}

function checkIfCheckboxAll() {
    $("#checkallproduct").prop("checked", (localStorage.length === checkboxCheckout.length && (localStorage.length >= 1 && checkboxCheckout.length >= 1)));
    $("#checkproductall-dekstop").prop("checked", (localStorage.length === checkboxCheckout.length && (localStorage.length >= 1 && checkboxCheckout.length >= 1)));
}


function checkoutButtonVisibility(visibleType) {
    if (visibleType) {
        $(".btn-checkout").removeClass("disabled-items");
        $(".btn-checkout").addClass("g-button")
        $(".btn-checkout").prop("disabled", false)
    } else {
        $(".btn-checkout").addClass("disabled-items");
        $(".btn-checkout").removeClass("g-button")
        $(".btn-checkout").prop("disabled", true)
    }
}


function loadCheckBoxProduct() {
    checkboxCheckout.on("change", function (e) {
        this.checked ? localStorage.setItem(e.target.id, "checked") : localStorage.removeItem(e.target.id)
        this.checked ? checkoutButtonVisibility(true) : checkoutButtonVisibility(false)
        loadCheckBoxProduct()
        checkIfCheckboxAll()
        calculateTotal('quantity')
        calculateTotal('price')
    });

    checkboxCheckout.each((index, checkbox) => {
        let data = localStorage.getItem(checkbox.id);
        const parentCheckbox = $(checkbox).closest(".card")
        if (data) {
            checkbox.checked = true
            checkoutButtonVisibility(true)
            parentCheckbox.find(".cart-input-quantity").attr("data-selected", "1")
        } else {
            checkbox.checked = false
            parentCheckbox.find(".cart-input-quantity").attr("data-selected", "0")
        }
    });
}

function checkboxAllProduct() {
    $("#checkallproduct").on("change", function (e) {
        const isChecked = this.checked;

        checkoutButtonVisibility((isChecked && checkboxCheckout.length >= 1) ? true : false);

        checkboxCheckout.each((index, checkbox) => {
            const parentCheckbox = $(checkbox).closest(".card");
            const data = localStorage.getItem(checkbox.id);
            const newDataValue = isChecked ? "checked" : "";

            checkbox.checked = isChecked;
            newDataValue ? localStorage.setItem(checkbox.id, newDataValue) : localStorage.removeItem(checkbox.id);
            parentCheckbox.find(".cart-input-quantity").attr("data-selected", newDataValue ? "1" : "0");
        });

        loadCheckBoxProduct();
        calculateTotal('quantity');
        calculateTotal('price');
        checkIfCheckboxAll()
    });

    $("#checkproductall-dekstop").on("change", function (e) {
        const isCheckedDekstop = this.checked

        checkoutButtonVisibility(isCheckedDekstop ? true : false);

        checkboxCheckout.each((index, checkbox) => {
            const parentCheckbox = $(checkbox).closest(".card")
            const data = localStorage.getItem(checkbox.id)
            const newDataValue = isCheckedDekstop ? "checked" : ""

            checkbox.checked = isCheckedDekstop
            newDataValue ? localStorage.setItem(checkbox.id, newDataValue) : localStorage.removeItem(checkbox.id)
            parentCheckbox.find(".cart-input-quantity").attr("data-selected", newDataValue)
        })

        loadCheckBoxProduct()
        calculateTotal('quantity')
        calculateTotal('price')
        checkIfCheckboxAll()
    })

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
                calculateTotal('quantity')
                calculateTotal('price')
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
                calculateTotal('quantity')
                calculateTotal('price')
                loadModalMessage("Berhasil Memperbarui Produk")
            },
            error: function (error) {
                loadModalMessage("Kamu tidak bisa menambahkan produk karena stoknya habis.")
                console.log(error)
            }
        })
    }

})

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
                loadModalMessage("Berhasil Memperbarui Produk")
            },
            error: function (error) {

                loadModalMessage("Kamu tidak bisa menambahkan produk karena stoknya habis.")
            }
        })
    }
})




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

$('.add-to-cart').on('click', function (e) {
    const currentUrl = '/cart'
    const parentContainer = $(this).closest('.container')
    let productQuantity = parentContainer.find('.input-of-quantity').val()
    let productId = $(this).children().attr('id')
    let productName = $(this).children().attr('data-name')
    let productTotalPrice = parentContainer.find('.subtotal').children().eq(1).text()
    const currentStock = parentContainer.find('.input-of-quantity').attr("data-currentstock")


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
            loadModalMessage("Kamu tidak bisa menambahkan produk karena stoknya habis.")
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
    let totalPrices = parseInt(productQuantity) * $("#product_price_mobile").attr("data-singleprice")
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
            $("#product-quantity-success").text(productQuantity)
            $("#product-price-success").text(rupiah(totalPrices))
            closeQuantityEditor(false)
            openSuccessAddToCart()
        },
        error: function (error) {
            loadModalMessage("Kamu tidak bisa menambahkan produk karena stoknya habis.")
        }

    })

})


$(".delete-product").on("click", function (e) {
    const currentUrl = '/cart'
    const deleteWrapper = $(e.target).closest(".card")
    const productId = deleteWrapper.find(".input-quantity").attr("data-transid")
    const checkBoxProduct = deleteWrapper.find(".checkbox-checkout")

    if (localStorage.getItem(productId)) {
        localStorage.removeItem(productId)

        loadCheckBoxProduct()
        checkIfCheckboxAll()

    }

    $.ajax({
        method: "delete",
        url: currentUrl,
        dataType: "json",
        data: {
            "product_id": productId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            deleteWrapper.remove()
            location.reload()
            loadModalMessage("Berhasil Menghapus Data")
            calculateTotal("price")
            calculateTotal("quantity")
            loadCheckBoxProduct()
            checkIfCheckboxAll()
        },
        error: function (error) {
            return
        }
    })
})

$(".btn-checkout").on("click", function (e) {
    const currentUrl = "/cart/checkout"
    let transactionList = [];

    checkboxCheckout.each((index, checkbox) => {
        if (checkbox.checked) {
            transactionList.push($(checkbox).attr("id"))
        }
    })

    $.ajax({
        method: "put",
        url: currentUrl,
        dataType: "json",
        data: {
            "product_list": transactionList,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            window.location.href = `/cart/checkout/${data.checkout_code}`
        },
        error: function (error) {
            console.log(error)
        }
    })
})
