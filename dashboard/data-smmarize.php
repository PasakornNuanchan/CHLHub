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
                                    <h4 class="card-title">1.Shipper's Data</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-1 align-self-center ">Client :</label>
                                    <div class="col-sm-9 col-lg-11">
                                        <div class="row">
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-client-name">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Tel :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-client-tel">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Email :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-client-email">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">LinkMan :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-client-linkman">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-1 align-self-center ">Shipper :</label>
                                    <div class="col-sm-9 col-lg-11">
                                        <div class="row">
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-shipper-name">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Tel :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-shipper-tel">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Email :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-shipper-email">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">LinkMan :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-shipper-linkman">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-1 align-self-center ">Distn.Agent :</label>
                                    <div class="col-sm-9 col-lg-11">
                                        <div class="row">
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Tel :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Email :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">LinkMan :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-1 align-self-center ">POL :</label>
                                    <div class="col-sm-9 col-lg-11">
                                        <div class="row">
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-pol">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">POD :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-pod">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">CNTR QTY. :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-c-qty">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Dept :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Loading Date :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-1 align-self-center ">Payment :</label>
                                    <div class="col-sm-9 col-lg-11">
                                        <div class="row">
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Item :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">ApplyToCus :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Transport :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm">
                                            </div>
                                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Sales :</label>
                                            <div class="col-lg">
                                                <input type="text" class="form-control form-control-sm inp-sale-name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">2.OP DATA</h4>
                                </div>
                            </div>
                            <div class="html_op_data_add">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-1 align-self-center ">Booking Agent :</label>
                                        <div class="col-sm-9 col-lg-11">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-agent-booking">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Tel :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-agent-tel">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Email :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-agent-email">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">LinkMan :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-agent-linkman">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-1 align-self-center ">VSL/VOY :</label>
                                        <div class="col-sm-9 col-lg-11">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-vslvoy">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">S/O :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-so">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">CLS :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-cls">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-1 align-self-center ">CNTR NO. :</label>
                                        <div class="col-sm-9 col-lg-11">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-cntr-no">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">ETD :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-etd">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">ETA :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-eta">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-1 align-self-center ">Cus.Broker :</label>
                                        <div class="col-sm-9 col-lg-11">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-cus-name">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Tel :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-cus-tel">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Linkman :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-cus-linkman">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Dock :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-dock">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-1 align-self-center ">Trailers :</label>
                                        <div class="col-sm-9 col-lg-11">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-trailers">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Tel :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-trailers-tel">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Linkman :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-trailers-linkman">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-1 align-self-center ">Carrier :</label>
                                        <div class="col-sm-9 col-lg-11">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm inp-carrier-name">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Loading Addr :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Verification Sheet  :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">B/L :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm inp-bl">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-1 align-self-center ">HeadVSL </label>
                                        <div class="col-sm-9 col-lg-11">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-headvsl">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">POT :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">HeadLoadETD :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-lg-1 align-self-center ">Checker </label>
                                        <div class="col-sm-9 col-lg-11">
                                            <div class="row">
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Market :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm inp-market">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">Filer :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm">
                                                </div>
                                                <label class="control-label col-sm-2 col-lg-1 align-self-center ">StowageMan :</label>
                                                <div class="col-lg">
                                                    <input type="text" class="form-control form-control-sm">
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
                                    <h4 class="card-title">3.INCOME (AR)</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover" name="tbl-income" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Fee description</th>
                                            <th>Amount</th>
                                            <th>Statement Co.</th>
                                            <th>Currecny</th>
                                            <th>D/N ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>test</td>
                                            <td align="right">test</td>
                                            <td>test</td>
                                            <td>test</td>
                                            <td>test</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">4.COST (AP)</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover" name="tbl-cost" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Fee description</th>
                                            <th>Amount</th>
                                            <th>Statement Co.</th>
                                            <th>Currecny</th>
                                            <th>C/N ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>test</td>
                                        <td align="right">test</td>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>test</td>
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
<script src="js/data-summarize/data-summarize.js"></script>
<script>
    $(document).ready(function() {
        data_sum.check_get();
    });
</script>