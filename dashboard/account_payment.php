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
        width: 100%;
        height: auto;
        margin: 30px;
        padding: 0;
    }

    .modal-xl {
        max-width: 95%;
    }

    .modal-content {
        height: auto;
        min-height: 100%;
        border-radius: 0;
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

    .table_list_data_processing>tbody td:nth-child(-n+29) {
        padding-left: 1px;
        padding-right: 1px;
    }

    .table_list_data_processing>tbody td:nth-child(-n+29) input {
        width: 100%;
    }

    .table_list_data_processing>tbody td:nth-child(4) input {
        width: 300px;
    }

    .table_list_data_processing>tbody td:nth-child(3) input,
    .table_list_data_processing>tbody td:nth-child(6) input,
    .table_list_data_processing>tbody td:nth-child(7) input,
    .table_list_data_processing>tbody td:nth-child(8) input,
    .table_list_data_processing>tbody td:nth-child(11) input {
        width: 190px;
    }
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
                                <label for="radio_process1" class="form-check-label pl-2">Process</label>
                                <input type="radio" class="form-check-input" name="radio_process" onclick="start.select_filter()" value="process" id="radio_process2">
                                <label for="radio_process2" class="form-check-label pl-2">Re-process</label>
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
                <div class="col-lg-2 col-xl-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <button class="btn btn-success btn-sm col-lg-12" onclick="start.generate_inv()">save</button>
                            <!-- <button class="btn btn-success btn-sm col-lg-12" onclick="start.generate_inv_v2()">save_v2</button> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-xl-1 col-lg-1"><label for="">Job Number</label></div>
                            <div class="col-xl-2 col-lg-2"><input type="text" class="form-control form-control-sm inp_job_number_filter" onchange="start.select_filter()"></div>
                            <div class="col-xl-1 col-lg-1"><label for="">currency</label></div>
                            <div class="col-xl-2 col-lg-2">
                                <select class="form-select form-select-sm inp_currency_main_change" onchange="start.change_currency(this)" name="" id="">
                                    <option value="USD">USD</option>
                                    <option value="THB" selected>THB</option>
                                    <option value="RMB">RMB</option>
                                    <option value="YEN">YEN</option>
                                    <option value="HKD">HKD</option>
                                </select>
                            </div>
                            <div class="col-xl-1 col-lg-1"><label for="">Actual AMT</label></div>
                            <div class="col-xl-2 col-lg-2"><input type="text" class="form-control form-control-sm inp_actual_amt_total text-end" disabled></div>
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
                            <div class="table-responsive" style="height:550px">
                                <table class="table table-hover table_payment" style="zoom:80%;overflow: scroll;">
                                    <thead>
                                        <tr class="text-center" style="zoom:90%">
                                            <th class="sticky-column">No</th>
                                            <th class="sticky-column">select</th>
                                            <th class="sticky-column">Job#</th>
                                            <th class="sticky-top">Code</th>
                                            <th class="sticky-top">Cur</th>
                                            <th class="sticky-top">AMTINCV</th>
                                            <th class="sticky-top">Outstanding</th>
                                            <th class="sticky-top">settlement</th>
                                            <th class="sticky-top">actual
                                                <br>ex.rate
                                            </th>
                                            <th class="sticky-top">actual<br>curr.</th>
                                            <th class="sticky-top">Total</th>
                                            <th class="sticky-top">Amt</th>
                                            <th class="sticky-top">Vat(%)</th>
                                            <th class="sticky-top">WHT</th>
                                            <th class="sticky-top">Customer</th>
                                            <th class="sticky-top">Finish</th>
                                            <th class="sticky-top">Remark</th>
                                            <th class="sticky-top">Sales</th>
                                            <th class="sticky-top">billing date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th><!-- No -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- check -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- Job number -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- bill to -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- status -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- currency -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- ??? -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- ??? -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- ??? -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- sysrate -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- to curr -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- ??? -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- ??? -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- ???Vat -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- ??? -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- description -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- stauts paid -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- remark -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- sales -->
                                            <th><input type="text" class="form-control form-control-sm"></th><!-- billing date -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group p-2 m-2">
                            <button class="btn btn-success btn-sm" onclick="start.select_all_check()">Select all</button>
                            <button class="btn btn-warning btn-sm" onclick="start.un_select_all_check()">Deselect all</button>
                        </div>
                        <hr>

                        <div class="form-group p-2 m-2">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="">
            <div class="row mt-2">
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">收付类型 Payment Type </label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_payment_type">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">结算单位 settlement unit</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_consignee_data_detail">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">业务员 saleman</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_sale_man">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">销账日期 write-off date</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="date" class="form-control form-control-sm inp_write_off_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">收付单号 Payment receipt number</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_payment_document">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">系统销账总额 total system write-offs</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control form-control-sm text-end inp_amount_all_write_off">
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control form-control-sm text-center inp_currency_main_write_off">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">经手人 handler</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_handler">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">收付地点 payment place</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-select form-select-sm sel_data_payment_place" onchange="start.set_payment_place()">
                                <option value="">-- select --</option>
                                <option value="TH">TH</option>
                                <option value="CN">CN</option>
                                <option value="HK">HK</option>
                                <option value="US">US</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">实际付款总额 Actual total payment</label>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control form-control-sm text-end inp_amount_all">
                        </div>
                        <div class="col-lg-3">
                            <select class="form-select form-select-sm text-center inp_currency_main">
                                <option value="">-- select --</option>
                                <option value="THB">THB</option>
                                <option value="USD">USD</option>
                                <option value="RMB">RMB</option>
                                <option value="YEN">YEN</option>
                                <option value="HKD">HKD</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">

                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">备注 Remark</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_remark_data_modal">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">付款方式 payment method</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-select form-select-sm inp_method_cash">
                                <option value=""> -- select --</option>
                                <option value="tranfer">Tranfer</option>
                                <option value="cash">Cash</option>
                                <option value="hedge">Hedge</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">付款记录数 number of payment records</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_number_payment_record">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="text-center"><i class="bi bi-image bi_image_receipt" id="blah" onclick="process_part.open_pic('${id_number}')"></i></div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for>序号 number<label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_number_rec">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">付款日期 payment date</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="date" class="form-control form-control-sm inp_payment_date">
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">银行账号 bank account</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-select form-select-sm inp_bank_account">
                                <option value="">-- select bank account --</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-lg-5">
                            <label for="">实际付款金额 actual payment amount</label>
                        </div>
                        <div class="col-lg-7">
                            <input type="text" class="form-control form-control-sm inp_acual_payment">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->



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
<script src="js/account_payment/start.js"></script>
<script src="js/account_payment/start_default.js"></script>
<script src="js/account_payment/process_part.js"></script>



<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        start_default.start_default();
        start.start_setting();
        start.start_setting_table();
        $('.check_start').prop('checked', true)
        // $(".table_payment").bootstrapTable();

        // $('#modal_account_payment').modal('show')

    });
</script>