<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CHLTruck</title>
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
                <div class="col-md-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Filter</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-1 col-md-1 col-lg-1 col-xl-1 text-center">Date</label>
                                <div class="col-sm-11 col-md-11 col-lg-11">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 ">
                                            <input type="date" class="form-control form-control-sm" maxlength="200">
                                        </div>
                                        <div class="col-lg-1 col-md-1 text-center">
                                            <label>To</label>
                                        </div>
                                        <div class="col-lg-2 col-md-2 ">
                                            <input type="date" class="form-control form-control-sm" maxlength="200">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Cash flow</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr class="text-center">
                                        <th>no</th>
                                        <th>description</th>
                                        <th>Cash</th>
                                        <th>Operation by</th>
                                        <th>Datetime operation</th>
                                        <th>Picture</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-start">Cash In</td>
                                        <td class="text-end">+ 20000.00 Bath</td>
                                        <td class="text-center">Owen</td>
                                        <td class="text-center">2023-01-01 11:11:11</td>
                                        <td class="text-center"><i class="bi bi-image"></i></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td class="text-start">Oil Fee</td>
                                        <td class="text-end">- 1000.00 Bath</td>
                                        <td class="text-center">Fah</td>
                                        <td class="text-center">2023-01-01 11:11:11</td>
                                        <td class="text-center"><i class="bi bi-image"></i></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end">
                                <button class="btn btn-success btn-sm rounded">Cash in</button>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Maintain Cost</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th>no</th>
                                        <th>Job Number</th>
                                        <th>Truck</th>
                                        <th>Description</th>
                                        <th>Maintain date</th>
                                        <th>Currency</th>
                                        <th>total</th>
                                        <th>Status</th>
                                        <th>Create By</th>
                                        <th>Create Datetime</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td><input type="text" class="form-control form-control-sm rounded" value="T20210101"></td>
                                        <td><select class="form-select form-select-sm rounded" name="" id="">
                                                <option value="">Plate 97-9422</option>
                                                <option value="">Plate 97-9421</option>
                                                <option value="">Plate 97-9420</option>
                                            </select></td>
                                        <td><select class="form-select form-select-sm rounded" name="" id="">
                                                <option value="1">Gas Fee</option>
                                                <option value="2">Maintain Fee</option>
                                                <option value="3">Express Way Fee</option>
                                            </select></td>
                                        <td><input type="date" class="form-control form-control-sm rounded"></td>
                                        <td><select class="form-select form-select-sm rounded" name="" id="">
                                                <option value="THB">THB</option>
                                                <option value="USD">USD</option>
                                                <option value="RMB">RMB</option>
                                                <option value="YEN">YEN</option>
                                            </select></td>
                                        <td><input type="number" class="form-control form-control-sm rounded"></td>
                                        <td></td>
                                        <td><input type="text" class="form-control form-control-sm rounded" disabled></td>
                                        <td><input type="text" class="form-control form-control-sm rounded" disabled></td>
                                        <td><button class="btn btn-success btn-sm"><i class="bi bi-save"></i> save</button> <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> del</button></td>
                                    </tr>
                                </tbody>
                            </table>
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


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        user_list_set.check_get();
    });
</script>