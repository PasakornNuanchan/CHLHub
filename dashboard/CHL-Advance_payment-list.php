<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Advance Payment</title>
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


            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="form-group row">
                                <label class="control-label col-sm-2 col-lg-1 ">Type :</label>
                                <div class="col-sm-2">
                                    <div class="row">
                                       <select name="" class="form form-select form-select-sm" id="">
                                        <option value="">All</option>
                                        <option value="">Paid</option>
                                        <option value="">Unpaid</option>
                                       </select>
                                    </div>
                                </div>
                            </div>
                        <div class="bd-example table-responsive">
                        <table id="datatable" class="table table-striped" name="data_table_list" data-toggle="data-table" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                <thead>
                                    <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                        <th>Create Date</th>
                                        <th>Advance number</th>
                                        <th>Create By</th>
                                        <th>Job Quantity</th>
                                        <th>Total amount</th>
                                        <th>Customs Clearance</th>
                                        <th>Advance Cash Clear</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                        <tr>
                                            <td></td>
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
<script src="js/advancecash-payment_list/advancecash_payment_list.js"></script>
<script src="js/advancecash-payment_list/advancecash_payment_list_set.js"></script>
<script>
    $(document).ready(function(){
        advance_cash_payment_list_set.set_data_rows();
    });
</script>