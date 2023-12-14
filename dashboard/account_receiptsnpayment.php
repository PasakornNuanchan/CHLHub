<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account payable check</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<style>
    .card {
        margin-left: 2px;
        margin-right: 2px;
    }

    .card_list {
        height: 775px;
        /* ความสูงของ card ที่ต้องการ */
        overflow-y: auto;
        /* เพิ่มการเลื่อนในแนวตั้ง */
    }

    .card_table {
        height: 775px;
        overflow-y: auto;

    }


    .active_side {
        font-weight: bold;
        color: red;
    }

    .card_list>.card-body>.data_sic>.form-group>button {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        /* zoom:120%; */
    }

    .active_side:hover {
        color: red;
    }

    .table>tbody td:nth-child(-n+29) {
        padding-left: 1px;
        padding-right: 1px;
    }

    .table_ar td:nth-child(2) input,
    .table_ar td:nth-child(3) input,
    .table_ar td:nth-child(4) input
    {
        width: 200px;
    }

    .table_ar td:nth-child(5) input,
    .table_ar td:nth-child(6) input,
    .table_ar td:nth-child(9) input,
    .table_ar td:nth-child(10) input
    {
        width: 90px;
    }

    .table_ar td:nth-child(7) input,
    .table_ar td:nth-child(8) input,
    .table_ar td:nth-child(11) input,
    .table_ar td:nth-child(12) input
    {
        width: 150px;

    }

    .table_ar td:nth-child(14) input,
    .table_ar td:nth-child(15) input,
    .table_ar td:nth-child(16) input,
    .table_ar td:nth-child(17) input,
    .table_ar td:nth-child(18) input,
    .table_ar td:nth-child(19) input,
    .table_ar td:nth-child(20) input,
    .table_ar td:nth-child(21) input,
    .table_ar td:nth-child(22) input,
    .table_ar td:nth-child(23) input,
    .table_ar td:nth-child(24) input,
    .table_ar td:nth-child(25) input,
    .table_ar td:nth-child(26) input,
    .table_ar td:nth-child(27) input,
    .table_ar td:nth-child(28) input
    {
        width: 200px;
    }

</style>


