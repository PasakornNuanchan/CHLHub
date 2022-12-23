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
                                    <label class="control-label col-sm-2 align-self-center mb-0">Request By:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-req_by" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0">Datetime Request:</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-req_datet" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0">Tranfer Method:</label>
                                    <div class="col-sm-9">
                                    <select class="form-select form-select-sm mb-3 shadow-none" disabled>
                                            <option value="">Plese select tranfer mehthod</option>
                                            <option value="">Cash</option>
                                            <option value="">Bank Tranfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" >Bank Name</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-bankname" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0">Bank Number:</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm inp-banknumber" placeholder="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Job Quantity</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="number" class="form-control form-control-sm inp-job_quantity" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" >Total Amount:</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm col-sm-2 inp-total_amount" style="text-align: right;" readonly>
                                            </div>
                                            <div class="col col-sm-2">
                                                <select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                    <option value="" selected>THB</option>
                                                    <option value="">USD</option>
                                                    <option value="">RMB</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Tranfer</h4>
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Amount Tranfer</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col col-sm-4">
                                                <input type="number" class="form-control form-control-sm inp-total_amount_tranfer" placeholder="">
                                            </div>
                                            <div class="col col-sm-2">
                                            <select name="" id="" class="form-select form-select-sm shadow-none">
                                                    <option value="" selected>THB</option>
                                                    <option value="">USD</option>
                                                    <option value="">RMB</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Trust Receipt :</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                    </div>
                                </div>
                                <div style="float: right">
                                    <button class="btn btn-success rounded-pill btn-sm "><i class="bi bi-check-circle-fill"></i> Save</button>
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
                                            <table id="basic-table" class="table table-striped mb-0" name="petty_cash_description" role="grid">
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
                                                                <option value=""></option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly></td>
                                                        <td><select name="" id="" class="form-select shadow-none" disabled>
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
    <script src="js/pettycash-payment/pettycash-payment.js"></script>
    <script> 
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
        pettycash_payment.check_get();
    });
    </script>