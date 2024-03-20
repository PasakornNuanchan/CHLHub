<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Job</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<style>
    .table_detail_bl td:nth-child(1) textarea {
        width: 400px;
    }

    .table_detail_bl td:nth-child(2) input,
    .table_detail_bl td:nth-child(5) input,
    .table_detail_bl td:nth-child(6) input,
    .table_detail_bl td:nth-child(7) input,
    .table_detail_bl td:nth-child(8) input {
        width: 200px;
    }

    .table_detail_bl td:nth-child(3) select {
        width: 200px;
    }

    .table_detail_bl td:nth-child(4) input {
        width: 50px;
    }


    /* #table_billing_ar td:nth-child(1) input,
    #table_billing_ar td:nth-child(2) input {
        width: 50px;
    }

    #table_billing_ar td:nth-child(4) input,
    #table_billing_ar td:nth-child(5) select {
        width: 300px;
    }

    #table_billing_ar td:nth-child(7) select,
    #table_billing_ar td:nth-child(8) input,
    #table_billing_ar td:nth-child(11) input,
    #table_billing_ar td:nth-child(15) select {
        width: 150px;
    }

    #table_billing_ar td:nth-child(9) input,
    #table_billing_ar td:nth-child(10) input,
    #table_billing_ar td:nth-child(12) input,
    #table_billing_ar td:nth-child(13) input,
    #table_billing_ar td:nth-child(14) input,
    #table_billing_ar td:nth-child(3) select,
    #table_billing_ar td:nth-child(18) input {
        width: 150px;
    }

    #table_billing_ar td:nth-child(17) input,
    #table_billing_ar td:nth-child(28) input,
    #table_billing_ar td:nth-child(26) input,
    #table_billing_ar td:nth-child(30) input,
    #table_billing_ar td:nth-child(29) input,
    #table_billing_ar td:nth-child(27) input,
    #table_billing_ar td:nth-child(22) input,
    #table_billing_ar td:nth-child(23) input,
    #table_billing_ar td:nth-child(24) input,
    #table_billing_ar td:nth-child(25) input,
    #table_billing_ar td:nth-child(19) input {
        width: 200px;
    } */


    #table_billing_ar td:nth-child(1),
    #table_billing_ar td:nth-child(2),
    #table_billing_ar td:nth-child(3) {
        width: 50px;
    }

    #table_billing_ar td:nth-child(4) select,
    #table_billing_ar td:nth-child(5) input,
    #table_billing_ar td:nth-child(6) select {
        width: 200px;
    }

    #table_billing_ar td:nth-child(7) select {
        width: 130px;
    }


    #table_billing_ar td:nth-child(11) input {
        width: 80px;
    }

    #table_billing_ar td:nth-child(9) input,
    #table_billing_ar td:nth-child(10) input {
        width: 130px;

    }

    #table_billing_ar td:nth-child(13) input,
    #table_billing_ar td:nth-child(14) input {
        width: 140px;
    }

    #table_billing_ar td:nth-child(8) input {
        width: 120px;
    }

    #table_billing_ar td:nth-child(18) input {
        width: 200px;
    }


    #table_billing_ar td:nth-child(22) input,
    #table_billing_ar td:nth-child(23) input,
    #table_billing_ar td:nth-child(24) input,
    #table_billing_ar td:nth-child(25) input,
    #table_billing_ar td:nth-child(26) input,
    #table_billing_ar td:nth-child(27) input {
        width: 200px;
    }


    #table_billing_ar td:nth-child(1),
    #table_billing_ar td:nth-child(2),
    #table_billing_ar td:nth-child(3),
    #table_billing_ar td:nth-child(4),
    #table_billing_ar td:nth-child(5),
    #table_billing_ar td:nth-child(6),
    #table_billing_ar td:nth-child(7),
    #table_billing_ar td:nth-child(8),
    #table_billing_ar td:nth-child(9),
    #table_billing_ar td:nth-child(10),
    #table_billing_ar td:nth-child(11),
    #table_billing_ar td:nth-child(12),
    #table_billing_ar td:nth-child(13),
    #table_billing_ar td:nth-child(14),
    #table_billing_ar td:nth-child(15),
    #table_billing_ar td:nth-child(16),
    #table_billing_ar td:nth-child(17),
    #table_billing_ar td:nth-child(18),
    #table_billing_ar td:nth-child(19),
    #table_billing_ar td:nth-child(20),
    #table_billing_ar td:nth-child(21),
    #table_billing_ar td:nth-child(22),
    #table_billing_ar td:nth-child(23),
    #table_billing_ar td:nth-child(24),
    #table_billing_ar td:nth-child(25),
    #table_billing_ar td:nth-child(26),
    #table_billing_ar td:nth-child(27),
    #table_billing_ar td:nth-child(28),
    #table_billing_ar td:nth-child(29),
    #table_billing_ar td:nth-child(30) {
        padding-left: 2px;
        padding-right: 2px;
    }




    #table_billing_ap td:nth-child(1),
    #table_billing_ap td:nth-child(2),
    #table_billing_ap td:nth-child(3) {
        width: 50px;
    }

    #table_billing_ap td:nth-child(4) select,
    #table_billing_ap td:nth-child(5) input,
    #table_billing_ap td:nth-child(6) select {
        width: 200px;
    }

    #table_billing_ap td:nth-child(7) select {
        width: 130px;
    }


    #table_billing_ap td:nth-child(11) input {
        width: 80px;
    }

    #table_billing_ap td:nth-child(9) input,
    #table_billing_ap td:nth-child(10) input {
        width: 130px;

    }

    #table_billing_ap td:nth-child(13) input,
    #table_billing_ap td:nth-child(14) input {
        width: 140px;
    }

    #table_billing_ap td:nth-child(8) input,
    #table_billing_ap td:nth-child(12) select {
        width: 120px;
    }

    #table_billing_ap td:nth-child(19) input,
    #table_billing_ap td:nth-child(21) input {
        width: auto;
    }


    #table_billing_ap td:nth-child(24) input,
    #table_billing_ap td:nth-child(25) input,
    #table_billing_ap td:nth-child(26) input,
    #table_billing_ap td:nth-child(27) input,
    #table_billing_ap td:nth-child(28) input,
    #table_billing_ap td:nth-child(29) input,
    #table_billing_ap td:nth-child(30) input {
        width: 200px;
    }


    /* #table_billing_ap td:nth-child(10) input,
    #table_billing_ap td:nth-child(9) input,
    #table_billing_ap td:nth-child(12) input,
    #table_billing_ap td:nth-child(13) input,
    #table_billing_ap td:nth-child(17) input {
        width: 150px;
    }

    

    #table_billing_ap td:nth-child(11) input,
    

    #table_billing_ap td:nth-child(18) input,
    #table_billing_ap td:nth-child(24) input,
    #table_billing_ap td:nth-child(25) input,
    #table_billing_ap td:nth-child(26) input,
    #table_billing_ap td:nth-child(27) input,
    #table_billing_ap td:nth-child(28) input,
    #table_billing_ap td:nth-child(29) input,
    #table_billing_ap td:nth-child(16) input {
        width: 200px;
    } */


    #table_billing_ap td:nth-child(1),
    #table_billing_ap td:nth-child(2),
    #table_billing_ap td:nth-child(3),
    #table_billing_ap td:nth-child(4),
    #table_billing_ap td:nth-child(5),
    #table_billing_ap td:nth-child(6),
    #table_billing_ap td:nth-child(7),
    #table_billing_ap td:nth-child(8),
    #table_billing_ap td:nth-child(9),
    #table_billing_ap td:nth-child(10),
    #table_billing_ap td:nth-child(11),
    #table_billing_ap td:nth-child(12),
    #table_billing_ap td:nth-child(13),
    #table_billing_ap td:nth-child(14),
    #table_billing_ap td:nth-child(15),
    #table_billing_ap td:nth-child(16),
    #table_billing_ap td:nth-child(17),
    #table_billing_ap td:nth-child(18),
    #table_billing_ap td:nth-child(19),
    #table_billing_ap td:nth-child(20),
    #table_billing_ap td:nth-child(21),
    #table_billing_ap td:nth-child(22),
    #table_billing_ap td:nth-child(23),
    #table_billing_ap td:nth-child(24),
    #table_billing_ap td:nth-child(25),
    #table_billing_ap td:nth-child(26),
    #table_billing_ap td:nth-child(27),
    #table_billing_ap td:nth-child(28),
    #table_billing_ap td:nth-child(29),
    #table_billing_ap td:nth-child(30),
    #table_billing_ap td:nth-child(31),
    #table_billing_ap td:nth-child(32),
    #table_billing_ap td:nth-child(33) {
        padding-left: 2px;
        padding-right: 2px;
    }


    #table_container_module_setting_width td:nth-child(6) input {
        width: 150px;
    }


    #table_container_module_setting_width td:nth-child(7) select {
        width: 150px;
    }

    #table_container_module_setting_width td:nth-child(8) input {
        width: 150px;
    }

    #table_container_module_setting_width td:nth-child(9) input {
        width: 150px;
    }

    #table_container_module_setting_width td:nth-child(10) input {
        width: 180px;
    }

    #table_container_module_setting_width td:nth-child(13) input {
        width: 250px;
    }


    .table_billing_ap {
        overflow-x: auto;
        white-space: nowrap;
        /* ป้องกันข้อความขึ้นบรรทัดใหม่ */
    }

    .table_billing_ap thead tr th:nth-child(-n+5),
    .table_billing_ap tbody tr td:nth-child(-n+5) {
        position: sticky;
        left: 0;
        background-color: #f8f9fa;
        z-index: 1;
    }

    .table_billing_ap thead tr th:nth-child(n+6),
    .table_billing_ap tbody tr td:nth-child(n+6) {
        position: sticky;
        background-color: #f8f9fa;
        z-index: 0;
    }

    .table_billing_ar {
        overflow-x: auto;
        white-space: nowrap;
        /* ป้องกันข้อความขึ้นบรรทัดใหม่ */
    }

    .table_billing_ar thead tr th:nth-child(-n+5),
    .table_billing_ar tbody tr td:nth-child(-n+5) {
        position: sticky;
        left: 0;
        background-color: #f8f9fa;
        z-index: 1;
    }

    .table_billing_ar thead tr th:nth-child(n+6),
    .table_billing_ar tbody tr td:nth-child(n+6) {
        position: sticky;
        background-color: #f8f9fa;
        z-index: 0;
    }
