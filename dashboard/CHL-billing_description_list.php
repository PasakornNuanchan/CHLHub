<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Billing description list</title>
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
                                            <button type="button" target="_blank" onclick="sent_create.sent_management()" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float: right;"><i class="bi bi-eye"></i> Add Billing Description</button> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bd-example table-responsive">
                                <table id="datatable" class="table table-hover" data-toggle="data-table" name="data_table_list" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class=" bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th class="text-center">No.</th>
                                            <th>Area Name</th>
                                            <th>Provice</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $sql_table_list = "
                                        SELECT * FROM `billing_description`
                                        ";
                                        $fetch_sql = mysqli_query($con, $sql_table_list);
                                        $i++;
                                        while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                          
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $i;$i++; ?></td>
                                                <td><?= $result_table_list['billing_code']?></td>
                                                <td><?= $result_table_list['billing_item_name']?></td>
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
<script src="js/billing_description_list/bd_list_sent_create.js"></script>
<script src="js/billing_description_list/bd_list_sent.js"></script>
<script src="js/billing_description_list/bd_list_set.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        bd_list_set.set_data_head();
    });
</script>