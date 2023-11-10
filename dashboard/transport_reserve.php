<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transport reserve</title>
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
                <!-- <div class="col-md-12 col-xl-2"></div> -->
                <div class="col-md-12 col-xl-12" style="zoom:80%">
                    <div class="card">
                        <div class="card-body row">
                            <div class="col">
                                <h4>Transport reserve</h4>
                            </div>
                            <div class="col text-end">
                                <a class="btn btn-outline-primary btn-sm" href="../dashboard/CHL-suptransport_list.php" target="_blank">Supplier</a>
                                <!-- <button class="btn btn-outline-primary btn-sm" href="">btn</button> -->
                            </div>
                        </div>
                    </div>
                    <div class="data_transport">
                        <div class="card" data-bs-toggle="collapse" href="#demo1">
                            <div class="card-body">
                                <div class="mx-auto">
                                    <div class="form-group row text-center">
                                        <div class="col-lg-1 col-xl-1"><label for="">From</label></div>
                                        <div class="col-lg-2 col-xl-2"><input type="text" class="form-control form-control-sm" value="Lam Chabang terminal 3" readonly></div>
                                        <div class="col-lg-1 col-xl-1"><label for="">To</label></div>
                                        <div class="col-lg-2 col-xl-2"><input type="text" class="form-control form-control-sm" value="Ladkrabang international school" readonly></div>
                                        <div class="col-lg-1 col-xl-1"><label for="">Container quantity</label></div>
                                        <div class="col-lg-1 col-xl-1"><input type="text" class="form-control form-control-sm" value="3" readonly></div>

                                        <div class="col-lg-1 col-xl-1"><label for="">Supplier</label></div>
                                        <div class="col-lg-2 col-xl-2"><select class="form-select form-select-sm" name="" id="">
                                                <option value="">sup1</option>
                                                <option value="">sup2</option>
                                                <option value="">sup3</option>
                                                <option value="">sup4</option>
                                            </select></div>
                                    </div>
                                    <div class="form-group row text-center">
                                        <div class="col-lg-1 col-xl-1"><label for="">Job number</label></div>
                                        <div class="col-lg-2 col-xl-2"><input type="text" class="form-control form-control-sm inp_job_number" value="" readonly></div>
                                        <div class="col-lg-1 col-xl-1"><label for="">Clearlance date</label></div>
                                        <div class="col-lg-2 col-xl-2"><input type="datetime-local" class="form-control form-control-sm inp_clearance_date" value="2023-11-10T22:00" readonly></div>
                                        <div class="col-lg-1 col-xl-1"><label for="">Delivery date plan</label></div>
                                        <div class="col-lg-2 col-xl-2"><input type="datetime-local" class="form-control form-control-sm inp_delivery_plan" value="2023-11-15T08:00" readonly></div>
                                        <div class="col-lg-1 col-xl-1"><label for="">Container Plan</label></div>
                                        <div class="col-lg-1 col-xl-1"><input type="text" class="form-control form-control-sm " value=""></div>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-outline-primary btn-sm">save</button>
                                        <button class="btn btn-outline-primary btn-sm" onclick="transport_function.get_to_copy(this)">copy context</button>
                                    </div>
                                    <div class="text-center">
                                        <span class="badge rounded-pill bg-secondary text-light">see more</span>
                                    </div>
                                </div>
                                <div id="demo1" class="collapse p-4">
                                    <div class="form-group row text-center">
                                        <div class="col-lg-2 col-xl-2"><label for="">Pickup Empty Container Address</label></div>
                                        <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="RHYTHM Ratchada" readonly></div>
                                        <div class="col-lg-2 col-xl-2"><label for="">remark</label></div>
                                        <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="" readonly></div>
                                    </div>
                                    <div class="form-group row text-center">
                                        <div class="col-lg-2 col-xl-2"><label for="">Loading Address</label></div>
                                        <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="Lam Chabang terminal 3" readonly></div>
                                        <div class="col-lg-2 col-xl-2"><label for="">remark</label></div>
                                        <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="" readonly></div>
                                    </div>
                                    <div class="form-group row text-center">
                                        <div class="col-lg-2 col-xl-2"><label for="">Delivery Container Address</label></div>
                                        <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="Ladkrabang international school" readonly></div>
                                        <div class="col-lg-2 col-xl-2"><label for="">remark</label></div>
                                        <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="" readonly></div>
                                    </div>
                                    <div class="form-group row text-center">
                                        <div class="col-lg-2 col-xl-2"><label for="">Drop off Empty Containe Address</label></div>
                                        <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="RHYTHM Ratchada" readonly></div>
                                        <div class="col-lg-2 col-xl-2"><label for="">remark</label></div>
                                        <div class="col-lg-4 col-xl-4"><input type="text" class="form-control form-control-sm" value="" readonly></div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr class="text-center">
                                                    <th>No</th>
                                                    <th>Container Type</th>
                                                    <th>Container Number</th>
                                                    <th>GW</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td><input type="text" class="form-control form-control-sm text-center inp_container_type" readonly value="40GP (General Purpose)"></td>
                                                    <td><input type="text" class="form-control form-control-sm text-center inp_container_name" readonly value="WHSU6863540/WHLP725253"></td>
                                                    <td><input type="text" class="form-control form-control-sm text-center inp_container_gw" readonly value="23000"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="area_text"></div>
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
<!-- <script src="js/carrier_management/carrier_management_set.js"></script> -->
<script src="js/transport_reserve/transport_function.js"></script>
<script src="js/transport_reserve/transport_first.js"></script>


<script>
    $(document).ready(async function() {
        sidebar_main.set_data_rows();
        await transport_first.setting_default();
        await transport_first.setting_first();
    });
</script>