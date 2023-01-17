<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
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
        <div class="iq-navbar-header" style="height: 100px;">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bcpage">
                            <li class="breadcrumb-item"><a href="" style="color:white;">Petty Cash List (Return)</a></li>
                            <li class="breadcrumb-item active page-item" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="pills-boooking-tab" data-bs-toggle="pill" data-bs-target="#pills-transport" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Booking Transport</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-pettycash-tab" data-bs-toggle="pill" data-bs-target="#pills-pettycash" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="false">Petty Cash & Advance</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-customs" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Customs & Document</button>
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
                            <div class="card-transport">
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
                                            <label class="control-label col-sm-3 col-lg-2 align-self-center mb-3">Budget:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <input type="input" style="text-align:right;" class="form-control form-control-sm inp-budget">
                                                    </div>
                                                    <div class="col-lg-1">
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
                                        <hr class="mb-4">
                                        <h4 class="mb-4">Supplier confirm</h4>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-2 align-self-center ">Sent Request Line DateTime :</label>
                                            <div class="col-sm-3 col-lg-3">
                                                <input type="input" class="form-control form-control-sm inp-sent_request_line" readonly>
                                            </div>
                                        </div>
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
                <div class="tab-pane fade" id="pills-pettycash" role="tabpanel" aria-labelledby="pills-pettycash-tab">
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
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <option selected>Please select type</option>
                                                <option value="">Petty Cash</option>
                                                <option value="">Advance Cash</option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-3 align-self-center ">description :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <option selected>Please select shipper</option>
                                                <option value="">Cargo rent</option>
                                                <option value="">OT Customs Department Officer </option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-3 align-self-center ">Pay to :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <option selected>Please select shipper</option>
                                                <option value="">Cargo rent</option>
                                                <option value="">OT Customs Department Officer </option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-3 align-self-center ">Picture :</label>
                                        <div class="col-sm-9">
                                            <div class="mb-3">
                                                <input type="file" class="form-control form-select-sm" id="customFile">
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-3 align-self-center ">Amount :</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-3">
                                                    <select class="form-select form-select-sm mb-3 shadow-none">
                                                        <option value="" selected>THB</option>
                                                        <option value="">AMB</option>
                                                        <option value="">USD</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-3 align-self-center ">Petty Cash Balance :</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <div class="col-3">
                                                    <select class="form-select form-select-sm mb-3 shadow-none">
                                                        <option value="" selected>THB</option>
                                                        <option value="">AMB</option>
                                                        <option value="">USD</option>
                                                    </select>
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
                                    <div style="float: right">
                                        <button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Clearance success</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-booking" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Detail</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Job number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Booking number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Shipper:</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">

                                                <?php
                                                $shipper_select = "SELECT * FROM carrier";

                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Shipment Terms</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $shipment_select = "SELECT * FROM shipment_term";

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Remark</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Carrier:</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $carrier_select = "SELECT * FROM carrier";

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Port of Receipt</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Port of Loading</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">T/S Port</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Port of Delivery</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3  align-self-center ">Mother Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center ">Voy No. :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Feeder Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center ">Voy No. :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">Voy No.:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">ETD:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" value="2019-12-18">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center ">ETA:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" value="2019-12-18">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Container</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group row">
                                            <div class="table-responsive mt-4">
                                                <table id="basic-table" class="table table-striped " role="grid">
                                                    <thead>
                                                        <tr align="center">
                                                            <th>Container type</th>
                                                            <th>Container Quantity</th>
                                                            <th>Single CNT Weight</th>
                                                            <th>SOC</th>
                                                            <th>OW</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr align="center">
                                                            <td><select class="form-select form-select-sm shadow-none">
                                                                    <?php
                                                                    $Container_type_select = "SELECT * FROM container_type";

                                                                    ?>
                                                                </select></td>
                                                            <td><input type="input" class="form-control form-control-sm"></td>
                                                            <td><input type="input" class="form-control form-control-sm"></td>
                                                            <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                                                            <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                                                            <td>
                                                                <button type="button" class="btn btn-warning rounded-pill btn-xs"><i class="bi bi-trash"></i> Edit</button>
                                                                <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-pencil-fill"></i> Delete</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <button type="submit" class="btn btn-link btn-soft-light rounded-pill">add new</button>

                                            <p></p>
                                            <label class="control-label col-sm-3 align-self-center ">CY:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" value="2019-12-18">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">RTN:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" value="2019-12-18">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Container Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Cargo description</label>
                                            <div class="col-sm-9">
                                                <input type="input" class="form-control form-control-sm">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">H.S.Code:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">
                                                    <?php
                                                    $hs_select = "SELECT * FROM hs_code";

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Cargo Type:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">

                                                    <?php
                                                    $cargo_type_select = "SELECT * FROM cargo_type";

                                                    ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Quantity:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">Package</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">G.W:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">KGS</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Volume:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">M3</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Marks:</label>
                                            <div class="col-sm-9">
                                                <input type="input" class="form-control form-control-sm">
                                            </div>

                                            <button class="btn btn-primary rounded-pill ">
                                                <span class="btn-inner">
                                                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                                Save
                                            </button>
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

<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<script src="js/customs/customs.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        customs.check_get();
    });
</script>