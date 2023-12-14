<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Incentive management</title>
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
    .table_ar td:nth-child(4) input {
        width: 200px;
    }

    .table_ar td:nth-child(5) input,
    .table_ar td:nth-child(6) input,
    .table_ar td:nth-child(9) input,
    .table_ar td:nth-child(10) input {
        width: 90px;
    }

    .table_ar td:nth-child(7) input,
    .table_ar td:nth-child(8) input,
    .table_ar td:nth-child(11) input,
    .table_ar td:nth-child(12) input {
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
    .table_ar td:nth-child(28) input {
        width: 200px;
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-label">Date </label>
                                <select class="form-select form-select-sm rounded">
                                    <option value="">Create Job Date</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Sale </label>
                                <select class="form-select form-select-sm rounded">
                                    <option value="">test</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Client </label>
                                <select class="form-select form-select-sm rounded">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-label">From</label>
                                <input type="date" class="form-control form-control-sm rounded">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-label">From</label>
                                <input type="date" class="form-control form-control-sm rounded">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Job</label>
                                <input type="text" class="form-control form-control-sm rounded">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <input type="text" class="form-control form-control-sm rounded">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" id="inp_have_ar">
                                <label for="inp_have_ar" class="form-label">Undisplay have AR</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" id="inp_no_ap">
                                <label for="inp_no_ap" class="form-label">Undisplay No AP</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" id="inp_unfinish">
                                <label for="inp_unfinish" class="form-label">Undisplay Unfinish Bill</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" id="inp_all_co">
                                <label for="inp_all_co" class="form-label">All Co</label>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="form-check-input" id="inp_commition">
                                <label for="inp_commition" class="form-label">Undisplay Commitsition taked out</label>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label class="form-label">Curr.</label>
                                <select class="form-select form-select-sm"name="" id="">
                                    <option value="THB">THB</option>
                                    <option value="USD">USD</option>
                                    <option value="RMB">RMB</option>
                                    <option value="YEN">YEN</option>
                                    <option value="HKD">HKD</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">with co-op ofc profit</label>
                                <input type="text" class="form-control form-control-sm rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" >
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" style="zoom:80%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>sCommiss</th>
                                        <th>Job#</th>
                                        <th>Sales</th>
                                        <th>AR amt</th>
                                        <th>Rcvd Amt</th>
                                        <th>AP Amt</th>
                                        <th>Paid Amt</th>
                                        <th>Profit</th>
                                        <th>Total</th>
                                        <th>OP Date</th>
                                        <th>Rcvd Date</th>
                                        <th>Paid Date</th>
                                        <th>AR Settled</th>
                                        <th>S/O#</th>
                                        <th>Vsl.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" >
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" style="zoom:80%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sales</th>
                                        <th>Sales</th>
                                        <th>Dept</th>
                                        <th>Type</th>
                                        <th>all results</th>
                                        <th>Cashing AR</th>
                                        <th>settled profit</th>
                                        <th>reduction</th>
                                        <th>Amt</th>
                                        <th>Profit rate</th>
                                        <th>Profit find AMT</th>
                                        <th>BANK Chg.</th>
                                        <th>Ex gain or loss</th>
                                        <th>Fee and ex. Dee sub co. Share%</th>
                                        <th>net commi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
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
<!-- <script src="js/account_payment/start.js"></script> -->
<!-- <script src="js/account_payment/start_default.js"></script> -->



<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        // start_default.start_default();
        // start.start_setting();
        // start.start_setting_table();
        // $('.check_start').prop('checked', true)
        // $('#modal_account_payment').modal('show')

    });
</script>