$(document).ready(function () {
    $('button.abra').on('click', function () {
        let email = $('#InputEmail').val();
        let password = $('#InputPassword').val();

        $.ajax({
            method: 'post',
            url: '../query/registration.php',
            data: {
                email: email,
                password: password
            },
            success: (function () {
                window.location = 'http://localhost/general';
            })
        })
            .done(function (msg) {
                alert("data saved: " + msg);
            });
    })
})
