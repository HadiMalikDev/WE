<?php
include('C:\xampp\htdocs\phpFile\php\api\api.php');

$versekey=$_GET['verse_key'];

echo Api::getInstance()->fetchSpecificVerse($versekey);

