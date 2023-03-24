<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Report Customer service</title>
    <?php include '../assets/include/theme_include_css.php'; ?>

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
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="pills-jobdetail-tab" data-bs-toggle="pill" data-bs-target="#pills-jobdetail" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Job Detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-container-tab" data-bs-toggle="pill" data-bs-target="#pills-container" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Container</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-driver-tab" data-bs-toggle="pill" data-bs-target="#pills-driver" type="button" role="tab" aria-controls="pills-booking" aria-selected="false">Driver</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-booking-tab" data-bs-toggle="pill" data-bs-target="#pills-booking" type="button" role="tab" aria-controls="pills-booking" aria-selected="false">Booking</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-jobdetail" role="tabpanel" aria-labelledby="pills-jobdetail-tab">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Job detail</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Job Number</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-job_number">
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">INV NO.</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-inv">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Consignee</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-consignee">
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">M B/L</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-mbl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">ETD</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="date" class="form-control form-control-sm inp-eth-job">
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">H B/L</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-hbl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">ETA</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="date" class="form-control form-control-sm inp-eta-job">
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">Carrier</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-carrier">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">POL</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-pol">
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">POD</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm  inp-pod ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center "> Mother Vessel</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-mother-vessel-job">
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center "> Voy No.</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-vessel-mother-job-voy">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center "> Feeder vessel</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-feeder-vessel-job">
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center "> Voy No.</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-vessel-job-voy">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="float: right">
                                        <button class="btn btn-success rounded-pill " onclick="reportcs.job_detail_container_sv()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Document Date</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Pick up D/O</label>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-pick_do">
                                                </div>
                                                <div class="col-lg-2 col-md-2">
                                                    <button class="btn btn-success rounded-pill btn-sm " onclick="reportcs.push_action_pickdo()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save date </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">Check doc.</label>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-check_doc">
                                                </div>
                                                <div class="col-lg-2 col-md-2">
                                                    <button class="btn btn-success rounded-pill btn-sm " onclick="reportcs.push_action_checkdoc()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save date </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">Enter</label>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-enter">
                                                </div>
                                                <div class="col-lg-2 col-md-2">
                                                    <button class="btn btn-success rounded-pill btn-sm " onclick="reportcs.push_action_enter()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save date </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Clearlance Date</label>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="date" class="form-control form-control-sm inp-clearance_date_for_customs">
                                                </div>
                                                <div class="col-lg-2 col-md-2">
                                                    <button class="btn btn-success rounded-pill btn-sm " onclick="reportcs.push_action_plan_clear()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save date </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Clearlance Date Finish</label>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-clearance_date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Delivery</label>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-delivery">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Document</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover" name="tbl_job_status" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Document</th>
                                            <th>Picture file</th>
                                            <th>Received By.</th>
                                            <th>Received Datetime</th>
                                            <th>Check Document By</th>
                                            <th>Check Document Datetime</th>
                                            <th>Action</th>
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
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
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

                </div>
                <div class="tab-pane fade" id="pills-container" role="tabpanel" aria-labelledby="pills-container-tab">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Container</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover" name="container-tbl" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th scope="col">No.</th>
                                            <th scope="col">Container type</th>
                                            <th scope="col">Container Number</th>
                                            <th scope="col">Seal Number</th>
                                            <th scope="col">Gross Weight</th>
                                            <th scope="col">CBM</th>
                                            <th scope="col">SOC</th>
                                            <th scope="col">OW</th>
                                            <th class="col">CY</th>
                                            <th class="col">RTN</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                        <tr>
                                            <td>1</td>
                                            <td>Dry Cargo Container (40HC)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div style="float: right">
                                <button class="btn btn-primary rounded-pill" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="reportcs.push_action_save_container();"><i class="bi bi-check-square"></i> Save </button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Demurrage Charge</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="Demurrage-part-add">
                                <div class="Demurrage-part-del">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2">Container number:</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="db-sel-dem">
                                                        <select class="form-select form-select-sm sel-dem-container" onchange="reportcs.container_dem_change(this)">
                                                            <option value="">pleses select route</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2">CY :</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <input type="input" class="form-control form-control-sm inp-dem-cy" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-lg-1" style="text-align:center;">OLD RTN :</label>
                                                <div class="col-lg-4">
                                                    <input type="date" class="form-control form-control-sm inp-dem-rtn" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2">Demurrage To :</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <input type="date" class="form-control form-control-sm ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2">Document :</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <input type="file" class="form-control form-control-sm ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="float: right">
                                <button class="btn btn-primary rounded-pill " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="reportcs.push_action_save_dem();"><i class="bi bi-check-square"></i> Save </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-soft-secondary" onclick="reportcs.adddemhtml();">Add Demurrage Charge</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-driver" role="tabpanel" aria-labelledby="pills-driver-tab">
                    <div class="card-transport">
                        <div class="card ">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Booking Transport Detail</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-2 col-lg-2  align-self-center ">Supplier:</label>
                                    <div class="col-sm-3 col-md-5">
                                        <div class="db-sel-sup">
                                            <select class="form-select form-select-sm mb-3 shadow-none sel-supplier">
                                                <option value="">plese select supplier</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center ">Pickup Empty Container Address:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-pick_emp">
                                            </div>
                                            <label class="control-label col-sm-2 align-self-center ">Remark :</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-pick_emp_remark">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center ">Pickup Container Address:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control inp-pick_con">
                                            </div>
                                            <label class="control-label col-sm-2 align-self-center ">Remark :</label>
                                            <div class="col">
                                                <input type="text" class="form-control inp-pick_con_remark">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center ">Drop off Container Address:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control inp-drop_con">
                                            </div>
                                            <label class="control-label col-sm-2 align-self-center ">Remark :</label>
                                            <div class="col">
                                                <input type="text" class="form-control inp-drop_con_reamrk">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center ">Drop off Empty Containe Address:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control inp-drop_emp">
                                            </div>
                                            <label class="control-label col-sm-2 align-self-center ">Remark :</label>
                                            <div class="col">
                                                <input type="text" class="form-control inp-drop_emp_remark">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center mb-3">Budget:</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-2">
                                                <input type="input" style="text-align:right;" class="form-control form-control-sm inp-budget">
                                            </div>
                                            <div class="col-lg-3 col-md-2">
                                                <select class="form-select form-select-sm sel-cur">
                                                    <option value=""></option>
                                                    <option value="THB">THB</option>
                                                    <option value="USD">USD</option>
                                                    <option value="RMB">RMB</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Type Truck:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <select class="form-select form-select-sm inp-type_truck">
                                                </select>
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Remark</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-remark_truck">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Truck Quantity:</label>
                                    <div class="col-sm-3 col-lg-1">
                                        <input type="text" class="form-control form-control-sm inp-truck_quantity" style="text-align:right;">
                                    </div>
                                </div>
                                <hr class="mb-4">
                                <h4 class="mb-4">Driver detail</h4>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Driver 1:</label>
                                    <div class="col-sm-3 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-supplier_firm" readonly>
                                    </div>
                                </div>
                                <hr class="mb-4">
                                <h4 class="mb-4">Supplier confirm</h4>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Supplier Confirm DateTime :</label>
                                    <div class="col-sm-3 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-supplier_firm" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-booking" role="tabpanel" aria-labelledby="pills-booking-tab">
                    <div class="row">
                        <div class="col-md-7 col-xl-7">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Detail</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Job number</label>
                                        <div class="col-sm-9 col-md-4 col-lg-4">
                                            <input type="input" class="form-control form-control-sm inp-jobno">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Booking number</label>
                                        <div class="col-sm-9 col-md-4 col-lg-4">
                                            <input type="input" class="form-control form-control-sm inp-bkno">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center">Shipper</label>
                                        <div class="col-sm-9 col-md-4 col-lg-4">
                                            <select class="form-select form-select-sm inp-shper">
                                                <option value="">pleses select shipper</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center">Shipment Terms</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-shptrm">
                                                <option selected="">Please select shipment term</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Remark</label>
                                        <div class="col-sm-9 col-md-8 col-lg-7">
                                            <input type="input" class="form-control form-control-sm inp-rmk">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Carrier:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-carrier-sel">
                                                <option selected="">Please select carrier</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Port of Receipt</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-prtrecieve">
                                                <option selected="">Please select Port of Receipt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Port of Loading</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-prtload">
                                                <option selected="">Please select Port of Loading</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">T/S Port</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-ts_port">
                                                <option selected="">Please select T/S Port</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Port of Delivery</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-delivery-sel-booking">
                                                <option selected="">Please select Port of Delivery</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Mother Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-M_vessel">
                                                </div>
                                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center ">Voy No.:</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-mother-voy-no">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Feeder Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-feeder_vessel">
                                                </div>
                                                <label class="control-label col-sm-1 col-md-2 col-lg-2  align-self-center ">Voy No.:</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-feeder_voy_no">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">ETD:</label>
                                        <div class="col-sm-9 col-md-4 col-lg-4">
                                            <input type="date" class="form-control form-control-sm inp-etd">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">ETA:</label>
                                        <div class="col-sm-9 col-md-4 col-lg-4">
                                            <input type="date" class="form-control form-control-sm inp-eta">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-xl-5">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Container Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Cargo description</label>
                                            <div class="col-sm-9 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-cargodes">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">H.S.Code:</label>
                                            <div class="col-sm-9 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-hscode">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Cargo Type:</label>
                                            <div class="col-sm-9 col-md-7 col-lg-7">
                                                <select class="form-select form-select-sm inp-cargo_type">
                                                    <option selected="">Please select cargo type</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Quantity:</label>
                                            <div class="col-sm-9 col-md-7 col-lg-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm inp-cargo_qty">
                                                    <span class="input-group-text">Package</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">G.W:</label>
                                            <div class="col-sm-9 col-md-7 col-lg-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control inp-cargo_gw">
                                                    <span class="input-group-text">KGS</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Volume:</label>
                                            <div class="col-sm-9 col-md-7 col-lg-7">
                                                <div class="input-group">
                                                    <input type="text" class="form-control inp-cargo_vol">
                                                    <span class="input-group-text">M3</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-3 align-self-center ">Marks:</label>
                                            <div class="col-sm-9 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-cargo_marks">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<script src="js/reportcs/reportcs.js"></script>
<script src="js/reportcs/set_default_data.js"></script>
<script src="js/reportcs/reportcs_sub_container_dem.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        reportcs.check_get();

    });
</script>