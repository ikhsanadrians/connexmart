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

const closeModalGoods = () => {
    $('.addgoodmodal').addClass('hidden');
    $('.backdrop').addClass('hidden');
    $('#thumbnail-input').val("");
    $('#category-input').val('goods-category');
}

const openModalGoodsUpdate = () => {
    $('.updategoodsmodal').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}

const closeModalGoodsUpdate = () => {
    $('.updategoodsmodal').addClass('hidden')
    $('.backdrop').addClass('hidden')
}

$('#openaddmodal').on('click', function () {
    openModal();
})

$('#closemodal').on('click', function () {
    closeModal();
});

$('#closemodalupdate').on('click', function () {
    closeModalUpdate();
});



$('#opengoodsmodal').on('click', function () {
    openModalGoods()
})


$('#closegoodmodal').on('click', function () {
    closeModalGoods()
})

$('#closemodalgoodsupdate').on('click', function () {
    closeModalGoodsUpdate()
})



$('.edit-btn').on('click', function (e) {
    openModalUpdate()
    const userId = $(this).parent().siblings().eq(0).text();
    const userName = $(this).parent().siblings().eq(1).text();
    const userRoles = $(this).parent().siblings().eq(2).data('role');


    let roleSelect = $(".role-select-update");

    roleSelect.find('option').each(function () {
        let value = $(this).val();
        if (value == userRoles) $(this).prop('selected', true);
        else $(this).prop('selected', false);
    });

    $('#username-input-update').val(userName);
    $('#username-input-update').data('userid', userId);

})

$('#update-btn').on('click', function (e) {
    e.preventDefault();
    const currentUrl = window.location.pathname
    let usernameValue = $('#username-input-update').val()
    let roleValue = $('#role-input-update').val()
    $.ajax({
        method: 'put',
        url: currentUrl,
        dataType: 'json',
        data: {
            "user_id": $('#username-input-update').data('userid'),
            "username": usernameValue,
            "role": roleValue,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            closeModal()
            $('#username-input').val("")
            $('#role-input').val("role").change()
            location.reload()
        },
        error: function (data) {
            return
        }
    })

})

$('.delete-btn').on('click', function (e) {
    if (confirm('Apakah Yakin Ingin Menghapus User Ini?')) {
        e.preventDefault();
        const currentUrl = window.location.pathname
        const idToDelete = $(this).parent().siblings().eq(0).text();

        $.ajax({
            method: 'delete',
            url: currentUrl,
            dataType: 'json',
            data: {
                "id_to_delete": idToDelete,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                location.reload()
            },
            error: function (data) {
                return
            }
        })
    }
})

$('.edit-goods-update-btn').on('click', function (e) {
    openModalGoodsUpdate()

    const productId = $(this).parent().parent().siblings().eq(0).data('productid')
    const productThumbnail = $(this).parent().parent().siblings().eq(1).data('thumbnail')
    const productName = $(this).parent().parent().siblings().eq(2).text()
    const productPrice = $(this).parent().parent().siblings().eq(3).data('price')
    const productStock = $(this).parent().parent().siblings().eq(4).text()
    const productCategoryId = $(this).parent().parent().siblings().eq(5).data('categoryid')
    const productDescription = $(this).parent().parent().siblings().eq(2).data('description')
    const urlProductThumbnail = "http://127.0.0.1:8000/" + productThumbnail.replace(/\/mart\//, '/');

    let categoryProductSelect = $(".category-select-goods");

    categoryProductSelect.find('option').each(function () {
        let value = $(this).val()
        value == productCategoryId ? $(this).prop('selected', true) : $(this).prop('selected', false)
    })

    $('#goods-input').val(productName)
    $('#goods-price').val(productPrice)
    $('#goods-stock').val(productStock)
    $('#product_id').val(productId)
    $('#goods-description').val(productDescription)
    $('#imgPreviewUpdate').attr('src', urlProductThumbnail)
})

$('#update-forms').on('submit', function () {
    $('#product_id').val($('#product_id').val())
    console.log('test')

    return true
});



$('#thumbnail-input').on('change', function (e) {
    const file = this.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {

            $('.icons').addClass('hidden')
            $('.img-previews').removeClass('hidden')
            $('#imgPreview').attr('src', event.target.result);

        }
        reader.readAsDataURL(file);
    }
})

const openModalCategory = () => {

}
