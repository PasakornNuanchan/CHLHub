<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Currency Rate</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />





</head>

<style>
    .table_rate tbody>tr>td:nth-child(n+2):nth-child(-n+16)>input {
        width: 150px;
    }

    .table-responsive.sticky-left {
        overflow-x: initial;
    }
</style>


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

            <!-- headtab -->
            <!-- <div class="card">
                <div class="card-body card_body_head_nav">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="job_detail_tab" data-bs-toggle="pill" data-bs-target="#job_detail_tab_target" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Job detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="transport_tab" data-bs-toggle="pill" data-bs-target="#transport_tab_target" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="false">Transport</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded " id="reportcs_tab" data-bs-toggle="pill" data-bs-target="#reportcs_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Report cs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="customs_tab" data-bs-toggle="pill" data-bs-target="#customs_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Customs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="billing_tab" data-bs-toggle="pill" data-bs-target="#billing_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Billing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="withdraw_tab" data-bs-toggle="pill" data-bs-target="#withdraw_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Withdraw</button>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="card">
                <div class="card-header">
                    <h4>Currency rate</h4>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <h5>Condition</h5>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-xl-2">Create date</label>
                        <div class="col-xl-2"><input type="date" class="form-control form-control-sm rounded inp_start_date"></div>
                        <div class="col-xl-2"><input type="date" class="form-control form-control-sm rounded inp_end_date"></div>
                    </div>

                    <div class="form-group row">
                        <h5>Rate</h5>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-2 text-center">Currency USD -> THB</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_usd_thb rounded">
                        </div>
                        <label class="col-xl-2 text-center">Currency USD -> RMB</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_usd_rmb rounded">
                        </div>
                        <label class="col-xl-2 text-center">Currency USD -> YEN</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_usd_yen rounded">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-2 text-center">Currency THB -> USD</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_thb_usd rounded">
                        </div>
                        <label class="col-xl-2 text-center">Currency THB -> RMB</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_thb_rmb rounded">
                        </div>
                        <label class="col-xl-2 text-center">Currency THB -> YEN</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_thb_yen rounded">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-2 text-center">Currency RMB -> USD</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_rmb_usd rounded">
                        </div>
                        <label class="col-xl-2 text-center">Currency RMB -> THB</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_rmb_thb rounded">
                        </div>
                        <label class="col-xl-2 text-center">Currency RMB -> YEN</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_rmb_yen rounded">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-2 text-center">Currency YEN -> USD</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_yen_usd rounded">
                        </div>
                        <label class="col-xl-2 text-center">Currency YEN -> THB</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_yen_thb rounded">
                        </div>
                        <label class="col-xl-2 text-center">Currency YEN -> RMB</label>
                        <div class="col-xl-2">
                            <input type="text" class="form-control form-control-sm inp_yen_rmb rounded">
                        </div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-primary rounded" onclick="currency_rate.get_load_currency()"><i class="bi bi-clipboard"></i> load</button>
                        <button class="btn btn-sm btn-success rounded" onclick="currency_rate.get_to_save()"><i class="bi bi-save"></i> save</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Currency latest</h4>
                </div>
                <div class="card-body">
                    <div class="bd-exsample ">
                        <table class="table  table_rate sticky-left ">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Create data currency</th>
                                    <th scope="col">Start date</th>
                                    <th scope="col">End date</th>
                                    <th scope="col">USD -> THB</th>
                                    <th scope="col">USD -> RMB</th>
                                    <th scope="col">USD -> YEN</th>
                                    <th scope="col">THB -> USD</th>
                                    <th scope="col">THB -> RMB</th>
                                    <th scope="col">THB -> YEN</th>
                                    <th scope="col">RMB -> USD</th>
                                    <th scope="col">RMB -> THB</th>
                                    <th scope="col">RMB -> YEN</th>
                                    <th scope="col">YEN -> USD</th>
                                    <th scope="col">YEN -> THB</th>
                                    <th scope="col">YEN -> RMB</th>
                                    <th scope="col">Create by</th>
                                    <th scope="col">Datetime create</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td><input type="text" class="form-control form-control-sm rounded" readonly></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
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

<script src="js/currency_rate/currency_rate.js"></script>




<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        currency_rate.first_page();
        // job_detail.set_header_page();
    });
</script>