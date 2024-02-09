<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account payment</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script> -->

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

    .table td:nth-child(3) input,
    .table td:nth-child(6) input,
    .table td:nth-child(7) input,
    .table td:nth-child(8) input,
    .table td:nth-child(9) input,
    .table td:nth-child(11) input,
    .table td:nth-child(12) input,
    .table td:nth-child(14) input,
    .table td:nth-child(15) input,
    .table td:nth-child(16) input {
        width: 150px;
    }

    .table td:nth-child(4) input {
        width: 200px;
    }

    .table td:nth-child(5) input,
    .table td:nth-child(10) input,
    .table td:nth-child(13) input {
        width: 100px;
    }


    .modal-backdrop {
        width: 1000%;
        height: 100%;
    }

    .modal-dialog {
        position: absolute;
        left: 5%;
        width: 1600px;
    }

    .modal-content {
        width: 1600px;
    }

    td.sticky-column {
        position: sticky;
        left: 0;
        z-index: 1;
        background-color: #fff;
    }

    th.sticky-column {
        position: sticky;
        left: 0;
        top: 0;
        z-index: 4;
        background-color: #fff;
    }

    th.sticky-top {
        z-index: 2;
        background-color: #fff;

    }

    .table_payment>tbody td:nth-child(-n+29) {
        padding-left: 1px;
        padding-right: 1px;
    }

    .table_payment>tbody td:nth-child(-n+29) input {
        width: 100%;
    }

    /* .table_list_data_processing>tbody td:nth-child(4) input {
        width: 300px;
    }

    .table_list_data_processing>tbody td:nth-child(3) input,
    .table_list_data_processing>tbody td:nth-child(6) input,
    .table_list_data_processing>tbody td:nth-child(7) input,
    .table_list_data_processing>tbody td:nth-child(8) input,
    .table_list_data_processing>tbody td:nth-child(11) input {
        width: 190px;
    } */
</style>


<body class="">
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
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-xl-2 col-lg-2">
                                <div class="form-group text-center mt-2">
                                    <input type="radio" class="form-check-input" checked onclick="start.select_filter()" value="ALL" name="radio_function_paid" id="radio_function_paid2">
                                    <label for="radio_function_paid2" class="form-check-label pl-2"> ALL</label>
                                    <input type="radio" class="form-check-input " onclick="start.select_filter()" value="Receivable" name="radio_function_paid" id="radio_function_paid1">
                                    <label for="radio_function_paid1" class="form-check-label pl-2"> Receive</label>
                                    <input type="radio" class="form-check-input " onclick="start.select_filter()" value="Payable" name="radio_function_paid" id="radio_function_paid3">
                                    <label for="radio_function_paid3" class="form-check-label pl-2"> Payable</label>
                                </div>
                            </div>
                            <div class="col-xl-1 col-lg-1 text-center"><label for="">PAYMENT/RECEIPT NUMBER </label></div>
                            <div class="col-xl-2 col-lg-2">
                                <input type="text" class="form-control form-control-sm inp_document_number_search" onchange="start.select_filter()" list="data_list_document_number">
                                <datalist id="data_list_document_number" class="list_document_number">
                                </datalist>
                            </div>
                            <div class="col-xl-1 col-lg-1 text-center"><label for="">JOB NUMBER </label></div>
                            <div class="col-xl-2 col-lg-2">
                                <input type="text" class="form-control form-control-sm inp_job_number_search" onchange="start.select_filter()" list="data_list_job_number">
                                <datalist id="data_list_job_number" class="list_job_number">
                                </datalist>
                            </div>
                            <div class="col-xl-1 col-lg-1 text-center"><label for="">CURRENCY</label></div>
                            <div class="col-xl-1 col-lg-1">
                                <select class="form-select form-select-sm inp_currency_search" onchange="start.select_filter()" name="" id="">
                                    <option value="ALL" selected>ALL</option>
                                    <option value="USD">USD</option>
                                    <option value="THB">THB</option>
                                    <option value="RMB">RMB</option>
                                    <option value="YEN">YEN</option>
                                    <option value="HKD">HKD</option>
                                </select>
                            </div>
                            <div class="col-xl-1 col-lg-1 text-center"><label for="">BANK ACCOUNT</label></div>
                            <div class="col-xl-1 col-lg-1">
                                <select class="form-select form-select-sm inp_bank_account_search" onchange="start.select_filter()" name="" id="">
                                    <option value="" selected >-- select bank number -- </option>
                                </select>
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
                    <div class="card card_list ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table_payment" style="zoom:80%;overflow: scroll;">
                                    <thead>
                                        <tr class="text-center" style="zoom:90%">
                                            <th>序号</th>
                                            <th>收付类型</th>
                                            <th>收付单号</th>
                                            <th>收付流水号</th>
                                            <th>收付款日期</th>
                                            <th>结算单位</th>
                                            <th>工作单号</th>
                                            <th>币种</th>
                                            <th>金额</th>
                                            <th>银行账号</th>
                                            <th>备注</th>
                                        </tr>
                                        <tr class="text-center">
                                            <th>NO.</th>
                                            <th>PAYMENT TYPE</th>
                                            <th>PAYMENT/RECEIPT NUMBER</th>
                                            <th>Number</th>
                                            <th>Payment date</th>
                                            <th>Settlement unit</th>
                                            <th>JOB NO.</th>
                                            <th>CURR</th>
                                            <th>Amount</th>
                                            <th>Bank Account</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                            <td><input type="text" class="form-control form-control-sm"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>

                        <!-- <div class="form-group p-2 m-2">
                            <div class="row">
                                <div class="col">
                                    <label for="">Total Pay/Rcvd</label>
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
                        </div> -->
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
<script src="js/account_payment_statement/start.js"></script>
<script src="js/account_payment_statement/start_default.js"></script>
<!-- <script src="js/account_payment_statement/process_part.js"></script> -->



<script>
    $(document).ready(async function() {
        await sidebar_main.set_data_rows();
        await start_default.start_default();
        await start.select_filter()
        await start.gen_default();

        // start.start_setting();
        // start.start_setting_table();


    });
</script>