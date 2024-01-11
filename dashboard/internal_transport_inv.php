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
    .table_expen>tbody td:nth-child(-n+29) {
        padding-left: 1px;
        padding-right: 1px;
    }

    .table_expen td:nth-child(2) select,
    .table_expen td:nth-child(3) select,
    .table_expen td:nth-child(4) select {
        width: 270px;
    }

    .table_expen td:nth-child(5) select {
        width: 100px;
    }

    .table_expen td:nth-child(6) input,
    .table_expen td:nth-child(7) input,
    .table_expen td:nth-child(8) input,
    .table_expen td:nth-child(10) input,
    .table_expen td:nth-child(11) input {
        width: 130px;
    }

    .table_expen td:nth-child(9) input {
        width: 100px;
    }


    .table_expen td:nth-child(12) input,
    .table_expen td:nth-child(13) input {
        width: 600px;
    }

    .table_expen td:nth-child(14) input {
        width: 200px;
    }

    .table_expen td:nth-child(15) input,
    .table_expen td:nth-child(16) input,
    .table_expen td:nth-child(17) input,
    .table_expen td:nth-child(18) input,
    .table_expen td:nth-child(19) input,
    .table_expen td:nth-child(20) input {
        width: 200px;
    }

    .modal-backdrop {
        width: 1000%;
        height: 100%;
    }

    .table_description_add th.sticky-top{
        position:sticky;
        background-color: #F3F4F9;
        z-index: 10;
        top:0;
    }

    .table_description_add td{
        z-index: 1;
        top:0;
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
            <!-- <div class="card">
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
            </div> -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="job_detail_tab_target" role="tabpanel" aria-labelledby="job_detail_tab">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="row-6">
                                    <h5>Expense</h5>
                                </div>
                                <div class="row-6 text-end">
                                    <button class="btn btn-sm btn-primary" onclick="create_description.modal_start()">description</button>
                                    <button class="btn btn-sm btn-primary" onclick="create_bill_to.modal_start()">Bill to</button>
                                    <button class="btn btn-sm btn-success" onclick="setup.add_list()">Add List</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row-6">
                                    <h5>Filter</h5>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Job </label>
                                    <input type="text" class="form-control form-control-sm inp_job_number" onchange="setup.setting_first()" list="job_list">
                                    <datalist id="job_list" class="data_list_job">

                                    </datalist>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Description</label>
                                    <input type="text" class="form-control form-control-sm inp_description" onchange="setup.setting_first()" list="description_list">
                                    <datalist id="description_list" class="data_list_description">

                                    </datalist>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Bill to</label>
                                    <input type="text" class="form-control form-control-sm inp_applied_person" onchange="setup.setting_first()" list="bill_to_list">
                                    <datalist id="bill_to_list" class="data_list_bill_to">

                                    </datalist>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Create Start date</label>
                                    <input type="Date" class="form-control form-control-sm inp_start_date" onchange="setup.setting_first()">
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">Create End date</label>
                                    <input type="Date" class="form-control form-control-sm inp_end_date" onchange="setup.setting_first()">
                                </div>
                            </div>

                            <div class="add_list_on mt-4 card">
                                
                            </div>
                            <div class="table-responsive bd-exsample mt-3">
                                <table class="table table-hover table_expen" style="zoom:80%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Job number</th>
                                            <th>Description</th>
                                            <th>Bill to</th>
                                            <th>Cur</th>
                                            <th>Qty</th>
                                            <th>Unit <br> Price</th>
                                            <th>Sub <br>Total</th>
                                            <th>Vat%</th>
                                            <th>Vat Excl.</th>
                                            <th>Total</th>
                                            <th>Picture</th>
                                            <th>remark</th>
                                            <th>Del</th>
                                            <th>Edit</th>
                                            <th>Create By.</th>
                                            <th>Create Date</th>
                                            <th>Check By.</th>
                                            <th>Check Date</th>
                                            <th>Gen inv By.</th>
                                            <th>Gen inv Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>1</td>
                                            <td><select class="form-select form-select-sm sel_job_number">
                                                    <option value="">-- select job number --</option>
                                                </select></td>
                                            <td><select class="form-select form-select-sm sel_description">
                                                    <option value="">-- select description --</option>
                                                </select>
                                            </td>
                                            <td><select class="form-select form-select-sm sel_bill_to">
                                                    <option value="">-- select bill to --</option>
                                                </select>
                                            </td>
                                            <td><select class="form-select form-select-sm sel_currency text-center">
                                                    <option value="THB">THB</option>
                                                    <option value="USD">USD</option>
                                                    <option value="HKD">HKD</option>
                                                    <option value="RMB">RMB</option>
                                                    <option value="YEN">YEN</option>
                                                </select></td>
                                            <td><input type="number" class="form-control form-control-sm inp_qty text-end"></td>
                                            <td><input type="number" class="form-control form-control-sm inp_unit_price text-end"></td>
                                            <td><input type="text" class="form-control form-control-sm inp_sub_total text-end" disabled></td>
                                            <td><input type="number" class="form-control form-control-sm inp_vat text-center"></td>
                                            <td><input type="text" class="form-control form-control-sm inp_vat_ex text-end" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm inp_total text-end" disabled></td>
                                            <td><button class="btn btn-primary btn-sm">upload</button></td>
                                            <td></td>
                                            <td><input type="text" class="form-control form-control-sm inp_remark" disabled></td>
                                            <td></td>
                                            <td><input type="text" class="form-control form-control-sm inp_create_by text-end" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm inp_create_date text-end" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm inp_check_by text-end" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm inp_check_date text-end" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm inp_gen_inv_by text-end" disabled></td>
                                            <td><input type="text" class="form-control form-control-sm inp_gen_inv_date text-end" disabled></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="tab-pane fade " id="transport_tab_target" role="tabpanel" aria-labelledby="job_detail_tab">




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

<script src="js/internal_transport_inv/setup.js"></script>
<script src="js/internal_transport_inv/action.js"></script>
<script src="js/internal_transport_inv/create_description.js"></script>
<script src="js/internal_transport_inv/create_bill_to.js"></script>


<script>
    $(document).ready(async function() {
        sidebar_main.set_data_rows();
        var today = new Date(); // วันปัจจุบัน

        // วันแรกของเดือน
        var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        firstDayOfMonth = formatDate(firstDayOfMonth)
        // วันสุดท้ายของเดือน
        var lastDayOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        lastDayOfMonth = formatDate(lastDayOfMonth)

        // console.log(firstDayOfMonth)
        // console.log(lastDayOfMonth)

        // ตั้งค่า date_start และ date_stop
        $('.inp_start_date').val(firstDayOfMonth);
        $('.inp_end_date').val(lastDayOfMonth);

        await setup.main_setup();

    });
</script>

<script>
    function formatDate(date) {
        var day = date.getDate();
        var month = date.getMonth() + 1; // 0-indexed month
        var year = date.getFullYear();

        // เพิ่ม 0 ข้างหน้าหากมีเพียงหลักเดียว
        if (day < 10) day = '0' + day;
        if (month < 10) month = '0' + month;

        return year + '-' + month + '-' + day;
    }
</script>