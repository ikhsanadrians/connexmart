import rupiah from "./utils/rupiahFormater.js";

$("#increase").on("click", function () {
    let valueQuantity = $("#value_quantity").val();
    let updatedQuantity = parseInt(valueQuantity) + 1;

    if($('#value_quantity').attr('data-currentstock') >= updatedQuantity){
        $("#value_quantity").val(updatedQuantity);

        let totalPrices = parseInt($('#price_of_product').attr('data-price')) * updatedQuantity
        $('#product_price').text(rupiah(totalPrices))

    }


});

$("#decrease").on("click", function () {
    let valueQuantity = $("#value_quantity").val();
    let updatedQuantity = parseInt(valueQuantity) - 1;

    if (updatedQuantity >= 1) {
        $("#value_quantity").val(updatedQuantity);
    }

    let totalPrices = parseInt($('#price_of_product').attr('data-price')) * updatedQuantity

    if(updatedQuantity >= 1){
        $('#product_price').text(rupiah(totalPrices))
    }

});



console.log("hello wolrdx");
