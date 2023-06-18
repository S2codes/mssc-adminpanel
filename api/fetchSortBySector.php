<?php
    include "../includes/config.php";
    include "../db/conn.php";
    $DB = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $sector = $_POST['sector'];
        
        $s = "SELECT * FROM `societies` WHERE `SectorType` = '$sector'";
        $Result = $DB->RetriveArray($s);
        if ($Result) {
            echo json_encode(array(
                "response" => true,
                "data" => $Result
            ));
        }else{
            echo json_encode(array(
                "response" => false,
                "message" => "No records found" 
            ));
        }


    }



?>