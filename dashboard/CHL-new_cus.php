<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>New Customer</title>
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
                                            <!-- <button type="button" target="_blank" onclick="carrier_sent_create.create_carrier()" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float: right;"><i class="bi bi-eye"></i> Add Carrier</button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bd-example table-responsive">
                                <table id="datatable" class="table table-hover" data-toggle="data-table" name="data_table_list" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone number</th>
                                            <th>Message</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $sql_table_list = "
                                        SELECT * FROM `new_quest_cus`
                                        ";
                                        $fetch_sql = mysqli_query($con, $sql_table_list);
                                        while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {

                                        ?>
                                            <tr>
                                                <td><?= $result_table_list['ID'] ?></td>
                                                <td><?= $result_table_list['name'] ?></td>
                                                <td><?= $result_table_list['email'] ?></td>
                                                <td><?= $result_table_list['phone'] ?></td>
                                                <td><?= $result_table_list['message'] ?></td>
                                                <td><button onclick="new_cus.delete_data('<?= $result_table_list['ID']?>')" class="btn btn-danger">Delete</button></td>
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
<script src="js/new_cus/new_cus.js"></script>

<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        new_cus.set_data_head();
    });
</script>