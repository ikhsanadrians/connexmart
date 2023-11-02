const openModal = (modalType) => {
    $('.addusermodal').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

const openModalUpdate = () => {
    $('.updateusermodal').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

const closeModalUpdate = () => {
    $('.updateusermodal').addClass('hidden')
    $('.backdrop').addClass('hidden')
}

const closeModal = () => {
    $('.addusermodal').addClass('hidden')
    $('.backdrop').addClass('hidden')
}

const openModalGoods = () => {
    $('.addgoodmodal').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

const closeModalGoods  = () => {
    $('.addgoodmodal').addClass('hidden');
    $('.backdrop').addClass('hidden');
}

const openModalGoodsUpdate = () => {
    $('.updategoodsmodal').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

const closeModalGoodsUpdate = () => {
    $('.updategoodsmodal').addClass('hidden')
    $('.backdrop').addClass('hidden')
}

$('#openaddmodal').on('click',function(){
      openModal();
})

$('#closemodal').on('click',function(){
      closeModal();
});

$('#closemodalupdate').on('click',function(){
    closeModalUpdate();
});



$('#opengoodsmodal').on('click',function(){
    openModalGoods()
})


$('#closegoodmodal').on('click',function(){
    closeModalGoods()
})

$('#closemodalgoodsupdate').on('click',function(){
    closeModalGoodsUpdate()
})



$('.edit-btn').on('click', function(e){
    openModalUpdate()
    const userId = $(this).parent().siblings().eq(0).text();
    const userName = $(this).parent().siblings().eq(1).text();
    const userRoles = $(this).parent().siblings().eq(2).data('role');


   let roleSelect = $(".role-select-update");

    roleSelect.find('option').each(function() {
        let value = $(this).val();
        if (value == userRoles)  $(this).prop('selected', true);
        else $(this).prop('selected', false);
    });

    $('#username-input-update').val(userName);
    $('#username-input-update').data('userid',userId);

})

$('#update-btn').on('click',function(e){
    e.preventDefault();
    const currentUrl = window.location.pathname
    let usernameValue = $('#username-input-update').val()
    let roleValue = $('#role-input-update').val()
    $.ajax({
        method: 'put',
        url : currentUrl,
        dataType: 'json',
        data: {
            "user_id" : $('#username-input-update').data('userid'),
            "username" : usernameValue,
            "role" : roleValue,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            closeModal()
            $('#username-input').val("")
            $('#role-input').val("role").change()
            location.reload()
        },
        error: function(data){
             return
        }
})

})

$('.delete-btn').on('click',function(e){
    if( confirm('Apakah Yakin Ingin Menghapus User Ini?')){
        e.preventDefault();
        const currentUrl = window.location.pathname
        const idToDelete = $(this).parent().siblings().eq(0).text();

        $.ajax({
            method: 'delete',
            url : currentUrl,
            dataType: 'json',
            data: {
                "id_to_delete" : idToDelete,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                location.reload()
            },
            error: function(data){
                 return
            }
    })
    }
})

$('.edit-goods-update-btn').on('click', function(e){
    openModalGoodsUpdate()

    const productId = $(this).parent().siblings().eq(0).text()
    const productName = $(this).parent().siblings().eq(1).text()
    const productPrice = $(this).parent().siblings().eq(2).data('price')
    const productStock = $(this).parent().siblings().eq(3).text()
    const productCategoryId = $(this).parent().siblings().eq(4).data('categoryid')
    const productDescription = $(this).parent().siblings().eq(1).data('description')


    let categoryProductSelect = $(".category-select-goods");

    categoryProductSelect.find('option').each(function(){
        let value = $(this).val()
        value == productCategoryId ? $(this).prop('selected',true) : $(this).prop('selected',false)
    })

    $('#goods-input').val(productName)
    $('#goods-price').val(productPrice)
    $('#goods-stock').val(productStock)
    $('#goods-description').val(productDescription)
})

$('#update-btn-goods').on('click', function(e){

    e.preventDefault();
    const currentUrl = window.location.pathname

    const productName = $('#goods-input').val()
    const productPrice = $('#goods-price').val()
    const productStock = $('#goods-stock').val()
    const productDescription = $('#goods-description').val()
    const productCategoryId = $('#category-input-update').val();

    $.ajax({
        method: 'put',
        url : currentUrl,
        dataType: 'json',
        data: {
            "product_id" : $('.product-id').data('productid'),
            "product_name" : productName,
            "product_price" : productPrice,
            "product_description" : productDescription,
            "product_stock" : productStock,
            "product_categoryid" : productCategoryId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            closeModalGoodsUpdate()
            location.reload()
        },
        error: function(data){
             console.log(data)
        }

   })
})


$('.delete-btn-goods-update').on('click',function(e){
    if( confirm('Apakah Yakin Ingin Menghapus Product Ini?')){
        e.preventDefault();
        const currentUrl = window.location.pathname
        const idToDelete = $(this).parent().siblings().eq(0).text();

        $.ajax({
            method: 'delete',
            url : currentUrl,
            dataType: 'json',
            data: {
                "id_to_delete" : idToDelete,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                location.reload()
                // console.log(data)
            },
            error: function(data){
                 console.log(data)
            }
    })
    }
})

$('#thumbnail-input').on('change',function(e){
    const file = this.files[0];
    if (file){
        let reader = new FileReader();
        reader.onload = function(event){
          console.log(event.target.result);
          $('.icons').addClass('hidden')
          $('.img-previews').removeClass('hidden')
          $('#imgPreview').attr('src', event.target.result);
        
        }
        reader.readAsDataURL(file);
      }
}) 