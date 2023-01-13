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
            <div class="iq-navbar-header" style="height: 100px;">
                <div class="conatiner-fluid content-inner mt-n5 py-0">
                    <button class="btn btn-outline-dark rounded-pill btn-sm" onclick="openCity(event, 'Booking_transport')" id="defaultOpen">Booking Transport</button>
                    <button class="btn btn-outline-dark rounded-pill btn-sm" onclick="openCity(event, 'driver')">Driver & Container</button>
                    <!-- <button class="btn btn-outline-dark rounded-pill btn-sm" onclick="openCity(event, 'tracking')">Tracking</button> -->
                    <button class="btn btn-outline-dark rounded-pill btn-sm" onclick="openCity(event, 'booking')" >Booking</button>
                </div>
            </div>
        </div> <!-- Nav Header Component End -->
        <!--Nav End-->

        <div id="Booking_transport" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Transport Detail</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" >Supplier:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0">Pickup Empty Container Address:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0" >Remark</label>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Pickup Container Address:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" >
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0"  >Remark</label>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Drop off Container Address:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" >
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0"  >Remark</label>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Drop off Empty Containe Address:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" >
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0"  >Remark</label>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Budget:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-1 col-md-3 col-lg-3">
                                                    <input type="number" class="form-control form-control-sm" style="text-align:right;"  >
                                                </div>
                                                <div class="col-sm-1 col-md-3 col-lg-2">
                                                    <select class="form-select form-select-sm shadow-none">
                                                        <option value="" selected>THB</option>
                                                        <option value="">AMB</option>
                                                        <option value="">USD</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Container:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-1 col-md-3 col-lg-3">
                                                    <select name="" id="" class="form-select form-select-sm"></select>
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
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Sent Request Line :</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <input type="input" class="form-control form-control-sm"   readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Supplier Confirm :</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <input type="input" class="form-control form-control-sm"   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary rounded-pill">Add Drop off</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="driver" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
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
                                        <table class="table table-borderless" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                            <thead>
                                                <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                    <th>No.</th>
                                                    <th>Container type</th>
                                                    <th>Container Number</th>
                                                    <th>Seal Number</th>
                                                    <th>PCS.</th>
                                                    <th>Package</th>
                                                    <th>Gross Weight</th>
                                                    <th>CBM</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody style="text-align:center;">
                                                <tr>
                                                    <td>1</td>
                                                    <td>Dry Cargo Container (40HC)</td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Dry Cargo Container (40HC)</td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Dry Cargo Container (40HC)</td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    <td><input type="text" class="form-control" ></td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Driver</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Driver name:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control"  readonly>
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0"  >Phone Number :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control"  readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Container number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm"   readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0"  >Seal number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm"   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div id="tracking" class="tabcontent">
            <h3>Tokyo</h3>
            <p>Tokyo is the capital of Japan.</p>
        </div> -->

        <div id="booking" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div class="">
                    <div class="row justify-content-center">
                        <div class="">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Booking Detail</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Job number</label>
                                        <div class="col-sm-9 col-md-4 col-lg-3">
                                            <input type="input" class="form-control form-control-sm inp-jobno" id=""  readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Booking number</label>
                                        <div class="col-sm-9 col-md-4 col-lg-3">
                                            <input type="input" class="form-control form-control-sm inp-bkno" id=""  readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="">Shipper</label>
                                        <div class="col-sm-9 col-md-4 col-lg-4">
                                            <select class="form-select form-select-sm inp-shper" disabled>
                                                <?php
                                                $shipper_select = "SELECT * FROM shipper";
                                                $result_shipper = mysqli_query($con, $shipper_select);
                                                ?>
                                                <option selected="">Please select shipper</option>
                                                <?php
                                                while ($result_shipper_total = mysqli_fetch_assoc($result_shipper)) {
                                                ?>
                                                    <option value="<?= $result_shipper_total['ID'] ?>"><?php echo $result_shipper_total['shipper_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center" for="">Shipment Terms</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-shptrm" disabled>
                                                <?php
                                                $shipment_select = "SELECT * FROM shipment_term";
                                                $result_shipment = mysqli_query($con, $shipment_select);
                                                ?>
                                                <option selected="">Please select shipment term</option>
                                                <?php
                                                while ($result_shipment_total = mysqli_fetch_assoc($result_shipment)) {
                                                ?>
                                                    <option value="<?= $result_shipment_total['ID'] ?>"><?php echo $result_shipment_total['st_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Remark</label>
                                        <div class="col-sm-9 col-md-8 col-lg-7">
                                            <input type="input" class="form-control form-control-sm inp-rmk" id=""  readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Carrier:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-carrier" disabled>
                                                <?php
                                                $carrier_select = "SELECT * FROM carrier";
                                                $result_carrier = mysqli_query($con, $carrier_select);
                                                ?>
                                                <option selected="">Please select carrier</option>
                                                <?php
                                                while ($result_carrier_total = mysqli_fetch_assoc($result_carrier)) {
                                                ?>
                                                    <option value="<?= $result_carrier_total['ID'] ?>"><?php echo $result_carrier_total['carrier_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Port of Receipt</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-prtrecieve" disabled>
                                                <?php

                                                $area_select = "SELECT * FROM area";
                                                $result_area = mysqli_query($con, $area_select);
                                                ?>
                                                <option selected="">Please select Port of Receipt</option>
                                                <?php
                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                ?>
                                                    <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Port of Loading</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-prtload" disabled>
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                $result_area = mysqli_query($con, $area_select);
                                                ?>
                                                <option selected="">Please select Port of Loading</option>
                                                <?php
                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                ?>
                                                    <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">T/S Port</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-ts_port" disabled>
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                $result_area = mysqli_query($con, $area_select);
                                                ?>
                                                <option selected="">Please select T/S Port</option>
                                                <?php
                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                ?>
                                                    <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Port of Delivery</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <select class="form-select form-select-sm inp-delivery" disabled>
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                $result_area = mysqli_query($con, $area_select);
                                                ?>
                                                <option selected="">Please select Port of Delivery</option>
                                                <?php
                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                ?>
                                                    <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Mother Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-M_vessel"  readonly>
                                                </div>
                                                <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center mb-0" for="">Voy No.:</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-mother-voy-no"  readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Feeder Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm feeder_vessel"  readonly>
                                                </div>
                                                <label class="control-label col-sm-1 col-md-2 col-lg-2  align-self-center mb-0" for="">Voy No.:</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-feeder_voy_no"  readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">ETD:</label>
                                        <div class="col-sm-9 col-md-4 col-lg-3">
                                            <input type="date" class="form-control form-control-sm inp-etd" id="" value="2019-12-18" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">ETA:</label>
                                        <div class="col-sm-9 col-md-4 col-lg-3">
                                            <input type="date" class="form-control form-control-sm inp-eta" id="" value="2019-12-18" readonly>
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
                                            <div class="table-responsive">
                                                <table id="basic-table" name="container-tbl" class="table table-striped" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" role="grid">
                                                    <thead>
                                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                            <th>Container type</th>
                                                            <th>Container Quantity</th>
                                                            <th>Single CNT Weight</th>
                                                            <th>SOC</th>
                                                            <th>OW</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="booking_container">
                                                            <td class="td-sel-conttype"><select class="form-select form-select-sm shadow-none inp-container_type" disabled>
                                                                    <?php
                                                                    $Container_type_select = "SELECT * FROM container_type";
                                                                    $result_Container_type = mysqli_query($con, $Container_type_select);
                                                                    ?>
                                                                    <option selected="">Please select container type</option>
                                                                    <?php
                                                                    while ($result_Container_type_total = mysqli_fetch_assoc($result_Container_type)) {
                                                                    ?>
                                                                        <option value="<?= $result_Container_type_total['container_type_number'] ?>"><?php echo $result_Container_type_total['container_type_name'] ?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select></td>
                                                            <td><input type="input" class="form-control form-control-sm inp-contqty" id=""  readonly></td>
                                                            <td><input type="input" class="form-control form-control-sm inp-single-wieght" id=""  readonly></td>
                                                            <td><input class="form-check-input inp-soc" type="checkbox" value="" id="flexCheckDefault" disabled></td>
                                                            <td><input class="form-check-input inp-ow" type="checkbox" value="" id="flexCheckDefault" disabled></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <p></p>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">CY:</label>
                                            <div class="col-sm-9 col-md-4 col-lg-3 ">
                                                <input type="date" class="form-control form-control-sm inp-cy" id="" value="2019-12-18" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">RTN:</label>
                                            <div class="col-sm-9 col-md-4 col-lg-3 ">
                                                <input type="date" class="form-control form-control-sm inp-rtn" id="" value="2019-12-18" readonly>
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
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">Cargo description</label>
                                            <div class="col-sm-9 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-cargodes" id=""  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">H.S.Code:</label>
                                            <div class="col-sm-9 col-md-5 col-lg-6">
                                                <select class="form-select form-select-sm inp-hscode" disabled>
                                                    <?php
                                                    $hs_select = "SELECT * FROM hs_code";
                                                    $result_hs = mysqli_query($con, $hs_select);
                                                    ?>
                                                    <option selected="">Please select H.S Code</option>
                                                    <?php
                                                    while ($result_hs_total = mysqli_fetch_assoc($result_hs)) {
                                                    ?>
                                                        <option value="<?php $result_hs_total['ID'] ?>"><?php echo "" . $result_hs_total['hs_code'] . " " . $result_hs_total['hs_decription'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">Cargo Type:</label>
                                            <div class="col-sm-9 col-md-4 col-lg-4">
                                                <select class="form-select form-select-sm inp-cargo_type" disabled>
                                                    <?php
                                                    $cargo_type_select = "SELECT * FROM cargo_type";
                                                    $result_cargo_type = mysqli_query($con, $cargo_type_select);
                                                    ?>
                                                    <option selected="">Please select cargo type</option>
                                                    <?php
                                                    while ($result_cargo_type_total = mysqli_fetch_assoc($result_cargo_type)) {
                                                    ?>
                                                        <option value="<?php $result_cargo_type_total['cargo_type_number'] ?>"><?php echo $result_cargo_type_total['cargo_type_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">Quantity:</label>
                                            <div class="col-sm-9 col-md-5 col-lg-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-sm inp-cargo_qty" aria-describedby="basic-addon2" readonly>
                                                    <span class="input-group-text" id="basic-addon2">Package</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">G.W:</label>
                                            <div class="col-sm-9 col-md-5 col-lg-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control inp-cargo_gw" aria-describedby="basic-addon2" readonly>
                                                    <span class="input-group-text" id="basic-addon2">KGS</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">Volume:</label>
                                            <div class="col-sm-9 col-md-5 col-lg-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control inp-cargo_vol" aria-describedby="basic-addon2" readonly>
                                                    <span class="input-group-text" id="basic-addon2">M3</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="">Marks:</label>
                                            <div class="col-sm-9 col-md-8 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-cargo_marks" id=""  readonly>
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