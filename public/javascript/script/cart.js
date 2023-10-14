$('#quantities').on('change',function(){
    let totalPrices  = $('#quantities').val() += $('#product_count').text();
    $('#product_count').text($(this).val())
    $('#total_prices').text(totalPrices)
});  