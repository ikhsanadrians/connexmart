
$(document).ready(function () {
    loadPaymentMethodDesc()
    checkConfirmPaymentMethod()
    loadPaymentMethodBox()
});

let currentPaymentMethod = ""


function modalPaymentMethod(visible) {
    $(".chosee-paymentmethod").toggleClass("hidden", !visible);
    $('.backdrop').toggleClass('hidden', !visible);
}

function modalInsertAddress(visible) {
    $(".insertaddress").toggleClass("hidden", !visible)
    $(".backdrop").toggleClass("hidden", !visible)
}


$("#close-btn-paymentmethod").on("click", function () {
    modalPaymentMethod(false)
})

$("#choose-payment-method-btn").on("click", function () {
    modalPaymentMethod(true)
})

$(".payment-change").on("click", function () {
    modalPaymentMethod(true)
})

$(".change-address").on("click", function () {
    modalInsertAddress(true)
})

$("#close-btn-insertaddress").on("click", function () {
    modalInsertAddress(false)
})



function loadPaymentMethodDesc() {
    $(".extend-tenbank").click(() => {
        $(".expanded-payment").toggleClass("hidden");
        $(".arrow").toggleClass("rotate");
    });

    $(".tenizen-bank-desc").removeClass("hidden");

    $(".form-radio").click((e) => {
        $(".btn-payment-method-confirm").prop("disabled", false).removeClass("disabled-items")
        $("#choose-payment-method-btn").removeClass("hidden")
        $(".tenizen-bank-desc, .bayar-di-kantin-desc, .cod-desc").addClass("hidden");
        $(".tenizen-bank-method, .bayar-di-kantin-method, .cod-method").addClass("hidden")

        switch (e.target.value) {
            case "tb-1":
                $(".tenizen-bank-desc").removeClass("hidden")
                currentPaymentMethod = e.target.value
                break;
            case "tb-2":
                $(".tenizen-bank-desc").removeClass("hidden")
                currentPaymentMethod = e.target.value
                break;
            case "bdk":
                $(".bayar-di-kantin-desc").removeClass("hidden");
                currentPaymentMethod = e.target.value
                break;
            case "cod":
                $(".cod-desc").removeClass("hidden")
                currentPaymentMethod = e.target.value
                break;
            default:
                break;
        }
    });
}

function checkConfirmPaymentMethod() {
    $(".btn-payment-method-confirm").on("click", function () {
        localStorage.setItem("payment_method", currentPaymentMethod)
        modalPaymentMethod(false)
        loadPaymentMethodBox()
    })
}

function loadPaymentMethodBox() {
    let paymentMethod = localStorage.getItem("payment_method")

    switch (paymentMethod) {
        case "tb-1":
            $(".tenizen-bank-method").removeClass("hidden")
            $("#tenbank-options").text("Antar Ke Tempat")
            $("#choose-payment-method-btn").addClass("hidden")
            break;
        case "tb-2":
            $(".tenizen-bank-desc").removeClass("hidden")
            $(".tenizen-bank-method").removeClass("hidden")
            $("#tenbank-options").text("Ambil Ke Kantin")
            $("#choose-payment-method-btn").addClass("hidden")
            break;
        case "bdk":
            $(".bayar-di-kantin-desc").removeClass("hidden");
            $(".bayar-di-kantin-method").removeClass("hidden")
            $("#choose-payment-method-btn").addClass("hidden")
            break;
        case "cod":
            $(".cod-desc").removeClass("hidden")
            $(".cod-method").removeClass("hidden")
            $("#choose-payment-method-btn").addClass("hidden")
            break;
        default:
            $("#choose-payment-method-btn").removeClass("hidden")
            break;
    }
}

