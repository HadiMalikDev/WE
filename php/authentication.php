<?php

require_once '../php/vendor/autoload.php';
use Kreait\Firebase\Factory;

$factory = (new Factory)->withServiceAccount('php-c8a6e-firebase-adminsdk-xxx9v-64d193ee86.json');

$auth = $factory->createAuth();

?>