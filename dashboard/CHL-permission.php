<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Permission</title>
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

            <!-- breadcrumb -->

            <div class="row">
                <div class="col-md-12 col-xl-3"></div>
                <div class="col-md-12 col-xl-6">
                    <!-- Booking -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Setting permission by department</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body card_body_head_nav">
                                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link rounded active" id="main_page_tab" data-bs-toggle="pill" data-bs-target="#main_page_tab_target" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Main page</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link rounded" id="job_tab" data-bs-toggle="pill" data-bs-target="#job_tab_target" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="false">Job detail</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link rounded " id="cash_tab" data-bs-toggle="pill" data-bs-target="#cash_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Cash</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="main_page_tab_target" role="tabpanel" aria-labelledby="main_page_tab">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 lg-3 align-self-center ">Department</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm sel_department" onchange="permission_set.change_department()">
                                                <option value="">pleses select department</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add_menu_select">

                                    </div>
                                    <div style="float: right">
                                        <button class="btn btn-success rounded-pill btn-sm " onclick="permission_set.save_per()"><i class="bi bi-check-square"></i> Save</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="job_tab_target" role="tabpanel" aria-labelledby="job_tab">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 lg-3 align-self-center ">Department</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm sel_department inp_select_department_job" onchange="permission_set.change_department_job_detail()">
                                                <option value="">pleses select department</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add_menu_select_job">
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_job_detail " >
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">job_detail</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_transport">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">transport</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_report">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">reportcs</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_customs">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">customs</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_billing">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">billing</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_withdraw">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">withdraw</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_billofladding">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">Bill of lading</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="float: right">
                                        <button class="btn btn-success rounded-pill btn-sm" onclick="permission_set.save_permission_job()"><i class="bi bi-check-square"></i> Save</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cash_tab_target" role="tabpanel" aria-labelledby="cash_tab">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 lg-3 align-self-center ">Department</label>
                                        <div class="col-sm-9 col-md-9 col-lg-9">
                                            <select class="form-select form-select-sm sel_department inp_select_department_cash" onchange="permission_set.change_department_cash()">
                                                <option value="">pleses select department</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="add_menu_select_cash">
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_payble">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">Payble</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_advance">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">Advance Cash</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_petty_cash_request">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">Petty Cash request</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 col-lg-3"></div>
                                            <div class="col-sm-9 col-lg-9">
                                                <div class="form-group row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                                        <select class="form-select form-select-sm inp_reutn_petty_cash">
                                                            <option value="1">Full permission</option>
                                                            <option value="2">View only</option>
                                                            <option value="3">Hide / disabled</option>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-3 col-lg-5 align-self-center ">Return Petty cash</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="float: right">
                                        <button class="btn btn-success rounded-pill btn-sm " onclick="permission_set.save_permission_cash()"><i class="bi bi-check-square"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-3"></div>
                <!-- container information -->
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
<script src="js/permission/permission_default.js"></script>
<script src="js/permission/permission_set.js"></script>


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        permission_set.run();
    });
</script>