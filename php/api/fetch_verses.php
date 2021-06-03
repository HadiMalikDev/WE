<?php

include('C:\xampp\htdocs\phpFile\php\api\api.php');

    $chapter=$_GET["chapter"];
    echo json_encode(Api::getInstance()->fetchVerses($chapter));
?>
