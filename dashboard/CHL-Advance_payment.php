<?php
require 'function/auth/get_session.php';
 
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Advance Cash Payment</title>
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
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between ">
                                <div class="header-title">
                                    <h4 class="card-title fw-normal">Request Advance Cash</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center">Advance Cash Nubmer :</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-advance_number" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center">Request By:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-req_by" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center">Datetime Request:</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-req_datet" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center ">Method payment request:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm sel_tranfer_mt" disabled>
                                            <option value="">Plese select tranfer mehthod</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Tranfer">Tranfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center">Bank Name</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-bankname" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center ">Bank Number:</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-banknumber" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center" for="pwd2">Job Number</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-all_job" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title fw-normal">Description request</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row">
                                        <div class="table-responsive mt-4">
                                            <table id="basic-table" class="table table table-hover col-sm-12 text-center" name="des-req" role="grid">
                                                <thead>
                                                    <tr class="text-center" style="background-color :#0D47A1; color :aliceblue;">
                                                        <th>No.</th>
                                                        <th>Description</th>
                                                        <th>Advance Cash Amount</th>
                                                        <th>Curency</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>1</td>
                                                        <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm" style="text-align: right;" readonly></td>
                                                        <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title fw-normal">Advance Cash Payment</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center">Total Advance Cash For Return :</label>
                                        <div class="col col-sm-3">
                                            <input type="text" class="form-control form-control-sm col-sm-2 inp-advance_cash_req" style="text-align: right;" readonly>
                                        </div>
                                        <div class="col col-sm-2">
                                            <select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                <option value="" selected>THB</option>
                                                <option value="">USD</option>
                                                <option value="">RMB</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center">Payment medthod :</label>
                                        <div class="col col-sm-3">
                                            <select name="" id="" class="form-select form-select-sm sel-mt-return" disabled>
                                                <option value="" selected></option>
                                                <option value="Tranfer">Tranfer</option>
                                                <option value="Cash">Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center">Payment By. :</label>
                                        <div class="col col-sm-3">
                                            <input type="text" class="form-control form-control-sm col-sm-2 inp-payment-by" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center">Payment datetime :</label>
                                        <div class="col col-sm-3">
                                            <input type="datetime" class="form-control form-control-sm col-sm-2 inp-payment-d-time" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center">Payment Amount :</label>
                                        <div class="col col-sm-3">
                                            <input type="text" class="form-control form-control-sm col-sm-2 inp-payment-re-amount" style="text-align: right;" readonly>
                                        </div>
                                        <div class="col col-sm-2">
                                            <select name="" id="" class="form-select form-select-sm shadow-none sel-payment-re-amount_cur" disabled>
                                                <option value="" selected></option>
                                                <option value="THB">THB</option>
                                                <option value="USD">USD</option>
                                                <option value="RMB">RMB</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div style="float: right">
                                    <button class="btn btn-success" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title fw-normal">Description Advance Cash Detail</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="des_ad">
                                        <div class="des_hide">
                                            <div class="form-group row">
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-2 align-self-center">Job number :</label>
                                                    <div class="col col-sm-3">
                                                        <input type="input" class="form-control form-control-sm col-sm-2" readonly>
                                                    </div>
                                                </div>
                                                <div class="table-responsive main_des_table">
                                                    <table id="table" class="table table table-hover col-sm-12 text-center" role="grid">
                                                        <thead>
                                                            <tr style="background-color :#0D47A1; color :aliceblue;">
                                                                <th>No.</th>
                                                                <th>Description</th>
                                                                <th>Amount</th>
                                                                <th>Curency</th>
                                                                <th>Receipt</th>
                                                                <th>remark</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="text-center">
                                                                <td>1</td>
                                                                <td><input type="input" class="form-control form-control-sm" value="" readonly></td>
                                                                <td><input type="input" class="form-control form-control-sm" value="" readonly></td>
                                                                <td><input type="input" class="form-control form-control-sm" value="" readonly></td>
                                                                <td><input type="input" class="form-control form-control-sm" value="" readonly></td>
                                                                <td><input type="input" class="form-control form-control-sm" value="" readonly></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="cal_des_detail">
                                                <div class="alert alert-solid col-sm-11 " style="background: #10929A; color:white; text-align:center;">
                                                    <div class="small">
                                                        <!-- <label class="control-label col-sm-0 align-self-center fw-bold">Advance Cash :</label>
                                                        <label class="control-label col-sm-2 align-self-center" align="right">12,000.00</label>
                                                        <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                                                        <label class="control-label col-sm-4 align-self-center fw-bold">Advance Cash Return :</label>
                                                        <label class="control-label col-sm-2 align-self-center" align="right">12,000.00</label>
                                                        <label class="control-label col-sm-0 align-self-center text-center">THB</label> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>





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
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            advance_return.check_get();
        });
    </script>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="js/advance-payment/advance_payment.js"></script>