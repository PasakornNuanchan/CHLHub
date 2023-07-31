<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
    <?php include '../assets/include/theme_include_css.php'; ?>

</head>

<body>
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
                    <h5>Job Number : </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Job detail</h5>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Job number :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Booking number :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Consignee :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Shipper :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Shipment Terms :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Remark :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Carrier :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Port of Receipt :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Port of Loading:</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>T/S Port :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Port of Delivery:</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Mother Vessel :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Feeder Vessel:</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>ETD:</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>ETA:</label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-xl-6">
                                    <h5>Billing</h5>
                                </div>
                                <div class="col-lg-6 col-xl-6">
                                    
                                    <div style="float:right;" class="mb-3 form-check form-switch">
                                        <label>AR</label>
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                        <label>AP</label>    
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>No.</th>
                                        <th>Description</th>
                                        <th>Pay to</th>
                                        <th>AMT(INCL.VAT)</th>
                                        <th>Currency</th>
                                        <th>Paid</th>
                                        <th>create by</th>
                                        <th>paid by</th>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Document</h5>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Inv No : <i class="bi bi-files"></i></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>M BL : <i class="bi bi-files"></i></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>H BL : <i class="bi bi-files"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Customs status</h5>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Pick up D/O :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Check Doc :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Enter :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Clearance Date :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Clearance By :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Ship Arrived :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Conatiner dropoff :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Customs Clearance :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Container upload :</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Container arrived :</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Document picture files</h5>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Invoice : <i class="bi bi-files"></i></label>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>BL : <i class="bi bi-files"></i></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>Packinglist : <i class="bi bi-files"></i></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>import decaletion : <i class="bi bi-files"></i></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label>import lincene : <i class="bi bi-files"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MAIN BODY END -->

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