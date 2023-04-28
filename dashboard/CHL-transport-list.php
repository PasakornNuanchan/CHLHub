<?php
require 'function/auth/get_session.php';
 
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transport</title>
    <?php include '../assets/include/theme_include_css.php'; ?>

</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    <!--Sidebar Start-->
    <?php include 'include/sidebarmain.php'; ?>
    <!--Sidebar End-->

    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <?php include 'include/nevbarmain.php'; ?>
            <!--Nav End-->
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <!-- MAIN BODY START -->

          
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <!-- <label class="control-label col-sm-2 col-lg-2 ">Transport Status :</label> -->
                                <div class="col-sm-2">
                                    <!-- <div class="row">
                                        <select name="" class="form form-select form-select-sm" >
                                            <option value="">All</option>
                                            <option value="">Success</option>
                                            <option value="">False</option>
                                        </select>
                                    </div> -->
                                </div>
                            </div>
                            <div class="bd-example table-responsive">
                            <table id="datatable" class="table table-hover" data-toggle="data-table" name="data_table_list" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                <thead>
                                    <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                        <th>Create Date</th>
                                        <th>Job number</th>
                                        <th>Consignee</th>
                                        <th>Type</th>
                                        <th>ETA</th>
                                        <th>T/S Port</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    $sql_table_list = "
                                    SELECT 
                                        jt.ID,
                                        jt.create_date,
                                        jt.job_number,
                                        jt.type_import_export as import_export,
                                        c.consignee_name,
                                        a.location_name,
                                        a.provice,
                                        jt.eta,
                                        (SELECT COUNT(*) FROM transport_booking as tb1 WHERE job_number = jt.job_number AND tb1.status IN (0,2)) AS status_data                                         
                                        FROM job_title as jt 
                                        LEFT JOIN consignee as c ON jt.consignee_number = c.consignee_number
                                        LEFT JOIN area as a ON jt.ts_port_number = a.area_number
                                        WHERE jt.status_job = '0' AND jt.job_number IS NOT null
                                        ";


                                    $fetch_sql = mysqli_query($con, $sql_table_list);
                                    while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                        $job_number_id = $result_table_list['ID'];

                                    ?>
                                        <tr>
                                            <td><?= $result_table_list['create_date'] ?></td>
                                            <td><?= $result_table_list['job_number'] ?></td>
                                            <td><?= $result_table_list['consignee_name'] ?></td>
                                            <td><?= $result_table_list['import_export'] ?></td>
                                            <td><?= $result_table_list['eta'] ?></td>
                                            <td><?= $result_table_list['location_name'] ?> ,<?= $result_table_list['provice'] ?></td>
                                            <td><?php
                                                 if ($result_table_list['status_data'] > 1) {
                                                    echo "<span class='badge rounded-pill bg-success'>Success</span>";
                                                } else {
                                                    echo "<span class='badge rounded-pill bg-danger'>False</span>";
                                                } 
                                                ?></td>
                                            <td><button type="button" onclick="transport_list.preview(<?=$job_number_id?>);" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

































            <!-- MAIN BODY END -->
        </div>

        <!-- Footer Section Start -->
        <?php include 'include/footermain.php'; ?>
        <!-- Footer Section End -->
    </main>

    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <?php include 'include/offcanvas.php'; ?>
    <?php include '../assets/include/theme_include_js.php'; ?>
</body>

</html>
<script src="js/transport-list/transport_list.js"></script>
<script src="js/transport-list/transport_list_set.js"></script>
<script>

    $(document).ready(function(){
        sidebar_main.set_data_rows();
        transport_list_set.set_data_rows();
    });
</script>

