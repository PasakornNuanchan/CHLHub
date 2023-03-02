<?php
require 'function/auth/get_session.php';
 
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
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
                                    <h4 class="card-title">Request Advance Cash</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-3 align-self-center">Advance Number:</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control form-control-sm inp-ac_number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-3 align-self-center" >Method request payment:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm shadow-none sel_tranfer_mt">
                                            <option value="">Plese select tranfer mehthod</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Tranfer">Tranfer</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center">Bank Name:</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control form-control-sm inp-bankname">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center">Bank Number:</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control form-control-sm inp-banknumber">
                                    </div>
                                </div> -->
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
                                            <table id="basic-table" class="table table-striped" name="advance-cash-tbl" role="grid">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Description</th>
                                                        <th>Amount Request</th>
                                                        <th>Curency</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="advance_detail">
                                                        <td class="db-select-des">
                                                            <select class="form-select form-select-sm row-of-description">
                                                            <option value="">Please select container type</option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm inp-amount"></td>
                                                        <td><select class="form-select form-select-sm sel_currency">
                                                                <option value="THB">THB</option>
                                                                <option value="USD">USD</option>
                                                                <option value="RMB">RMB</option>
                                                            </select></td>
                                                       <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-link btn-soft-light rounded-pill btn-add-adhtml" onclick="advance_cash.addadhtml();">Add new list Advance</button>
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
                                    <label class="control-label col-sm-3 align-self-center">Job quantity:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-2">
                                        <input type="input" class="form-control form-control-sm inp-count" style="text-align:right;" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center">Amount:</label>
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
                                    <label class="control-label col-sm-3 align-self-center">Total amount by currency:</label>
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
<script src="js/advance/advance.js"></script>

<script>
    $(document).ready(function(){
        advance_cash.check_get();
    })
</script>