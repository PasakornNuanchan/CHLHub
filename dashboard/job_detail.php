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
</head>
<style>
    #table_billing_ar td:nth-child(1) input {
        width: 200px;

    }

    #table_billing_ar td:nth-child(2) input {
        width: 150px;
    }

    #table_billing_ar td:nth-child(4) select {
        width: 95px;
    }

    #table_billing_ar td:nth-child(5) input {
        width: 100px;
    }

    #table_billing_ar td:nth-child(6) input {
        width: 140px;
    }

    #table_billing_ar td:nth-child(7) input {
        width: 140px;
    }

    #table_billing_ar td:nth-child(8) input {
        width: 140px;
    }

    #table_billing_ar td:nth-child(9) input {
        width: 80px;
    }

    #table_billing_ar td:nth-child(10) input {
        width: 140px;
    }

    #table_billing_ar td:nth-child(11) input {
        width: 200px;
    }


    #table_billing_ap td:nth-child(1) input {
        width: 200px;
    }

    #table_billing_ap td:nth-child(2) input {
        width: 150px;
    }

    #table_billing_ap td:nth-child(4) select {
        width: 95px;
    }

    #table_billing_ap td:nth-child(5) input {
        width: 100px;
    }

    #table_billing_ap td:nth-child(6) input {
        width: 140px;
    }

    #table_billing_ap td:nth-child(7) input {
        width: 140px;
    }

    #table_billing_ap td:nth-child(8) input {

        width: 80px;
    }

    #table_billing_ap td:nth-child(9) input {

        width: 140px;
    }

    #table_billing_ap td:nth-child(10) input {

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

            <!-- headtab -->
            <div class="card">
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
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade " id="job_detail_tab_target" role="tabpanel" aria-labelledby="job_detail_tab">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Job Detail</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Job Number:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_jobnumber">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Booking number:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_bookingnumber">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Consignee:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select id="consginee_db" class="form-select form-select-sm inp_consignee">
                                                <option value="">-- plsese select consignee</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center">Shipper:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_shipper " id="shipper_db">
                                                <option value="">-- pleses select shipper --</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Shipment Terms:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_shipment" id="shipment_db">
                                                <option value="">-- pleses select shipment --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Remark:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_remark">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Carrier:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_carrier" id="carrier_data">
                                                <option value="">-- pleses select carrier --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Port of Receipt:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_port_of_receipt" id="area_data">
                                                <option value="">-- pleses select port of receipt --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Port of Loading:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_port_of_loading" id="area_datal">
                                                <option value="">-- pleses select port of loading--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">T/S Port:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_ts_port" id="area_datat">
                                                <option value="">-- pleses select t/s port -- </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Port of Delivery:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_port_of_delivery" id="area_datad">
                                                <option value="">-- pleses select port of delivery --</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Mother Vessel:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_mother_vessel">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Feeder Vessel:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_feeder_vessel">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">ETD:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="date" class="form-control form-control-sm inp_etd">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">ETA:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="date" class="form-control form-control-sm inp_eta">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">INV No.:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_inv">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">M B/L:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_mbl">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">H B/L:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_hbl">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Cargo Description:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_cargo_des">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Cargo Type:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_cargo_type" id="cargo_data">
                                                <option value="">-- pleses select cargo type --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Quantity:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="number" class="form-control form-control-sm inp_quantity">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">G.W:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="number" class="form-control form-control-sm inp_gw">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Volume:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="number" class="form-control form-control-sm inp_vol">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Marks:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <input type="text" class="form-control form-control-sm inp_remark_container">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-3 align-self-center ">Booking agent:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-9">
                                            <select class="form-select form-select-sm inp_booking_agent" id="agent_data">
                                                <option value="">-- pleses select agent booking --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card p-4">
                        <div class="card-header">
                            <h4>Representator</h4>
                        </div>
                        <div class="card-body">
                            
                        </div>
                    </div> -->
                    <div class="card p-4">
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
                                            <td><input type="text" class="form-control form-control-sm inp_container_number" ></td>
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
                    </div>
                </div>
                <div class="tab-pane fade " id="transport_tab_target" role="tabpanel" aria-labelledby="transport_tab">
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
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Pickup Container Address *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Drop off Container Address *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Drop off Empty Containe Address *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center">Remark</label>
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm">
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
                                            <input type="text" class="form-control form-control-sm">
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
                                        <div class="col-lg-2 col-md-3 ">
                                            <input type="text" class="form-control form-control-sm" placeholder="Driver name">
                                        </div>
                                        <div class="col-lg-2 col-md-3 ">
                                            <input type="text" class="form-control form-control-sm" placeholder="Phone number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="col">
                        <button class="btn btn-block btn-outline-primary col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12" onclick="function_sub_transport.add_new_route();">add new route</button>
                    </div>

                    <!-- </div> -->
                </div>
                <div class="tab-pane fade " id="reportcs_tab_target" role="tabpanel" aria-labelledby="reportcs_tab">
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
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Pick up D/O: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_pick_do">
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_pick_do">received</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Check Doc: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_check_doc">
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_check_doc">received</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Enter: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_enter">
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_enter">received</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Clearlance Date: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="date" class="form-control form-control-sm inp_clearance_date">
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_clear_date">received</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Assign to shipping: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <select id="sel_ats" class="form-select form-select-sm inp_ats">
                                                <option value="">pleses select shipping</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-1 col-md-1">
                                            <button class="btn btn-success btn-sm btn_ats">confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Clearlance Success: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_clearlance_success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Delivery: *</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 ">
                                            <input type="text" class="form-control form-control-sm inp_delivery">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="customs_tab_target" role="tabpanel" aria-labelledby="customs_tab">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Customs Clearlance Plan</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-3 col-lg-3 align-self-center">Customs Clearlance Plan: *</label>
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
                            <h4>Customs Clearlance</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">Ship Arrived: *</label>
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
                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">Conatiner dropoff: *</label>
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
                            <h4>Container upload</h4>
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
                            <h4>Container arrived</h4>
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
                            <h4>Return to CY</h4>
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
                <div class="tab-pane fade " id="billing_tab_target" role="tabpanel" aria-labelledby="billing_tab">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Account Receivable</h4>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover table_billing_ar" id="table_billing_ar">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Description</th>
                                            <th>Bill to</th>
                                            <th>Payble</th>
                                            <th>Currency</th>
                                            <th>QTY.</th>
                                            <th>Unit Price</th>
                                            <th>Add on Profit</th>
                                            <th>AR AMT.</th>
                                            <th>AR VAT%</th>
                                            <th>AMT(INCL.VAT)</th>
                                            <th>Remark</th>
                                            <th>CHECK</th>
                                            <th>PAID</th>
                                            <th>ACTION</th>
                                            <th>Create by.</th>
                                            <th>Create datetime</th>
                                            <th>Check by.</th>
                                            <th>Check datetime</th>
                                            <th>Paid Check by.</th>
                                            <th>Paid Check datetime</th>
                                            <th>Last update by.</th>
                                            <th>Last update datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm"></td> <!-- Description -->
                                            <td><input type="text" class="form-control form-control-sm"></td> <!-- Bill to -->
                                            <td align="center"><input type="checkbox" class="form-input-check "></td> <!-- Payble -->
                                            <td><select class="form-select form-select-sm">
                                                    <option value="THB">THB</option>
                                                    <option value="USD">USD</option>
                                                    <option value="RMB">RMB</option>
                                                </select></td> <!-- Currency -->
                                            <td><input type="number" class="form-control form-control-sm"></td> <!-- QTY. -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- Unit Price -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- Add on profit -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AR AMT -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AR VAT% -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AMT(INCL.vat) -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- remark -->
                                            <td><input type="checkbox" class="form-input-check "></td><!-- CHECK -->
                                            <td></td><!-- PAID -->
                                            <td><button class="btn btn-success btn-sm m-1">Save</button><button class="btn btn-danger btn-sm">Del</button></td><!-- ACTION -->
                                            <td></td><!-- Create by. -->
                                            <td></td><!-- Create datetime -->
                                            <td></td><!-- Check by. -->
                                            <td></td><!-- Check datetime -->
                                            <td></td><!-- Paid Check by. -->
                                            <td></td><!-- Paid Check datetime -->
                                            <td></td><!-- Last update by. -->
                                            <td></td><!-- Last update datetime -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="button_add_new_list_ar text-center">
                                <button class="btn btn-sm btn-outline-primary col-lg-12 col-xs-12 col-sm-12 col-md-12 col-xl-12" onclick="function_sub_billing.add_new_list_ar()">add new list account receivable</button>
                            </div>
                            <div class="text-end mt-4">
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 col-md-6"></div>
                                    <label class="control-label align-self-center col-lg-2 col-md-3">Currency :</label>
                                    <div class="col-lg-2 col-xl-2 col-md-3 text-end">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" onclick="function_sub_billing.cal_currency('thb','ar')" name="radiocurar" id="radiocurar1" checked="">
                                            <label for="radio1" class="form-check-label">THB</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" onclick="function_sub_billing.cal_currency('usd','ar')" name="radiocurar" id="radiocurar2">
                                            <label for="radio2" class="form-check-label">USD</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" onclick="function_sub_billing.cal_currency('rmb','ar')" name="radiocurar" id="radiocurar3">
                                            <label for="radio2" class="form-check-label">RMB</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 col-md-6"></div>
                                    <label class="control-label align-self-center col-lg-2 col-md-3">Sub total :</label>
                                    <div class="col-lg-2 col-md-3">
                                        <input type="text" class="form-control form-control-sm inp_sub_total_ar text-end">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 col-md-6"></div>
                                    <label class="control-label align-self-center col-lg-2 col-md-3">Value added Tax :</label>
                                    <div class="col-lg-2 col-md-3">
                                        <input type="text" class="form-control form-control-sm inp_vat_inc text-end">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 col-md-6"></div>
                                    <label class="control-label align-self-center col-lg-2 col-md-3">Total :</label>
                                    <div class="col-lg-2 col-md-3">
                                        <input type="text" class="form-control form-control-sm inp_total text-end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Account Payble</h4>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover table_billing_ap" id="table_billing_ap">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Bill to</th>
                                            <th>Payble</th>
                                            <th>Currency</th>
                                            <th>QTY.</th>
                                            <th>Unit Price</th>
                                            <th>AP AMT.</th>
                                            <th>AP VAT%</th>
                                            <th>AMT(INCL.VAT)</th>
                                            <th>Remark</th>
                                            <th>CHECK</th>
                                            <th>PAID</th>
                                            <th>ACTION</th>
                                            <th>Create by.</th>
                                            <th>Create datetime</th>
                                            <th>Check by.</th>
                                            <th>Check datetime</th>
                                            <th>Paid Check by.</th>
                                            <th>Paid Check datetime</th>
                                            <th>Last update by.</th>
                                            <th>Last update datetime</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm"></td> <!-- Description -->
                                            <td><input type="text" class="form-control form-control-sm"></td> <!-- Bill to -->
                                            <td></td> <!-- Payble -->
                                            <td><select class="form-select form-select-sm"></select></td> <!-- Currency -->
                                            <td><input type="number" class="form-control form-control-sm"></td> <!-- QTY. -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- Unit Price -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AR AMT -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AR VAT% -->
                                            <td><input type="number" class="form-control form-control-sm"></td><!-- AMT(INCL.vat) -->
                                            <td><input type="text" class="form-control form-control-sm"></td><!-- remark -->
                                            <td><input type="checkbox" class="form-input-check "></td><!-- CHECK -->
                                            <td></td><!-- PAID -->
                                            <td></td><!-- ACTION -->
                                            <td></td><!-- Create by. -->
                                            <td></td><!-- Create datetime -->
                                            <td></td><!-- Check by. -->
                                            <td></td><!-- Check datetime -->
                                            <td></td><!-- Paid Check by. -->
                                            <td></td><!-- Paid Check datetime -->
                                            <td></td><!-- Last update by. -->
                                            <td></td><!-- Last update datetime -->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="button_add_new_list_ap">
                                <button class="btn btn-sm btn-outline-primary col-lg-12 col-sm-12 col-md-12 col-xl-12" onclick="function_sub_billing.add_new_list_ap()">add new list account payble</button>
                            </div>
                            <div class="text-end mt-4">
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 col-md-6"></div>
                                    <label class="control-label align-self-center col-lg-2 col-md-3">Currency :</label>
                                    <div class="col-lg-2 col-xl-2 col-md-3 text-end">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" onclick="function_sub_billing.cal_currency('thb','ap')" name="radiocurap" id="radiocurap1" checked="">
                                            <label for="radio1" class="form-check-label">THB</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" onclick="function_sub_billing.cal_currency('usd','ap')" name="radiocurap" id="radiocurap2">
                                            <label for="radio2" class="form-check-label">USD</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" onclick="function_sub_billing.cal_currency('rmb','ap')" name="radiocurap" id="radiocurap3">
                                            <label for="radio2" class="form-check-label">RMB</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 col-md-6"></div>
                                    <label class="control-label align-self-center col-lg-2 col-md-3">Sub total :</label>
                                    <div class="col-lg-2 col-md-3">
                                        <input type="text" class="form-control form-control-sm inp_sub_total_ap text-end">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 col-md-6"></div>
                                    <label class="control-label align-self-center col-lg-2 col-md-3">Value added Tax :</label>
                                    <div class="col-lg-2 col-md-3">
                                        <input type="text" class="form-control form-control-sm inp_vat_inc_ap text-end">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-9 col-xl-8 col-md-6"></div>
                                    <label class="control-label align-self-center col-lg-2 col-md-3">Total :</label>
                                    <div class="col-lg-2 col-md-3">
                                        <input type="text" class="form-control form-control-sm inp_total_ap text-end">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade show active" id="withdraw_tab_target" role="tabpanel" aria-labelledby="withdraw_tab">
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
                                                    <select class="form-select form-select-sm inp_type_wd" onchange="sub_withdraw.show_petty_cash(this)" >
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
                                                    <input class="form-control form-control-sm inp_pay_to_wd" list="Payto_list">
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
                                                    <input class="form-control form-control-sm inp_description_wd" list="description_list" name="browser" id="browser">
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
                                                    <input type="text" class="form-control form-control-sm inp_remark_wd">
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