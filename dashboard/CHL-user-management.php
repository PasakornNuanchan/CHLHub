<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Management</title>
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
                <div class="col-md-12 col-xl-7">
                    <!-- Booking -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Detail</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">User number</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="number" class="form-control form-control-sm inp-un" id="">
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">First name</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-fname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Last name</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-lname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Mobile number</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-mphone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">E-mail</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Address</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Department</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm sel_department">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Status</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm sel_st">
                                        <option value="1" selected>Active</option>
                                        <option value="2">In Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Container</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="bd-example">
                                    <svg class="bd-placeholder-img img-thumbnail" width="200" height="200" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera: 200x200" preserveAspectRatio="xMidYMid slice" focusable="false">
                                        <rect width="100%" height="100%" fill="#868e96"></rect><text x="30%" y="50%" fill="#dee2e6" dy=".3em">200x200</text>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- container information -->
                <div class="col-md-12 col-xl-5">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title head_change">Change Password </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center ">Username</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-user_name" >
                                </div>
                            </div>
                            <div class="form-group row fn_old_pass">
                                <label class="control-label col-sm-3 align-self-center ">Old password </label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="password" class="form-control form-control-sm inp-old_pass_word">
                                </div>
                            </div>
                            <div class="form-group row fn_new_pass">
                                <label class="control-label col-sm-3 align-self-center text_new_pass ">New password</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="password" class="form-control form-control-sm inp-new_password">
                                </div>
                            </div>
                            <div class="form-group row fn_cf_new_pass">
                                <label class="control-label col-sm-3 align-self-center ">Confirm new password</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="password" class="form-control form-control-sm inp-cf_newpassword">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title">Cash detail</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center ">Bank Name</label>
                                    <div class="col-sm-9 col-md-9 col-lg-9">
                                        <input type="input" class="form-control form-control-sm inp-bank_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center ">Bank number:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-9">
                                        <input type="input" class="form-control form-control-sm inp-bank_number">
                                    </div>
                                </div>
                            </div>
                            <div style="float: right" class="bun_save">
                                <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="user_list_set.fn_save_raw()"><i class="bi bi-check-square"></i> Save</button>
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
<script src="js/user_management/user_management_set.js"></script>
<script src="js/user_management/user_management_set_default.js"></script>
<script src="js/user_management/create_user.js"></script>


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        user_list_set.check_get();
    });
</script>