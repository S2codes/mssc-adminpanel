<?php
     include "../includes/config.php";
     include "../db/conn.php";
     $DB = new Database();    

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            


        $s2 = "SELECT DISTINCT SectorType FROM societies";
        $totalSector = $DB->CountRows($s2);
        
        $sectorData = $DB->RetriveArray($s2);
        
        $sectorDataWithNum = array();
        $sectorName = array();
        
        foreach ($sectorData as $key => $st) {
            $n = $st['SectorType'];
            if ($n != "") {
                array_push($sectorName, $n);
            }
        }

        foreach ($sectorData as $key => $st) {
            $t = $st['SectorType'];
            $s = "SELECT * FROM `societies` WHERE `SectorType`='$t'";
            $sectorNUm = $DB->CountRows($s);
            if ($t != "") {
                array_push($sectorDataWithNum, $sectorNUm);
            }
        }
        
        echo json_encode(array(
            "response" => true,
            "sectorData" => $sectorName,
            "sectorNum" => $sectorDataWithNum
        ));


    
}


?>