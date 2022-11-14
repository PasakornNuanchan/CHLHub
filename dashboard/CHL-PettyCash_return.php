<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Petty Cash return</title>

    <style>
        .card {
            box-shadow: 3px 2px 6px rgba(0, 0, 0, 0.25);
            border-radius: 8px;
            background-color: #0D47A1;
        }

        .table {
            border-radius: 12px;
        }

        .button{
            
        }
       
        
    </style>

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
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" style="color:white;">Petty Cash List (Return)</a></li>
                            <li class="breadcrumb-item active" aria-current="page">SG202201023</li>
                        </ol>
                    </nav>
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between ">
                                <div class="header-title">
                                    <h4 class="card-title fw-normal">Request Petty Cash</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Petty Cash Nubmer :</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Request By:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Datetime Request:</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Tranfer Method:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select form-select-sm" disabled>
                                            <option value="">Plese select tranfer mehthod</option>
                                            <option value="">Cash</option>
                                            <option value="">Bank Tranfer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Bank Name</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Bank Number:</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Tranfer By.</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Tranfer Date time :</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Job Quantity</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Total Tranfer :</label>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm col-sm-2" placeholder="12,000.00" style="text-align: right;" readonly>
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
                                <div class="form-group row">
                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Job Number</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title fw-normal">Description</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row">
                                        <div class="table-responsive mt-4">
                                            <table id="basic-table" class="table mb-0 table table-hover col-sm-12 text-center" role="grid">
                                                <thead>
                                                    <tr class="text-center" style="background-color :#0D47A1; color :aliceblue;">
                                                        <th>No.</th>
                                                        <th>Description</th>
                                                        <th>Petty Cash Amount</th>
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
                                                        <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly></td>
                                                        <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td>2</td>
                                                        <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly></td>
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
                                    <h4 class="card-title fw-normal">Petty Cash Return</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Petty Cash :</label>
                                        <div class="col col-sm-3">
                                            <input type="text" class="form-control form-control-sm col-sm-2" placeholder="12,000.00" style="text-align: right;" readonly>
                                        </div>
                                        <div class="col col-sm-2">
                                            <select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                <option value="" selected>THB</option>
                                                <option value="">USD</option>
                                                <option value="">RMB</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Pay :</label>
                                        <div class="col col-sm-3">
                                            <input type="text" class="form-control form-control-sm col-sm-2" placeholder="12,000.00" style="text-align: right;" readonly>
                                        </div>
                                        <div class="col col-sm-2">
                                            <select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                <option value="" selected>THB</option>
                                                <option value="">USD</option>
                                                <option value="">RMB</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Petty Cash return :</label>
                                        <div class="col col-sm-3">
                                            <input type="text" class="form-control form-control-sm col-sm-2" placeholder="12,000.00" style="text-align: right;" readonly>
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
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Payment medthod :</label>
                                        <div class="col col-sm-3">
                                            <select name="" id="" class="form-select form-select-sm">
                                                <option value="">Bank Tranfer</option>
                                                <option value="">Cash</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Payment By. :</label>
                                        <div class="col col-sm-3">
                                            <input type="text" class="form-control form-control-sm col-sm-2" placeholder="" style="text-align: right;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Payment datetime :</label>
                                        <div class="col col-sm-3">
                                            <input type="date" class="form-control form-control-sm col-sm-2" placeholder="" style="text-align: right;" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Payment Amount :</label>
                                        <div class="col col-sm-3">
                                            <input type="text" class="form-control form-control-sm col-sm-2" placeholder="12,000.00" style="text-align: right;" readonly>
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
                                <div style="float: right">
                                    <button class="btn btn-success" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save</button>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title fw-normal">Description Petty Cash Detail</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group row">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-2 align-self-center mb-0" for="email1">Job number :</label>
                                            <div class="col col-sm-3">
                                                <input type="input" class="form-control form-control-sm col-sm-2" placeholder="" style="text-align: right; " readonly>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="table" class="table mb-0 table table-hover col-sm-12 text-center" role="grid">
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
                                                        <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly></td>
                                                        <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td>2</td>
                                                        <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                                <option value="" selected>Plese select description</option>
                                                                <option value=""></option>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly></td>
                                                        <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                                                                <option value="" selected>THB</option>
                                                                <option value="">USD</option>
                                                                <option value="">RMB</option>
                                                            </select>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <center>
                                        <div class="alert alert-solid col-sm-11" style="background: #10929A; color:white;">
                                            <div class="small">
                                                <label class="control-label col-sm-0 align-self-center fw-bold">Petty Cash :</label>
                                                <label class="control-label col-sm-2 align-self-center" align="right">12,000.00</label>
                                                <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                                                <label class="control-label col-sm-1 align-self-center fw-bold">Pay :</label>
                                                <label class="control-label col-sm-2 align-self-center" align="right">12,000.00</label>
                                                <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                                                <label class="control-label col-sm-2 align-self-center fw-bold">Pay Return :</label>
                                                <label class="control-label col-sm-2 align-self-center" align="right">12,000.00</label>
                                                <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                                            </div>
                                        </div>
                                    </center>
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
    <?php include '../assets/include/theme_include.php'; ?>
</body>

</html>