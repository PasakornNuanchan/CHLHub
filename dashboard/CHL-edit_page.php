<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Management</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="  ">
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <?php include 'include/sidebarmain.php'; ?>


    <main class="main-content">
        <div class="position-relative iq-banner">

            <?php include 'include/nevbarmain.php'; ?>

        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="card">
                <div class="card-header">
                    <h4>Edit page chlth</h4>
                </div>
                <div class="card-body">
                    <h5>Header</h5>
                    <!-- header -->
                    <div class="header_pageth"></div>
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <button class="btn btn-block btn-success btn-sm mt-2 " onclick="edit_page_th.add_header();">add header</button>
                        </div>
                    </div>
                    <!-- service -->
                    <h5 class="mt-2">Service</h5>
                    <div class="service_pageth"></div>
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <button class="btn btn-block btn-success btn-sm mt-2 " onclick="edit_page_th.add_service();">add service</button>
                        </div>
                    </div>

                    <!-- event -->
                    <h5 class="mt-2">Event</h5>
                    <div class="event_pageth"></div>
                    <div class="row">
                        <div class="col-xl-2"></div>
                        <div class="col-xl-8">
                            <button class="btn btn-block btn-success btn-sm mt-2 " onclick="edit_page_th.add_event();">add event</button>
                        </div>
                    </div>
                    <!-- about -->
                    <h5>About</h5>
                    <div class="about_pageth"></div>
                    <!-- contact us -->
                    <h5 class="mt-2">Contact us</h5>
                    <div class="contact_pageth"></div>
                    <button class="btn btn-success" onclick="edit_page_th.get_data_before_save()">save</button>
                </div>
            </div>
        </div>


        <?php include 'include/footermain.php'; ?>

    </main>
    <?php include 'include/offcanvas.php'; ?>
    <?php include '../assets/include/theme_include_js.php'; ?>
</body>

</html>

<!-- <script src="js/customer_management/customer_managemnet.js"></script> -->

<script src="js/edit_pageth/edit_pageth.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        edit_page_th.start();
        // customer_management.set_data_head();
        // customer_management.check_get()
    });
</script>