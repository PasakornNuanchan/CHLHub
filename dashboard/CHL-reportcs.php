<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Report Customer service</title>
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
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Job Detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Driver & Container</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Job detail</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Job Number</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-job_number" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">INV NO.</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-inv" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Consignee</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-consignee" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">M B/L</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-mbl" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">ETD</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-eth" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">H B/L</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-hbl" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">ETA</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-eta" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">Carrier</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-carrier" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">POL</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-pol" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">Vessel</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-vessel" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">POD</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-pod" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">PORT</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-port" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">INV NO.</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-invno" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Document Date</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Clearlance Date</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-clearance_date" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">Check doc.</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-check_doc" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Delivery</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-delivery" readonly>
                                                </div>
                                                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center ">Enter</label>
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-enter" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center ">Pick up D/O</label>
                                        <div class="col-sm-12 col-md-10">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-5">
                                                    <input type="text" class="form-control form-control-sm inp-pick_do" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Document</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover" name="tbl_job_status" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Document</th>
                                            <th>Picture file</th>
                                            <th>Received By.</th>
                                            <th>Received Datetime</th>
                                            <th>Check Document By</th>
                                            <th>Check Document Datetime</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Container</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bd-example table-responsive">
                                <table class="table table-hover" name="container-tbl" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th scope="col">No.</th>
                                            <th scope="col">Container type</th>
                                            <th scope="col">Container Number</th>
                                            <th scope="col">Seal Number</th>
                                            <th scope="col">Gross Weight</th>
                                            <th scope="col">CBM</th>
                                            <th scope="col">SOC</th>
                                            <th scope="col">OW</th>
                                            <th class="col">CY</th>
                                            <th class="col">RTN</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                        <tr>
                                            <td>1</td>
                                            <td>Dry Cargo Container (40HC)</td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>
                                            <td><input type="text" class="form-control"></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-transport">
                        <div class="card ">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Booking Transport Detail</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-2 col-lg-2  align-self-center ">Supplier:</label>
                                    <div class="col-sm-3 col-md-5">
                                        <div class="db-sel-sup">
                                            <select class="form-select form-select-sm mb-3 shadow-none sel-supplier">
                                                <option value="">plese select supplier</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center ">Pickup Empty Container Address:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-pick_emp">
                                            </div>
                                            <label class="control-label col-sm-2 align-self-center ">Remark :</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-pick_emp_remark">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center ">Pickup Container Address:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control inp-pick_con">
                                            </div>
                                            <label class="control-label col-sm-2 align-self-center ">Remark :</label>
                                            <div class="col">
                                                <input type="text" class="form-control inp-pick_con_remark">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center ">Drop off Container Address:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control inp-drop_con">
                                            </div>
                                            <label class="control-label col-sm-2 align-self-center ">Remark :</label>
                                            <div class="col">
                                                <input type="text" class="form-control inp-drop_con_reamrk">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2  align-self-center ">Drop off Empty Containe Address:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control inp-drop_emp">
                                            </div>
                                            <label class="control-label col-sm-2 align-self-center ">Remark :</label>
                                            <div class="col">
                                                <input type="text" class="form-control inp-drop_emp_remark">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center mb-3">Budget:</label>
                                    <div class="col-sm-9 col-md-10">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-2">
                                                <input type="input" style="text-align:right;" class="form-control form-control-sm inp-budget">
                                            </div>
                                            <div class="col-lg-3 col-md-2">
                                                <select class="form-select form-select-sm sel-cur">
                                                    <option value=""></option>
                                                    <option value="THB">THB</option>
                                                    <option value="USD">USD</option>
                                                    <option value="RMB">RMB</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-4">
                                <h4 class="mb-4">Supplier confirm</h4>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-">Sent Request Line DateTime :</label>
                                    <div class="col-sm-3 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-sent_request_line" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Supplier Confirm DateTime :</label>
                                    <div class="col-sm-3 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-supplier_firm" readonly>
                                    </div>
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
<script src="js/reportcs/reportcs.js"></script>
<script>
    $(document).ready(function() {
        reportcs.check_get();
    });
</script>