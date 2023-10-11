$(document).ready(function () {

$('#login-btn').on('click',function(){
    $('.login').toggleClass('hidden');
    $('.backdrop').toggleClass('hidden');
})

function hideLoginCard(){
    $('.login').addClass('hidden')
    $('.backdrop').toggleClass('hidden')
    $('.login-error').addClass('hidden')
    $('#user-id').val("")
    $('#user-password').val("")
}

function showLoginCard(){
    $('.login').removeClass('hidden')
    $('.backdrop').removeClass('hidden')
}


$('#close-btn').on('click',function(){
   hideLoginCard()
});

$('#submit-login').on('click',function(e){
    e.preventDefault();
    const currentUrl = window.location.pathname
    $.ajax({
        method: 'post',
        url : currentUrl,
        dataType: 'json',
        data: {
            "username" : $('#user-id').val(),
            "password" : $('#user-password').val(),
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success:function(data){
            if(data.message == "auth-err"){
              showLoginCard()
              $('.login-error').removeClass('hidden')
            } else {
              hideLoginCard()
              location.reload()
            }
            console.log(data)
        },
        error: function(data){
            // console.log(data)
            showLoginCard()
        }
    })
});

});
