
$(document).ready(function () {
    $('#registerForm').bind('submit', function () {
        $.ajax({
            type: "POST",
            url: "../php/upload-user-details.php",
            data: {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            },
            dataType: "json"

        }).done(function (response) {
            if (!response.success) {
                document.getElementById('formMessage').innerHTML = response.message;
            }
            else {
                window.location.href = '../html/main-page.html';
            }
        }).fail(function (response) {

        });
        return false;
    });
});