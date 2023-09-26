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

<style>

    .table_data_internal td:nth-child(1) select,
    .table_data_internal td:nth-child(2) select,
    .table_data_internal td:nth-child(3) select,
    .table_data_internal td:nth-child(12) select
    {
        width: 200px;
    }

    .table_data_internal td:nth-child(8) select
    {
        width: 100px;
    }

    .table_data_internal td:nth-child(4) input,
    .table_data_internal td:nth-child(5) input,
    .table_data_internal td:nth-child(6) input,
    .table_data_internal td:nth-child(7) input,
    .table_data_internal td:nth-child(11) input
    {
        width: 150px;
    }

    .table_data_internal td:nth-child(12) input,
    .table_data_internal td:nth-child(9) input{
        width: 250px;

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

            <!-- headtab -->
            <div class="card">
                <div class="card-body card_body_head_nav">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="job_detail_tab" data-bs-toggle="pill" data-bs-target="#job_detail_tab_target" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Statement</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="transport_tab" data-bs-toggle="pill" data-bs-target="#transport_tab_target" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="false">Detail</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade " id="job_detail_tab_target" role="tabpanel" aria-labelledby="job_detail_tab">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cash in</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-xl-2 col-lg-2 col-md-3 ">
                                    <label>Cash in :</label>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-5">
                                    <input type="number" class="form-control form-control-sm rounded">
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-xl-2 col-lg-2 col-md-3 ">
                                    <label>Picture :</label>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-5">
                                    <input type="file" class="form-control form-control-sm rounded">
                                </div>
                            </div>
                            <div class="text-end">
                                <button class="btn btn-success btn-sm rounded"><i class="bi bi-save"> Save</i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Internal Transport </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-xl-2 col-lg-2 col-md-3 ">
                                    <label>Date :</label>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-5">
                                    <input type="date" class="form-control form-control-sm rounded date_start">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3 ">
                                    <label>to :</label>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-5">
                                    <input type="date" class="form-control form-control-sm rounded date_stop">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-2 col-lg-2 col-md-3 ">
                                    <label>Pay to :</label>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-5">
                                    <select class="form-select form-select-sm rounded sel_payto_statement">
                                        <option value="">-- please select pay to --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Statement</h4>
                        </div>
                        <div class="card-body">
                            <div class="bd-exsample table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Date Create lasted</th>
                                            <th>Description</th>
                                            <th>Pay to</th>
                                            <th>Pictrue</th>
                                            <th>Cash</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="transport_tab_target" role="tabpanel" aria-labelledby="job_detail_tab">
                    <div class="card">
                        <div class="card-header">
                            <h4>Internal Transport </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-xl-2 col-lg-2 col-md-3 ">
                                    <label>Pay to :</label>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-5">
                                    <select class="form-select form-select-sm rounded sel_payto_detail">
                                        <option value="">-- please select pay to --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Expenses</h4>
                        </div>
                        <div class="card-body">
                        <div class="head_btn_add_rows text-end">
                                <button class="btn btn-outline-primary btn-sm " onclick="internal_transport.add_rows_req()">add rows</button>
                            </div>
                            <div class="bd-example table-responsive">
                                <table class="table table-hover mt-4 text-center table_data_internal">
                                    <thead>
                                        <tr>
                                            <th>Job number</th>
                                            <th>Description</th>
                                            <th>Pay to</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Vat(%)</th>
                                            <th>Total</th>
                                            <th>Currency</th>
                                            <th>Receipt</th>
                                            <th>Remark</th>
                                            <th>Operation date</th>
                                            <th>truck number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><select name="" id="" class="form-select form-select-sm rounded sel_jobnumber">
                                                    <option value="">-- select job number -- </option>
                                                </select></td>
                                            <td><select class="form-select form-select-sm rounded sel_description">
                                                    <option value="">-- select description -- </option>
                                                    
                                                </select></td>
                                            <td><select name="" id="" class="form-select form-select-sm rounded sel_payto">
                                                    <option value="">-- select pay to -- </option>
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
                                            <td><input type="file" class="form-control form-control-sm rounded inp_data_file_internal" onchange="internal_transport.function_show_preview_pic(this)" id="fileInput"></td>
                                            <td><input type="text" class="form-control form-control-sm rounded inp_remark"></td>
                                            <td><input type="date" class="form-control form-control-sm rounded inp_operation_date"></td>
                                            <td><select name="" id="" class="form-select form-select-sm rounded sel_plate">
                                                    <option value="">-- select truck operation --</option>
                                                </select></td>
                                            <td><button class="btn btn-outline-success btn-sm" onclick="internal_transport.save_data_function(this)"><i class="bi bi-save"></i> Save</button>
                                                <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Del</button>
                                            </td>
                                        </tr>
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
<script src="js/internal_transport/internal_transport.js"></script>
<script src="js/internal_transport/setting_data_default.js"></script>
<script src="js/internal_transport/setting_data_first.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<!-- <script src="js/job_detail/job_detail.js"></script>

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
        setting_data_default.setting_data_first();
        setting_data_first.first_set();
        // job_detail.set_header_page();
    });
</script>

<script>
    $(document).ready(function() {
    var today = new Date(); // วันปัจจุบัน

    // วันแรกของเดือน
    var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
    firstDayOfMonth = formatDate(firstDayOfMonth)
    // วันสุดท้ายของเดือน
    var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    lastDayOfMonth = formatDate(lastDayOfMonth)


    // ตั้งค่า date_start และ date_stop
    $('.date_start').val(firstDayOfMonth);
    $('.date_stop').val(lastDayOfMonth);
});

function formatDate(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1; // 0-indexed month
    var year = date.getFullYear();

    // เพิ่ม 0 ข้างหน้าหากมีเพียงหลักเดียว
    if (day < 10) day = '0' + day;
    if (month < 10) month = '0' + month;

    return year + '-' + month + '-' +day ;
}


</script>


