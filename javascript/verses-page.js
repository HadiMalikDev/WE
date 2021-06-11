import {Verse} from './models/verse.js'

$(document).ready(
    function () {
    $.ajax({
        type: "GET",
        url: "../php/api/fetch_verses.php",
        dataType: "json",
        data:{
            chapter:localStorage["chapter"],
        }

    }).done(function (response) {
        var verses=response;
        verses.forEach(rawVerse => {
            addVerse(rawVerse);
        });
    }).fail(function (response){
        console.log(response);
    });
    

    function addVerse(rawVerse) {
        var verse = new Verse(rawVerse.verse_key, rawVerse.verse, rawVerse.verseTranslation);
        var htmlVerse = getHTMLVerse(verse);
        $('#verses').append(htmlVerse);
    }
    
    function getHTMLVerse(verse) {
        var element=document.createElement('div');
        var bookmarkElement=document.createElement('div');
        bookmarkElement.innerHTML=`🖤`;
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
            <div>
            🖤
            </div>
            </div>
        </div>`;
        element.onclick=function () {
            $.ajax({
                type: "GET",
                url: "../php/firestore/add-bookmark.php",
                dataType: "json",
                data:{
                    verse_key:verse.verse_key,
                    uid:localStorage['uid']
                }
        
            }).done(function (response) {
                if(response.success){
                    alert('Bookmark added');
                }
            });
        }
        return element;
    }

})