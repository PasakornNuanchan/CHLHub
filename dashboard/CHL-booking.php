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
    <?php require_once 'include/lang_lib.php' ?>
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


            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" style="color:white;">Petty Cash List (Return)</a></li>
                        <li class="breadcrumb-item active" aria-current="page">SG202201023</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-12 col-xl-5">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"><?=$get_lang['Booking_Detail']?></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for=""><?=$get_lang['Job_number']?></label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-jobno" id="" placeholder="" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="">Booking number</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-bkno" id="" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center" for="">Shipper</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm inp-shper">
                                        <?php
                                        $shipper_select = "SELECT * FROM shipper";
                                        $result_shipper = mysqli_query($con, $shipper_select);
                                        ?>
                                        <option selected value="">Please select shipper</option>
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
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm inp-shptrm">
                                        <?php
                                        $shipment_select = "SELECT * FROM shipment_term";
                                        $result_shipment = mysqli_query($con, $shipment_select);
                                        ?>
                                        <option selected value="">Please select shipment term</option>
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
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="input" class="form-control form-control-sm inp-rmk" id="" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="">Carrier:</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm inp-carrier">
                                        <?php
                                        $carrier_select = "SELECT * FROM carrier";
                                        $result_carrier = mysqli_query($con, $carrier_select);
                                        ?>
                                        <option selected value="">Please select carrier</option>
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
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm inp-prtrecieve">
                                        <?php

                                        $area_select = "SELECT * FROM area";
                                        $result_area = mysqli_query($con, $area_select);
                                        ?>
                                        <option selected value="">Please select Port of Receipt</option>
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
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm inp-prtload">
                                        <?php
                                        $area_select = "SELECT * FROM area";
                                        $result_area = mysqli_query($con, $area_select);
                                        ?>
                                        <option selected value="">Please select Port of Loading</option>
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
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm inp-ts_port">
                                        <?php
                                        $area_select = "SELECT * FROM area";
                                        $result_area = mysqli_query($con, $area_select);
                                        ?>
                                        <option selected value="">Please select T/S Port</option>
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
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <select class="form-select form-select-sm inp-delivery">
                                        <?php
                                        $area_select = "SELECT * FROM area";
                                        $result_area = mysqli_query($con, $area_select);
                                        ?>
                                        <option selected value="">Please select Port of Delivery</option>
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
                                        <div class="col-lg-9 col-md-9">
                                            <input type="text" class="form-control form-control-sm inp-feeder_voy_no" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="">ETD:</label>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <input type="date" class="form-control form-control-sm inp-etd" id="" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-sm-3 align-self-center mb-0" for="">ETA:</label>
                                <div class="col-sm-9 col-md-4 col-lg-3">
                                    <input type="date" class="form-control form-control-sm inp-eta" id="" value="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-xl-7">
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
                                            <option selected value="">Please select H.S Code</option>
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
                                            <option selected value="">Please select cargo type</option>
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
                                                            <option selected value="">Please select container type</option>
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
                                                    <td onclick="">
                                                        <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.7688 8.71387H16.2312C18.5886 8.71387 20.5 10.5831 20.5 12.8885V17.8254C20.5 20.1308 18.5886 22 16.2312 22H7.7688C5.41136 22 3.5 20.1308 3.5 17.8254V12.8885C3.5 10.5831 5.41136 8.71387 7.7688 8.71387ZM11.9949 17.3295C12.4928 17.3295 12.8891 16.9419 12.8891 16.455V14.2489C12.8891 13.772 12.4928 13.3844 11.9949 13.3844C11.5072 13.3844 11.1109 13.772 11.1109 14.2489V16.455C11.1109 16.9419 11.5072 17.3295 11.9949 17.3295Z" fill="currentColor"></path>
                                                            <path opacity="0.4" d="M17.523 7.39595V8.86667C17.1673 8.7673 16.7913 8.71761 16.4052 8.71761H15.7447V7.39595C15.7447 5.37868 14.0681 3.73903 12.0053 3.73903C9.94257 3.73903 8.26594 5.36874 8.25578 7.37608V8.71761H7.60545C7.20916 8.71761 6.83319 8.7673 6.47754 8.87661V7.39595C6.4877 4.41476 8.95692 2 11.985 2C15.0537 2 17.523 4.41476 17.523 7.39595Z" fill="currentColor"></path>
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
                            <div style="float: right">
                                <button class="btn btn-success rounded-pill btn-save-booking " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="booking.save_booking();"><i class="bi bi-check-square"></i> Save</button>
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

