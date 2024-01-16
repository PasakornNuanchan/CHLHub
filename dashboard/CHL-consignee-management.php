<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Consignee Management</title>
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

            <div class="card">
                <div class="card-body card_body_head_nav">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="consignee_detail_tab" data-bs-toggle="pill" data-bs-target="#consignee_detail_tab_target" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Consignee detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="user_detail_tab" data-bs-toggle="pill" data-bs-target="#user_tab_target" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="false">User control</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="consignee_detail_tab_target" role="tabpanel" aria-labelledby="job_detail_tab">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Consignee Detail</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Corporate name</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-cname" onchange="consignee_list_set.corp_check()" maxlength="100">
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2">
                                                <div class="data_check_name"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Address</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <textarea type="input" class="form-control form-control-sm inp-address" rows="3" maxlength="200"></textarea>
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2"></div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Tax ID</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-tax_id" maxlength="30">
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2"></div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Email</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <input type="email" class="form-control form-control-sm inp-email" maxlength="80">
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2"></div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Phone number</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-phone_number" maxlength="20">
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2"></div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Fax</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-fax" maxlength="50">
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2"></div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Contact</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-linkman" maxlength="60">
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2"></div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Contact Tel</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <input type="input" class="form-control form-control-sm inp-contact" maxlength="20">
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2"></div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">Sale support</label>
                                            <div class="col-sm-7 col-md-7 col-lg-7">
                                                <select class="form-select form-select-sm sel_sale_support">
                                                    <option value="">--- select sale support ---</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2 col-md-2 col-lg-2"></div>

                                        </div>
                                        <div style="float: right">
                                            <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="consignee_list_set.fn_save_raw()"><i class="bi bi-check-square"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5">
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
                                        <button class="btn btn-outline-primary btn-sm col-12" onclick="consignee_list_set.add_bank()">Add Bank</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="user_tab_target" role="tabpanel" aria-labelledby="job_detail_tab">
                        <div class="card">
                            <div class="card-header">
                                <h5>User Control</h5>
                            </div>
                            <div class="card-body ">
                                <div class="user_card_tab">
                                    <div class="consignee_user" user_consignee_id="">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">username :</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="input" class="form-control form-control-sm inp_username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">password :</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="input" class="form-control form-control-sm inp_pass">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">stauts :</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <select class="form-select form-select-sm inp_status">
                                                    <option value="1">active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center ">forgot pin (for reset password) :</label>
                                            <div class="col-sm-9 col-md-9 col-lg-9">
                                                <input type="input" class="form-control form-control-sm inp_forgot">
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <button class="btn btn-sm btn-danger" onclick="consignee_list_set.delete_user_consingee(this)"><i class="bi bi-trash"></i> Delete</button>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-block btn-sm btn-primary col" onclick="consignee_list_set.add_new_user_consignee()">add new user customer</button>
                                    <button class="btn btn-block btn-sm btn-success col" onclick="consignee_list_set.save_user_consignee()">save</button>
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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="js/consignee_management/consignee_management_set.js"></script>
<script src="js/consignee_management/setting_default.js"></script>


<script>
    $(document).ready(async function() {
        sidebar_main.set_data_rows();
        await setting_default.setting_sale_support();

        await consignee_list_set.check_get();
    });
</script>