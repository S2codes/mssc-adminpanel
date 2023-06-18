<?php
include "./includes/config.php";
include "./db/conn.php";

$DB = new Database();


$s2 = "SELECT DISTINCT SectorType FROM societies";
$totalSector = $DB->CountRows($s2);



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
    <title>Analytics - Multi State Cooperative Societies</title>
</head>

<style>
    .active {
        color: #000;
    }
</style>

<body id="body-pd">

    <!-- sidebar  -->
    <?php
    include "./partials/sidebar.php"
    ?>


    <section class="componentContainer" style="min-height: 80vh;">
        <!-- <h1>Component</h1> -->
        <div class="navigation mb-2">
            <span class="rootMenu"><a href="#">Home</a> / </span><Span class="mainMenu"><a href="#">Analytics</a></Span>
        </div>


        <div class="dataContainer mt-3">
            <div class="row ">
                <div class="col-md-12 ">
                    <!-- <h3 style="font-weight: 600;">Recent Registration</h3> -->


                    <!-- analytics tab  -->


                    <ul class="nav nav-tabs flex-row" id="myTab" role="tablist" style="height: auto; justify-content: flex-start;">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active tab-navlink" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Popular sectors</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-navlink" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sector in State</button>
                        </li>

                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <!-- popular sector  -->
                        <div class="tab-pane fade  p-2 color-dark w-100 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <h4 class="text-dark mb-2">Total Number of Sector Type -
                                <span class="text-primary">
                                    <?php echo $totalSector; ?>
                                </span>
                            </h4>
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="piChartContainer mt-3">
                                        <div class="chart">
                                            <canvas id="mychart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="piChartDetails mt-3">
                                        <h5 class="text-dark" style="font-weight: 600;">Registrated Sector with frequency</h5>

                                        <table class="table" id="sectorTable">
                                            <thead>
                                                <tr>
                                                    <th>Sr No.</th>
                                                    <th>Sector Type</th>
                                                    <th>Total NUmber</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade  p-2  w-100  " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="grahpChart">

                                    <select required name="state" id="stateSelect" class="form-select mb-4">
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

                                    <!-- DataTable  -->
                                    <table id="StateSectorDataTable" class="mt-3 row-border stripe hover">
                                        <thead>
                                            <th class="text-dark">Sn No.</th>
                                            <th class="text-dark">Sector Type</th>
                                            <th class="text-dark">Quantity</th>
                                        </thead>
                                        <tbody id="StateSectorDataTableBody">

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>



                </div>














            </div>

        </div>
        </div>
    </section>

    <!-- sidebar  -->
    <?php
    include "./partials/footer.php";
    ?>

    <!--===== MAIN JS =====-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="assets/js/main.js"></script>
    <!-- <script src="assets/js/chart.js"></script> -->
    <script src="assets/js/ajaxRequest.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script src="assets/js/anlytics.js"></script>

    <script>
        $(document).ready(function() {

            $('.analyticsPage').addClass('NavItem-active');

            // generate random color 

            function generateRandomRGB() {
                var red = Math.floor(Math.random() * 256);
                var green = Math.floor(Math.random() * 256);
                var blue = Math.floor(Math.random() * 256);
                return 'rgb(' + red + ', ' + green + ', ' + blue + ')';
            }

            function generateRandomColors(n) {
                var colors = [];
                for (var i = 0; i < n; i++) {
                    var randomColor = generateRandomRGB();
                    colors.push(randomColor);
                }
                return colors;
            }


            function LoadData(d) {
                const sectorData = JSON.parse(d)


                var dataColor = generateRandomColors(sectorData.sectorData.length);
                // console.log(randomColors);
                // if (sectorData.response) {
                //     console.log("true");
                //     console.log(sectorData.sectorData);
                //     console.log(sectorData.sectorNum);
                // }

                // insert data in table 
                let sn = 1;
                $.each(sectorData.sectorData, function(key, value) {
                    $('#tableBody').append(`<tr>
                    <td>${sn}</td>
                    <td>${value}</td>
                    <td>${sectorData.sectorNum[key]}</td>
                    </tr>`)
                    sn = sn + 1;
                })

                // ====== chart ====== 

                const data = {

                    labels: sectorData.sectorData,
                    datasets: [{
                        label: 'Sector type Dataset',
                        data: sectorData.sectorNum,
                        backgroundColor: dataColor,
                        hoverOffset: 4
                    }]
                };

                const config = {
                    type: 'pie',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: true,
                                text: 'Sector type Pie Chart'
                            }
                        }
                    },
                }
                chart1 = new Chart(
                    document.getElementById('mychart').getContext("2d"),
                    config
                );



            }

            // here 
            HttpRequest("./api/sectorAnylytics.php", {
                "sector": ""
            }, function(data) {
                LoadData(data)
            })


            // second tab anylyticst 
            // data table 
            $('#StateSectorDataTable').DataTable();


            const stateSelect = $('#stateSelect')
            stateSelect.on('change', function() {
                const selectedState = stateSelect.val();

                HttpRequest("./api/ftechSectorByState", {
                    "state": selectedState
                }, function(response) {
                    const responseData = JSON.parse(response)
                    console.log(response);
                    if (responseData.response) {
                        $('#StateSectorDataTableBody').html("")
                        let sn = 1;
                        $.each(responseData.data, function(key, value) {
                            $('#StateSectorDataTableBody').append(`
                            <tr>
                            <td>${sn}</td>
                            <td>${key}</td>
                            <td>${value}</td>
                            </tr>
                            `)
                            sn = sn + 1;

                        })

                    } else {
                        $('#StateSectorDataTable').dataTable().fnClearTable();
                    }

                })

            })



        })
    </script>



</body>

</html>