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
                                <h4 class="card-title">Account Receivable</h4>
                                <div style="float: right">
                                    <button class="btn btn-success rounded-pill btn-save-booking " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ><i class="bi bi-check-square"></i> Export</button>
                                    <button class="btn btn-warning rounded-pill btn-save-booking " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ><i class="bi bi-check-square"></i> Print</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row">
                                        <div class="table-responsive mt-4">
                                            <table id="basic-table" class="table table-striped mb-0" role="grid">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Code.</th>
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
                                                        <th>CN#</th>
                                                        <th>Action</th>
                                                        <th>Paid Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>1</td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select>
                                                        </td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select>
                                                        </td>
                                                        <td>Prepaid</td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select></td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select></td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning rounded-pill btn-xs"><i class="bi bi-pencil-fill"></i> Edit</button>
                                                            <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-trash"></i> Delete</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-success rounded-pill btn-xs"><i class="bi bi-cash-coin"></i> Paid</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-link btn-soft-light rounded-pill">add new</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-lg-1 align-self-center mb-0" for="">Total:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-M_vessel" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">THB</label>
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">RMB</label>
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">USD</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-lg-1 align-self-center mb-0" for="">Sub Total:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-M_vessel" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">THB</label>
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">RMB</label>
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">USD</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title">Account Payble</h4>
                                <div style="float: right">
                                    <button class="btn btn-success rounded-pill btn-save-booking " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ><i class="bi bi-check-square"></i> Export</button>
                                    <button class="btn btn-warning rounded-pill btn-save-booking " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ><i class="bi bi-check-square"></i> Print</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row">
                                        <div class="table-responsive mt-4">
                                            <table id="basic-table" class="table table-striped mb-0" role="grid">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>Code.</th>
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
                                                        <th>CN#</th>
                                                        <th>Action</th>
                                                        <th>Paid Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-center">
                                                        <td>1</td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select>
                                                        </td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select>
                                                        </td>
                                                        <td>Prepaid</td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select></td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td><input type="text" class="form-control"></td>
                                                        <td><select name="" id="" class="form-select shadow-none">
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select></td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning rounded-pill btn-xs"><i class="bi bi-pencil-fill"></i> Edit</button>
                                                            <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-trash"></i> Delete</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-success rounded-pill btn-xs"><i class="bi bi-cash-coin"></i> Paid</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-link btn-soft-light rounded-pill">add new</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-lg-1 align-self-center mb-0" for="">Total:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-M_vessel" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">THB</label>
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">RMB</label>
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">USD</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-lg-1 align-self-center mb-0" for="">Sub Total:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-M_vessel" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">THB</label>
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">RMB</label>
                                            <div class="col-lg-2 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-1 align-self-center mb-0" for="">USD</label>
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