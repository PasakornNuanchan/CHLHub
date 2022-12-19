<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quotation</title>
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
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="control-label col-sm-2 col-lg-2 align-self-center mb-0" for="pwd2">Quotation status:</label>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <select name="" id="" class="form form-select form-select-sm">
                                                <option value="">All</option>
                                                <option value="">Sign</option>
                                                <option value="">Not Sign</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-7"></div>
                                        <div class="col-lg-2">
                                            <button type="button" target="_blank" onclick="" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float: right;"><i class="bi bi-eye"></i> Add Quotation</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bd-example table-responsive">
                            <table id="datatable" class="table table-striped" data-toggle="data-table" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
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
                                    $sql_table_list = "SELECT * FROM quartation_title as qt
                                    INNER JOIN consignee as c ON qt.consignee_number = c.consignee_number
                                    INNER JOIN user as u ON qt.user_sale = u.user_number";


                                    $fetch_sql = mysqli_query($con, $sql_table_list);
                                    while ($result_table_list = mysqli_fetch_assoc($fetch_sql)) {
                                        $quartation_number = $result_table_list['quartation_number'];
                                        
                                        if($status = $result_table_list['status'] == '1'){
                                            $rs = "<span class='badge rounded-pill bg-success'>sign</span>";
                                        } else {
                                            $rs = "<span class='badge rounded-pill bg-danger'>unsign</span>";
                                        } 
                                        
                                    ?>
                                        <tr>
                                            <td><?= $result_table_list['create_datetime'] ?></td>
                                            <td><?= $result_table_list['quartation_number'] ?></td>
                                            <td><?= $result_table_list['first_name'] ?></td>
                                            <td><?= $result_table_list['consignee_name'] ?></td>
                                            <td><?= $result_table_list['type'] ?></td>
                                            <td><?= $rs ?> 
                                            <td><button type="button" onclick="quartation_list.preview(<?=$quartation_number?>);" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
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