<body class="" style="">
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
            <!-- <div class="card col-xl-12 col-lg-12">
                <div class="card-body">
                    test
                </div>
            </div> -->

            <div class="row">
                <div class="col-lg-2 col-xl-2">
                    <div class="card">
                        <div class="card-body">
                            <td class="text-center">
                                <input type="radio" class="form-check-input check_start" name="radio_process" onclick="start.select_filter()" value="Rprocess" id="radio_process1">
                                <label for="radio_process1" class="form-check-label pl-2">Unprocess</label>
                                <input type="radio" class="form-check-input" name="radio_process" onclick="start.select_filter()" value="process" id="radio_process2">
                                <label for="radio_process2" class="form-check-label pl-2">Process</label>
                            </td>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-2">
                    <div class="card">
                        <div class="card-body">
                            <td class="text-center">
                                <input type="radio" class="form-check-input check_start" onclick="start.select_filter()" value="AR" name="radio_function_paid" id="radio_function_paid1">
                                <label for="radio_function_paid1" class="form-check-label pl-2">Receive</label>
                                <input type="radio" class="form-check-input" onclick="start.select_filter()" value="AP" name="radio_function_paid" id="radio_function_paid2">
                                <label for="radio_function_paid2" class="form-check-label pl-2">Paid</label>
                            </td>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-8">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-xl-2 col-lg-2"><label for="">Job Number</label></div>
                            <div class="col-xl-4 col-lg-4"><input type="text" class="form-control form-control-sm inp_job_number" onchange="start.select_filter()"></div>
                            <div class="col-xl-2 col-lg-2"><label for="">DN/CN</label></div>
                            <div class="col-xl-4 col-lg-4"><input type="text" class="form-control form-control-sm inp_dn_cn" onchange="start.select_filter()"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-2 col-xl-2">
                    <div class="card card_list">
                        <div class="card-body">
                            <div class="data_sic">
                                <div class="form-group">
                                    <button class="btn btn-sm active_side" data_id="0" data_type="0" name_type="0" onclick="start.mark_active(this)"><i class="bi bi-folder text-warning" style="zoom:135%"></i> ALL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-xl-10">
                    <div class="card card_list">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover " style="zoom:75%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Cashing</th>
                                            <th>Cust.Code</th>
                                            <th>Curr.</th>
                                            <th>Occurred Date</th>
                                            <th>Amount</th>
                                            <th>Ex.gains and Losses</th>
                                            <th>???</th>
                                            <th>???</th>
                                            <th>Job</th>
                                            <th>DNCN</th>
                                            <th>Cus.inv</th>
                                            <th>Bank Chg</th>
                                            <th>Mehtod</th>
                                            <th>TR/TP Offset</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td><!-- No -->
                                            <td><input type="text" class="form-control form-control-sm" value="APSZ23111425"></td><!-- Cashing -->
                                            <td><input type="text" class="form-control form-control-sm" value="MSC"></td><!-- Cust.Code -->
                                            <td><input type="text" class="form-control form-control-sm text-center" value="THB"></td><!-- Curr. -->
                                            <td><input type="text" class="form-control form-control-sm text-center" value="2023/11/10"></td><!-- Occurred Date -->
                                            <td><input type="text" class="form-control form-control-sm text-end" value="1776.00"></td><!-- Amount -->
                                            <td><input type="text" class="form-control form-control-sm" value=""></td><!-- Ex.gains and Losses -->
                                            <td><input type="text" class="form-control form-control-sm" value=""></td><!-- ??? -->
                                            <td><input type="text" class="form-control form-control-sm text-end" value="1776.00"></td><!-- ??? -->
                                            <td><input type="text" class="form-control form-control-sm text-center" value="T2311153"></td><!-- Job -->
                                            <td><input type="text" class="form-control form-control-sm" value=""></td><!-- DNCN -->
                                            <td><input type="text" class="form-control form-control-sm" value=""></td><!-- Cus.inv -->
                                            <td><input type="text" class="form-control form-control-sm text-end" value="0.00"></td><!-- Bank Chg -->
                                            <td><input type="text" class="form-control form-control-sm" value=""></td><!-- Mehtod -->
                                            <td class="text-center"><input type="checkbox" class="form-input-check" style="zoom:150%"></td><!-- TR/TP Offset -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="">Total pay/rcvd</label>
                            </div>
                            <div class="col">USD : <div class="data_currency_usd"></div>
                            </div>
                            <div class="col">THB : <div class="data_currency_thb"></div>
                            </div>
                            <div class="col">RMB : <div class="data_currency_rmb"></div>
                            </div>
                            <div class="col">YEN : <div class="data_currency_yen"></div>
                            </div>
                            <div class="col">HKD : <div class="data_currency_hkd"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="">Total review</label>
                            </div>
                            <div class="col">USD : <div class="data_currency_review_usd"></div>
                            </div>
                            <div class="col">THB : <div class="data_currency_review_thb"></div>
                            </div>
                            <div class="col">RMB : <div class="data_currency_review_rmb"></div>
                            </div>
                            <div class="col">YEN : <div class="data_currency_review_yen"></div>
                            </div>
                            <div class="col">HKD : <div class="data_currency_review_hkd"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- MAIN BODY END -->


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
<!-- <script src="js/account_payable/setting_first.js"></script> -->
<!-- <script src="js/account_payable/setting_default.js"></script> -->
<!-- <script src="js/account_payable/ap_function.js"></script> -->
<!-- <script src="js/currency_rate/currency_rate.js"></script> -->
<script src="js/account_check_payable/first_setting.js"></script>
<script src="js/account_check_payable/function_acp.js"></script>
<script src="js/account_receiptnpayment/start.js"></script>
<script src="js/account_receiptnpayment/start_default.js"></script>



<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        first_setting.start_page();
        start_default.start_default();
        start.start_setting();
        start.start_setting_table();
        $('.check_start').prop('checked', true)

    });
</script>