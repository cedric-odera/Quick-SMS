<?php
require_once ('africa.php');
$test = new africa();

//Accepts the posted data
$json = json_decode(file_get_contents("php://input"));

    foreach ($json as $singlesms){
       
        $number = $singlesms[1];
        $message = $singlesms[2];

        $sms = $test->service_one('+'.$number, $message);

        
    }










