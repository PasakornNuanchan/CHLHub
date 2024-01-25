<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>OP review</title>
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
        height: 850px;
        /* ความสูงของ card ที่ต้องการ */
        overflow-y: auto;
        /* เพิ่มการเลื่อนในแนวตั้ง */
    }

    .card_table {
        height: 850px;
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

    .table>tbody td:nth-child(-n+20) {
        padding-left: 2px;
        padding-right: 2px;
    }

    .table_check td:nth-child(1),
    .table_check td:nth-child(2) {
        width: 100px;
    }


    .table_check td:nth-child(7) input,
    .table_check td:nth-child(11) input,
    .table_check td:nth-child(10) input {
        width: 90px;
    }

    .table_check td:nth-child(3) input,
    .table_check td:nth-child(9) input,
    .table_check td:nth-child(8) input {
        width: 150px;
    }

    .table_check td:nth-child(6) input,
    .table_check td:nth-child(4) input,
    .table_check td:nth-child(5) input,
    .table_check td:nth-child(12) input,
    .table_check td:nth-child(14) input,
    .table_check td:nth-child(15) input,
    .table_check td:nth-child(16) input,
    .table_check td:nth-child(17) input,
    .table_check td:nth-child(18) input,
    .table_check td:nth-child(19) input,
    .table_check td:nth-child(20) input {
        width: 200px;
    }

    .table_check td:nth-child(13) select{
        width: 230px;
    }
   

    .table_check > thead > tr > th.sticky-top {
        z-index: 4;
        position: sticky;
        background-color:#fff;
    }


    .table_check > tbody > tr > td:nth-child(1) {
        z-index: 2;
        position: sticky;
        left: 0;
        background-color:#fff;
    }
    .table_check > tbody > tr > td:nth-child(2) {
        z-index: 2;
        position: sticky;
        left: 105px;
        background-color:#fff;
    }
    .table_check > tbody > tr > td:nth-child(3) {
        z-index: 2;
        position: sticky;
        left: 225px;
        background-color:#fff;
    }
    .table_check > tbody > tr > td:nth-child(4) {
        z-index: 2;
        position: sticky;
        left: 298px;
        background-color:#fff;
    }
    .table_check > tbody > tr > td:nth-child(5) {
        z-index: 2;
        position: sticky;
        left: 501.5px;
        background-color:#fff;
    }
    .table_check > tbody > tr > td:nth-child(6) {
        z-index: 2;
        position: sticky;
        left: 705px;
        background-color:#fff;
    }

    .table_check > thead > tr > th:nth-child(1) {
        z-index: 5;
        position: sticky;
        left: 0;
        background-color:#fff;
    }
    .table_check > thead > tr > th:nth-child(2) {
        z-index: 5;
        position: sticky;
        left: 105px;
        background-color:#fff;
    }
    .table_check > thead > tr > th:nth-child(3) {
        z-index: 5;
        position: sticky;
        left: 225px;
        background-color:#fff;
    }
    .table_check > thead > tr > th:nth-child(4) {
        z-index: 5;
        position: sticky;
        left: 298px;
        background-color:#fff;
    }
    .table_check > thead > tr > th:nth-child(5) {
        z-index: 5;
        position: sticky;
        left: 501.5px;
        background-color:#fff;
    }
    .table_check > thead > tr > th:nth-child(6) {
        z-index: 5;
        position: sticky;
        left: 705px;
        background-color:#fff;
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
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Job number</label>
                                    <input type="text" class="form-control form-control-sm inp_job_number" onchange="start.select_filter()" list="job_number_list">
                                    <datalist id="job_number_list" class="data_list_job_number">

                                    </datalist>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Applied Person</label>
                                    <input type="text" class="form-control form-control-sm inp_applied_person" onchange="start.select_filter()" list="applied_person_list">
                                    <datalist id="applied_person_list" class="data_list_applied_person">

                                    </datalist>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Applied Date</label>
                                    <input type="Date" class="form-control form-control-sm inp_date_applied" onchange="start.select_filter()">
                                </div>
                                <div class="col-sm-1 col-md col-lg-1 col-xl-1">
                                    <div class="form-group">
                                        <input type="radio" class="form-check-input check_start" name="radio_p" id="radio1" value="unpaid" onclick="start.select_filter()">
                                        <label class="form-check-label pl-2">Unpaid</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" class="form-check-input" name="radio_p" id="radio2" value="paid" onclick="start.select_filter()">
                                        <label class="form-check-label pl-2">Paid</label>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md col-lg-2 col-xl-2">
                                    <div class="form-group">
                                        <input type="radio" class="form-check-input check_start" name="radio_type" value="AP" onclick="start.select_filter()">
                                        <label class="form-check-label pl-2">Account Payable</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" class="form-check-input" name="radio_type" value="AR" onclick="start.select_filter()">
                                        <label class="form-check-label pl-2">Account Receivable</label>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Billing Code</label>
                                    <input type="text" class="form-control form-control-sm inp_billing_code" onchange="start.select_filter()" list="billing_list">
                                    <datalist id="billing_list" class="data_list_billing_list">

                                    </datalist>
                                </div>
                            </div>
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
                    <div class="card card_table">
                        <div class="card-body">
                            <div class="table-responsive" style="height:540px">
                                <table class="table table-hover table_check" style="zoom:75%;overflow: scroll;">
                                    <thead>
                                        <tr >
                                            <th class="sticky-top">Check</th>
                                            <th class="sticky-top">Rewise</th>
                                            <th class="sticky-top">No</th>
                                            <th class="sticky-top">Job Number</th>
                                            <th class="sticky-top">Bill to</th>
                                            <th class="sticky-top">Description</th>
                                            <th class="sticky-top">Cur.</th>
                                            <th class="sticky-top">Qty</th>
                                            <th class="sticky-top">unit price</th>
                                            <th class="sticky-top">Vat%</th>
                                            <th class="sticky-top">W/H</th>
                                            <th class="sticky-top">Total</th>
                                            <th class="sticky-top">Bank <br> payment</th>
                                            <th class="sticky-top">Payment <br> Term</th>
                                            <th class="sticky-top">Create By</th>
                                            <th class="sticky-top">Create Datetime</th>
                                            <th class="sticky-top">Check by</th>
                                            <th class="sticky-top">Check Datetime</th>
                                            <th class="sticky-top">Apply By</th>
                                            <th class="sticky-top">Apply Datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><input type="checkbox" style="zoom:200%"></td>
                                            <td class="text-center">1</td>
                                            <td><input type="text" class="form-control form-control-sm" disabled value="T231153"></td>
                                            <td><input type="text" class="form-control form-control-sm" disabled value="WINTEK testerwrwe"></td>
                                            <td><input type="text" class="form-control form-control-sm" disabled value="TCF"></td>
                                            <td><input type="text" class="form-control form-control-sm text-center" disabled value="THB"></td>
                                            <td><input type="text" class="form-control form-control-sm text-end" value="1" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm text-end" value="1000.00" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm text-center" value="7%" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm text-center" value="3%" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm text-end" value="1040.00" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm text-start" disabled value="Manomai Sudkaew"></td>
                                            <td><input type="text" class="form-control form-control-sm text-start" disabled value="2023/01/01 00:00:00"></td>
                                            <td><input type="text" class="form-control form-control-sm text-start" disabled value="Manomai Sudkaew"></td>
                                            <td><input type="text" class="form-control form-control-sm text-start" disabled value="2023/01/01 00:00:00"></td>
                                            <td><input type="text" class="form-control form-control-sm text-start" disabled value="Manomai Sudkaew"></td>
                                            <td><input type="text" class="form-control form-control-sm text-start" disabled value="2023/01/01 00:00:00"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group m-2 p-2 ">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-success btn-sm" onclick="start.select_all('select')">Select All</button>
                                    <button class="btn btn-warning btn-sm" onclick="start.select_all('unselect')">Unselect All</button>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <button class="btn btn-success btn-sm" onclick="function_act.save_function()">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group  m-2 p-2">
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
                        <div class="form-group  m-2 p-2">
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
<script src="js/account_review_check/start.js"></script>
<script src="js/account_review_check/function_act.js"></script>
<script src="js/account_review_check/start_apply.js"></script>



<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        first_setting.start_page();
        $('.check_start').prop('checked', true)

        start.start_setting();
        start.start_default();
        start.select_filter();
        // start.data_start()

    });
</script>