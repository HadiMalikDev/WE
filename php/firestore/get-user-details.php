<?php 

include('C:\xampp\htdocs\phpFile\php\firestore\firestore.php');

$uid=$_GET['uid'];
echo FirestoreApi::getInstance()->getUserDetails($uid);

?>