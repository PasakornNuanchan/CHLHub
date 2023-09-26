<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Accounting Part</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<style>
    .table_data td:nth-child(1) {
        z-index: 1;
    }

    .table_data td:nth-child(2) input {
        width: 200px;
    }

    .table_data td:nth-child(3) input {
        width: 300px;
    }

    .table_data td:nth-child(4) input {
        width: 300px;
    }

    .table_data td:nth-child(5) input {
        width: 100px;
    }

    .table_data td:nth-child(6) input {
        width: 150px;
    }

    .table_data td:nth-child(7) input {
        width: 150px;
    }

    .table_data td:nth-child(8) input {
        width: 150px;
    }

    .table_data td:nth-child(9) input {
        width: 80px;
    }

    .table_data td:nth-child(10) input {
        width: 150px;
    }

    .table_data td:nth-child(12) input {
        width: 150px;
    }

    .table_data td:nth-child(13) input {
        width: 200px;
    }

    .table_data td:nth-child(14) input {
        width: 200px;
    }

    .table_data td:nth-child(15) input {
        width: 200px;
    }

    .table_data td:nth-child(16) input {
        width: 200px;
    }

    .table_data td:nth-child(17) input {
        width: 200px;
    }
</style>

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

            <!-- breadcrumb -->

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <!-- Booking -->
                    <div class="card p-2">
                        <div class="card-header">
                            <h4>Filter</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-xl-1">
                                    <label>Job number</label>
                                </div>
                                <div class="col-xl-2">
                                    <input class="form-control form-control-sm rounded inp_job_number" list="job_number_list" maxlength="200">
                                    <datalist class="job_number_data_list" id="job_number_list">

                                    </datalist>
                                </div>
                                <div class="col-xl-1 ">
                                    <label>BL No.</label>
                                </div>
                                <div class="col-xl-2">
                                    <input class="form-control form-control-sm rounded inp_mbl" list="mbl_list" maxlength="200">
                                    <datalist class="mbl_data_list" id="mbl_list">

                                    </datalist>
                                </div>
                                <div class="col-xl-1 ">
                                    <label>Container No.</label>
                                </div>
                                <div class="col-xl-2">
                                    <input class="form-control form-control-sm rounded inp_container" list="container_list" maxlength="200">
                                    <datalist class="container_data_list" id="container_list">

                                    </datalist>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-1 ">
                                    <label>Status</label>
                                </div>
                                <div class="col-xl-11">
                                    <!-- <div class="bd-example"> -->
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="status_rd" id="status_rd_1" value="All">
                                        <label for="radio1" class="form-check-label pl-2">All</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="status_rd" id="status_rd_2" value="PREPAID">
                                        <label for="radio2" class="form-check-label pl-2">Prepaid</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="status_rd" id="status_rd_3" value="PAID">
                                        <label for="radio3" class="form-check-label pl-2">Paid</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="status_rd" id="status_rd_4" value="REJECT">
                                        <label for="radio3" class="form-check-label pl-2">Reject</label>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-1 ">
                                    <label>Type</label>
                                </div>
                                <div class="col-xl-11">
                                    <div class="bd-example">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="type_rd" id="type_rd_1" value="All">
                                            <label for="radio1" class="form-check-label pl-2">All</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="type_rd" id="type_rd_2" value="AP">
                                            <label for="radio2" class="form-check-label pl-2">Account Payable (AP)</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="type_rd" id="type_rd_3" value="AR">
                                            <label for="radio3" class="form-check-label pl-2">Account Receivable (AR)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-1">
                                    <label>request by</label>
                                </div>
                                <div class="col-xl-2">
                                    <select class="form-select form-select-sm rounded inp_request_by request_data_list">
                                        <option value="">ALL</option>
                                    </select>

                                </div>
                                <div class="text-end">
                                    <button class="btn btn-sm btn-outline-primary" onclick="setting_data.setting_data_first()"><i class="bi bi-search"></i> search</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-5">
                        <div class="table-responsive">
                            <div id="tableContainer">
                                <table class="table table-hover table_data">
                                    <thead>
                                        <tr class="text-center sticky-top">
                                            <th>No.</th>
                                            <th>Inv No.</th>
                                            <th>Bill to</th>
                                            <th>Description</th>
                                            <th>Currency</th>
                                            <th>Qty.</th>
                                            <th>Unit Price</th>
                                            <th>Amt.</th>
                                            <th>Vat(%)</th>
                                            <th>Amt Incv.</th>
                                            <th>Status</th>
                                            <th>Paid Amt</th>
                                            <th>Remark</th>
                                            <th>Request Datetime</th>
                                            <th>Request By</th>
                                            <th>Sale Support</th>
                                            <th>Operation By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td></td>
                                            <td><input type="text" class="form-control form-control-sm rounded" value="T2023011231"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded" value="BINDING FEE"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded" value="Air port of thailand(PAT)"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded text-center" value="THB"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded text-end" value="1"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded text-center" value="1"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded text-end" value="1.01"></td>
                                            <td>
                                                <input type="radio" class="form-check-input" name="status_row_rd" id="radio1" checked=>
                                                <label for="radio1" class="form-check-label pl-2">Waiting</label>
                                                <input type="radio" class="form-check-input" name="status_row_rd" id="radio2">
                                                <label for="radio2" class="form-check-label pl-2">Approve</label>
                                                <input type="radio" class="form-check-input" name="status_row_rd" id="radio3">
                                                <label for="radio3" class="form-check-label pl-2">Reject</label>
                                            </td>
                                            <td><input type="text" class="form-control form-control-sm rounded text-end" value=""></td>
                                            <td><input type="text" class="form-control form-control-sm rounded" value=""></td>
                                            <td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm rounded" value="" disabled></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="bd-exsample table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>job number </th>
                                            <th>Container type, air freight, LCL </th>
                                            <th>quantity </th>
                                            <th>Currency </th>
                                            <th>Amount </th>
                                            <th>Request payment date </th>
                                            <th>Request by </th>
                                            <th>Receipt </th>
                                            <th>Payee </th>
                                            <th>remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                            <td>1</td>
                                        </tr>
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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="js/account_check/set_page.js"></script>
<script src="js/account_check/setting_data.js"></script>
<script src="js/account_check/function_account_check.js"></script>


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        set_page.set_head_page();
    });
</script>