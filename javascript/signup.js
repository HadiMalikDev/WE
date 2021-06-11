console.log("ASD");
$(document).ready(function () {
    console.log('called');
    $('#registerForm').bind('submit', function () {
        
        if (document.getElementById('password').value != document.getElementById('confirmation').value) {
            alert('Please make sure the passwords match');
            return;
        }
        if (document.getElementById('email').value == null
            || document.getElementById('password').value == null
            || document.getElementById('confirmation').value == null
        ) {
            alert('Please do not leave any field empty');
            return;
        }

        

        $.ajax({
            type: "POST",
            url: "../php/firestore/register-user.php",
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
                localStorage['uid']=response['uid'];
                window.location.href = '../html/settings-page.html';
            }
        }).fail(function (response) {

        });
        return false;
    });
});