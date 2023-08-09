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
                                    <label class="fw-bolder">Job number : </label> <label class="inp_job_number"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)" fntype="inp_job_number"id="copyButton" ></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Booking number : </label> <label class="inp_booking_number"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_booking_number"id="copyButton"></i>
                                    </div>
                                </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Consignee : </label> <label class="inp_consignee"></label> <i class="bi bi-files"  onclick="preview_management.get_to_copy(this)" fntype="inp_consignee"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Shipper : </label> <label class="inp_shipper"></label> <i class="bi bi-files"  onclick="preview_management.get_to_copy(this)" fntype="inp_shipper"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Shipment Terms : </label> <label class="inp_shipment"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)" fntype="inp_shipment"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Remark : </label> <label class="inp_remark"></label> <i class="bi bi-files"  onclick="preview_management.get_to_copy(this)" fntype="inp_remark"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Carrier : </label> <label class="inp_carrier"></label> <i class="bi bi-files"  onclick="preview_management.get_to_copy(this)" fntype="inp_carrier"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Port of Receipt : </label> <label class="inp_por"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_por"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Port of Loading : </label> <label class="inp_pol"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_pol"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">T/S Port : </label> <label class="inp_ts"></label> <i class="bi bi-files"  onclick="preview_management.get_to_copy(this)" fntype="inp_ts"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Port of Delivery : </label> <label class="inp_pod"></label> <i class="bi bi-files"  onclick="preview_management.get_to_copy(this)" fntype="inp_pod"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Mother Vessel : </label> <label class="inp_mother"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_mother"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">Feeder Vessel : </label> <label class="inp_feeder"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_feeder"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">ETD : </label> <label class="inp_etd"></label> <i class="bi bi-files"  onclick="preview_management.get_to_copy(this)"  fntype="inp_eta"id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label class="fw-bolder">ETA : </label> <label class="inp_eta"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_eta" id="copyButton"></i>
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
                                    <h5>Account receivable</h5>
                                </div>
                            </div>
                            <div class="table-responsive mt-4">
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

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-xl-6">
                                    <h5>Account payable</h5>
                                </div>
                            </div>
                            <div class="table-responsive mt-4">
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
                                    <label class="fw-bolder">Inv No : </label> <label class="inp_inv"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_inv" id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">M BL : </label> <label class="inp_mbl"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_mbl" id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">H BL : </label> <label class="inp_hbl"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_hbl" id="copyButton"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Customs status</h5>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Pick up D/O : </label> </i></label> <label class="inp_pick_up_do"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_pick_up_do" id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Check Doc : </label> </i></label> <label class="inp_checkdoc"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_checkdoc" id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Enter : </label> </i></label> <label class="inp_enter"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_enter" id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Clearance Date : </label> </i></label> <label class="inp_clearance_date"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_clearance_date" id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Clearance By : </label> </i></label> <label class="inp_clearance_by"></label> <i class="bi bi-files" onclick="preview_management.get_to_copy(this)"  fntype="inp_clearance_by" id="copyButton"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Ship Arrived : </label> </label> <label class="inp_ship_arrived"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Conatiner dropoff : </label></label> <label class="inp_container_dropff"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Customs Clearance : </label></label> <label class="inp_cus_clerance"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Container upload : </label></label> <label class="inp_container_upload"></label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Container arrived : </label></label> <label class="inp_container_arrived"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4">Document picture files</h5>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Invoice : </label> <i class="bi bi-image-fill" onclick="preview_management.get_show_photo('INV')"></i>

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">BL : </label> <i class="bi bi-image-fill" onclick="preview_management.get_show_photo('BL')"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">Packinglist : </label> <i class="bi bi-image-fill" onclick="preview_management.get_show_photo('PL')"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">import decaletion : </label> <i class="bi bi-image-fill" onclick="preview_management.get_show_photo('ID')"></i>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xl-12 col-lg-12">
                                    <label class="fw-bolder">import lincene :</label> <i class="bi bi-image-fill" onclick="preview_management.get_show_photo('IL')"></i>
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
<script src="js/preview_management/preview_management.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        preview_management.set_header_page();
    })
</script>

