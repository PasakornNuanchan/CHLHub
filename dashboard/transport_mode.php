<?php
include 'core/conn.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Transport</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




</head>

<body style="zoom:70%">

    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="text-center">CHLTH</h3>
            </div>

            <div class="card-body p-5">

                <div class="form-group row">
                    <h4 class="text-center text_languages">languages</h4>
                    <select name="" id="" class="form-select form-select-sm rounded sel_langague" onchange="func_transport_mode.select_language()">
                        <option value="TH" selected>ภาษาไทย</option>
                        <option value="EN">English</option>
                    </select>
                </div>

                <h4 class="text-center text_address">Address</h4>
                <div class="form-group row mt-3">
                    <label class="text-center text_pickup_emp_container">Pickup Empty Container Address</label>
                    <textarea class="form-control form-control-sm rounded inp_pick_emt inp_pick_emt_remark"cols="30" rows="5" readonly></textarea>
                    <button class="btn btn-outline-primary btn-sm btn_pick_emt "><i class="bi bi-map"></i> google maps</button>
                    <!-- <input type="text" class="form-control form-control-sm rounded inp_pick_emt" name="" id=""> -->
                    <!-- <input type="text" class="form-control form-control-sm rounded inp_pick_emt_remark" name="" id=""> -->
                </div>
                <div class="form-group row">
                    <label class="text-center text_loading_address">Loading Address</label>
                    <textarea class="form-control form-control-sm rounded inp_loading inp_loading_remark"cols="30" rows="5" readonly></textarea>
                    <button class="btn btn-outline-primary btn-sm btn_loading"><i class="bi bi-map"></i> google maps</button>
                    <!-- <input type="text" class="form-control form-control-sm rounded inp_loading" name="" id=""> -->
                    <!-- <input type="text" class="form-control form-control-sm rounded inp_loading_remark" name="" id=""> -->
                </div>
                <div class="form-group row">
                    <label class="text-center text_delivery_container">Delivery Container Address</label>
                    <textarea class="form-control form-control-sm rounded inp_delivery inp_delivery_remark"cols="30" rows="5" readonly></textarea>
                    <button class="btn btn-outline-primary btn-sm btn_delivery"><i class="bi bi-map"></i> google maps</button>
                    <!-- <input type="text" class="form-control form-control-sm rounded inp_delivery" name="" id=""> -->
                    <!-- <input type="text" class="form-control form-control-sm rounded inp_delivery_remark" name="" id=""> -->
                </div>
                <div class="form-group row">
                    <label class="text-center text_drop_off_emp_container">Drop off Empty Containe Address</label>
                    <textarea class="form-control form-control-sm rounded inp_drop_off inp_drop_off_remark"cols="30" rows="5" readonly></textarea>
                    <button class="btn btn-outline-primary btn-sm btn_drop_off"><i class="bi bi-map"></i> google maps</button>
                    <!-- <input type="text" class="form-control form-control-sm rounded inp_drop_off" name="" id=""> -->
                    <!-- <input type="text" class="form-control form-control-sm rounded inp_drop_off_remark" name="" id=""> -->
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h4 class="text-center text_detail">Detail</h4>
            </div>
            <div class="card-body p-5">
                <div class="driver_data">
                    <div class="form-group row">
                        <label class="text-center text_driver">Driver</label>
                        <input type="text" class="form-control form-control-sm rounded" name="" id="">
                    </div>
                    <div class="form-group row">
                        <label class="text-center text_container">Container</label>
                        <input type="text" class="form-control form-control-sm rounded" name="" id="">
                    </div>
                </div>

            </div>
        </div>
        <div class="status_delivery">
            <!-- <div class="card mt-2">
                <div class="card-header">
                    <h4 class="text-center text_arrived_deivery">Arrived Delivery Address</h4>
                </div>
                <div class="card-body p-5">
                    <div class="from-group row">
                        <label class="text-center text_datetime">Date Time</label>
                        <input type="text" class="form-control form-control-sm rounded">
                    </div>
                    <div class="form-group row mt-2">
                        <button class="btn btn-success text_arrived_deivery">Arrived Delivery Address</button>
                    </div>
                </div>
            </div> -->
            <div class="card mt-2">
                <div class="card-header">
                    <h4 class="text-center text_delivered">Delivered</h4>
                </div>
                <div class="card-body p-5">
                    <div class="from-group row">
                        <label class="text-center text_datetime">Date Time</label>
                        <input type="text" class="form-control form-control-sm rounded">
                    </div>
                    <div class="form-group row mt-2">
                        <button class="btn btn-success text_delivered">Delivered</button>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <h4 class="text-center text_return_to_cy">Return to CY</h4>
                </div>
                <div class="card-body p-5">
                    <div class="from-group row">
                        <label class="text-center text_datetime">Date Time</label>
                        <input type="text" class="form-control form-control-sm rounded">
                    </div>
                    <div class="form-group row mt-2">
                        <button class="btn btn-success text_return_to_cy">Return</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/transport_mode/func_transport_mode.js"></script>
<script src="js/transport_mode/first_setting.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(async function() {
        await first_setting.setting_data();
        await func_transport_mode.select_language();
    })
</script>