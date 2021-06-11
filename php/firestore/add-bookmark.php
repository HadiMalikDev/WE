<?php
include('C:\xampp\htdocs\phpFile\php\firestore\firestore.php');

    
$uid=$_GET['uid'];
$verse_key=$_GET['verse_key'];

echo FirestoreApi::getInstance()->addBookmark($uid,$verse_key);
?>