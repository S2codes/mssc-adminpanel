<?php
include "./includes/config.php";
include "./db/conn.php";
$DB = new Database();

$searchQuery = $_GET['q'];

if (!isset($searchQuery) || empty($searchQuery) || $searchQuery == '') {
    header("Location: ./index");
}

$sql = "SELECT * FROM `societies` WHERE 
`SocietyName` LIKE '%$searchQuery%' 
OR `Address` LIKE '%$searchQuery%'
OR `State` LIKE '%$searchQuery%'  
OR `OperationArea` LIKE '%$searchQuery%'  
OR `SectorType` LIKE '%$searchQuery%'  
";

$numberOfItemFind = $DB->CountRows($sql);
$allData = $DB->RetriveArray($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

    <!-- ===== CSS ===== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <title>Search - Multi State Cooperative Societies</title>
</head>

<body id="body-pd">
    <!-- sidebar  -->
    <?php
    include "./partials/sidebar.php"

    ?>


    <section class="componentContainer" style="min-height: 80vh;">
        <!-- <h1>Component</h1> -->
        <div class="navigation mb-2">
            <span class="rootMenu"><a href="#">Home</a> / </span><Span class="mainMenu"><a href="#">Search Result</a></Span>
        </div>


        <div class="dataContainer mt-3">
            <?php

            if ($allData) {

                echo ' <h3> <span class="text-primary">'.$numberOfItemFind.'</span> Record Found</h3>';

                foreach ($allData as $key => $d) {
                    echo '
                    <div class="searchItem px-3 p-2 mb-3">
                    <a href="view?id=' . $d['id'] . '" class="w-100">
                        <p class="searchItemTitle mb-1">' . $d['SocietyName'] . '</p>
                        <ul class="list-unstyled m-0 d-flex attributes">
                            <li class="text-dark">
                                <span class="fw-bold">
                                    <i class="bi bi-geo-alt-fill"></i> State :
                                </span> ' . $d['State'] . '
                            </li>
    
                            <li class="text-dark pe-3">
                                <span class="fw-bold">
                                    <i class="bi bi-buildings-fill"></i> Sector :
                                </span>
                                ' . $d['SectorType'] . '
                            </li>
    
                        </ul>
                    </a>
    
    
                </div>
    
                    ';
                }
            } else {
                echo '<h4 class="text-center text-danger mt-5">No Record Found</h4>';
            }

            ?>


        </div>
    </section>

    <!-- sidebar  -->
    <?php
    include "./partials/footer.php";
    ?>

    <!--===== MAIN JS =====-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="assets/js/main.js"></script>

    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>


</body>

</html>