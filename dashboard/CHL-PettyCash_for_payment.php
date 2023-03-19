<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Petty Cash Payment</title>
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
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Request Petty Cash</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 col-md-2 col-lg-2 align-self-center">Request By:</label>
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
                                <hr>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center">Tranfer Method:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm mb-3 shadow-none sel_tranfer_mt" disabled>
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
                                            <label class="control-label col-sm-3 align-self-center">Bank Number:</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-banknumber" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Description</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row">
                                        <div class="table-responsive mt-4">
                                            <table id="basic-table" class="table table-striped" name="petty_cash_description" role="grid">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                        <th>Curency</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center h-des">
                                                        <td><select name="" id="" class="form-select shadow-none" disabled>
                                                                <option value="" selected>Plese select description</option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm" readonly></td>
                                                        <td><select name="" id="" class="form-select shadow-none sel_cur" disabled>
                                                                <option value="THB" selected>THB</option>
                                                                <option value="USD">USD</option>
                                                                <option value="RMB">RMB</option>
                                                            </select></td>
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
                                    <h4 class="card-title">Total</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center">Job quantity:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-1">
                                        <input type="input" class="form-control form-control-sm inp-count" style="text-align:right;" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center">Amount:</label>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-sm-9 col-md-4 col-lg-2">
                                                <input type="input" class="form-control form-control-sm inp-amt-usd" style="text-align:right;" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-1  align-self-center">USD</label>
                                            <div class="col-sm-9 col-md-4 col-lg-2">
                                                <input type="input" class="form-control form-control-sm inp-amt-thb" style="text-align:right;" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-1  align-self-center">THB:</label>
                                            <div class="col-sm-9 col-md-4 col-lg-2">
                                                <input type="input" class="form-control form-control-sm inp-amt-rmb" style="text-align:right;" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-1 align-self-center">RMB:</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center">Total amount by currency:</label>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-sm-9 col-md-4 col-lg-2">
                                                <input type="input" class="form-control form-control-sm inp-total-amt-usd" style="text-align:right;" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-1  align-self-center">USD</label>
                                            <div class="col-sm-9 col-md-4 col-lg-2">
                                                <input type="input" class="form-control form-control-sm inp-total-amt-thb" style="text-align:right;" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-1  align-self-center">THB:</label>
                                            <div class="col-sm-9 col-md-4 col-lg-2">
                                                <input type="input" class="form-control form-control-sm inp-total-amt-rmb" style="text-align:right;" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-1 align-self-center">RMB:</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="add_card_tranfer">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Tranfer</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center">Amount Request :</label>
                                        <div class="col-sm-9 col-lg-9">
                                            <div class="row">
                                                <div class="col-sm-3 col-lg-3">
                                                    <input type="text" class="form-control form-control-sm" readonly>
                                                </div>
                                                <div class="col-sm-3 col-lg-2">
                                                    <select name="" id="" class="form-select form-select-sm shadow-none sel_amt_req_tranfer">
                                                        <option value="THB">THB</option>
                                                        <option value="USD">USD</option>
                                                        <option value="RMB">RMB</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center">Amount Tranfer</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col col-sm-4 col-sm-3">
                                                    <input type="number" class="form-control form-control-sm inp_amount_tranfer">
                                                </div>
                                                <div class="col col-sm-2">
                                                    <select name="" id="" class="form-select form-select-sm shadow-none sel_amount_tranfer">
                                                        <option value="THB" selected>THB</option>
                                                        <option value="USD">USD</option>
                                                        <option value="RMB">RMB</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-2 align-self-center">Trust Receipt :</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control form-control-sm" readonly>
                                        </div>
                                    </div>
                                    <div style="float: right">
                                        <button class="btn btn-success rounded-pill btn-sm "><i class="bi bi-check-circle-fill"></i> Save</button>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="js/pettycash-payment/pettycash-payment.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        $('.js-example-basic-single').select2();
        pettycash_payment.check_get();
    });
</script>