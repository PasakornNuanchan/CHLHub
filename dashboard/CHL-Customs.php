<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
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
                                        <h4 class="card-title">Transport</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Container Quantity:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Pallet :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Booking Transport Detail</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Supplier:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">
                                                    <?php
                                                   
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Pickup Empty Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Pickup Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Drop off Container Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Drop off Empty Containe Address:</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                    <label class="control-label col-sm-2 align-self-center mb-0" for="pwd2">Remark :</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Budget:</label>
                                                <div class="col-sm-9">
                                                    <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary rounded-pill btn-sm ">
                                            <span class="btn-inner">
                                                <i class="bi bi-check-square"></i>
                                            </span>
                                            Save
                                        </button>
                                        <button class="btn btn-success rounded-pill btn-sm">
                                            <span class="btn-inner">
                                                <i class="bi bi-line"></i>
                                            </span>
                                            Sent to line group
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Confirm status</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Sent Request Line :</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Supplier Confirm :</label>
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
    <?php include '../assets/include/theme_include.php'; ?>
</body>

</html>