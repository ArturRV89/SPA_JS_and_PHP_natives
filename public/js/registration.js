$(document).ready(function () {
    $('button.register').on('click', function () {
        let email = $('#InputEmail').val();
        let password = $('#InputPassword').val();

        $.ajax({
            method: 'post',
            url: '../query/registration.php',
            data: {
                email: email,
                password: password
            },
            success: (function (data) {
                let res = JSON.parse(data);
                document.cookie = "user_id=" + res[1].id;
                document.cookie = "user_email=" + res[1].email;
                window.location = 'http://localhost/general';
            })
        })
    })
})
