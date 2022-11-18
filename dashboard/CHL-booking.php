<?php
session_start();
include 'core/conn.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <style></style>
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

            <div class="">
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" style="color:white;">Petty Cash List (Return)</a></li>
                            <li class="breadcrumb-item active" aria-current="page">SG202201023</li>
                        </ol>
                    </nav>

                </div>
                <div class="row justify-content-center">
                    <div class="">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Booking Detail</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Job number</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-jobno" id="" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Booking number</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="input" class="form-control form-control-sm inp-bkno" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Shipper</label>
                                    <div class="col-sm-9 col-md-4 col-lg-4">
                                        <select class="form-select form-select-sm inp-shper">
                                            <?php
                                            $shipper_select = "SELECT * FROM shipper";
                                            $result_shipper = mysqli_query($con, $shipper_select);
                                            ?>
                                            <option selected="">Please select shipper</option>
                                            <?php
                                            while ($result_shipper_total = mysqli_fetch_assoc($result_shipper)) {
                                            ?>
                                                <option value="<?= $result_shipper_total['ID'] ?>"><?php echo $result_shipper_total['shipper_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="">Shipment Terms</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm inp-shptrm">
                                            <?php
                                            $shipment_select = "SELECT * FROM shipment_term";
                                            $result_shipment = mysqli_query($con, $shipment_select);
                                            ?>
                                            <option selected="">Please select shipment term</option>
                                            <?php
                                            while ($result_shipment_total = mysqli_fetch_assoc($result_shipment)) {
                                            ?>
                                                <option value="<?= $result_shipment_total['ID'] ?>"><?php echo $result_shipment_total['st_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Remark</label>
                                    <div class="col-sm-9 col-md-8 col-lg-7">
                                        <input type="input" class="form-control form-control-sm inp-rmk" id="" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Carrier:</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm inp-carrier">
                                            <?php
                                            $carrier_select = "SELECT * FROM carrier";
                                            $result_carrier = mysqli_query($con, $carrier_select);
                                            ?>
                                            <option selected="">Please select carrier</option>
                                            <?php
                                            while ($result_carrier_total = mysqli_fetch_assoc($result_carrier)) {
                                            ?>
                                                <option value="<?= $result_carrier_total['ID'] ?>"><?php echo $result_carrier_total['carrier_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Port of Receipt</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm inp-prtrecieve">
                                            <?php

                                            $area_select = "SELECT * FROM area";
                                            $result_area = mysqli_query($con, $area_select);
                                            ?>
                                            <option selected="">Please select Port of Receipt</option>
                                            <?php
                                            while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                            ?>
                                                <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Port of Loading</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm inp-prtload">
                                            <?php
                                            $area_select = "SELECT * FROM area";
                                            $result_area = mysqli_query($con, $area_select);
                                            ?>
                                            <option selected="">Please select Port of Loading</option>
                                            <?php
                                            while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                            ?>
                                                <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">T/S Port</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm inp-ts_port">
                                            <?php
                                            $area_select = "SELECT * FROM area";
                                            $result_area = mysqli_query($con, $area_select);
                                            ?>
                                            <option selected="">Please select T/S Port</option>
                                            <?php
                                            while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                            ?>
                                                <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Port of Delivery</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm inp-delivery">
                                            <?php
                                            $area_select = "SELECT * FROM area";
                                            $result_area = mysqli_query($con, $area_select);
                                            ?>
                                            <option selected="">Please select Port of Delivery</option>
                                            <?php
                                            while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                            ?>
                                                <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['Provice'] . " ," . $result_area_total['Country'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Mother Vessel:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-M_vessel" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-2 align-self-center mb-0" for="">Voy No.:</label>
                                            <div class="col-lg-4 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-mother-voy-no" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">Feeder Vessel:</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-5">
                                                <input type="text" class="form-control form-control-sm feeder_vessel" placeholder="">
                                            </div>
                                            <label class="control-label col-sm-1 col-md-2 col-lg-2  align-self-center mb-0" for="">Voy No.:</label>
                                            <div class="col-lg-4 col-md-5">
                                                <input type="text" class="form-control form-control-sm inp-feeder_voy_no" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">ETD:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="date" class="form-control form-control-sm inp-etd" id="" value="2019-12-18">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center mb-0" for="">ETA:</label>
                                    <div class="col-sm-9 col-md-4 col-lg-3">
                                        <input type="date" class="form-control form-control-sm inp-eta" id="" value="2019-12-18">
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
                                            <table id="basic-table" name="container-tbl" class="table table-striped mb-0" role="grid">
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
                                                    <tr class="booking_container">
                                                        <td class="td-sel-conttype"><select class="form-select form-select-sm shadow-none inp-container_type">
                                                                <?php
                                                                $Container_type_select = "SELECT * FROM container_type";
                                                                $result_Container_type = mysqli_query($con, $Container_type_select);
                                                                ?>
                                                                <option selected="">Please select container type</option>
                                                                <?php
                                                                while ($result_Container_type_total = mysqli_fetch_assoc($result_Container_type)) {
                                                                ?>
                                                                    <option value="<?= $result_Container_type_total['container_type_number'] ?>"><?php echo $result_Container_type_total['container_type_name'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select></td>
                                                        <td><input type="input" class="form-control form-control-sm inp-contqty" id="" placeholder=""></td>
                                                        <td><input type="input" class="form-control form-control-sm inp-single-wieght" id="" placeholder=""></td>
                                                        <td><input class="form-check-input inp-soc" type="checkbox" value="" id="flexCheckDefault"></td>
                                                        <td><input class="form-check-input inp-ow" type="checkbox" value="" id="flexCheckDefault"></td>
                                                        <td onclick="booking.del_container_row(this);"><svg class="del-tr" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                                                <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                                            </svg>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <button type="button" class="btn btn-link btn-soft-light rounded-pill" onclick="booking.addconthtml();">add new</button>

                                        <p></p>
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">CY:</label>
                                        <div class="col-sm-9 col-md-4 col-lg-3 ">
                                            <input type="date" class="form-control form-control-sm inp-cy" id="" value="2019-12-18">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">RTN:</label>
                                        <div class="col-sm-9 col-md-4 col-lg-3 ">
                                            <input type="date" class="form-control form-control-sm inp-rtn" id="" value="2019-12-18">
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
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Cargo description</label>
                                        <div class="col-sm-9 col-md-7 col-lg-7">
                                            <input type="input" class="form-control form-control-sm inp-cargodes" id="" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">H.S.Code:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-6">
                                            <select class="form-select form-select-sm inp-hscode">
                                                <?php
                                                $hs_select = "SELECT * FROM hs_code";
                                                $result_hs = mysqli_query($con, $hs_select);
                                                ?>
                                                <option selected="">Please select H.S Code</option>
                                                <?php
                                                while ($result_hs_total = mysqli_fetch_assoc($result_hs)) {
                                                ?>
                                                    <option value="<?php $result_hs_total['ID'] ?>"><?php echo "" . $result_hs_total['hs_code'] . " " . $result_hs_total['hs_decription'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Cargo Type:</label>
                                        <div class="col-sm-9 col-md-4 col-lg-4">
                                            <select class="form-select form-select-sm inp-cargo_type">
                                                <?php
                                                $cargo_type_select = "SELECT * FROM cargo_type";
                                                $result_cargo_type = mysqli_query($con, $cargo_type_select);
                                                ?>
                                                <option selected="">Please select cargo type</option>
                                                <?php
                                                while ($result_cargo_type_total = mysqli_fetch_assoc($result_cargo_type)) {
                                                ?>
                                                    <option value="<?php $result_cargo_type_total['cargo_type_number'] ?>"><?php echo $result_cargo_type_total['cargo_type_name'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Quantity:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm inp-cargo_qty" aria-describedby="basic-addon2">
                                                <span class="input-group-text" id="basic-addon2">Package</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">G.W:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control inp-cargo_gw" aria-describedby="basic-addon2">
                                                <span class="input-group-text" id="basic-addon2">KGS</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Volume:</label>
                                        <div class="col-sm-9 col-md-5 col-lg-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control inp-cargo_vol" aria-describedby="basic-addon2">
                                                <span class="input-group-text" id="basic-addon2">M3</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 align-self-center mb-0" for="">Marks:</label>
                                        <div class="col-sm-9 col-md-8 col-lg-7">
                                            <input type="input" class="form-control form-control-sm inp-cargo_marks" id="" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div style="float: right">
                                    <button class="btn btn-success rounded-pill btn-save-booking " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="booking.save_booking();"><i class="bi bi-check-square"></i> Save</button>
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

<script src="js/booking/booking.js"></script>
<script>
</script>