<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Balance</title>
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
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Petty Cash Balance</h4>
                                <div class="col-lg-12 text-center mt-5">
                                    <div class="row">
                                        <div class="col-lg-4" >
                                            <div class="card" >
                                                <h5 class="card-title text-center txt-head-pet-th" ></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <h5 class="card-title text-center txt-head-pet-us"></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <h5 class="card-title text-center txt-head-pet-ch"></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p>Petty Cash Waiting for clear</p>
                                <div class="table-responsive mt-4">
                                    <table id="basic-table" class="table table-hover mb-3 " name="pc_wfc_table" role="grid" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                        <thead>
                                            <tr align="center" class="bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                <th>PT. Number</th>
                                                <th>Amount</th>
                                                <th>Curency</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>PT220902</td>
                                                <td>18,000.00</td>
                                                <td><span class="badge rounded-pill bg-success">Success</span></td>
                                                <td><button class="btn btn-primary rounded-pill btn-xs "><i class="bi bi-eye"></i> Check</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Advance Cash Balance</h4>
                                <div class="col-lg-12 text-center mt-5">
                                    <div class="row">
                                        <div class="col-lg-4" >
                                            <div class="card" >
                                                <h5 class="card-title text-center txt-head-adc-th" ></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <h5 class="card-title text-center txt-head-adc-us"></h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="card">
                                                <h5 class="card-title text-center txt-head-adc-ch"></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p>Advance Waiting tranfer</p>
                                <div class="table-responsive mt-4">
                                    <table id="basic-table" class="table table-hover mb-3" name="ad_wfc_table" role="grid" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                        <thead>
                                            <tr align="center" class="bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                <th>AD. Number</th>
                                                
                                                <th>Amount</th>
                                                <th>Curency</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>PT220902</td>
                                                <td>18,000.00</td>
                                                
                                                <td><button class="btn btn-primary rounded-pill btn-xs "><i class="bi bi-eye"></i> Check</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p>Job Not Have Create Advance Cash</p>
                                <div class="table-responsive mt-4">
                                    <table id="basic-table" class="table table-hover mb-3 text-center" name="ad_nhc_table" role="grid" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                        <thead>
                                            <tr class="bg-gradient" style="background-color :#FF0000; color :aliceblue;">
                                                <th>Job Nubmer</th>
                                                <th>Amount</th>
                                                <th>Curency</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>PT220902</td>
                                                <td>17,000.00</td>
                                                <td></td>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="js/balance/balance.js"></script>
<script src="js/balance/petty_cash_con.js"></script>
<script src="js/balance/advance_cash_con.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        $('.js-example-basic-single').select2();
        balance.set_preview_data();
    });
</script>