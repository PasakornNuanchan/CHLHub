<?php
include 'core/conn.php';
require 'function/auth/get_session.php';
include 'core/con_path.php';
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User List</title>
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
                            <div class="bd-example table-responsive">
                                <table class="table table-hover" name="data_table_list" data-toggle="data-table" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>User number</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>mobile phone</th>
                                            <th>status</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                         $sql_table_list = "
                                         SELECT * FROM user
                                            ";
                                        $fetch_sql = mysqli_query($con, $sql_table_list);
                                        while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                            $sal = '';
                                            if($result_table_list['status'] == '1' ){
                                               $sal = '<button class="btn btn-success rounded-pill btn-sm"> Save</button>'; 
                                             }
                                        ?>
                                            <tr>
                                                <td><?= $result_table_list['ID'] ?></td>
                                                <td><?= $result_table_list['first_name']; ?> <?= $result_table_list['last_name']; ?></td>
                                                <td><?= $result_table_list['email']; ?></td>
                                                <td><?= $result_table_list['mobile_number']; ?></td>
                                                <td><?=  $sal ?></td>
                                                <td><button type="button" onclick="pettycash_list.preview('<?= $result_table_list['petty_cash_number']; ?>');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
                                                
                                            </tr>
                                        <?php }; ?>

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

<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
       
    });
</script>
