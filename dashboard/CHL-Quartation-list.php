<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quartation</title>
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
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h3 class="card-title">Quartation</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 col-lg-2 align-self-center mb-0" for="pwd2">Document status:</label>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <select name="" id="" class="form form-select form-select-sm">
                                                <option value="">All</option>
                                                <option value="">Sign</option>
                                                <option value="">Not Sign</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-7"></div>
                                        <div class="col-lg-2" style="float: right">
                                            <button type="button" target="_blank" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Add Quartation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bd-example table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                <thead>
                                    <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                        <th>Create Date</th>
                                        <th>Quartation number</th>
                                        <th>Sale</th>
                                        <th>Consignee</th>
                                        <th>Quartation Type</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody align="center">
                                    <tr>
                                        <td>2022-12-01</td>
                                        <td>QT2022120001</td>
                                        <td>Champ</td>
                                        <td>Test co.,ltd</td>
                                        <td>Import</td>
                                        <td>Not Sign</td>
                                        <td>Ocean Freight</td>
                                        <td><button type="button" onclick="location.href='CHL-quartation.php';" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
                                    </tr>
                                    <tr>
                                        <td>2022-12-01</td>
                                        <td>QT2022120002</td>
                                        <td>Champ</td>
                                        <td>Oversea co.,ltd</td>
                                        <td>Export</td>
                                        <td>Sign</td>
                                        <td>Air Freight</td>
                                        <td><button type="button" onclick="location.href='CHL-quartation.php';" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
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