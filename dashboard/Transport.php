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
                                        <h4 class="card-title">Booking Detail</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Job number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Booking number:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Shipper:</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none" >

                                                <?php
                                                $shipper_select = "SELECT * FROM carrier";
                                               
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Shipment Terms</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $shipment_select = "SELECT * FROM shipment_term";
                                               
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Remark</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Carrier:</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $carrier_select = "SELECT * FROM carrier";
                                                
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Receipt</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                               
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Loading</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                               
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">T/S Port</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                               
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Port of Delivery</label>
                                        <div class="col-sm-9">
                                            <select class="form-select form-select-sm mb-3 shadow-none">
                                                <?php
                                                $area_select = "SELECT * FROM area";
                                               
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3  align-self-center mb-0" for="pwd2">Mother Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-1 align-self-center mb-0" for="pwd2">Voy No. :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Feeder Vessel:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <label class="control-label col-sm-1 align-self-center mb-0" for="pwd2">Voy No. :</label>
                                                <div class="col">
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Voy No.:</label>
                                        <div class="col-sm-9">
                                            <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">ETD:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">ETA:</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Container</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group row">
                                            <div class="table-responsive mt-4">
                                                <table id="basic-table" class="table table-striped mb-0" role="grid">
                                                    <thead>
                                                        <tr>
                                                            <th>Container type</th>
                                                            <th>Container Quantity</th>
                                                            <th>Single CNT Weight</th>
                                                            <th>SOC</th>
                                                            <th>OW</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><select class="form-select form-select-sm shadow-none">
                                                                    <?php
                                                                    $Container_type_select = "SELECT * FROM container_type";
                                                                   
                                                                    ?>
                                                                </select></td>
                                                            <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
                                                            <td><input type="input" class="form-control form-control-sm" id="pwd2" placeholder=""></td>
                                                            <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                                                            <td><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></td>
                                                            <td><svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                                                    <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                                                </svg>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <button type="submit" class="btn btn-link btn-soft-light rounded-pill">add new</button>

                                            <p></p>
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">CY:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">RTN:</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control form-control-sm" id="pwd2" value="2019-12-18">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Container Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Cargo description</label>
                                            <div class="col-sm-9">
                                                <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">H.S.Code:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">
                                                    <?php
                                                    $hs_select = "SELECT * FROM hs_code";
                                                   
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="email1">Cargo Type:</label>
                                            <div class="col-sm-9">
                                                <select class="form-select form-select-sm mb-3 shadow-none">

                                                    <?php
                                                    $cargo_type_select = "SELECT * FROM cargo_type";
                                                    
                                                    ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Quantity:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">Package</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">G.W:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">KGS</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Volume:</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                                                    <span class="input-group-text" id="basic-addon2">M3</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 align-self-center mb-0" for="pwd2">Marks:</label>
                                            <div class="col-sm-9">
                                                <input type="input" class="form-control form-control-sm" id="pwd2" placeholder="">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary rounded-pill ">
                                            <span class="btn-inner">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                            Save
                                        </button>

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