<?php
include "./includes/config.php";
include "./db/conn.php";
$DB = new Database();

$sql = "SELECT * FROM `societies`";
$allData = $DB->RetriveArray($sql);


$s2 = "SELECT DISTINCT SectorType FROM societies";
$Sectors = $DB->RetriveArray($s2);


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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <title>Registered Data - Multi State Cooperative Societies</title>
</head>

<body id="body-pd">
    <!-- sidebar  -->
    <?php
    include "./partials/sidebar.php"

    ?>


    <section class="componentContainer">
        <!-- <h1>Component</h1> -->
        <div class="navigation mb-2">
            <span class="rootMenu"><a href="#">Home</a> / </span><Span class="mainMenu"><a href="#">Registered
                    Data</a></Span>
        </div>


        <div class="dataContainer mt-3">
            <div class="row mb-2 sortingRow">
                <div class="col-md-4">
                    <label for="" class="form-label fw-color-bold">Sort By State</label>
                    <select required name="state" id="stateSelect" class="form-select">
                        <option value="">Select a state</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="jammu and kashmir">jammu and kashmir</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label fw-color-bold">Sort By Sector Type</label>
                    <select name="" required id="selectSector" class="form-select">
                        <option value="">Select Sector Type</option>
                        <?php
                        foreach ($Sectors as $key => $s) {
                            if ($s['SectorType'] != "") {
                                echo '<option value="' . $s['SectorType'] . '">' . $s['SectorType'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label fw-color-bold">Sort By Operation Area</label>
                    <select name="" id="operationAreaSelect" required class="form-select">
                        <option value="">Select a Area</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                    </select>
                </div>
            </div>

            <div class="row ">
                <div class="col-md-12 ">
                    <!-- <h3 style="font-weight: 600;">Recent Registration</h3> -->
                    <table id="DataTable" class="row-border stripe hover">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name of Society</th>
                                <th>State</th>
                                <th>District</th>
                                <th>Sector Type</th>
                                <th>Area of Operation</th>
                                <th>Date of Registration</th>
                            </tr>
                        </thead>

                        <tbody id="tablleBody">

                            <?php

                            $sn = 1;
                            foreach ($allData as $key => $data) {
                                // $date = date_create($data['RegistrationDate']);
                                // $d = date_format($date, 'D/M/Y');
                                $d = $data['RegistrationDate'];
                                echo '
                                <tr>
                                <td>' . $sn . '</td>
                                <td>
                                    <a href="view?id=' . $data['id'] . '">' . $data['SocietyName'] . '</a>
                                </td>
                                <td>' . $data['State'] . '</td>
                                <td>' . $data['District'] . '</td>
                                <td>' . $data['SectorType'] . '</td>
                                <Td>' . $data['OperationArea'] . '</Td>
                                <td>' . $d . '</td>
                            </tr>
                                ';
                                $sn = $sn + 1;
                            }

                            ?>


                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </section>

    <!-- sidebar  -->
    <?php
    include "./partials/footer.php"
    ?>

    <!--===== MAIN JS =====-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>

    <script src="assets/js/main.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js/ajaxRequest.js"></script>



    <script>
        $(document).ready(function() {

            $('.dataPage').addClass('NavItem-active');


            $('#DataTable').DataTable();


            // load filter data 
            function LoadData(d) {
                const resultData = JSON.parse(d)
                if (resultData.response) {

                    $('#tablleBody').html("")
                    let sn = 1;
                    $.each(resultData.data, function(key, value) {

                        $('#tablleBody').append(`
                        <tr>
                               <td>${sn}</td>
                               <td>
                                   <a href="view?id=${value.id}">${value.SocietyName}</a>
                               </td>
                               <td>${value.State}</td>
                               <td>${value.District}</td>
                               <td>${value.SectorType}</td>
                               <Td>${value.OperationArea}</Td>
                               <td>${value.RegistrationDate}</td>
                           </tr>
                        `)
                        sn = sn + 1;

                    })

                } else {
                    
                    $('#DataTable').dataTable().fnClearTable();
                }
            }


            // filter state 
            const stateSelect = $('#stateSelect')

            stateSelect.on('change', function() {
                const selectedState = stateSelect.val();

                HttpRequest("./api/fetchSortByState.php", {
                    "state": selectedState
                }, function(data) {
                    LoadData(data)
                })

            })

            // filter Sector
            const sectorSelect = $('#selectSector')

            sectorSelect.on('change', function() {
                const selectedSector = sectorSelect.val();
                HttpRequest("./api/fetchSortBySector.php", {
                    "sector": selectedSector
                }, function(data) {
                    LoadData(data)
                })

            })


            // filter operation area
            const areaSelect = $('#operationAreaSelect')

            areaSelect.on('change', function() {
                const selectedArea = areaSelect.val();
                alert(selectedArea)

                HttpRequest("./api/fetchSortByArea.php", {
                    "area": selectedArea
                }, function(data) {
                    LoadData(data)
                })

            })

         


        })
    </script>



</body>

</html>