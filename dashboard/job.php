<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
?>
<!doctype html>
<html lang="en" dir="ltr">
<style>
    .table tr {
        padding-left: 0px;
        padding-right: 0px;
    }

    .table {
        width: 100%;
        /* กำหนดความกว้างของตารางเป็น 100% */
        table-layout: fixed;
        /* ทำให้ความกว้างของเซลล์ในตารางเป็นคงที่ */
        overflow-x: auto;
        white-space: nowrap;
        /* ป้องกันข้อความขึ้นบรรทัดใหม่ */
    }

    .table th,
    .table td {
        /* กำหนดความกว้างสูงสุดของเซลล์ในตาราง */
        overflow: hidden;
        text-overflow: ellipsis;
        /* การแสดง ... สำหรับข้อความที่เกินขนาดเซลล์ */
        white-space: nowrap;
    }

    @media only screen and (max-width: 768px) {

        .table th:nth-child(1),
        .table th:nth-child(2),
        .table th:nth-child(3),
        .table th:nth-child(4),
        .table th:nth-child(5),
        .table th:nth-child(6),
        .table th:nth-child(7),
        .table th:nth-child(8),
        .table th:nth-child(9),
        .table th:nth-child(10) {
            width: 120px;

        }
    }

    
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Job</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
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

            <!-- breadcrumb -->

            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <!-- Booking -->
                    <div class="card p-3">
                        <div class="form-group row">
                            <div class="col-sm-2"></div>
                            <div class="col-lg-12">
                                <button type="button" onclick="job_list.set_to_page_create();" class="btn btn-success rounded-pill btn-sm bg-gradient btn_create_job" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float: right;"><i class="bi bi-eye"></i> Add Booking</button>
                            </div>
                        </div>
                        <div class="bd-example table-responsive">
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr class="text-center bg-gradient p-1" style="background-color :#0D47A1; color :aliceblue;">
                                        <th>Action</th>
                                        <th>Job number</th>
                                        <th>Sale Support</th>
                                        <th>Client</th>
                                        <th>Booking number</th>
                                        <th>POL</th>
                                        <th>POD</th>
                                        <th>ETD</th>
                                        <th>ETA</th>
                                        <!-- <th>Payable</th> -->
                                        <!-- <th>Receivable</th> -->
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;">

                                </tbody>
                            </table>
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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="js/job_list/job_list.js"></script>


<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        job_list.set_header_page();
    });
</script>