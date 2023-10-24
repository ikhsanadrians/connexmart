const quantities = document.querySelectorAll('.quantities')
const price = document.querySelectorAll('.price-products')
let currentInputElement = "";

// Fungsi untuk menghitung jumlah semua nilai input
function calculateTotal() {
    let quantityAll = 0;
    quantities.forEach(element => {
        quantityAll += parseInt(element.value);
    });
    return quantityAll;
}

function multiplyAll(){
    let quantityAll = 0;
    quantities.forEach()

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
        currentInputElement = e.target.id;

        // Memperbarui tampilan quantityAll
        const quantityAll = calculateTotal();
        $('#product_count').text(quantityAll);

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
