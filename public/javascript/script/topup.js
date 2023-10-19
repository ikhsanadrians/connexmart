import rupiah from "./utils/rupiahFormater.js";

let checkbox = $('.nominal-checkbox')
let lastClickedCheckbox = null;

checkbox.on('click', function (e) {
    if (lastClickedCheckbox) {
        lastClickedCheckbox.parent().removeClass('selected-topup');
        lastClickedCheckbox.prop('checked', false)
    }

    $(e.target).parent().addClass('selected-topup');
    lastClickedCheckbox = $(e.target)
    $('#top-up-sum').text(rupiah($(this).attr('value')))
    $('#top-up-submit').prop('disabled', false);

})

$('#top-up-submit').on('click', function (e) {
    e.preventDefault();
    const currentUrl = window.location.pathname

    const selectedNominals = checkbox.filter(':checked').map(function () {
        return $(this).attr('value');
    }).get();

    $('#load').removeClass('!hidden')
    $('.content-top-up').addClass('hidden')

    $.ajax({
        method: 'post',
        url: currentUrl,
        dataType: 'json',
        data: {
            "nominals": selectedNominals[0],
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data.data.user.name)
            $('#load').addClass('!hidden')
            $('#success-topup').removeClass('!hidden')
            $('#unique-code').text(data.data.unique_code)
            $('#nominals').text(rupiah(data.data.nominals))
            $('#unique-code-value').val(data.data.unique_code)
            $('#user-name').text(data.data.user.name)
        },
        error: function (data) {
            console.log(data)
        }
    })
});
