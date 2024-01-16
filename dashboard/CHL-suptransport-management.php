<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Supplier Transport Management</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
            <div class="row">
                <div class="col-md-12 col-xl-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Consignee Detail</h4>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Supplier name</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-cname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Address</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Tax ID</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-tax_id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Email</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Phone number</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-phone_number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Line</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-line">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">fax</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-fax">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Contact personname (linkman)</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-linkman">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Contact tel</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-contact">
                                </div>
                            </div>
                            <div style="float: right">
                                <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="suptransport_list_set.fn_save_raw()"><i class="bi bi-check-square"></i> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4>Accounting</h4>
                            <div class="form-group pl-2 mt-3">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="">Payment term (day)</label>
                                    </div>
                                    <div class="col-9">
                                        <input type="text" class="form-control form-control-sm inp_payment_term_day">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4>Bank</h4>
                            <div class="card_bank_data">
                                <div class="card card_cma mt-3">
                                    <div class="card-body">
                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">The bank abbreviation</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_bank_abb" maxlength="60">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">Company Name</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_company_name" maxlength="80">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">Company address</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_company_address" maxlength="200">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">Bank name</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_bank_name" maxlength="40">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">Bank account No</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_bank_account" maxlength="70">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">Bank SWIFT CODE</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_bank_swift_code" maxlength="40">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">BANK CODE</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_bank_code" maxlength="40">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pl-2 mt-4">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">Country</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_country" maxlength="40">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">TAX number</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_tax_number" maxlength="40">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pl-2">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="">Commercial number</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" class="form-control form-control-sm inp_commercial_number" maxlength="70">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary btn-sm col-12" onclick="suptransport_list_set.add_bank()">Add Bank</button>
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
<script src="js/suptransport_management/suptransport_management_set.js"></script>


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        suptransport_list_set.check_get();
    });
</script>