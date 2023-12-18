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
        width: 2000px;
    }

    .modal-content {
        width: 2000px;
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
                <div class="col-lg-2 col-xl-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <button class="btn btn-success btn-sm col-lg-12" onclick="start.generate_inv()">save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-xl-1 col-lg-1"><label for="">Job Number</label></div>
                            <div class="col-xl-2 col-lg-2"><input type="text" class="form-control form-control-sm inp_job_number" onchange="start.select_filter()"></div>
                            <div class="col-xl-1 col-lg-1"><label for="">currency</label></div>
                            <div class="col-xl-2 col-lg-2">
                                <select class="form-select form-select-sm inp_currency_main_change" onchange="start.change_currency(this)" name="" id="">
                                    <option value="USD">USD</option>
                                    <option value="THB">THB</option>
                                    <option value="RMB">RMB</option>
                                    <option value="YEN">YEN</option>
                                    <option value="HKD">HKD</option>
                                </select>
                            </div>
                            <div class="col-xl-1 col-lg-1"><label for="">Actual AMT</label></div>
                            <div class="col-xl-2 col-lg-2"><input type="text" class="form-control form-control-sm inp_actual_amt_total text-end" disabled onchange="start.select_filter()"></div>
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
                            <div class="table-responsive" style="height:100%">
                                <table class="table table-hover table_payment" style="zoom:100%;overflow: scroll;">
                                    <thead>
                                        <tr class="text-center" style="zoom:90%">
                                            <th onclick="start.sort_data()">No</th>
                                            <th onclick="start.sort_data()">select</th>
                                            <th onclick="start.sort_data()">Job#</th>
                                            <th onclick="start.sort_data()">Code</th>
                                            <th onclick="start.sort_data()">Cur</th>
                                            <th onclick="start.sort_data()">AMTINCV</th>
                                            <th onclick="start.sort_data()">Outstanding</th>
                                            <th onclick="start.sort_data()">settlement</th>
                                            <th onclick="start.sort_data()">actual
                                                <br>ex.rate
                                            </th>
                                            <th>actual<br>curr.</th>
                                            <th>Total</th>
                                            <th>Amt</th>
                                            <th>Vat(%)</th>
                                            <th>WHT</th>
                                            <th>Customer</th>
                                            <th>Finish</th>
                                            <th>Remark</th>
                                            <th>Sales</th>
                                            <th>billing date</th>
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


                <!-- <table id="datatable" class="table table-striped" data-toggle="data-table">
                    <thead>
                        <tr class="text-center" style="zoom:90%">
                            <th>No</th>
                            <th>select</th>
                            <th>Job#</th>
                            <th>Code</th>
                            <th>Cur</th>
                            <th>AMTINCV</th>
                            <th>Outstanding</th>
                            <th>settlement</th>
                            <th>actual
                                <br>ex.rate
                            </th>
                            <th>actual<br>curr.</th>
                            <th>Total</th>
                            <th>Amt</th>
                            <th>Vat(%)</th>
                            <th>WHT</th>
                            <th>Customer</th>
                            <th>Finish</th>
                            <th>Remark</th>
                            <th>Sales</th>
                            <th>billing date</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table> -->
            </div>
            <!-- <div class="card">
                <div class="card-body"> -->

            <!-- <div class="form-group">
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
                    </div> -->
            <!-- </div>
            </div> -->
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
<script src="js/account_payment/start.js"></script>
<script src="js/account_payment/start_default.js"></script>



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