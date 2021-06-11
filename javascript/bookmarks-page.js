import {Verse} from './models/verse.js'

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "../php/firestore/get-bookmarks.php",
        dataType: "json",
        data:{
            uid:localStorage["uid"],
        }

    }).done(function (response) {
    if(response.success){
        console.log(response);
        if(response.data.length==0){
            console.log('No bookmarks added yet!');
        }
        else{
            for(var i=0;i<response.data.length;i++){
                console.log(i);
                getBookMarkedVerse(response.data[i].verse_key);   
            }
            
            
        }
    }
    else{
        console.log('Invalid response');
    } 
    });

})
function getBookMarkedVerse(verse_key){
    $.ajax({
        type: "GET",
        url: "../php/api/get-specific-verse.php",
        dataType: "json",
        data:{
            verse_key:verse_key,
        }

    }).done(function (response) {
        addVerse(response);
        
    }).fail(function (response){
        console.log(response);
    });
}
function addVerse(rawVerse) {
    var verse = new Verse(rawVerse.verse_key, rawVerse.verse, rawVerse.verseTranslation);
    var htmlVerse = getHTMLVerse(verse);
    $('#bookmarks').append(htmlVerse);
}


function getHTMLVerse(verse) {
    var element=document.createElement('div');
    element.innerHTML=
    `<div class="verse">
        <div class="verse_key">
            ${verse.verse_key}
        </div>
        <div>
            <div class="verse_arabic">
                ${verse.verse}
            </div>
            <div class="translation">
                ${verse.verseTranslation}
            </div>
        </div>
        </div>
    </div>`;
    return element;
}