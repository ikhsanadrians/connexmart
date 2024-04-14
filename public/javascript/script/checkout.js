
$(document).ready(function () {
    loadPaymentMethodDesc()
    checkConfirmPaymentMethod()
    loadPaymentMethodBox()
});

let currentPaymentMethod = ""

function loadModalMessage(messageText) {
    $("#modal-message").removeClass("hidden-items")
    $("#modal-text").text(messageText)
    setTimeout(() => {
        $("#modal-message").addClass("hidden-items")
    }, 2000)
}


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
        
        const paymentMethods = {
            "tb-1": ".tenizen-bank-desc",
            "tb-2": ".tenizen-bank-desc",
            "bdk": ".bayar-di-kantin-desc",
            "cod": ".cod-desc"
        };

        $(".btn-payment-method-confirm").prop("disabled", false).removeClass("disabled-items");
        $("#choose-payment-method-btn").removeClass("hidden");
        $(".tenizen-bank-desc, .bayar-di-kantin-desc, .cod-desc").addClass("hidden");
        $(".tenizen-bank-method, .bayar-di-kantin-method, .cod-method").addClass("hidden");

        const selectedPaymentMethod = paymentMethods[e.target.value];
        if (selectedPaymentMethod) {
            $(selectedPaymentMethod).removeClass("hidden");
            currentPaymentMethod = e.target.value;
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


function checkValueInputAddress(){
    const recipient = $("#recipient").val()
    const recipientNumber = $("#recipient_phone").val()
    const address = $("#address").val()
    
    recipient && recipientNumber && address ? checkoutBtnGroupVisibility("insertAddress" , true) : checkoutBtnGroupVisibility("insertAddress", false)
    
}

$("#recipient_phone").on("input", function() {
    $(this).val($(this).val().slice(0, 13));
});


$("#recipient, #recipient_phone, #address").on("keyup", function(){
    checkValueInputAddress()
})
 

function submitAddress(){ 
    const recipient = $("#recipient").val()
    const recipientNumber = $("#recipient_phone").val()
    const address = $("#address").val()

    $.ajax({
        url: '/cart/checkout/updateaddress',
        method: 'put',
        dataType: 'json',
        data: {
            "recipient": recipient,
            "recipient_phonenumber" : recipientNumber,
            "address" : address,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
           modalInsertAddress(false)
           $("#address-box").removeClass("hidden")
           $("#recipient_name").text(recipient)
           $("#recipient_phonenumber").text(recipientNumber)
           $("#recipient_address").text(address)
           $("#address-warning").addClass("hidden")
           loadModalMessage("Berhasil Menambahkan Alamat")
        },
        error: function (error) {
            loadModalMessage("Gagal Menambahkan Alamat")
            console.log(error)
        }
    })

}   

$(".btn-confirm-address").on("click", function(){
    submitAddress()
})

function checkoutBtnGroupVisibility(btnType, visible) {
    const targetElement = btnType === "insertAddress" ? $(".btn-confirm-address") : $(".payment-button");
    
    targetElement.prop("disabled", !visible)
                 .toggleClass("disabled-items", !visible);
}

