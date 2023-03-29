<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Carrier</title>
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-7"></div>
                                        <div class="col-lg-2">
                                            <button type="button" target="_blank" onclick="carrier_sent_create.create_carrier()" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float: right;"><i class="bi bi-eye"></i> Add Carrier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bd-example table-responsive">
                                <table id="datatable" class="table table-hover" data-toggle="data-table" name="data_table_list" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Carrier Name</th>
                                            <th>Carrier Sub Name</th>
                                            <th>Email</th>
                                            <th>Phone number</th>
                                            <th>Contact</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $sql_table_list = "
                                        SELECT * FROM `carrier`
                                        ";
                                        $fetch_sql = mysqli_query($con, $sql_table_list);
                                        while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {

                                        ?>
                                            <tr>
                                                <td><?= $result_table_list['carrier_name'] ?></td>
                                                <td><?= $result_table_list['carrier_sub_name'] ?></td>
                                                <td><?= $result_table_list['email'] ?></td>
                                                <td><?= $result_table_list['phone_number'] ?></td>
                                                <td><?= $result_table_list['contact_name'] ?></td>
                                                <td><button type="button" onclick="carrier_sent.preview('<?= $result_table_list['ID']; ?>');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
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
<script src="js/carrier_list/carrier_list_sent.js"></script>
<script src="js/carrier_list/carrier_list_sent_create.js"></script>
<script src="js/carrier_list/carrier_list_set.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        carrier_list_set.set_data_head();
    });
</script>