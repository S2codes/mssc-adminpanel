<?php
include "./includes/config.php";
include "./db/conn.php";
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
    <title>Admin Panel - Multi State Cooperative Societies</title>
</head>

<body id="body-pd">

    <!-- sidebar  -->
    <?php
    include "./partials/sidebar.php";
    $DB =  new Database();

    $s1 = "SELECT * FROM `societies`";
    $totalRegisteredSocity = $DB->CountRows($s1);

    $s2 = "SELECT DISTINCT SectorType FROM societies";
    $totalSector = $DB->CountRows($s2);

    $s3 = "SELECT DISTINCT State FROM societies";
    $totalState = $DB->CountRows($s3);

    $s4 = "SELECT DISTINCT District FROM societies";
    $totalDistrict = $DB->CountRows($s4);

    // recent 10 registred 
    $s5 = "SELECT * FROM `societies`  
    ORDER BY `societies`.`id`  DESC LIMIT 10";
    $recentRegisterData = $DB->RetriveArray($s5);



    ?>


    <section class="componentContainer">
        <!-- <h1>Component</h1> -->
        <div class="navigation mb-2">
            <span class="rootMenu"><a href="#">Home</a> / </span><Span class="mainMenu"><a href="#">DashBoard</a></Span>
        </div>

        <!-- statictics card  -->
        <div class="row">
            <div class="col m-2 numBox">
                <div class="numIcon" style="background-color: rgba(3, 3, 177, 0.678);">
                    <!-- <i class='bx bxs-widget'></i> -->
                    <i class="bi bi-buildings-fill"></i>
                </div>
                <div class="numDetails">
                    <span class="numHead">Registered Society </span>
                    <span id="totalnum">
                        <?php
                        echo $totalRegisteredSocity;
                        ?>
                    </span>
                </div>
            </div>
            <div class="col m-2 numBox">
                <div class="numIcon" style=" background-color: rgba(134, 12, 175, 0.705);">
                    <i class="bi bi-bounding-box"></i>
                </div>
                <div class="numDetails">
                    <span class="numHead">Total Sectors</span>
                    <span id="totalnum">
                        <?php
                        echo $totalSector;
                        ?>
                    </span>
                </div>
            </div>
            <div class="col m-2 numBox">
                <div class="numIcon" style=" background-color: rgba(3, 3, 177, 0.678);">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="numDetails">
                    <span class="numHead">Total States</span>
                    <span id="totalnum">
                        <?php
                        echo $totalState;
                        ?>
                    </span>
                </div>
            </div>
            <div class="col m-2 numBox">
                <div class="numIcon" style=" background-color: rgba(134, 12, 175, 0.705);;">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="numDetails">
                    <span class="numHead">Total District</span>
                    <span id="totalnum">
                        <?php
                        echo $totalDistrict;
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="dataContainer mt-3">
            <div class="row ">
                <div class="col-md-6 ">
                    <h3 style="font-weight: 600;">Recent Registration</h3>
                    <table class="table resTable" id="recentData">

                        <tbody>

                            <?php
                            foreach ($recentRegisterData as $key => $d) {
                                echo '
                                <tr>
                                <td class="recentProduct"><a href="./view?id=' . $d['id'] . '">' . $d['SocietyName'] . '</a></td>
                                <td class="recentDate">' . $d['SectorType'] . '</td>
                            </tr>
                                ';
                            }
                            ?>


                        </tbody>
                    </table>

                </div>
                <div class="col-md-6 ">
                    <h3 style="font-weight: 600;">Overview</h3>
                    <p>State with total number of Sector</p>
                    <div class="rightdata">
                        <div class="chart">
                            <!-- <canvas id="mychart"></canvas> -->
                            <div id="chartdiv"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer  -->
    <?php
    include "./partials/footer.php"
    ?>


    <!--===== MAIN JS =====-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- chart  -->

    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/maps.js"></script>
    <script src="https://www.amcharts.com/lib/4/geodata/india2019High.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/ajaxRequest.js"></script>

    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
    <script>
        var MapData = [];
        $(document).ready(function() {

            $('.HomePage').addClass('NavItem-active');

            HttpRequest("./api/fetchForMap", {}, function(data) {
                MapData = JSON.parse(data);
                // console.log(MapData);
                loadDataToMap(MapData)
            })

            const loadDataToMap = function(mapSectordata) {



                console.log(" here");
                console.log(mapSectordata);
                console.log(mapSectordata.Bihar);

                // Themes begin

                am4core.useTheme(am4themes_animated);
                // Themes end

                // Create map instance
                var chart = am4core.create("chartdiv", am4maps.MapChart);

                // Set map definition
                chart.geodata = am4geodata_india2019High;

                // Create map polygon series
                var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

                //Set min/max fill color for each area
                polygonSeries.heatRules.push({
                    property: "fill",
                    target: polygonSeries.mapPolygons.template,
                    min: chart.colors.getIndex(0).brighten(1),
                    min: chart.colors.getIndex(1).brighten(0.3),
                    // logarithmic: true
                    // "min": am4core.color("#ffd7b1"), 
                });

                // Make map load polygon data (state shapes and names) from GeoJSON
                polygonSeries.useGeodata = true;

                // Set heatmap values for each state
                polygonSeries.data = [{
                        id: "IN-JK",
                        value: mapSectordata.jammuandkashmir
                    },
                    {
                        id: "IN-MH",
                        value: mapSectordata.Maharashtra
                    },
                    {
                        id: "IN-UP",
                        value: mapSectordata.UttarPradesh
                    },
                    {
                        id: "US-AR",
                        value: mapSectordata.ArunachalPradesh
                    },
                    {
                        id: "IN-RJ",
                        value: mapSectordata.Rajasthan
                    },
                    {
                        id: "IN-AP",
                        value: mapSectordata.AndhraPradesh
                    },
                    {
                        id: "IN-MP",
                        value: mapSectordata.MadhyaPradesh
                    },
                    {
                        id: "IN-TN",
                        value: mapSectordata.TamilNadu
                    },
                    {
                        id: "IN-JH",
                        value: mapSectordata.Jharkhand
                    },
                    {
                        id: "IN-WB",
                        value: mapSectordata.WestBengal
                    },
                    {
                        id: "IN-GJ",
                        value: mapSectordata.Gujarat
                    },
                    {
                        id: "IN-BR",
                        value: mapSectordata.Bihar
                    },
                    {
                        id: "IN-TG",
                        value: mapSectordata.Telangana
                    },
                    {
                        id: "IN-GA",
                        value: mapSectordata.Goa
                    },
                    {
                        id: "IN-DN",
                        value: 00
                    },
                    {
                        id: "IN-DL",
                        value: mapSectordata.NewDelhi
                    },
                    {
                        id: "IN-DD",
                        value: 00
                    },
                    {
                        id: "IN-CH",
                        value: 00
                    },
                    {
                        id: "IN-CT",
                        value: mapSectordata.Chhattisgarh
                    },
                    {
                        id: "IN-AS",
                        value: mapSectordata.Assam
                    },
                    {
                        id: "IN-AR",
                        value: mapSectordata.ArunachalPradesh
                    },
                    {
                        id: "IN-AN",
                        value: 00
                    },
                    {
                        id: "IN-KA",
                        value: mapSectordata.Karnataka
                    },
                    {
                        id: "IN-KL",
                        value: mapSectordata.Kerala
                    },
                    {
                        id: "IN-OR",
                        value: mapSectordata.Odisha
                    },
                    {
                        id: "IN-SK",
                        value: mapSectordata.Sikkim
                    },
                    {
                        id: "IN-HP",
                        value: mapSectordata.HimachalPradesh
                    },
                    {
                        id: "IN-PB",
                        value: mapSectordata.Punjab
                    },
                    {
                        id: "IN-HR",
                        value: mapSectordata.Haryana
                    },
                    {
                        id: "IN-UT",
                        value: mapSectordata.Uttarakhand
                    },
                    {
                        id: "IN-LK",
                        value: mapSectordata.Ladakh
                    },
                    {
                        id: "IN-MN",
                        value: mapSectordata.Manipur
                    },
                    {
                        id: "IN-TR",
                        value: mapSectordata.Tripura
                    },
                    {
                        id: "IN-MZ",
                        value: mapSectordata.Mizoram
                    },
                    {
                        id: "IN-NL",
                        value: mapSectordata.Nagaland
                    },
                    {
                        id: "IN-ML",
                        value: mapSectordata.Meghalaya
                    }
                ];

                // polygonSeries.data = mapSectordata;

                // Configure series tooltip
                var polygonTemplate = polygonSeries.mapPolygons.template;
                polygonTemplate.tooltipText = "{name}: {value}";
                polygonTemplate.nonScalingStroke = true;
                polygonTemplate.strokeWidth = 0.5;

                // Create hover state and set alternative fill color
                var hs = polygonTemplate.states.create("hover");
                hs.properties.fill = am4core.color("#ff7d01");


            }

        })
    </script>

</body>

</html>