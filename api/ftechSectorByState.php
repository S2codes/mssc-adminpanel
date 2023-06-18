<?php
    include "../includes/config.php";
    include "../db/conn.php";
    $DB = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $state = $_POST['state'];
        
        $s = "SELECT * FROM `societies` WHERE `State` = '$state'";
        $totalSectorNum = $DB->CountRows($s);
        $DataROW = $DB->RetriveArray($s);

        $data = array();

        foreach ($DataROW as $key => $item) {
            $SectorType = $item['SectorType'];
            $s1 = "SELECT * FROM `societies` WHERE `State` = '$state' AND `SectorType` = '".$SectorType."'";
            $sectorQuntity = $DB->CountRows($s1);
            $data[$SectorType] = $sectorQuntity; 
        }


        if ($totalSectorNum > 0) {
            echo json_encode(array(
                "response" => true,
                "data" => $data
            ));
        }else{
            echo json_encode(array(
                "response" => false,
                "message" => "No records found" 
            ));
        }


    }



?>