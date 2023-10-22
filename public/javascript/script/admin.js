const editButtons = document.querySelectorAll('.edit-btn')

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


editButtons.forEach((button) => {
    button.addEventListener('click',(e)=>{
        openModal()
        console.log($(e.target).data('id'))
        $('#user-name-modal').text(`Update ${$(e.target).data('id')}`)
    })
})
