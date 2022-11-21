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
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <!-- MAIN BODY START -->


            <div>
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
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Job Number</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">INV NO.</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Consignee</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">M B/L</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">ETD</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">H B/L</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">ETA</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Carrier</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">POL</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Vessel</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">POD</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">PORT</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
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
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Clearlance Date</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Check doc.</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Delivery</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Enter</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Pick up D/O</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">INV NO.</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
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
                                    <table class="table table-borderless" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                        <thead>
                                            <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
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
                                                    <center>Check By Customs Clerance</center>
                                                </th>
                                                <th scope="col">
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center;">
                                            <tr>
                                                <td>Invoice</td>
                                                <td>
                                                    <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                </td>
                                                <td>Natdanai Keephimai</td>
                                                <td>Apichat philalee</td>
                                                <td><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Confirm</button></td>
                                            </tr>
                                            <tr>
                                                <td>Bill of lading</td>
                                                <td>
                                                    <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                </td>
                                                <td>Natdanai Keephimai</td>
                                                <td>Apichat philalee</td>
                                                <td><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Confirm</button></td>
                                            </tr>
                                            <tr>
                                                <td>Packing list</td>
                                                <td>
                                                    <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                </td>
                                                <td>Natdanai Keephimai</td>
                                                <td>Apichat philalee</td>
                                                <td><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Confirm</button></td>
                                            </tr>
                                            <tr>
                                                <td>Import Declaration</td>
                                                <td>
                                                    <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                </td>
                                                <td>Natdanai Keephimai</td>
                                                <td>Apichat philalee</td>
                                                <td><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Confirm</button></td>
                                            </tr>
                                            <tr>
                                                <td>Import Licence</td>
                                                <td>
                                                    <div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div>
                                                </td>
                                                <td>Natdanai Keephimai</td>
                                                <td>Apichat philalee</td>
                                                <td><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Confirm</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Container</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="bd-example table-responsive">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align:center;">
                                            <tr>
                                                <td>1</td>
                                                <td>Dry Cargo Container (40HC)</td>
                                                <td><input type="text" class="form-control" placeholder="FSSU7291592"></td>
                                                <td><input type="text" class="form-control" placeholder="0062067"></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save</button></td>
                                            </tr>
                                            <tr>
                                            <td>2</td>
                                                <td>Dry Cargo Container (40HC)</td>
                                                <td><input type="text" class="form-control" placeholder="FSSU7291592"></td>
                                                <td><input type="text" class="form-control" placeholder="0062067"></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save</button></td>
                                            </tr>
                                            <tr>
                                            <td>3</td>
                                                <td>Dry Cargo Container (40HC)</td>
                                                <td><input type="text" class="form-control" placeholder="FSSU7291592"></td>
                                                <td><input type="text" class="form-control" placeholder="0062067"></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><input type="text" class="form-control" placeholder=""></td>
                                                <td><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
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