const quantities = document.querySelectorAll('.quantities')
let currentInputElement = "";
const priceElements = document.querySelectorAll('.price-products');

// Fungsi untuk menghitung jumlah semua nilai input

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
    $('#total_prices').text(totalPrice);
}



function openModal(){
    $('.success-addproduct').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

function showLoginCard(){
    $('.login').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

function hideLoginCard(){
    $('.login').addClass('hidden')
    $('.backdrop').toggleClass('hidden')
    $('.login-error').addClass('hidden')
    $('#user-id').val("")
    $('#user-password').val("")
}



function closeModal(){
    $('.success-addproduct').addClass('hidden')
    $('.backdrop').addClass('hidden')
}

$('#close-btn-successaddproduct').on('click',function(){
    closeModal()
})



quantities.forEach(element => {
    element.addEventListener('change', function(e) {
        updateTotals();
        // Memperbarui tampilan quantityAll
        $.ajax({
            method: 'put',
            url : '/cart/quantityupdate',
            dataType: 'json',
            data: {
                "transaction_id" : e.target.getAttribute('data-transaction'),
                "quantity" : e.target.value,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                console.log(data)
            },
            error: function(data){
                 console.log(data)
            }
    })


    });
});


//addToCart Logic
$('.add-to-cart').on('click',function(e){
    if($(this).attr('data-islogined') == "logined"){
        e.preventDefault()
        const currentUrl = '/cart'

        let productName = $(this).closest('.product-card').find('h1').text();
        $('#success-product-name').text(productName)
        openModal()
        let productId = $(this).attr('id')
        let productQuantity = $(this).siblings().eq(0).val()

        $.ajax({
            method: 'post',
            url : currentUrl,
            dataType: 'json',
            data: {
                "product_id" : productId,
                "quantity" : productQuantity,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
               $('#quantity').val(1);
            },
            error: function(data){
                 return
            }
    })
    } else {
        showLoginCard()
    }

});
