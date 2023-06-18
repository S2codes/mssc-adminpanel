<?php
include "./includes/config.php";
include "./db/conn.php";
$DB = new Database();
$id = $_GET['id'];
if (!isset($id) || empty($id) || $id == '') {
    header("Location: ./index");
}

$s = "SELECT * FROM `societies` WHERE `id` = $id";
if ($DB->CountRows($s) < 1) {
    header("Location: ./index");
}
$Data = $DB->RetriveSingle($s);


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
    <title>Registered Data - Multi State Cooperative Societies</title>
</head>

<body id="body-pd">

    <?php
    include "./partials/sidebar.php"
    ?>


    <section class="componentContainer" style="min-height: 80vh; ">
        <div class="navigation mb-2">
            <span class="rootMenu"><a href="#">Home</a> / </span><Span class="mainMenu"><a href="#">Details</a></Span>
        </div>


        <div class="dataContainer mt-3">

            <h5 style="font-weight: 600;" class="text-primary">Details of Society</h5>
            <div class="row p-3">
                <div class="col-md-8 ">
                    <ul class="list-unstyled m-0 p-0">
                        <li class="mb-2"><span class="tag">Name of Society</span>: <?php echo $Data['SocietyName'] ?></li>
                        <li class="mb-2"><span class="tag">State</span>: <?php echo $Data['State'] ?></li>
                        <li class="mb-2"><span class="tag">District</span>: <?php echo $Data['District'] ?></li>
                        <li class="mb-2"><span class="tag">Date of Registration</span>: <?php echo $Data['RegistrationDate'] ?></li>
                        <li class="mb-2"><span class="tag">Address</span>: <?php echo $Data['Address'] ?></li>
                        <li class="mb-2"><span class="tag">Area of Operation</span>:
                            <?php
                            $a = explode(", ", $Data['OperationArea']);

                            foreach ($a as $key => $value) {
                                echo '
                            <span class="badge bg-primary m-1 p-2">' . $value . '</span>
                            ';
                            }
                            ?>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </section>


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