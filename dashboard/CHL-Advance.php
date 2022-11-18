<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Advance Cash</title>
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
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Tranfer Mehthod Tranfer:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm mb-3 shadow-none">
                                            <option value="">Plese select tranfer mehthod</option>
                                            <option value="">Cash</option>
                                            <option value="">Bank Tranfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Bank Name:</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Bank Number:</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
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
                                            <table id="basic-table" class="table table-striped mb-0" role="grid">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>Description</th>
                                                        <th>Amount</th>
                                                        <th>Curency</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>1</td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select></td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning rounded-pill btn-xs"><i class="bi bi-pencil-fill"></i> Edit</button>
                                                            <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-trash"></i> Delete</button>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td>2</td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select></td>
                                                        <td>
                                                            <button type="button" class="btn btn-success rounded-pill btn-xs"><i class="bi bi-check-circle-fill"></i> Save</button>
                                                            <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-x-circle-fill"></i> Cancle</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-link btn-soft-light rounded-pill">add new</button>
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
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Job quantity:</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="2" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Amount:</label>
                                    <div class="col-sm-9">
                                        <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
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