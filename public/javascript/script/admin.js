$('#openaddmodal').on('click',function(){
   $('.addusermodal').removeClass('hidden')
   $('.backdrop').removeClass('hidden')
})

$('#closemodal').on('click',function(){
   $('.addusermodal').addClass('hidden')
   $('.backdrop').addClass('hidden')
});
