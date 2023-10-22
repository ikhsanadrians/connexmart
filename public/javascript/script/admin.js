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


$('#openaddmodal').on('click',function(){
      openModal();
})

$('#closemodal').on('click',function(){
      closeModal();
});

$('#closemodalupdate').on('click',function(){
    closeModalUpdate();
});

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

