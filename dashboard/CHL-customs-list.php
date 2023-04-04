<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
include 'core/con_path.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customs</title>
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
                                <!-- <label class="control-label col-sm-2 col-lg-1 ">Type :</label> -->
                                <div class="col-sm-2">
                                    <!-- <div class="row">
                                       <select name="" class="form form-select form-select-sm" id="">
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
                                        <th>Type</th>
                                        <th>Consignee</th>
                                        <th>ETA</th>
                                        <th>T/S Port</th>
                                        <th>Document</th>
                                        <th>Transport</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody align="center">

                                <?php 
                                $sql = "
                                SELECT 
                                jt.create_date,
                                jt.job_number,
                                jt.type_import_export,
                                c.consignee_name,
                                jt.eta,
                                a.location_name,
                                a.country,
                                IF((js.INV_check_by AND
                                    js.PL_check_by AND
                                    js.BL_check_by AND
                                    js.ID_check_by AND 
                                    js.IL_check_by) IS null , 0 ,1) as document_status,
                               IF(COUNT(tb.job_number) >0 ,1,0) as transport_status
                                   FROM job_title as jt 
                                   LEFT OUTER JOIN consignee as c ON jt.consignee_number = c.consignee_number
                                   LEFT OUTER JOIN area as a ON jt.ts_port_number = a.area_number
                                   LEFT OUTER JOIN transport_booking as tb ON jt.job_number = tb.job_number
                                   LEFT OUTER JOIN job_status as js ON jt.job_number = js.job_number
                                   WHERE jt.status_job = '0'
                                   GROUP BY jt.job_number
                                   
                                ";

                                $fetch_sql = mysqli_query($con, $sql);
                                while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {

                                    if ($result_table_list['document_status'] != '1') {
                                        $color_dt = 'bg-danger';
                                        $st_txt_dt = "fasle";
                                    } else {
                                        $color_dt = 'bg-success';
                                        $st_txt_dt = "done";
                                    }

                                    if ($result_table_list['transport_status'] != '1') {
                                        $color_ts = 'bg-danger';
                                        $st_txt_ts = "false";
                                    } else {
                                        $color_ts = 'bg-success';
                                        $st_txt_ts = "done";
                                    }
                                ?>
                                        <tr>
                                            <td><?= $result_table_list['create_date']; ?></td>
                                            <td><?= $result_table_list['job_number']; ?></td>
                                            <td><?= $result_table_list['type_import_export']; ?></td>
                                            <td><?= $result_table_list['consignee_name']; ?></td>
                                            <td><?= $result_table_list['eta']; ?></td>
                                            <td><?= $result_table_list['location_name']; ?> ,<?= $result_table_list['country']; ?></td>
                                            <td><span class="badge rounded-pill <?= $color_dt ?>" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><?= $st_txt_dt ?></span></td>
                                            <td><span class="badge rounded-pill <?= $color_ts ?>" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><?= $st_txt_ts ?></span></td>
                                            <td><button type="button" onclick="customs_list.preview('<?= $result_table_list['job_number']; ?>');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
                                        </tr>
                                        <?php }; ?>
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
<script src="js/customs-list/customs_list.js"></script>
<script src="js/customs-list/customs_list_set.js"></script>
<script>
    $(document).ready(function(){
        sidebar_main.set_data_rows();
        customs_list_set.set_data_rows();
    });
</script>