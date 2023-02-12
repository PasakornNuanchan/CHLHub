<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customs Clearance</title>
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
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="pills-boooking-tab" data-bs-toggle="pill" data-bs-target="#pills-transport" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Booking Transport</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-pettycash-tab" data-bs-toggle="pill" data-bs-target="#pills-pettycash" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="false">Petty Cash & Advance</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded " id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-customs" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Customs & Document</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-booking" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Booking</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-transport" role="tabpanel" aria-labelledby="pills-booking-tab">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Transport</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Container Quantity:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center ">Pallet :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-transport-add">
                                <div class="card-transport-del">
                                    <div class="card ">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h4 class="card-title">Booking Transport Detail</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 col-lg-2  align-self-center ">Supplier:</label>
                                                <div class="col-sm-3">
                                                    <div class="db-sel-sup">
                                                        <select class="form-select form-select-sm  shadow-none sel-supplier">
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
                                            <hr class="mb-4">
                                            <h4 class="mb-4">Driver detail</h4>
                                            <div class="add_driver">
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Driver 1:</label>
                                                    <div class="col-sm-3 col-lg-3">
                                                        <input type="input" class="form-control form-control-sm inp-supplier_firm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="mb-4">
                                            <h4 class="mb-4">Supplier confirm</h4>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 col-lg-2 align-self-center ">Supplier Confirm DateTime :</label>
                                                <div class="col-sm-3 col-lg-3">
                                                    <input type="input" class="form-control form-control-sm inp-supplier_firm" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="pills-pettycash" role="tabpanel" aria-labelledby="pills-pettycash-tab">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Petty Cash & Advance Cash</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Type :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm  shadow-none " onchange="customs_set_sub_cash.type_change_cash(this);">
                                                <option selected>Please select type</option>
                                                <option value="1">Petty Cash</option>
                                                <option value="2">Advance Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">description :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm  shadow-none sel-des-cash">
                                                <option selected>Please select shipper</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Pay to :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm  shadow-none">
                                                <option selected>Please select shipper</option>
                                                <option value="">Cargo rent</option>
                                                <option value="">OT Customs Department Officer </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Picture :</label>
                                        <div class="col-sm-9">
                                                <input type="file" class="form-control form-select-sm" id="customFile">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Amount :</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-3">
                                                    <select class="form-select form-select-sm  shadow-none">
                                                        <option value="THB" selected>THB</option>
                                                        <option value="RMB">RMB</option>
                                                        <option value="USD">USD</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="add_pcn">
                                        <div class="del_pcn">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Petty Cash number :</label>
                                                <div class="col-sm-3 col-lg-3">
                                                    <select class="form-select form-select-sm  shadow-none">
                                                        <option selected>Please select shipper</option>
                                                        <option value="">Cargo rent</option>
                                                        <option value="">OT Customs Department Officer </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Petty Cash Balance :</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control form-control-sm inp-cash-balance">
                                                </div>
                                                <div class="col-lg-2">
                                                    <select class="form-select form-select-sm  shadow-none sel-cur-balance">
                                                        <option value="THB" selected>THB</option>
                                                        <option value="RMB">RMB</option>
                                                        <option value="USD">USD</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2">
                                                   <input type="text" class="form-control form-control-sm inp-req-cash" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="float: right">
                                        <button class="btn btn-success rounded-pill btn-sm "><i class="bi bi-check-square"></i> Save</button>
                                        <button class="btn btn-warning rounded-pill btn-sm"><i class="bi bi-arrow-clockwise"></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="bd-example table-responsive">
                                        <table class="table table-borderless" name="cash_payment_table">
                                            <thead>
                                                <tr align="center">
                                                    <th>No.</th>
                                                    <th>Type</th>
                                                    <th>Description</th>
                                                    <th>Pay to</th>
                                                    <th>picture</th>
                                                    <th>amount</th>
                                                    <th>create by.</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Advance Cash</td>
                                                    <td>Rent cargo</td>
                                                    <td></td>
                                                    <td>32,000.00</td>
                                                    <td>Apichat Pilalee</td>
                                                    <td></td>
                                                    <td>

                                                        <button type="button" class="btn btn-warning rounded-pill btn-xs"><i class="bi bi-trash"></i> Edit</button>
                                                        <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-pencil-fill"></i> Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-customs" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Document Check</h4>
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
                                                    <td>Invoice : </td>
                                                    <td align="center">
                                                        <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                    </td>
                                                    <td align="center">sintanarak yatsamer</td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Bill of lading</td>
                                                    <td align="center">
                                                        <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                    </td>
                                                    <td align="center">sintanarak yatsamer</td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Packing list</td>
                                                    <td align="center">
                                                        <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                    </td>
                                                    <td align="center">sintanarak yatsamer</td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Import Declaration</td>
                                                    <td align="center">
                                                        <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                    </td>
                                                    <td align="center">sintanarak yatsamer</td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Import Licence</td>
                                                    <td align="center">
                                                        <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                    </td>
                                                    <td align="center">sintanarak yatsamer</td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"></td>
                                                    <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Customs Clearance</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Clearance Date Plan :</label>
                                        <div class="col-sm-9 col-lg-3">
                                            <input type="input" class="form-control form-control-sm " readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Clearance by.</label>
                                        <div class="col-sm-9 col-lg-3">
                                            <input type="input" class="form-control form-control-sm inp-clearance_by" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-2 align-self-center ">Datetime Success :</label>
                                        <div class="col-sm-9 col-lg-3">
                                            <input type="input" class="form-control form-control-sm inp-datetime_success" readonly>
                                        </div>
                                    </div>
                                    <div class="add_btn_clearance">
                                        <div style="float: right">
                                            <button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs.push_action_clearance()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Clearance success</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-booking" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                            <select class="form-select form-select-sm inp-carrier">
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
                                            <select class="form-select form-select-sm inp-delivery">
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
        </div>
    </main>
    <!-- Footer Section Start -->
    <?php include 'include/footermain.php'; ?>
    <!-- Footer Section End -->
    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <?php include 'include/offcanvas.php'; ?>
    <?php include '../assets/include/theme_include_js.php'; ?>
</body>

</html>

<script src="js/customs/customs.js"></script>
<script src="js/customs/customs_set_data_default.js"></script>
<script src="js/customs/customs_set_sub_booking.js"></script>
<script src="js/customs/customs_set_sub_customs.js"></script>
<script src="js/customs/customs_set_sub_transport.js"></script>
<script src="js/customs/customs_set_sub_cash.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        customs.check_get();
    });
</script>