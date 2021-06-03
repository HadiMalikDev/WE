<?php

use Kreait\Firebase\Exception\FirebaseException;

include('authentication.php');


$userDetails = [
    $_POST["email"],
    $_POST["password"],
];


try {
    $auth->createUserWithEmailAndPassword($userDetails[0], $userDetails[1]);
    echo json_encode(array("success"=>true));
    } 
    catch (FirebaseException $e) {
    echo json_encode(
        array(
            "message" => $e->getMessage(),
            "success" => false
        )
    );
} catch (Exception $e) {
    echo json_encode(
        array(
            'success' => false,
            'message' => strval($e->getMessage())
        )
    );
}