</style>

<body class="" style="zoom:90%">
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
                <div class="card-body card_body_head_nav" style="zoom:80%">
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
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="bl_tab" data-bs-toggle="pill" data-bs-target="#bl_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Bill of Lading</button>
                        </li> -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="billing_tab" data-bs-toggle="pill" data-bs-target="#billing_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Invoice</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="withdraw_tab" data-bs-toggle="pill" data-bs-target="#withdraw_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Withdraw</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="job_detail_tab_target" role="tabpanel" aria-labelledby="job_detail_tab" style="zoom:80%;">
                    <div class="card p-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                    <h4>Job Detail</h4>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 text-end">
                                    <button class="btn btn-outline-primary btn-sm btn_load_date" onclick="function_sub_job_detail.load_save_data()">load</button>
                                    <button class="btn btn-outline-primary btn-sm btn_generate_job_detail" onclick="function_sub_job_detail.generate_job_detail_document()"><i class="bi bi-printer"></i> Job detail</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Create Date:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="datetime" class="form-control form-control-sm inp_create_date" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Job Number:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_jobnumber" maxlength="10" disabled>
                                        </div>
                                    </div>
                                    <div class="generate_job_func">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Date Generate Job:</label>
                                            <div class="col-sm-6 col-md-9 col-lg-6">
                                                <input type="month" class="form-control form-control-sm inp_month_check " maxlength="10">
                                            </div>
                                            <div class="col">
                                                <button class="btn btn-sm btn-primary col-xl-12" onclick="function_sub_job_detail.generate_job()">Generate job</button>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Type:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <select class="form-select form-select-sm inp_type_generate" name="" id="">
                                                    <option value="">-- select type --</option>
                                                    <option value="I">IMPORT</option>
                                                    <option value="E">EXPORT</option>
                                                    <option value="R">RE-EXPORT</option>
                                                    <option value="P">PRODUCT</option>
                                                    <option value="L">LCL</option>
                                                    <option value="A">AIR FREIGHT</option>
                                                    <option value="G">GUANGZHOU</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Booking number:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_bookingnumber" maxlength="60">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center">Client:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm inp_client " id="client_db">
                                                <option value="">-- pleses select client --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center">Shipper:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-10 col-lg-10">
                                                    <select class="form-select form-select-sm inp_shipper inp_copy_data " id="shipper_db">
                                                        <option value="">-- pleses select shipper --</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 text-end">
                                                    <button class="btn btn-outline-primary btn-sm"><i class="bi bi-clipboard" onclick="function_sub_job_detail.get_to_copy(this)"></i> </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Consignee:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-10 col-lg-10">
                                                    <select id="consginee_db" class="form-select form-select-sm inp_consignee inp_copy_data">
                                                        <option value="">-- plsese select consignee</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 text-end">
                                                    <button class="btn btn-outline-primary btn-sm"><i class="bi bi-clipboard text-primary" onclick="function_sub_job_detail.get_to_copy(this)"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Notify:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <!-- <input type="text" class="form-control form-control-sm inp_notify" maxlength="300"> -->
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-10 col-lg-10">
                                                    <select class="form-select form-select-sm inp_notify_job_detail inp_copy_data" id="notify_db">
                                                        <option value="">-- plsese select notify -- </option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-end">
                                                    <button class="btn btn-outline-primary btn-sm"><i class="bi bi-clipboard text-primary" onclick="function_sub_job_detail.get_to_copy(this)"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Shipment Terms:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm inp_shipment" id="shipment_db">
                                                <option value="">-- pleses select shipment --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Carrier:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-10 col-lg-10">
                                                    <select class="form-select form-select-sm inp_carrier" onchange="function_sub_job_detail.carrier_web(this)" id="carrier_data">
                                                        <option value="">-- pleses select carrier --</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-end">
                                                    <a class="btn btn-outline-primary btn-sm btn_carrier_daata" target="_blank"><i class="bi bi-calendar2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Port of Receipt:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm inp_port_of_receipt" id="area_data">
                                                <option value="">-- pleses select port of receipt --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Port of Loading:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm inp_port_of_loading" id="area_datal">
                                                <option value="">-- pleses select port of loading--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">T/S Port:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm inp_ts_port" id="area_datat">
                                                <option value="">-- pleses select t/s port -- </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Port of Discharge:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm inp_port_of_discharge" id="area_datad">
                                                <option value="">-- pleses select port of delivery --</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Port of Delivery:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm inp_port_of_delivery" id="area_datadl">
                                                <option value="">-- pleses select port of delivery --</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Feeder Vessel:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_feeder_vessel" maxlength="60">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Mother Vessel & Flight:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_mother_vessel" maxlength="60">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Commodity:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <textarea class="form-control inp_commodity" id="exampleFormControlTextarea1" rows="5" maxlength="600"></textarea>
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">ETD:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="date" class="form-control form-control-sm inp_etd">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">ETA:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="date" class="form-control form-control-sm inp_eta">
                                        </div>
                                    </div>


                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">CS support By:</label>
                                        <div class="col">
                                            <select class="form-select form-select-sm inp_cs_user" disabled>
                                                <option value="">-- pleses select Customer service --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Sale support By.</label>
                                        <div class="col">
                                            <select class="form-select form-select-sm inp_sale_user">
                                                <option value="">-- pleses select sale --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center " maxlength="40">M B/L:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_mbl">
                                        </div>
                                    </div>
                                    <div class="hbl_added">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center " maxlength="100">H B/L:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="text" class="form-control form-control-sm inp_first_hbl_d inp_hbl hbl_sel_data">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-md-3 col-lg-3"></div>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <button class="btn btn-primary btn_add_hbl btn-sm btn-block col-lg-12 col-xl-12" onclick="function_sub_job_detail.add_hbl()">add hb/l</button>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center " maxlength="20">INV No.:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_inv">
                                        </div>
                                    </div>
                                    <div class="job_description">
                                        <hr>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Cargo Type:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <select class="form-select form-select-sm inp_cargo_type" id="cargo_data">
                                                    <option value="">-- pleses select cargo type --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Cargo Description:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <!-- <input type="text" class="form-control form-control-sm inp_cargo_des" maxlength="200"> -->
                                                <textarea class="form-control inp_cargo_des" id="exampleFormControlTextarea1" rows="5" maxlength="600"></textarea>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Marks:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="text" class="form-control form-control-sm inp_remark_container" maxlength="400">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Quantity:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="number" class="form-control form-control-sm inp_quantity" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Tare weight :</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="text" class="form-control form-control-sm inp_scntrw_container">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">G.W:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="number" class="form-control form-control-sm inp_gw_container" disabled>
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Volume:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="number" class="form-control form-control-sm inp_vol" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Booking agent:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm inp_booking_agent" id="agent_data">
                                                <option value="">-- pleses select agent booking --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Final destination:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_finaldestination">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Delivery place:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_delivery_place" maxlength="60">
                                        </div>
                                    </div> -->
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Remark:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_remark" maxlength="400">
                                        </div>
                                    </div>
                                    <div class="save_create_btn_add text-end"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="card p-4 c_container_add">
                                <div class="card-header">
                                    <h4>Container</h4>
                                </div>
                                <div class="card-body">
                                    <div class="bd-example table-responsive">
                                        <table class="table table-hover table_container_v2">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No.</th>
                                                    <th>Container Type</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="q_container"></div>
                                                    </td>
                                                    <td><select class="form-select form-select-sm inp_container_type" id="container_type_data">
                                                            <option value="">-- pleses select container type --</option>
                                                        </select></td>
                                                    <td><input type="number" class="form-control form-control-sm inp_num_q text-center"></td>
                                                    <td class="text-center"><button class="btn btn-success btn-sm" onclick="function_sub_job_detail.add_container_module(this,'1')"><i class="bi bi-plus-circle"></i></button> <button class="btn btn-danger btn-sm" onclick="function_sub_job_detail.delete_container_main(this,'1')"><i class="bi bi-trash"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="head_b_btn_add_new_row">
                                            <button class="btn btn-outline-primary btn_add_container_job_detail btn-sm col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="function_sub_job_detail.add_container_v2()">Add Container</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-4 c_container_module">
                        <div class="card-header">
                            <h4>Container module</h4>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover table_container_module table_container_module_setting_width" id="table_container_module_setting_width" onchange="function_sub_job_detail.cal_cargo_information()" style="zoom:80%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Container Type</th>
                                            <th>Container Number</th>
                                            <th>Seal Number</th>
                                            <th>Tare WEIGHT</th>
                                            <th>Quantity</th>
                                            <th>Packing</th>
                                            <th>G.W</th>
                                            <th>Volume</th>
                                            <th>VGM</th>
                                            <th>CY</th>
                                            <th>RTN</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center" container_data_q>1</td>
                                            <td><select class="form-select form-select-sm inp_container_type" id="container_type_data" disabled>
                                                    <option value="">-- pleses select container type --</option>
                                                </select></td>
                                            <td><input type="text" class="form-control form-control-sm text-center"></td>
                                            <td><input type="text" class="form-control form-control-sm text-center text-center"></td>
                                            <td><input type="number" class="form-control form-control-sm text-center"></td>
                                            <td><input type="number" class="form-control form-control-sm text-center"></td>
                                            <td><input type="number" class="form-control form-control-sm text-center"></td>
                                            <td><input type="number" class="form-control form-control-sm text-center"></td>
                                            <td><select class="form-select form-select-sm inp_select_packing" name="" id="">
                                                    <option value=""></option>
                                                </select></td>
                                            <td><input type="number" class="form-control form-control-sm text-center"></td>
                                            <td><input type="text" class="form-control form-control-sm text-center"></td>
                                            <td><input type="date" class="form-control form-control-sm text-center"></td>
                                            <td><input type="date" class="form-control form-control-sm text-center"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-end">
                                    <button class="btn btn-success btn_save_job_detail btn-sm " onclick="function_sub_job_detail.get_data_all_page()"><i class="bi bi-save"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card p-4">
                        <div class="card-header">
                            <h4>Container</h4>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover table_data_container">
                                    <thead>
                                        <tr class="text-center">
                                            <th>CONTAINER TYPE</th>
                                            <th>CONTAINER NUMBER</th>
                                            <th>SINGLE CNT WEIGHT</th>
                                            <th>SOC</th>
                                            <th>OW</th>
                                            <th>CY</th>
                                            <th>RTN</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td><select class="form-select form-select-sm inp_container_type" id="container_type_data">
                                                    <option value="">-- pleses select container type --</option>
                                                </select></td>
                                            <td><input type="text" class="form-control form-control-sm inp_container_number" maxlength="30"></td>
                                            <td><input type="number" class="form-control form-control-sm inp_cntr"></td>
                                            <td><input type="checkbox" class="form-check-input inp_soc"></td>
                                            <td><input type="checkbox" class="form-check-input inp_ow"></td>
                                            <td><input type="date" class="form-control form-control-sm inp_cy"></td>
                                            <td><input type="date" class="form-control form-control-sm inp_rtn"></td>
                                            <td><button class="btn btn-sm btn-danger"><i class="bi bi-trash text-white"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="head_b_btn_add_new_row col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-block btn-sm btn-outline-success col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="function_sub_job_detail.add_row_new_container()" style="width:100%">add new container</button>
                                </div>

                            </div>
                            <div class="mt-2 head_d_btn_get_data_detail" style="float:right;">
                                <button class="btn btn-sm btn-success btn_get_data_detail_f_save" onclick="function_sub_job_detail.get_data_all_page()"><i class="bi bi-save"></i> save</button>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="tab-pane fade " id="transport_tab_target" role="tabpanel" aria-labelledby="transport_tab" style="zoom:80%;">
                    <div class="transport_booking_detail">
                        <h5>Transport Booking Detail (route 1)</h5>
                        <div class="form-group mt-4 row">
                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Supplier:</label>
                            <div class="col-sm-9 col-md-5 col-lg-4">
                                <select class="form-select form-select-sm" id="sel_supplier">
                                    <option value="">-- pleses select supplier --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Pickup Empty Container Address *</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="200">
                                    </div>
                                    <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Loading Address *</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="200">
                                    </div>
                                    <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Delivery Container Address *</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="200">
                                    </div>
                                    <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Drop off Empty Container Address *</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="200">
                                    </div>
                                    <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="200">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Type Truck: *</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 ">
                                        <select class="form-select form-select-sm" id="db_type_truck">
                                        </select>
                                    </div>
                                    <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm" maxlength="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Type Truck: *</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <input type="text" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Budget: *</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3 ">
                                        <input type="text" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-lg-2 col-md-3 ">
                                        <select class="form-select form-select-sm">
                                            <option value="THB">THB</option>
                                            <option value="USD">USD</option>
                                            <option value="RMB">RMB</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>Driver</h5>
                        <div class="form-group mt-4 row">
                            <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Driver: *</label>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_driver_name" placeholder="Name" maxlength="100">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm inp_driver_phone" placeholder="Phone" maxlength="20">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" placeholder="Plate" maxlength="20">
                                    </div>
                                    <div class="col">
                                        <select class="form-select form-select-sm inp_select_container_transport">
                                            <option value="">-- select container --</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control form-control-sm" placeholder="Seal" disabled>
                                    </div>
                                    <div class="col">
                                        <button class="bi bi-trash btn btn-outline-danger" onclick="function_sub_transport.delete_driver(this)"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <button class="btn btn-block btn-outline-primary btn_add_new_route col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12" onclick="function_sub_transport.add_new_route();">add new route</button>
                    </div>
                </div>
                <div class="tab-pane fade " id="reportcs_tab_target" role="tabpanel" aria-labelledby="reportcs_tab" style="zoom:80%;">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Document</h4>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Document</th>
                                            <th>Picture</th>
                                            <th>Received By.</th>
                                            <th>Received Datetime</th>
                                            <th>CheckDoc. By.</th>
                                            <th>CheckDoc. Datetime</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td class="text-start">Invoice :</td>
                                            <td>
                                                <div class="pic_inv_r"></div>
                                            </td>
                                            <td>
                                                <div class="revby_inv_r"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_inv_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_inv_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_inv_r"></div>
                                            </td>
                                            <td>
                                                <div class="act_inv_r"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Bill of laddding</td>
                                            <td>
                                                <div class="pic_bl_r"></div>
                                            </td>
                                            <td>
                                                <div class="revby_bl_r"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_bl_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_bl_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_bl_r"></div>
                                            </td>
                                            <td>
                                                <div class="act_bl_r"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Packing list</td>
                                            <td>
                                                <div class="pic_pl_r"></div>
                                            </td>
                                            <td>
                                                <div class="revby_pl_r"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_pl_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_pl_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_pl_r"></div>
                                            </td>
                                            <td>
                                                <div class="act_pl_r"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Import Declaration</td>
                                            <td>
                                                <div class="pic_id_r"></div>
                                            </td>
                                            <td>
                                                <div class="revby_id_r"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_id_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_id_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_id_r"></div>
                                            </td>
                                            <td>
                                                <div class="act_id_r"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start">Import Licence</td>
                                            <td>
                                                <div class="pic_il_r"></div>
                                            </td>
                                            <td>
                                                <div class="revby_il_r"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_il_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_il_r"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_il_r"></div>
                                            </td>
                                            <td>
                                                <div class="act_il_r"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="mt-4">Document Date</h4>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Check Doc: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_check_doc" disabled>
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_check_doc">confirm</button>
                                        </div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label for="">By</label>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_check_doc_by" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Enter: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_enter" disabled>
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_enter">confirm</button>
                                        </div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label for="">By</label>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_enter_by" disabled>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Pick up D/O: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_pick_do" disabled>
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_pick_do">confirm</button>
                                        </div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label for="">By</label>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_pick_do_by" disabled>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Import Entry: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_import_entry">
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_import_ent">confirm</button>
                                        </div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label for="">By</label>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_import_entry_by" disabled>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_import_entry_datetime" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Customs Clearance plan: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <input type="date" class="form-control form-control-sm inp_clearance_date">
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_clear_date">confirm</button>
                                        </div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label for="">By</label>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_clearance_date_by" disabled>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_clearance_datetime" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Assign to shipping: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <select id="sel_ats" class="form-select form-select-sm inp_ats">
                                                <option value="">pleses select shipping</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_ats">confirm</button>
                                        </div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label for="">By</label>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_ats_by" disabled>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_ats_datetime" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Delivery Date plan: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <input type="datetime-local" class="form-control form-control-sm inp_delivery_plan">
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_delivery">confirm</button>
                                        </div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label for="">By</label>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_delivery_plan_by " disabled>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_delivery_plan_datetime" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Clearance Success: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_clearlance_success">
                                        </div>
                                        <div class="col-lg-1 col-md-1"></div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label for="">By</label>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_clearlance_success_by" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center">Delivery: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_delivery">
                                        </div>
                                        <div class="col-lg-1 col-md-1"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="customs_tab_target" role="tabpanel" aria-labelledby="customs_tab" style="zoom:80%;">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Customs Clearance Plan</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Customs Clearance Plan: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="col-lg-5 col-md-5 ">
                                        <input type="text" class="form-control form-control-sm inp_customs_plan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Document Check</h4>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Document</th>
                                            <th>Picture</th>
                                            <th>Received By.</th>
                                            <th>Received Datetime</th>
                                            <th>CheckDoc. By.</th>
                                            <th>CheckDoc. Datetime</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Invoice :</td>
                                            <td>
                                                <div class="pic_inv"></div>
                                            </td>
                                            <td>
                                                <div class="revby_inv"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_inv"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_inv"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_inv"></div>
                                            </td>
                                            <td>
                                                <div class="act_inv"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bill of laddding</td>
                                            <td>
                                                <div class="pic_bl"></div>
                                            </td>
                                            <td>
                                                <div class="revby_bl"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_bl"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_bl"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_bl"></div>
                                            </td>
                                            <td>
                                                <div class="act_bl"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Packing list</td>
                                            <td>
                                                <div class="pic_pl"></div>
                                            </td>
                                            <td>
                                                <div class="revby_pl"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_pl"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_pl"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_pl"></div>
                                            </td>
                                            <td>
                                                <div class="act_pl"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Import Declaration</td>
                                            <td>
                                                <div class="pic_id"></div>
                                            </td>
                                            <td>
                                                <div class="revby_id"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_id"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_id"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_id"></div>
                                            </td>
                                            <td>
                                                <div class="act_id"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Import Licence</td>
                                            <td>
                                                <div class="pic_il"></div>
                                            </td>
                                            <td>
                                                <div class="revby_il"></div>
                                            </td>
                                            <td>
                                                <div class="revtime_il"></div>
                                            </td>
                                            <td>
                                                <div class="checkdocby_il"></div>
                                            </td>
                                            <td>
                                                <div class="checkdoctime_il"></div>
                                            </td>
                                            <td>
                                                <div class="act_il"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Customs Clearance</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">Vessel Arrived : *</label>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_sa_cb">
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="datetime" class="form-control form-control-sm inp_sa_dc">
                                        </div>
                                        <div class="col-lg-3 col-md-5 text-center">
                                            <button class="btn btn-success btn-sm cf_sa">Confirm</button>
                                            <button class="btn btn-danger btn-sm tb_sa">Troubleshoot</button>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_sa_pro">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">Container Discharge: *</label>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_dr_cb">
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="datetime" class="form-control form-control-sm inp_dr_dc">
                                        </div>
                                        <div class="col-lg-3 col-md-5 text-center">
                                            <button class="btn btn-success btn-sm cf_dr">Confirm</button>
                                            <button class="btn btn-danger btn-sm tb_dr">Troubleshoot</button>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_dr_pro">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">Customs Clearance: *</label>
                                <div class="col-sm-10 col-md-10 col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_cc_cb">
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="datetime" class="form-control form-control-sm inp_cc_dc">
                                        </div>
                                        <div class="col-lg-3 col-md-5 text-center">
                                            <button class="btn btn-success btn-sm cf_cc">Confirm</button>
                                            <button class="btn btn-danger btn-sm tb_cc">Troubleshoot</button>
                                        </div>
                                        <div class="col-lg-3 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_cc_pro">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Container unload</h4>
                        </div>
                        <div class="card-body">
                            <div class="contaienr_status_container_upload">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">Ship Arrived: *</label>
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="date" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-lg-3 col-md-5 text-center">
                                                <button class="btn btn-success">Confirm</button>
                                                <button class="btn btn-danger">Troubleshoot</button>
                                            </div>
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Delivery</h4>
                        </div>
                        <div class="card-body">
                            <div class="contaienr_status_container_arrived">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">Ship Arrived: *</label>
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="date" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-lg-3 col-md-5 text-center">
                                                <button class="btn btn-success">Confirm</button>
                                                <button class="btn btn-danger">Troubleshoot</button>
                                            </div>
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>CY return</h4>
                        </div>
                        <div class="card-body">
                            <div class="contaienr_status_container_cy">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">Ship Arrived: *</label>
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="date" class="form-control form-control-sm">
                                            </div>
                                            <div class="col-lg-3 col-md-5 text-center">
                                                <button class="btn btn-success">Confirm</button>
                                                <button class="btn btn-danger">Troubleshoot</button>
                                            </div>
                                            <div class="col-lg-3 col-md-5 ">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="bl_tab_target" role="tabpanel" aria-labelledby="bl_tab">
                    <div class="row">
                        <div class=" col-xl-7 col-lg-7">
                            <div class="card p-4">
                                <div class="card-header">
                                    <h4>Bill of Landing</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Shipper : </label>
                                            <div class="col">
                                                <textarea class="form-control inp_bl_shipping" id="exampleFormControlTextarea1" rows="5" maxlength="400"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Consignee : </label>
                                            <div class="col">
                                                <textarea class="form-control inp_bl_consingee" id="exampleFormControlTextarea1" rows="5" maxlength="400"></textarea>
                                                <button class="btn btn-sm btn-outline-primary" onclick="function_sub_bl.address_consignee()">Save as consignee</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Notify Party : </label>
                                            <div class="col">
                                                <textarea class="form-control inp_notify_bl" id="exampleFormControlTextarea1" rows="5" maxlength="400"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Pre-Carriage By : </label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp_pre_carriage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Place of Receipt : </label>
                                            <div class="col">
                                                <select class="form-select form-select-sm bl_por inp_bl_por" disabled>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Port of loading : </label>
                                            <div class="col">
                                                <select class="form-select form-select-sm bl_pol inp_bl_pol" disabled>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Port of Discharge : </label>
                                            <div class="col">
                                                <select class="form-select form-select-sm bl_pod inp_bl_pod" disabled>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Place of delivery : </label>
                                            <div class="col">
                                                <select class="form-select form-select-sm bl_pode inp_bl_pode" disabled>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Vessel / Yoyage : </label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp_mother_vessel" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5">
                            <div class="card p-4 ">
                                <div class="card-header">

                                </div>
                                <div class="card-body">

                                    <div class="form-group mt-4">
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">Bill header : </label>
                                            <div class="col">
                                                <select class="form-select form-select-sm inp_bill_header_bl">
                                                    <option value="">Select bill header</option>
                                                    <option value="CHL">CHINA HIGHWIN LIMITED</option>
                                                    <option value="THS">TH SHIPPING CONTAINER LINE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">Delivery Agent : </label>
                                            <div class="col">
                                                <textarea class="form-control inp_delivery_agent_bl" id="exampleFormControlTextarea1" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">ship on board date: </label>
                                            <div class="col">
                                                <input type="date" class="form-control form-control-sm inp_shipper_on_board">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">surrender date: </label>
                                            <div class="col">
                                                <input type="date" class="form-control form-control-sm inp_on_board_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3"> Final destination</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp_final_destination">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">No. of Original B(s)/L : </label>
                                            <div class="col">
                                                <input type="number" class="form-control form-control-sm inp_bl_number" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-3 col-lg-3 col-md-3 col-sx-3">Place of issue : </label>
                                            <div class="col">
                                                <input class="form-control form-control-sm inp_place" list="place_list" maxlength="60">
                                                <datalist id="place_list">
                                                    <option value="Bangkok">
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card p-4">
                            <div class="card-header">
                                <h4>Bill of lading detail</h4>
                                <div class="bd-example table-responsive">
                                    <table class="table table-hover table_detail_bl">
                                        <thead class="text-center">
                                            <tr>
                                                <th row="2">Container No. & Seal No. Marks and Number</th>
                                                <th>No.of Container or package</th>
                                                <th>unit</th>
                                                <th>Kind of package; Description of goods</th>
                                                <th>Gross Weight</th>
                                                <th>unit</th>
                                                <th>Measurement</th>
                                                <th>unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><textarea class="form-control inp_container_no_and_seal" id="exampleFormControlTextarea1" rows="4"></textarea></td>
                                                <td><input type="text" class="form-control form-control-sm inp_container_or_package"></td>
                                                <td><textarea class="form-control inp_kind_of_package" id="exampleFormControlTextarea1" rows="4"></textarea></td>
                                                <td><input type="text" class="form-control form-control-sm inp_unit_package"></td>
                                                <td><input type="text" class="form-control form-control-sm inp_gross_Weight"></td>
                                                <td><input type="text" class="form-control form-control-sm inp_gross_weight_unit"></td>
                                                <td><input type="text" class="form-control form-control-sm inp_mesurement"></td>
                                                <td><input type="text" class="form-control form-control-sm inp_mesurement_unit"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card p-4">
                            <div class="card-header">
                                <h4>Container</h4>
                            </div>
                            <div class="card-body">
                                <div class="bd-example table-responsive">
                                    <table class="table table-hover table_container_bl">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Contianer type</th>
                                                <th>Container number</th>
                                                <th>Seal number</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Weight</th>
                                                <th>CBM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><select class="form-select form-select-sm bl_container_type inp_bl_contianer_type">
                                                        <option value="">select container type</option>
                                                    </select></td>
                                                <td><input type="text" class="form-control form-control-sm"></td>

                                                <td><input type="text" class="form-control form-control-sm inp_quantity_bl"></td>
                                                <td>
                                                    <select class="form-select form-select-sm inp_unit_bl">
                                                        <option value="BAGS">BAGS</option>
                                                        <option value="BALES">BALES</option>
                                                        <option value="BOXES">BOXES</option>
                                                        <option value="BUNDLES">BUNDLES</option>
                                                        <option value="CANS">CANS</option>
                                                        <option value="CATRONS">CATRONS</option>
                                                        <option value="CASES">CASES</option>
                                                        <option value="CRATES">CRATES</option>
                                                        <option value="CARTON">CARTON</option>
                                                        <option value="CTNS">CTNS</option>
                                                        <option value="DOZENS">DOZENS</option>
                                                        <option value="DRUMS">DRUMS</option>
                                                        <option value="LOTS">LOTS</option>
                                                        <option value="PACKAGES">PACKAGES</option>
                                                        <option value="PAIRS">PAIRS</option>
                                                        <option value="PALLET(S)">PALLET(S)</option>
                                                        <option value="PAPER PLTS">PAPER PLTS</option>
                                                        <option value="PCS">PCS</option>
                                                        <option value="PIECES">PIECES</option>
                                                        <option value="PKGS">PKGS</option>
                                                        <option value="PLASTIC PLTS">PLASTIC PLTS</option>
                                                        <option value="PLTS">PLTS</option>
                                                        <option value="PLYWOOD CASE(S)">PLYWOOD CASE(S)</option>
                                                        <option value="RACKS">RACKS</option>
                                                        <option value="REELS">REELS</option>
                                                        <option value="ROLLS">ROLLS</option>
                                                        <option value="SACKS">SACKS</option>
                                                        <option value="SETS">SETS</option>
                                                        <option value="SHEET">SHEET</option>
                                                        <option value="STEEL CASES">STEEL CASES</option>
                                                        <option value="TANKS">TANKS</option>
                                                        <option value="TINS">TINS</option>
                                                        <option value="TRAYS">TRAYS</option>
                                                        <option value="UNIT">UNIT</option>
                                                        <option value="CREATE">W/CREATE</option>
                                                        <option value="WOODEN CASES">WOODEN CASES</option>
                                                    </select>

                                                </td>
                                                <td><input type="text" class="form-control form-control-sm"></td>
                                                <td><input type="text" class="form-control form-control-sm inp_cbm_bl"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <div class="form-group">
                                        <div class="row text-center">
                                            <div class="col-xl-2 col-lg-2 col-md-2">
                                                <label>Total : Quantity </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2">
                                                <input type="text" class="form-control form-control-sm inp_package_total text-end" disabled>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2">
                                                <label class="col-xl-3">Weight </label>
                                            </div>

                                            <div class="col-xl-2 col-lg-2 col-md-2">
                                                <input type="text" class="form-control form-control-sm inp_weight_total text-end" disabled>
                                            </div>

                                            <div class="col-xl-2 col-lg-2 col-md-2">
                                                <label class="col-xl-3">CBM </label>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2">
                                                <input type="text" class="form-control form-control-sm col-xl-2 inp_cbm_total text-end" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card p-4">
                                <div class="card-header">

                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-xl-2 col-lg-2 col-md-2 col-sx-2">Description : </label>
                                            <div class="col">
                                                <textarea class="form-control inp_description_of_good" id="exampleFormControlTextarea1" rows="12" maxlength="400"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-success btn-sm rounded " onclick="function_sub_bl.get_save_data()"><i class="bi bi-save"></i> save</button>
                                        <button class="btn btn-outline-primary btn-sm " onclick="function_sub_bl.generate_telex_line()">Telex release BL</button>
                                        <button class="btn btn-outline-primary btn-sm " onclick="function_sub_bl.generate_bl()">Generate BL</button>
                                        <button class="btn btn-outline-primary btn-sm " onclick="function_sub_bl.generate_bl_line()">Generate BL With line</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <style>

                </style>
                <div class="tab-pane fade  " id="billing_tab_target" role="tabpanel" aria-labelledby="billing_tab" style="zoom:70%">
                    <div class="card p-4">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <h4>Account Payble</h4>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="text-end btn_save_mode_invoice">
                                        <button class="btn btn-success rounded m-1 btn_save_all_billing text-end hide_mode_invoice" onclick="function_sub_billing.save_all_billing()"><i class="bi bi-save"></i> save</button>
                                        <button class="btn btn-outline-primary m-1 rounded text-end hide_mode_invoice" onclick="function_sub_billing.generate_bill_ap()">Generate bill</button>
                                        <button class="btn btn-outline-primary m-1 rounded text-end hide_mode_invoice" onclick="function_sub_billing.get_copy_ap_to_ar()">Copy AP to AR</button>
                                        <button class="btn btn-outline-primary m-1 rounded text-end hide_mode_invoice" onclick="function_sub_billing.modal_profit_billing()">profit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover table_billing_ap" id="table_billing_ap" onchange="function_sub_billing.cal_result_ap(this)">
                                    <thead>
                                        <tr class="text-center" style="font-size:14;">
                                            <th class="text-center">Action</th>
                                            <th class="text-center"><button class="btn btn-sm btn-outline-primary" onclick="function_sub_billing.select_all_box('ap')">all</button></th>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Code</th>
                                            <th class="text-center">Item</th>
                                            <th class="text-center">Bill to</th>
                                            <th class="text-center">Currency</th>
                                            <th class="text-center">QTY.</th>
                                            <th class="text-center">Unit Price</th>
                                            <th class="text-center">AP AMT.</th>
                                            <th class="text-center">VAT%</th>
                                            <th class="text-center">Tax <br> (w/h)</th>
                                            <th class="text-center">Vat (EXCL)</th>
                                            <th class="text-center">AMT <br> (INCL.VAT)</th>
                                            <th class="text-center">Paid amt</th>
                                            <th class="text-center">Remark</th>
                                            <th class="text-center">Billing Date</th>
                                            <th class="text-center">Sys Rate</th>
                                            <th class="text-center">Apply</th>
                                            <th class="text-center">Apply By</th>
                                            <th class="text-center">Apply Date</th>
                                            <th class="text-center">CHECK</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Commission <br> Sale</th>
                                            <th class="text-center">Branch</th>
                                            <th class="text-center">Creater</th>
                                            <th class="text-center">Create date</th>
                                            <th class="text-center">Last modifier</th>
                                            <th class="text-center">Last modifier date</th>
                                            <th class="text-center">Cheker</th>
                                            <th class="text-center">Check Date</th>
                                            <th class="text-center">Approve By</th>
                                            <th class="text-center">Approve Date</th>
                                        </tr>
                                        <!-- <tr>
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                            <td>11</td>
                                            <td>12</td>
                                            <td>13</td>
                                            <td>14</td>
                                            <td>15</td>
                                            <td>16</td>
                                            <td>17</td>
                                            <td>18</td>
                                            <td>19</td>
                                            <td>20</td>
                                            <td>21</td>
                                            <td>22</td>
                                            <td>23</td>
                                            <td>24</td>
                                            <td>25</td>
                                            <td>26</td>
                                            <td>27</td>
                                            <td>28</td>
                                            <td>29</td>
                                            <td>30</td>
                                        </tr> -->

                                    </thead>
                                    <tbody class="justify-content-center text-align-center" style="text-align: center; vertical-align: middle;">
                                        <tr class="text-center">
                                            <td><button class="btn btn-success btn-sm rounded"><i class="bi bi-save"></i> save</button>
                                                <button class="btn btn-danger btn-sm rounded"><i class="bi bi-trash"></i> Del</button>
                                            </td><!--  action -->
                                            <td></td>
                                            <td><select class="form-select form-select-sm sel_data_billing_ap" onchange="function_sub_billing.change_sub_billing(this)">
                                                    <option value="">-- please select code --</option>
                                                </select></td>
                                            <td><input type="text" class="form-control form-control-sm inp_des_ap" disabled></td> <!-- Description -->
                                            <td><select class="form-select form-select-sm inp_billing_to_ap">
                                                    <option value="">-- please select bill to</option>
                                                </select></td> <!-- Bill to -->
                                            <td>
                                                <!-- <div class="paid_status"></div> -->
                                            </td> <!-- Payble -->
                                            <td><select class="form-select form-select-sm">
                                                    <option value="THB">THB</option>
                                                    <option value="USD">USD</option>
                                                    <option value="RMB">RMB</option>
                                                    <option value="YEN">YEN</option>
                                                </select></td> <!-- Currency -->
                                            <td><input type="number" class="form-control form-control-sm"></td> <!-- QTY. -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- Unit Price -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AR AMT -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AR VAT% -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AMT(INCL.vat) -->
                                            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- Billing Date -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- Sys rate -->
                                            <td><input type="checkbox" class="form-input-check "></td><!-- apply -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- apply date -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- paid amt -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- remark -->
                                            <td><input type="checkbox" class="form-input-check "></td><!-- CHECK -->
                                            <td><span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Paid</span></td><!-- status -->
                                            <td><input type="checkbox" class="form-input-check "></td><!-- tax with hold -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- commission sale -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- branch -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- creater -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- creater date -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- last modifier -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- last modifier date -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- checker  -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- checker date -->

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="button_add_new_list_ap">
                                <button class="btn btn-sm btn-outline-primary btn_add_new_list_ap col-lg-12 col-sm-12 col-md-12 col-xl-12" onclick="function_sub_billing.add_new_list_ap()">add new list account payble</button>
                            </div>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1"></div>
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1 text-center">USD</div>
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1 text-center">THB</div>
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1 text-center">HKD</div>
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1 text-center">RMB</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <p>Sub total</p>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end sub_total_ap_usd" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end sub_total_ap_thb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end sub_total_ap_rmb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end sub_total_ap_hkd" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <p>Vat</p>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end vat_ap_usd" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end vat_ap_thb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end vat_ap_rmb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end vat_ap_hkd" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <p>Total</p>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end total_ap_usd" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end total_ap_thb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end total_ap_rmb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end total_ap_hkd" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <h4>Account Receivable</h4>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="text-end btn_save_mode_invoice">
                                    <button class="btn btn-success rounded btn_save_all_billing m-1 text-end hide_mode_invoice" onclick="function_sub_billing.save_all_billing()"><i class="bi bi-save"></i> save</button>
                                    <button class="btn btn-outline-primary rounded m-1 text-end hide_mode_invoice" onclick="function_sub_billing.generate_bill_ar()">Generate Invoice</button>
                                    <button class="btn btn-outline-primary rounded m-1 text-end hide_mode_invoice" onclick="function_sub_billing.generate_bill_ar_full()">Generate Invoice (Full)</button>
                                    <button class="btn btn-outline-primary rounded m-1 text-end hide_mode_invoice" onclick="function_sub_billing.get_generate_bill_ar_state_ment_account()">Generate Statement of Account</button>
                                    <button class="btn btn-outline-primary rounded m-1 text-end hide_mode_invoice" onclick="function_sub_billing.get_generate_bill_ar_debit_note()">Generate debit note</button>
                                    <button class="btn btn-outline-primary rounded m-1 text-end hide_mode_invoice" onclick="function_sub_billing.get_generate_bill_ar_debit_note_line()">Generate debit note line</button>

                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover table_billing_ar" id="table_billing_ar">
                                    <thead>
                                        <tr class="text-center">
                                            <th>action</th>
                                            <th><button class="btn btn-sm btn-outline-primary" onclick="function_sub_billing.select_all_box('ar')">all</button></th>
                                            <th>No.</th>
                                            <th>Code</th>
                                            <th>Item</th>
                                            <th>Bill to</th>
                                            <!-- <th>Payble</th> -->
                                            <th>Currency</th>
                                            <th>QTY.</th>
                                            <th>Unit Price</th>
                                            <th>AR AMT.</th>
                                            <th>VAT%</th>

                                            <th>With hold (%)</th>
                                            <th>Vat (EXCL)</th>
                                            <th>AMT<br>(INCL.VAT)</th>
                                            <th>Rcvd Amt</th>
                                            <th>Remark</th>

                                            <th>Billing Date</th>
                                            <th>Sys rate</th>
                                            <!-- <th>Sys Rate currency</th> -->
                                            <th>Need Vat</th>
                                            <th>Check</th>
                                            <th>staus</th>
                                            <th>branch</th>
                                            <th>creater</th>
                                            <th>create date</th>
                                            <th>last modifier</th>
                                            <th>last modifier date</th>
                                            <th>checker</th>
                                            <th>checker date</th>
                                        </tr>
                                        <!-- <tr>
                                            <th class="text-center">1</th>
                                            <th class="text-center">2</th>
                                            <th class="text-center">3</th>
                                            <th class="text-center">4</th>
                                            <th class="text-center">5</th>
                                            <th class="text-center">6</th>
                                            <th class="text-center">7</th>
                                            <th class="text-center">8</th>
                                            <th class="text-center">9</th>
                                            <th class="text-center">10</th>
                                            <th class="text-center">11</th>
                                            <th class="text-center">12</th>
                                            <th class="text-center">13</th>
                                            <th class="text-center">14</th>
                                            <th class="text-center">15</th>
                                            <th class="text-center">16</th>
                                            <th class="text-center">17</th>
                                            <th class="text-center">18</th>
                                            <th class="text-center">19</th>
                                            <th class="text-center">20</th>
                                            <th class="text-center">21</th>
                                            <th class="text-center">22</th>
                                            <th class="text-center">23</th>
                                            <th class="text-center">24</th>
                                            <th class="text-center">25</th>
                                            <th class="text-center">26</th>
                                            <th class="text-center">27</th>
                                            <th class="text-center">28</th>
                                            <th class="text-center">29</th>
                                        </tr> -->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>test</td> <!-- No -->
                                            <td><select class="form-select form-select-sm select_code_billing_ar" onchange="function_sub_billing.change_sub_billing_ar(this)"> <!-- Code -->
                                                    <option value="">-- pleas select code --</option>
                                                </select></td>
                                            <td><input type="text" class="form-control form-control-sm"></td> <!-- item -->
                                            <td><select class="form-select form-select-sm select_bill_to_ar"> <!-- bill to -->
                                                    <option value="">-- please select bill to --</option>
                                                </select></td>
                                            <td align="center"></td> <!-- Payble -->
                                            <td><select class="form-select form-select-sm">
                                                    <option value="THB">THB</option>
                                                    <option value="USD">USD</option>
                                                    <option value="RMB">RMB</option>
                                                </select></td> <!-- Currency -->
                                            <td><input type="number" class="form-control form-control-sm"></td> <!-- QTY. -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- Unit Price -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AR AMT -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- VAT% -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AMT(INCL.vat) -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- Billing Date -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- sysrate -->
                                            <td><input type="checkbox" class="form-input-check"></td><!-- need vat -->
                                            <td><input type="checkbox" class="fotm-input-check"></td><!-- rcvd amt -->
                                            <td><input type="text" class="form-control form-control-sm"></td> <!-- remark -->
                                            <td><input type="checkbox" class="form-input-check"></td>
                                            <td></td><!-- Create by. -->
                                            <td></td><!-- Create datetime -->
                                            <td></td><!-- Check by. -->
                                            <td></td><!-- Check datetime -->
                                            <td></td><!-- Paid Check by. -->
                                            <td></td><!-- Paid Check datetime -->
                                            <td></td><!-- Last update by. -->
                                            <td></td><!-- Last update datetime -->
                                            <td><button class="btn btn-success btn-sm m-1">Save</button><button class="btn btn-danger btn-sm">Del</button></td><!-- ACTION -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="button_add_new_list_ar text-center">
                                <button class="btn btn-sm btn-outline-primary btn_add_new_list_ar col-lg-12 col-xs-12 col-sm-12 col-md-12 col-xl-12" onclick="function_sub_billing.add_new_list_ar()">add new list account receivable</button>
                            </div>
                            <div class="mt-4">
                                <div class="row">
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1"></div>
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1 text-center">USD</div>
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1 text-center">THB</div>
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1 text-center">HKD</div>
                                    <div class="m-2 col-md-2 col-lg-1 col-xl-1 text-center">RMB</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <p>Sub total</p>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end sub_total_ar_usd " readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end sub_total_ar_thb " readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end sub_total_ar_rmb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end sub_total_ar_hkd" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <p>Vat</p>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end vat_ar_usd " readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end vat_ar_thb " readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end vat_ar_rmb " readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end vat_ar_hkd " readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <p>Total</p>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end total_ar_usd" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end total_ar_thb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end total_ar_rmb" readonly>
                                    </div>
                                    <div class="col-md-2 col-lg-1 col-xl-1 m-2">
                                        <input type="text" class="form-control form-control-sm text-end total_ar_hkd" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="withdraw_tab_target" role="tabpanel" aria-labelledby="withdraw_tab">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Withdraw</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-md-2 col-lg-3 align-self-center">Type: </label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col">
                                                    <select class="form-select form-select-sm inp_type_wd" onchange="sub_withdraw.show_petty_cash(this)">
                                                        <option value="Payble">Payable</option>
                                                        <option value="Advancecash">Advance cash</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="data_petty_cash">

                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-md-2 col-lg-3 align-self-center">Pay to: </label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input class="form-control form-control-sm inp_pay_to_wd" list="Payto_list" maxlength="200">
                                                    <datalist id="Payto_list">
                                                        <option value="Port Authority of Thailand (PAT)">
                                                        <option value="Airports of Thailand (AOT)">
                                                        <option value="Thai Customs">
                                                    </datalist>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-md-2 col-lg-3 align-self-center">Description: </label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input class="form-control form-control-sm inp_description_wd" list="description_list" name="browser" id="browser" maxlength="300">
                                                    <datalist id="description_list">
                                                        <option value="RENT cargo">
                                                        <option value="Customs Fee">
                                                        <option value="OT officer">
                                                    </datalist>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-md-2 col-lg-3 align-self-center">Amount: </label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="number" class="form-control form-control-sm inp_amount_wd">
                                                </div>
                                                <div class="col">
                                                    <select class="form-select form-select-sm inp_currency_wd">
                                                        <option value="THB">THB</option>
                                                        <option value="USD">USD</option>
                                                        <option value="RMB">RMB</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row fg_pic">
                                        <label class="control-label col-sm-3 col-md-2 col-lg-3 align-self-center">Picture: </label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="file" class="form-control form-control-sm inp_picfile" id="imgInp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-md-2 col-lg-3 align-self-center ">Remark: </label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm inp_remark_wd" maxlength="300">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 text-center">
                                    <div class="bd-example">
                                        <img id="blah" style="width:300px;height:300px;border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" class="bg-secondary" />
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <div class="col-sm-3 col-md-3 col-lg-6">
                                        <div class="row">
                                            <div class="col text-end">
                                                <button class="btn btn-success btn-sm " onclick="function_sub_withdraw.get_data_save();">save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Payable list</h4>
                        </div>
                        <div class="card-body">
                            <div class="db-example table-responsive">
                                <table class="table table-hover table_wd_payble">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Pay to</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Picture</th>
                                            <th>Remark</th>
                                            <th>status</th>
                                            <th>action</th>
                                            <th>request by.</th>
                                            <th>datetime request</th>
                                            <th>paid by.</th>
                                            <th>paid datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Advance Cash list</h4>
                        </div>
                        <div class="card-body">
                            <div class="db-example table-responsive">
                                <table class="table table-hover table_wd_advancecash">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Pay to</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Picture</th>
                                            <th>Remark</th>
                                            <th>status</th>
                                            <th>action</th>
                                            <th>request by.</th>
                                            <th>datetime request</th>
                                            <th>paid by.</th>
                                            <th>paid datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
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
                    <div class="petty_cash_data_all">

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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="js/job_detail/job_detail.js"></script>
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
<script src="js/job_detail/setting_create_job.js"></script>
<script src="js/job_detail/setting_sub_bl.js"></script>
<script src="js/job_detail/function_sub_bl.js"></script>
<script src="js/job_detail/setting_bl_gang_bl.js"></script>
<script src="js/job_detail/log_job.js"></script>

<script>
    $(document).ready(function() {
        // ดึงวันที่ปัจจุบัน
        var today = new Date();
        var year = today.getFullYear();
        var month = (today.getMonth() + 1).toString().padStart(2, "0"); // หลักเดียวให้เติม 0 ข้างหน้า
        var defaultValue = `${year}-${month}`;

        // ใส่ค่าเริ่มต้นลงใน input
        $(".inp_month_check").val(defaultValue);
    });
</script>


<script>
    $(document).ready(function() {

        sidebar_main.set_data_rows();
        job_detail.set_header_page();

    });
</script>



<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').attr('src', e.target.result).css({
                    "width": "300px",
                    "height": "400px"
                });
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imgInp").change(function() {
        readURL(this);
    });
</script>