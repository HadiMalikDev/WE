<?php

require_once './vendor/autoload.php';
use Kreait\Firebase\Factory;

$factory = (new Factory)->withServiceAccount('php-c8a6e-firebase-adminsdk-xxx9v-64d193ee86.json');
$firestore = $factory->createFirestore();
$database = $firestore->database();

$collection = $database->collection('users');

?>