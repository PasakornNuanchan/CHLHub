<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Internal Transport</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

            <!-- headtab -->
            <!-- <div class="card">
                <div class="card-body card_body_head_nav">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="job_detail_tab" data-bs-toggle="pill" data-bs-target="#job_detail_tab_target" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Job detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="transport_tab" data-bs-toggle="pill" data-bs-target="#transport_tab_target" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="false">Transport</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded " id="reportcs_tab" data-bs-toggle="pill" data-bs-target="#reportcs_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Report cs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="customs_tab" data-bs-toggle="pill" data-bs-target="#customs_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Customs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="billing_tab" data-bs-toggle="pill" data-bs-target="#billing_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Billing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="withdraw_tab" data-bs-toggle="pill" data-bs-target="#withdraw_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Withdraw</button>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="card">
                <div class="card-header">
                    <h4>Internal Transport </h4>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-xl-2 col-lg-2 col-md-3 ">
                            <label>Document number :</label>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-5">
                            <input type="text" class="form-control form-control-sm rounded" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-xl-2 col-lg-2 col-md-3 ">
                            <label>Pay to :</label>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-5">
                            <select class="form-select form-select-sm rounded">
                                <option value="">-- please select pay to --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="bd-example table-responsive">
                        <table class="table table-hover mt-4 text-center table_data_internal">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Description</th>
                                    <th>QTY</th>
                                    <th>Price</th>
                                    <th>Vat(%)</th>
                                    <th>Total</th>
                                    <th>Currency</th>
                                    <th>Receipt</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><select class="form-select form-select-sm rounded">
                                            <option value="">-- please select description -- </option>
                                            <option value="1">Fuel cost</option>
                                            <option value="2">Maintenance cost</option>
                                            <option value="3">Highway cost</option>
                                        </select></td>
                                    <td><input type="number" class="form-control form-control-sm rounded inp_qty text-center" onchange="internal_transport.cal_in_row(this)"></td>
                                    <td><input type="number" class="form-control form-control-sm rounded inp_price text-end" onchange="internal_transport.cal_in_row(this)"></td>
                                    <td><input type="number" class="form-control form-control-sm rounded inp_vat text-center" onchange="internal_transport.cal_in_row(this)"></td>
                                    <td><input type="text" class="form-control form-control-sm rounded inp_total_row text-end " disabled></td>
                                    <td><select class="form-select form-select-sm rounded inp_currency" onchange="internal_transport.cal_in_row(this)">
                                            <option value="THB">THB</option>
                                            <option value="USD">USD</option>
                                            <option value="RMB">RMB</option>
                                        </select></td>
                                    <td><button class="btn btn-outline-primary btn-sm "><i class="bi bi-upload"></i> upload picture</button>
                                        <button class="btn btn-outline-warning btn-sm "><i class="bi bi-upload"></i> re-upload picture</button>
                                    </td>
                                    <td><input type="number" class="form-control form-control-sm rounded"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="head_btn_add_rows">
                        <button class="btn btn-outline-primary btn-sm col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="internal_transport.add_rows_req()">add rows</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-end">

                        <div class="form-group row">
                            <div class="col-lg-9 col-xl-8 col-md-6"></div>
                            <label class="control-label align-self-center col-lg-2 col-md-3">Currency :</label>
                            <div class="col-lg-2 col-xl-2 col-md-3 text-end">
                                <div class="currency_raio">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input radiocur" onchange="internal_transport.cal_result(this)" name="radio_currecny" data_c="THB" checked>
                                        <label for="radio2" class="form-check-label">THB</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input radiocur" onchange="internal_transport.cal_result(this)" name="radio_currecny" data_c="USD">
                                        <label for="radio2" class="form-check-label">USD</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input radiocur" onchange="internal_transport.cal_result(this)" name="radio_currecny" data_c="RMB">
                                        <label for="radio2" class="form-check-label">RMB</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label>Sub total : </label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-5">
                                <input type="text" class="form-control form-control-sm rounded inp_res_sub_total" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Add value tax : </label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-5">
                                <input type="text" class="form-control form-control-sm rounded" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Total : </label>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-5">
                                <input type="text" class="form-control form-control-sm rounded inp_total_res" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="head_btn_save_data text-end ">
                        <button class="btn btn-success btn-sm"><i class="bi bi-save"></i> save</button>
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
<script src="js/internal_transport/internal_transport.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<!-- <script src="js/job_detail/job_detail.js"></script>
<script src="js/job_detail/permission.js"></script>
<script src="js/job_detail/setting_data_default.js"></script>
<script src="js/job_detail/setting_sub_job_detail.js"></script>
<script src="js/job_detail/setting_sub_transport.js"></script>
<script src="js/job_detail/function_sub_reportcs.js"></script>
<script src="js/job_detail/function_sub_job_detail.js"></script>
<script src="js/job_detail/function_sub_custom.js"></script>
<script src="js/job_detail/function_sub_billing.js"></script>
<script src="js/job_detail/function_sub_transport.js"></script>
<script src="js/job_detail/function_sub_withdraw.js"></script>
<script src="js/job_detail/setting_sub_reportcs.js"></script>
<script src="js/job_detail/setting_sub_custom.js"></script>
<script src="js/job_detail/setting_sub_billing.js"></script>
<script src="js/job_detail/setting_sub_withdraw.js"></script>
<script src="js/job_detail/setting_create_job.js"></script> -->



<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        internal_transport.set_header_page();
        // job_detail.set_header_page();
    });
</script>