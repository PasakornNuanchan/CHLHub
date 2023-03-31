<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quotation list</title>
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
        
            <div class="row ">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row">
                                <!-- <label class="control-label col-sm-2 col-lg-2 align-self-center mb-0" for="pwd2">Quotation status:</label> -->
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <!-- <select name="" id="" class="form form-select form-select-sm">
                                                <option value="">All</option>
                                                <option value="">Sign</option>
                                                <option value="">Not Sign</option>
                                            </select> -->
                                        </div>
                                        <div class="col-lg-7"></div>
                                        <div class="col-lg-2">
                                            <button type="button" target="_blank" onclick="quartation_list_create.create();" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float: right;"><i class="bi bi-eye"></i> Add Quotation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bd-example table-responsive">
                                <table id="datatable" class="table table-hover" name="data_table_list" data-toggle="data-table" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
                                    <thead>
                                        <tr class="text-center bg-gradient" style="background-color :#0D47A1; color :aliceblue;">
                                            <th>Create Date</th>
                                            <th>Quotation number</th>
                                            <th>Sale</th>
                                            <th>Consignee</th>
                                            <th>Quotation Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">

                                        <?php
                                        $sql_query = "
                                SELECT 
                                    qt.create_datetime,
                                    qt.quartation_number,
                                    sale.first_name,
                                    sale.last_name,
                                    c.consignee_name,
                                    qt.type,
                                    qt.status
                                FROM 
                                quartation_title as qt
                                INNER JOIN user as sale ON qt.user_sale = sale.user_number
                                INNER JOIN consignee as c ON qt.consignee_number = c.consignee_number
                                ";

                                        $fetch_sql = mysqli_query($con, $sql_query);
                                        while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                        if($result_table_list['status'] == 1) {
                                            $status_quo_list = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">sign</span>';
                                        } else {
                                            $status_quo_list = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">unsign</span>';
                                        }

                                        ?>
                                            <tr>
                                                <td><?= $result_table_list['create_datetime']; ?></td>
                                                <td><?= $result_table_list['quartation_number']; ?></td>
                                                <td><?= $result_table_list['first_name']; ?> <?= $result_table_list['last_name']; ?></td>
                                                <td><?= $result_table_list['consignee_name']; ?></td>
                                                <td><?= $result_table_list['type']; ?></td>
                                                <td><?= $status_quo_list ?></td>
                                                <td><button type="button" onclick="quartation_list.preview('<?= $result_table_list['quartation_number']; ?>');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
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

<script src="js/quotation-list/quotation_list.js"></script>
<script src="js/quotation-list/quotation_list_set.js"></script>
<script src="js/quotation-list/quotation_list_create.js"></script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        quotation_list_set.set_data_rows();
    });
</script>