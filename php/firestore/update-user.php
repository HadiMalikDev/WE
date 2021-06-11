<?php
include('C:\xampp\htdocs\phpFile\php\firestore\firestore.php');


$name=$_GET['name'];
$city=$_GET['city'];
$countryName=$_GET['countryName'];
$age=$_GET['age'];
$uid=$_GET['uid'];

echo FirestoreApi::getInstance()->uploadUserDetails($uid,$name,$city,$countryName,$age);


?>