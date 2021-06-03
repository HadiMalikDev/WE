import { Surah } from "./models/surah.js";

$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "../php/api/fetch_surahs.php",
        dataType: "json",

    }).done(function (response) {
        var rawchapters = response.chapters;
        
        rawchapters.forEach(rawchapter => {
            addChapter(rawchapter);
        });
    });

    function addChapter(rawchapter) {
        var chapter = new Surah(rawchapter.id, rawchapter.name_simple, rawchapter.translated_name.name);
        var htmlSurah = getHTMLSurah(chapter);
        $('#surahs').append(htmlSurah);

    }

    function getHTMLSurah(chapter) {
        var element=document.createElement('div');
        element.innerHTML=
        `<div class="surah">
            <div class="surah-name-arab">
                ${chapter.name}
            </div>
            <div class="surah-name-english">
                ${chapter.translatedName}
            </div>
        </div>`;
        element.onclick=function () {
            localStorage["chapter"]=chapter.id;
            window.location.href="../html/verses-page.html";
        };
        return element;
    }

});