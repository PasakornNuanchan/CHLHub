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
    <title>Petty Cash Payment</title>
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
                            <!-- <div class="form-group row">
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
                            </div> -->
                            <div class="bd-example table-responsive">
                                <table class="table table-hover" data-toggle="data-table" name="data-table-list" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Create Date</th>
                                            <th>Petty number</th>
                                            <th>Create By</th>
                                            <th>Job Quantity</th>
                                            <th>Payble</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                            $sql = "
                                            SELECT
                                            pct.datetime_request,
                                            pct.petty_cash_number,
                                            u.user_number,
                                            u.first_name,
                                            u.last_name,
                                            COUNT(pcd.job_number) AS COUNT_job,
                                            IF((SELECT COUNT(DISTINCT currency) FROM petty_cash_detail as pcd1 WHERE pcd1.petty_cash_number = pct.petty_cash_number) = 
                                            (SELECT COUNT(trp.doc_number) FROM transac_recript_petty_cash as trp WHERE trp.doc_number = pct.petty_cash_number),1,0) as payble_st
                                        FROM
                                            `petty_cash_title` AS pct
                                        LEFT JOIN USER AS u ON pct.request_by = u.user_number
                                        LEFT JOIN petty_cash_detail AS pcd ON pct.petty_cash_number = pcd.petty_cash_number
                                        WHERE
                                            u.user_number = '1'
                                        GROUP BY
                                            pcd.petty_cash_number
                                            ";
                                            $fetch_sql = mysqli_query($con, $sql);
                                            while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                                $st_ptc = '';
                                                if($result_table_list['payble_st'] != '1'){
                                                    $color = 'bg-danger';
                                                    $st_txt = "Paid";
                                                }else{
                                                    $color = 'bg-success';
                                                    $st_txt = "Unpaid";
                                                }
                                        ?>
                                        <tr>
                                            <td><?= $result_table_list['datetime_request']; ?></td>
                                            <td><?= $result_table_list['petty_cash_number']; ?></td>
                                            <td><?= $result_table_list['first_name']; ?> <?= $result_table_list['last_name']; ?></td>
                                            <td><?= $result_table_list['COUNT_job']; ?></td>
                                            <td><span class="badge rounded-pill <?= $color ?>" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><?= $st_txt ?></span></td>
                                            <td><button type="button" target="_blank" onclick="pettycash_payment_list.preview('<?= $result_table_list['petty_cash_number']; ?>');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
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
<script src="js/pettycash-payment-list/pettycash_payment_list.js"></script>
<script src="js/pettycash-payment-list/pettycash_payment_list_set.js"></script>


<script>
    $(document).ready(function() {
        petty_cash_payment_list_set.set_data_rows();
    });
</script>