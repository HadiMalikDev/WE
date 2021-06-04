
$(document).ready(function () {
    console.log('called');
    $('#loginForm').bind('submit', function () {
        console.log("called");
        $.ajax({
            type: "POST",
            url: "../php/login.php",
            data: {
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
            },
            dataType: "json"

        }).done(function (response) {
            if (!response.success) {
                alert(response.message);
            }
            else {
                window.location.href = '../html/main-page.html';
            }
        }).fail(function (response) {

        });
        return false;
    });
});