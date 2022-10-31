$(document).ready(function () {
    $('button.abra').on('click', function () {
        let email = $('#InputEmail').val();
        let password = $('#InputPassword').val();

        $.ajax({
            method: 'post',
            url: '../query/login.php',
            data: {
                email: email,
                password: password
            },
            success: (function (data) {
                let res = JSON.parse(data);
                document.cookie = "user_id=" + res.id;
                document.cookie = "user_email=" + res.email;
                window.location = '/';
            })
        })
    })
})
