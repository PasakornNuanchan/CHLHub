<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Petty Cash Return</title>
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


            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="form-group row">
                                <label class="control-label col-sm-2 col-lg-1 ">Type :</label>
                                <div class="col-sm-2">
                                    <div class="row">
                                       <select name="" class="form form-select form-select-sm" id="">
                                        <option value="">All</option>
                                        <option value="">Paid</option>
                                        <option value="">Unpaid</option>
                                       </select>
                                    </div>
                                </div>
                            </div>
                        <div class="bd-example table-responsive">
                        <table id="datatable" class="table table-striped" data-toggle="data-table" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                <thead>
                                    <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                        <th>Create Date</th>
                                        <th>Petty number</th>
                                        <th>Create By</th>
                                        <th>Job Quantity</th>
                                        <th>Total amount</th>
                                        <th>Customs Clearance</th>
                                        <th>Petty Cash Clear</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <?php
                                    $sql_table_list = "SELECT * FROM petty_cash_title as pc
                                    INNER JOIN user as u ON pc.request_by = u.user_number";


                                    $fetch_sql = mysqli_query($con, $sql_table_list);
                                    while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {

                                        // count job
                                        $count_job = $result_table_list['petty_cash_number'];
                                        $sql_table_job = "SELECT COUNT(petty_cash_number) FROM `petty_cash_detail` WHERE petty_cash_number = '$count_job'";
                                        $fetch_job = mysqli_query($con, $sql_table_job);
                                        $result_table_job = mysqli_fetch_assoc($fetch_job);

                                        // status check
                                        $sql_cal_job_number = "SELECT SUM(jt.status_job) as status_check FROM petty_cash_detail as pcd
                                        INNER JOIN job_title as jt ON pcd.job_number = jt.job_number WHERE petty_cash_number ='$count_job'";
                                        $fetch_cal_job_status = mysqli_query($con, $sql_cal_job_number);
                                        $result_table_job_status = mysqli_fetch_assoc($fetch_cal_job_status);
                                        
                                      
                                    ?>
                                        <tr>
                                            <td><?= $result_table_list['datetime_request'] ?></td>
                                            <td><?= $result_table_list['petty_cash_number'] ?></td>
                                            <td><?= $result_table_list['first_name'] ?> <?= $result_table_list['last_name'] ?></td>
                                            <td><?= $result_table_job['COUNT(petty_cash_number)'] ?></td>
                                            <td><?= $result_table_list['total_amount_request'] ?></td>
                                            <td><?php if ($result_table_job['COUNT(petty_cash_number)'] == $result_table_job_status['status_check']) {
                                                    echo "<span class='badge rounded-pill bg-success'>success</span>";
                                                } else {
                                                    echo "<span class='badge rounded-pill bg-danger'>fail</span>";
                                                } ?></td>
                                            <td><?php if ($result_table_list['return_payment_by'] <> '0') {
                                                    echo "<span class='badge rounded-pill bg-success'>Paid</span>";
                                                } else {
                                                    echo "<span class='badge rounded-pill bg-danger'>Unpaid</span>";
                                                } ?></td>
                                            <td><button type="button" onclick="location.href='CHL-pettyCash_return.php';" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
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