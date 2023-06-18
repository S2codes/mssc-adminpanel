
<?php
    include "../includes/config.php";
    include "../db/conn.php";
    $DB = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $indianStates = ["Andhra Pradesh","New Delhi", "Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat","Haryana","Himachal Pradesh","Jharkhand","jammu and kashmir","Karnataka","Kerala","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Ladakh","Punjab","Rajasthan","Sikkim","Tamil Nadu","Telangana","Tripura","Uttar Pradesh","Uttarakhand","West Bengal"];
        
        $data = array();

        foreach ($indianStates as $key => $state) {
            $stateName = strtoupper($state);
            $s = "SELECT * FROM `societies` WHERE `State` = '$stateName'";
            $num = $DB->CountRows($s); 

            if ( $num> 0) {
                $Result = $DB->RetriveArray($s);
                $StateName = str_replace(' ', '', $state);
                $data[$StateName] = $num;
            }else{
                $StateName = str_replace(' ', '', $state);
                $data[$StateName] = 0;

            }
   
        }
          
        echo json_encode($data);

    }

?>
