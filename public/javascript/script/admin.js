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


const openModalCategory = (visible) => {
    $(".addcategorymodal").toggleClass("hidden", !visible);
    $('.backdrop').toggleClass('hidden', !visible);
}

const openModalCategoryUpdate = (visible) => {
    $("#updategoodscategorymodal").toggleClass("hidden", !visible);
    $(".backdrop").toggleClass("hidden", !visible)
}

$("#closegoodcategorymodal").on("click", function () {
    openModalCategory(false)
})

$("#opengoodcategorymodal").on("click", function () {
    openModalCategory(true)
})

$(document).on("click", ".edit-goods-categoty-update-btn", function () {
    const productname = $(this).parent().parent().siblings().eq(0).attr("data-name")
    const productId = $(this).attr('id')

    $('#category-name-input-update').val(productname)
    $("#category-name-input-update").attr("data-categoryid", productId)
    $("#category_update_id").val(productId)

    openModalCategoryUpdate(true)

})

$('#update-form-category').on('submit', function () {
    $('#category_update_id').val($('#category_update_id').val())

    return true
});


$("#closegoodcategorymodalupdate").on("click", function () {
    openModalCategoryUpdate(false)
})




