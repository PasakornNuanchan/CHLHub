<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
    <?php include '../assets/include/theme_include_css.php'; ?>

</head>

<body>
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
                                    <label class="control-label col-sm-3 col-lg-3 align-self-center" for="pwd2">Petty cash number:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-pt_number" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center">Tranfer Mehthod Tranfer:</label>
                                    <div class="col-sm-9 col-lg-3">
                                        <select class="form-select form-select-sm shadow-none sel_tranfer_mt">
                                            <option value="">Plese select tranfer mehthod</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Tranfer">Tranfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center">Bank Name:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-bankname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center">Bank Number:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-banknumber">
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
                                            <table id="basic-table" class="table table-striped mb-0" name="petty-cash-tbl" role="grid">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                        <th>Curency</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="pettycash_detail">
                                                        <td>
                                                            <div class="db-select-des">
                                                                <select class="form-select form-select-sm sel_description">
                                                                    <option value="" selected>Plese select Congsignee</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td><input type="input" class="form-control form-control-sm inp-amount" onchange="petty_cash.amount_total();"></td>
                                                        <td><select name="" id="" class="form-select">
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-link btn-soft-light rounded-pill" onclick="petty_cash.addpthtml();">add new</button>
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
                                    <label class="control-label col-sm-3 align-self-center mb-0">Job quantity:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="input" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0">Amount:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="input" class="form-control form-control-sm" readonly>
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
<script src="js/pettycash/pettycash.js"></script>
