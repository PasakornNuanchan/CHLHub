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
<style>
        body {
            font-family: Arial;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 0px solid #ccc;
            border-top: none;
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
            <div class="iq-navbar-header" style="height: 215px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    <h1>Customs Clearance</h1>
                                    <p></p>
                                    <div>
                                        <button class="btn btn-outline-dark rounded-pill btn-sm" onclick="openCity(event, 'Document')">Customs Clearance</button>
                                        <button class="btn btn-outline-dark rounded-pill btn-sm" onclick="openCity(event, 'pettycash_advance')" id="defaultOpen">Pettycash & Advance</button>
                                        <button class="btn btn-outline-dark rounded-pill btn-sm" onclick="openCity(event, 'transport')">Transport</button>
                                        <button class="btn btn-outline-dark rounded-pill btn-sm" onclick="openCity(event, 'booking')">Booking</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-header-img">
                    <img src="../../assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                    <img src="../../assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div> <!-- Nav Header Component End -->
            <!--Nav End-->
        </div>
        </div>
        <div id="transport" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
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
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Container Quantity:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Pallet :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Booking Transport Detail</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Supplier:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">
                                                    <?php
                                                    $transport_sup_select = "SELECT * FROM transport_sup";
                                                    
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Pickup Empty Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Pickup Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Drop off Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Drop off Empty Containe Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Budget:</label>
                                                <div class="col-sm-9">
                                                    <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary rounded-pill btn-sm ">
                                            <span class="btn-inner">
                                                <i class="bi bi-check-square"></i>
                                            </span>
                                            Save
                                        </button>
                                        <button class="btn btn-success rounded-pill btn-sm">
                                            <span class="btn-inner">
                                                <i class="bi bi-line"></i>
                                            </span>
                                            Sent to line group
                                        </button>
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
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Sent Request Line :</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Supplier Confirm :</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="pettycash_advance" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
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
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">No. :</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-select-sm mb-3 shadow-none" readonly>
                                        </div>
                                    
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Type :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <option selected>Please select shipper</option>
                                                <option value="">Petty Cash</option>
                                                <option value="">Advance Cash</option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Description :</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <option selected>Please select shipper</option>
                                                <option value="">Cargo rent</option>
                                                <option value="">OT Customs Department Officer </option>
                                            </select>
                                        </div>
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Picture :</label>
                                        <div class="col-sm-9">
                                            <div class="mb-3">
                                                <input type="file" class="form-control form-select-sm" id="customFile">
                                            </div>
                                        </div>
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Amount :</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="text" class="form-control form-control-sm" placeholder="">
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
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        <center>No.</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>Type</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>Description</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>picture</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>amount</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>create by.</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>action</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <center>1</center>
                                                    </td>
                                                    <td>
                                                        <center>Advance Cash</center>
                                                    </td>
                                                    <td>
                                                        <center>Rent cargo</center>
                                                    </td>
                                                    <td>
                                                        <center></center>
                                                    </td>
                                                    <td>
                                                        <center>32,000.00</center>
                                                    </td>
                                                    <td>
                                                        <center>Apichat Pilalee</center>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <button type="button" class="btn btn-warning rounded-pill btn-xs"><i class="bi bi-trash"></i> Edit</button>
                                                            <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-pencil-fill"></i> Delete</button>
                                                        </center>
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
            </div>
        </div>
        <div id="Document" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
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
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">
                                                        <center>Document</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>Picture file</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>Received By.</center>
                                                    </th>
                                                    <th scope="col">
                                                        <center>Action</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Invoice : </td>
                                                    <td>
                                                        <center>
                                                            <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                        </center>
                                                    </td>

                                                    <td>
                                                        <center>sintanarak yatsamer</center>
                                                    </td>
                                                    <td>
                                                        <center><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Bill of lading</td>
                                                    <td>
                                                        <center>
                                                            <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                        </center>
                                                    </td>

                                                    <td>
                                                        <center>sintanarak yatsamer</center>
                                                    </td>
                                                    <td>
                                                        <center><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Packing list</td>
                                                    <td>
                                                        <center>
                                                            <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                        </center>
                                                    </td>

                                                    <td>
                                                        <center>sintanarak yatsamer</center>
                                                    </td>
                                                    <td>
                                                        <center><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Import Declaration</td>
                                                    <td>
                                                        <center>
                                                            <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                        </center>
                                                    </td>

                                                    <td>
                                                        <center>sintanarak yatsamer</center>
                                                    </td>
                                                    <td>
                                                        <center><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Import Licence</td>
                                                    <td>
                                                        <center>
                                                            <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                        </center>
                                                    </td>

                                                    <td>
                                                        <center>sintanarak yatsamer</center>
                                                    </td>
                                                    <td>
                                                        <center><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Confirm</button></center>
                                                    </td>
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
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Clearance Date Plan :</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="bd-example table-responsive">
                                            <table class="table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">
                                                            <center>Description</center>
                                                        </th>
                                                        <th scope="col">
                                                            <center>Datetime Success</center>
                                                        </th>
                                                        <th scope="col">
                                                            <center>Clearance By.</center>
                                                        </th>
                                                        <th scope="col">
                                                            <center>Operation Success</center>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <center>Customs Clearlance</center>
                                                        </td>
                                                        <td>
                                                            <center>18/10/2022 16:00:00</center>
                                                        </td>
                                                        <td>
                                                            <center>Apichat Pilalee</center>
                                                        </td>
                                                        <td>
                                                            <center><button type="button" class="btn btn-success rounded-pill btn-sm"><i class="bi bi-check-square"></i> Success</button></center>
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
                </div>
            </div>
        </div>
        <div id="booking" class="tabcontent">
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                <div>
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
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Job number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Booking number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Shipper:</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">

                                                <?php
                                                $shipper_select = "SELECT * FROM carrier";
                                               
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Shipment Terms</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $shipment_select = "SELECT * FROM shipment_term";
                                                
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Remark</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Carrier:</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $carrier_select = "SELECT * FROM carrier";
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Receipt</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Loading</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">T/S Port</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Delivery</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3  align-self-center mb-0" for="pwd2">Mother Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Voy No. :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Feeder Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Voy No. :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Voy No.:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">ETD:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">ETA:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
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
                                                <table id="basic-table" class="table table-striped mb-0" role="grid">
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
                                                            <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
                                                            <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
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
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">CY:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">RTN:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
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
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Cargo description</label>
                                            <div class="col-sm-9">
                                                <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">H.S.Code:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">
                                                    <?php
                                                    $hs_select = "SELECT * FROM hs_code";
                                                    
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Cargo Type:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">

                                                    <?php
                                                    $cargo_type_select = "SELECT * FROM cargo_type";
                                                    
                                                    ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Quantity:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">Package</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">G.W:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">KGS</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Volume:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">M3</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Marks:</label>
                                            <div class="col-sm-9">
                                                <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
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