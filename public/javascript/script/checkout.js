
$(document).ready(function () {
    loadPaymentMethodDesc();
});


function loadPaymentMethodDesc() {
    $(".extend-tenbank").on("click", function () {
        $(".expanded-payment").toggleClass("hidden")
    })

    $(".tenizen-bank-desc").removeClass("hidden");

    $(".form-radio").on("click", function (e) {
        $(".tenizen-bank-desc").addClass("hidden");
        $(".bayar-di-kantin-desc").addClass("hidden");
        $(".cod-desc").addClass("hidden");

        if (e.target.value == "tb") {
            $(".tenizen-bank-desc").removeClass("hidden");
        } else if (e.target.value == "bdk") {
            $(".bayar-di-kantin-desc").removeClass("hidden");
        } else if (e.target.value == "cod") {
            $(".cod-desc").removeClass("hidden");
        }
        console.log(e.target.value);
    });
}

