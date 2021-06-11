$(document).ready(function () {
    
    
    $.ajax({
        type: "GET",
        url: "../php/firestore/get-user-details.php",
        dataType: "json",
        data: {
            uid: localStorage['uid'],
        }
    }).done(function (response) {
        if(!response.success){
            alert('Error. Please try again later');
        }
        else{
            document.getElementById('name').value=response.data.name;
            document.getElementById('city').value=response.data.city;
            document.getElementById('countryName').value=response.data.country;
            document.getElementById('age').value=response.data.age;
        }
    });
    
    
    
    $('#settings').bind('submit', function () {
        if (
            document.getElementById('name').value == ''
            || document.getElementById('name').value == null
            || document.getElementById('city').value == ''
            || document.getElementById('city').value == null
            || document.getElementById('countryName').value == ''
            || document.getElementById('countryName').value == null
            || document.getElementById('age').value == ''
            || document.getElementById('age').value == null
        ) {
            alert('Please do not leave any field empty');
        }
        else {
            $.ajax({
                type: "GET",
                url: "../php/firestore/update-user.php",
                dataType: "json",
                data: {
                    name: document.getElementById('name').value,
                    city: document.getElementById('city').value,
                    countryName: document.getElementById('countryName').value,
                    age: document.getElementById('age').value,
                    uid: localStorage['uid'],
                }
            }).done(function (response) {
                
            });
            
        }
    });

})