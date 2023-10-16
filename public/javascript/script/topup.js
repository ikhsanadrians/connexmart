let checkbox = $('.nominal-checkbox')
let lastClickedCheckbox = null;

    checkbox.on('click',function(e){
        if (lastClickedCheckbox) {
            lastClickedCheckbox.parent().removeClass('border-2 border-black');
            lastClickedCheckbox.prop('checked',false)
        }

        $(this).parent().addClass('border-2 border-black');
        lastClickedCheckbox = $(this)
        $('#top-up-sum').text($(this).attr('value'))
    })
