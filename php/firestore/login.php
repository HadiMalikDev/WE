<?php


include('C:\xampp\htdocs\phpFile\php\firestore\x.php');
$userDetails = [
    $_POST["email"],
    $_POST["password"],
];
echo FirebaseApi::getInstance()->loginUser($userDetails[0],$userDetails[1]);
