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
    <title>Petty Cash</title>
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
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <!-- <select name="" class="form form-select form-select-sm">
                                                <option value="">All</option>
                                                <option value="">Paid</option>
                                                <option value="">Unpaid</option>
                                            </select> -->
                                        </div>
                                        <div class="col-lg-7"></div>
                                        <div class="col-lg-2">
                                            <button type="button" target="_blank" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="pettycash_list.preview();" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float: right;"><i class="bi bi-eye"></i> Add Petty Cash</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bd-example table-responsive">
                                <table class="table table-hover" name="data_table_list" data-toggle="data-table" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Create Date</th>
                                            <th>Petty number</th>
                                            <th>Create By</th>
                                            <th>Job request</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php

                                            if ($_SESSION['department_name'] == "support" || $_SESSION['department_name'] == "Account") {
                                                $sql_where = '';
                                            } else {
                                                $sql_where = "
                                            WHERE 
                                            u.user_number = '$data_user'
                                            ";
                                            };

                                         $sql_table_list = "
                                          SELECT 
                                                pct.id,
                                                pct.datetime_request,
                                                pct.petty_cash_number,
                                                u.first_name,
                                                u.last_name,
                                                COUNT(pcd.job_number) as COUNT_job,
                                                IF(tranfer_by IS NOT NULL ,1,0) as payble_check
                                            FROM 
                                                `petty_cash_title` as pct
                                                INNER JOIN user as u ON pct.request_by = u.user_number
                                                INNER JOIN petty_cash_detail as pcd ON pct.petty_cash_number = pcd.petty_cash_number
                                                $sql_where               
                                            GROUP BY 
                                                pcd.petty_cash_number   
                                            ORDER BY 
                                                pcd.id DESC      
                                            
                                            ";
                                        $fetch_sql = mysqli_query($con, $sql_table_list);
                                        while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                        ?>
                                            <tr>
                                                <td><?= $result_table_list['datetime_request']; ?></td>
                                                <td><?= $result_table_list['petty_cash_number']; ?></td>
                                                <td><?= $result_table_list['first_name']; ?> <?= $result_table_list['last_name']; ?></td>
                                                <td><?= $result_table_list['COUNT_job']; ?></td>
                                                <td><button type="button" onclick="pettycash_list.preview('<?= $result_table_list['petty_cash_number']; ?>');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>

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
<script src="js/pettycash-list/pettycash_list.js"></script>
<script src="js/pettycash-list//pettycash_list_set.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        petty_cash_list_set.set_data_rows();
    });
</script>