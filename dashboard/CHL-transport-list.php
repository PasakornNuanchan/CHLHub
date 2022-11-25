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


            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="mt-4">
                                <table id="basic-table" class="table table-striped table-hover mb-0" role="grid">
                                    <thead>
                                        <tr>
                                            <th>Create Date</th>
                                            <th>Job number</th>
                                            <th>Consignee</th>
                                            <th>Type</th>
                                            <th>ETA</th>
                                            <th>T/S Port</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                 
                                        <?php
                                        $sql_table_list = "SELECT jt.create_date,jt.job_number,IF(jt.type_import_export=1,'Export','Import') as import_export,c.consignee_name,a.location_name,a.country,jt.eta,(SELECT COUNT(*) FROM transport_booking WHERE job_number = jt.job_number) AS status
                                        FROM job_title as jt 
                                        INNER JOIN consignee as c ON jt.consignee_number = c.consignee_number
                                        INNER JOIN area as a ON jt.ts_port_number = a.area_number
                                        WHERE jt.status_job ='0'";


                                        $fetch_sql = mysqli_query($con, $sql_table_list);
                                        while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                        ?>
                                        <tr>
                                            <td><?= $result_table_list['create_date'] ?></td>
                                            <td><?= $result_table_list['job_number'] ?></td>
                                            <td><?= $result_table_list['consignee_name'] ?></td>
                                            <td><?= $result_table_list['import_export'] ?></td>
                                            <td><?= $result_table_list['eta'] ?></td>
                                            <td><?= $result_table_list['location_name'] ?> ,<?= $result_table_list['country'] ?></td>
                                            <td><?= $result_table_list['status'] ?></td>
                                            <td>010</td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
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