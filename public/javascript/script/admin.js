// const editButtons = document.querySelectorAll('.edit-btn')

const openModal = () => {
    $('.addusermodal').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
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

$('.edit-btn').on('click', function(e){
    $('#user-name-modal').text(`Update User`)
    $('#password-input').addClass('hidden');
    openModal()
    const userId = $(this).parent().siblings().eq(0).text();
    const userName = $(this).parent().siblings().eq(1).text();
    const userRoles = $(this).parent().siblings().eq(2).data('role');


   let roleSelect = $(".role-select");

    roleSelect.find('option').each(function() {
        let value = $(this).val();
        if (value == userRoles)  $(this).prop('selected', true);
        else $(this).prop('selected', false);
    });

    $('#username-input').val(userName);
    $('#username-input').data('userid',userId);

})

$('#modal-btn').on('click',function(e){
    e.preventDefault();
    const currentUrl = window.location.pathname
    let usernameValue = $('#username-input').val()
    let roleValue = $('#role-input').val()
    $.ajax({
        method: 'put',
        url : currentUrl,
        dataType: 'json',
        data: {
            "user_id" : $('#username-input').data('userid'),
            "username" : usernameValue,
            "role" : roleValue,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            closeModal()
            location.reload()
        },
        error: function(data){
            console.log(data)
        }
    })
})


