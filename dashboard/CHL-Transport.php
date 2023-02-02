<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transport</title>
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
        <!-- Nav Header Component End -->
        <!--Nav End-->
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Booking Transport</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Driver & Containert</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-booking-tab" data-bs-toggle="pill" data-bs-target="#pills-booking" type="button" role="tab" aria-controls="pills-booking" aria-selected="false">Booking</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="add-card-transport">
                            <div class="card-transport">
                                <div class="col-sm-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h4 class="card-title">Booking Transport Detail</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Supplier:</label>
                                                <div class="col-sm-9 col-md-5 col-lg-4">
                                                    <select class="form-select form-select-sm sel-supplier">
                                                        <option value="">plese select supplier</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Pickup Empty Container Address:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                        <label class="control-label col-sm-2 align-self-center ">Remark</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Pickup Container Address:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                        <label class="control-label col-sm-2 align-self-center ">Remark</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Drop off Container Address:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                        <label class="control-label col-sm-2 align-self-center ">Remark</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Drop off Empty Containe Address:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                        <label class="control-label col-sm-2 align-self-center ">Remark</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 col-lg-2 align-self-center mb-3">Type Truck:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <select class="form-select form-select-sm sel-type_truck">
                                                               <option value="">plese select type truck</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label class="control-label col-sm-2 align-self-center ">Remark</label>
                                                            <div class="col">
                                                                <input type="text" class="form-control form-control-sm inp-remark_truck">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Budget:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-1 col-md-3 col-lg-2">
                                                            <input type="number" class="form-control form-control-sm" style="text-align:right;">
                                                        </div>
                                                        <div class="col-sm-1 col-md-3 col-lg-2">
                                                            <select class="form-select form-select-sm shadow-none sel-cur">
                                                                <option value=""></option>
                                                                <option value="THB">THB</option>
                                                                <option value="RMB">RMB</option>
                                                                <option value="USD">USD</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Container:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-1 col-md-3 col-lg-3">
                                                            <select name="" class="form-select form-select-sm"></select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="float: right">
                                                <button class="btn btn-primary rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save </button>
                                                <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-line"></i> Sent to line group</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <div class="header-title">
                                                <h4 class="card-title">Confirm status</h4>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Sent Request Line :</label>
                                                <div class="col-sm-9 col-md-5 col-lg-4">
                                                    <input type="input" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Supplier Confirm :</label>
                                                <div class="col-sm-9 col-md-5 col-lg-4">
                                                    <input type="input" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Container</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class=" table-responsive">
                                        <table class="table table-borderless " name="container-tbl" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                            <thead>
                                                <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                    <th>No.</th>
                                                    <th>Container type</th>
                                                    <th>Container Number</th>
                                                    <th>Seal Number</th>
                                                    <th>Gross Weight</th>
                                                    <th>CBM</th>
                                                    <th>SOC</th>
                                                    <th>OW</th>
                                                    <th>CY</th>
                                                    <th>RTN</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align:center;">
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
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="float: right">
                                        <button class="btn btn-primary rounded-pill " onclick="transport.save_container()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card ">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Driver</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="driver-part-add">
                                        <div class="driver-part-del">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 col-lg-2 align-self-center ">Route number:</label>
                                                <div class="col-lg-4">
                                                    <select class="form-select form-select-sm sel-route-driver">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Driver name:</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" class="form-control" readonly>
                                                        </div>
                                                        <label class="control-label col-sm-2 align-self-center ">Phone Number :</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Container number:</label>
                                                <div class="col-sm-9">
                                                    <input type="input" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center ">Seal number:</label>
                                                <div class="col-sm-9">
                                                    <input type="input" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <div style="float: right">
                                                <button class="btn btn-primary rounded-pill " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-soft-secondary" onclick="transport.adddriverhtml();">Add Drop off</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade " id="pills-booking" role="tabpanel" aria-labelledby="pills-booking-tab">
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
                                                <select class="form-select form-select-sm inp-hscode">
                                                    <option selected="">Please select H.S Code</option>
                                                </select>
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

<script src="js/transport/transport.js"></script>
<script src="js/transport//set_default_data.js"></script>
<script>
    $(document).ready(function() {
        transport.check_get();
        transport_set_default.set_data_default();
    });
</script>