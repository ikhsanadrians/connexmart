import rupiah from "./utils/rupiahFormater.js";

$("#value_quantity").on("input", function (e) {
    const defaultPrice = parseInt($("#price_of_product").attr("data-price"));
    let quantityProduct = $(this).val().replace(/[^\d]|,|\.| /g, '');
    const currentStock = $(e.target).attr("data-currentstock")

    if (quantityProduct.length === 1 && quantityProduct[0] === '0' || $(this).val() === "") {
        $(this).val('');
        return;
    }

    if (parseInt(quantityProduct) >= 1 && parseInt(currentStock) >= parseInt(quantityProduct)) {
        let updatedPrice = parseInt(quantityProduct) * defaultPrice;
        $("#product_price_subtotals").text(rupiah(updatedPrice));
    }

});

$("#increase").on("click", function () {
    let valueQuantity = $("#value_quantity").val();
    let updatedQuantity = parseInt(valueQuantity) + 1;

    if ($('#value_quantity').attr('data-currentstock') >= updatedQuantity) {
        $("#value_quantity").val(updatedQuantity);

        let totalPrices = parseInt($('#price_of_product').attr('data-price')) * updatedQuantity
        $('#product_price_subtotals').text(rupiah(totalPrices))

    }


});

$("#decrease").on("click", function () {
    let valueQuantity = $("#value_quantity").val();
    let updatedQuantity = parseInt(valueQuantity) - 1;

    if (updatedQuantity >= 1) {
        $("#value_quantity").val(updatedQuantity);
    }

    let totalPrices = parseInt($('#price_of_product').attr('data-price')) * updatedQuantity

    if (updatedQuantity >= 1) {
        $('#product_price_subtotals').text(rupiah(totalPrices))
    }

});


$("#mobile-increase").on("click", function () {
    let mb_valueQuantity = $("#mobile_value_quantity").val()
    let mb_updatedQuantity = parseInt(mb_valueQuantity) + 1


    if ($('#mobile_value_quantity').attr('data-mbcurrentstock') >= mb_updatedQuantity) {
        $("#mobile_value_quantity").val(mb_updatedQuantity);

        let totalPrices = parseInt($('#price_of_product').attr('data-price')) * mb_updatedQuantity
        $('#product_price_mobile').text(rupiah(totalPrices))
    }
})

$("#mobile-decrease").on("click", function () {
    let mb_valueQuantity = $("#mobile_value_quantity").val()
    let mb_updatedQuantity = parseInt(mb_valueQuantity) - 1

    if (mb_updatedQuantity >= 1) {
        $("#mobile_value_quantity").val(mb_updatedQuantity)
    }

    let totalPrices = parseInt($('#price_of_product').attr('data-price')) * mb_updatedQuantity

    if (mb_updatedQuantity >= 1) {
        $("#product_price_mobile").text(rupiah(totalPrices))
    }


})



$("#mobile_value_quantity").on("input", function (e) {
    const defaultPrice = parseInt($("#price_of_product").attr("data-price"));
    let quantityProduct = $(this).val().replace(/[^\d]|,|\.| /g, '');
    const currentStock = $(e.target).attr("data-mbcurrentstock")


    if (quantityProduct.length === 1 && quantityProduct[0] === '0' || $(this).val() === "") {
        $(this).val('');
        return;
    }

    if (parseInt(quantityProduct) >= 1 && parseInt(currentStock) > parseInt(quantityProduct)) {
        let updatedPrice = parseInt(quantityProduct) * defaultPrice;
        $("#product_price_mobile").text(rupiah(updatedPrice));
    }

});



