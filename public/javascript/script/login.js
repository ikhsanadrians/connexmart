$(document).ready(function () {
    const currentUrl = window.location.pathname


    $("#showpass").on("click", function () {
        const passInputType = $("#password-input").attr('type');
        passInputType === "password" ? showPass() : hidePass();
    });

    $("#login-btn").on("click", function () {
        checkAuth()
    })

    $("#password-input").on("keyup", function () {
        checkInputValue()
    })

    $("#username-input").on("keyup", function () {
        checkInputValue()
    })

    function showPass() {
        $("#password-input").attr('type', 'text');
        $(".bi-eye-fill").addClass("eyechecked")
    }

    function hidePass() {
        $("#password-input").attr('type', 'password');
        $(".bi-eye-fill").removeClass("eyechecked")
    }

    function enableButton() {
        $("#login-btn").prop("disabled", false);
        $("#login-btn").removeClass("disabled");
    }

    function disableButton() {
        $("#login-btn").prop("disabled", true);
        $("#login-btn").addClass("disabled");
    }

    function checkInputValue() {
        const usernameInput = $("#username-input").val()
        const passwordInput = $("#password-input").val()
        const loginButton = $("#login-btn")

        usernameInput && passwordInput ? enableButton() : loginButton.addClass("disabled")
    }

    function showAlertError() {
        $("#modal-alert").removeClass("hidden-items");
        setTimeout(() => {
            $("#modal-alert").addClass("hidden-items");
        }, 5000)
    }

    function clearForm() {
        $("#username-input").val("")
        $("#password-input").val("")
    }

    function checkAuth() {

        $("#form-wrappers").addClass("hidden-items")
        $("#loader").removeClass("hidden-items")
        $.ajax({
            method: 'post',
            url: currentUrl,
            dataType: 'json',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                "username": $('#username-input').val(),
                "password": $('#password-input').val()
            },
            success: function (data) {
                $("#form-wrappers").removeClass("hidden-items")
                $("#loader").addClass("hidden-items")

                if (data.status == "unauthenticated") {
                    showAlertError()
                    clearForm()
                    disableButton()
                } else {
                    window.location.replace("/");
                }

            },
            error: function (error) {
                console.log(error)
            }

        })
    }


});
