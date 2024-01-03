<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Billing</title>
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

            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Account Receivable</h3>
                            <div style="float: right">
                                <button class="btn btn-info rounded-pill bg-info bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-filetype-xlsx"></i> Export</button>
                                <button class="btn btn-warning rounded-pill bg-warning bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-printer"></i> Print</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="des-ar-add">
                                    <div class="des-ar-del">
                                        <div class="form-group row">
                                            <div class="table-responsive mt-4">
                                                <table id="basic-table" class="table table-hover"  name="billing-ar-tbl" role="grid" style="border-radius: 12px;">
                                                    <thead>
                                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                            <th>Description</th>
                                                            <th>Bill to</th>
                                                            <th>Payble</th>
                                                            <th>Currency</th>
                                                            <th>Qty.</th>
                                                            <th>Unit Price</th>
                                                            <th>AR amt.</th>
                                                            <th>Vat(%)</th>
                                                            <th>Amt(incl.Vat)</th>
                                                            <th>Remark</th>
                                                            <th>check</th>
                                                            <th>Paid</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="text-center ar_des">
                                                            <td>
                                                                <div class="db-sel-des">
                                                                    <select name="" id="" class="form-select shadow-none sel_description_ar" onchange="billing.set_vat_description_ar(this);">
                                                                        <option value="" selected>Plese select description</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="db-sel-bill">
                                                                    <select class="form-select shadow-none sel_bill_to_ar">
                                                                        <option value="" selected>Plese select description</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>Prepaid</td>
                                                            <td><select class="form-select shadow-none sel_cur_description_ar">
                                                                    <option value="THB">THB</option>
                                                                    <option value="USD">USD</option>
                                                                    <option value="RMB">RMB</option>
                                                                </select></td>
                                                            <td><input type="text" class="form-control"></td>
                                                            <td><input type="text" class="form-control"></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"></td>
                                                            <td><input type="checkbox" class="form-check-input"></td>
                                                            <td></td>
                                                            <td>
                                                                <button type="button" class="btn btn-success rounded-pill btn-xs" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button type="submit" class="btn btn-link btn-soft-light rounded-pill" onclick="billing.addarhtml();">add new</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-1 align-self-center ">Total:</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_thb_total_ar" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">THB</label>
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_rmb_total_ar" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">RMB</label>
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_usd_total_ar" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">USD</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-1 align-self-center ">Sub Total:</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_thb_total_cur_ar" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">THB</label>
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_rmb_total_cur_ar" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">RMB</label>
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_usd_total_cur_ar" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">USD</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Account Payble</h3>
                            <div style="float: right">
                                <button class="btn btn-info rounded-pill bg-secondary bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="billing_ap.modal_billing_import_pcac();"><i class="bi bi-filetype-xlsx"></i> Import petty cash and advance cash</button>
                                <button class="btn btn-info rounded-pill bg-info bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-filetype-xlsx"></i> Export</button>
                                <button class="btn btn-warning rounded-pill bg-warning bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-printer"></i> Print</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="des-ap-add">
                                    <div class="des-ap-del">
                                        <div class="form-group row">
                                            <div class="table-responsive mt-4">
                                                <table id="basic-table" class="table table-hover " name="billing-ap-tbl" role="grid" style="border-radius: 12px;">
                                                    <thead>
                                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                                            <th>Description</th>
                                                            <th>Bill to</th>
                                                            <th>Payble</th>
                                                            <th>Currency</th>
                                                            <th>Qty.</th>
                                                            <th>Unit Price</th>
                                                            <th>AR amt.</th>
                                                            <th>Vat(%)</th>
                                                            <th>Amt(incl.Vat)</th>
                                                            <th>Remark</th>
                                                            <th>check</th>
                                                            <th>Paid</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="text-center ap_des">
                                                            <td>
                                                                <div class="db-sel-des">
                                                                    <select name="" id="" class="form-select shadow-none sel_description_ap" onchange="billing_ap.set_vat_description_ap(this)">
                                                                        <option value="" selected>Plese select description</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="db-sel-bill">
                                                                    <select class="form-select shadow-none sel_bill_to_ap">
                                                                        <option value="" selected>Plese select description</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>Prepaid</td>
                                                            <td><select class="form-select shadow-none sel_cur_description_ap">
                                                                    <option value="THB">THB</option>
                                                                    <option value="USD">USD</option>
                                                                    <option value="RMB">RMB</option>
                                                                </select></td>
                                                            <td><input type="text" class="form-control"></td>
                                                            <td><input type="text" class="form-control"></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><input type="text" class="form-control"></td>
                                                            <td><input type="checkbox" class="form-check-input"></td>
                                                            <td></td>
                                                            <td>
                                                                <button type="button" class="btn btn-success rounded-pill btn-xs" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <button type="submit" class="btn btn-link btn-soft-light rounded-pill" onclick="billing_ap.addaphtml();">add new</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-1 align-self-center ">Total:</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_thb_total_ap" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">THB</label>
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_rmb_total_ap" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">RMB</label>
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_usd_total_ap" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">USD</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-lg-1 align-self-center ">Sub Total:</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_thb_total_cur_ap" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">THB</label>
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_rmb_total_cur_ap" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">RMB</label>
                                        <div class="col-lg-2 col-md-5">
                                            <input type="text" class="form-control form-control-sm inp_usd_total_cur_ap" readonly>
                                        </div>
                                        <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center ">USD</label>
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
<script src="js/billing/billing.js"></script>
<script src="js/billing/billing_ap.js"></script>
<script src="js/billing/billing_all.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        $('.js-example-basic-single').select2();
        billing.check_get();

    });
</script>