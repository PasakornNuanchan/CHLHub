<?php
require 'function/auth/get_session.php';
 
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Billing</title>
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
                            <table id="datatable" class="table table-hover" name="data_table_list" data-toggle="data-table" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                <thead>
                                    <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                        <th>CreateDate</th>
                                        <th>Job number</th>
                                        <th>Consignee</th>
                                        <th>Sale</th>
                                        <th>Shipped</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    $sql_table_list = "SELECT jt.create_date,jt.job_number,u.first_name,u.last_name,c.consignee_name,s.shipper_name
                                    FROM job_title as jt 
                                    LEFT JOIN consignee as c ON jt.consignee_number = c.consignee_number
                                    LEFT JOIN shipper as s ON jt.shipper_number = s.ID
                                    LEFT JOIN user as u ON jt.sale_support = u.ID
                                    WHERE jt.status_job = '0'
                                                       ";


                                    $fetch_sql = mysqli_query($con, $sql_table_list);
                                    while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                    ?>
                                        <tr>
                                            <td><?= $result_table_list['create_date'] ?></td>
                                            <td><?= $result_table_list['job_number'] ?></td>
                                            <td><?= $result_table_list['consignee_name'] ?></td>
                                            <td><?= $result_table_list['first_name'] ?> <?= $result_table_list['last_name'] ?></td>
                                            <td><?= $result_table_list['shipper_name'] ?></td>
                                            <td><button type="button" onclick="location.href='CHL-Billing.php';" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
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
<script src="js/billing-list/billing_list.js"></script>
<script src="js/billing-list/billing_list_set.js"></script>
<script>
    $(document).ready(function(){
        sidebar_main.set_data_rows();
        billing_list_set.set_data_rows();
    });
</script>