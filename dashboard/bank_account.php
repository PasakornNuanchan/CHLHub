<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bank Account</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />





</head>

<style>
    .table_data_account td:nth-child(2) input{
        width: 80px;
    }


    .table_data_account td:nth-child(6) input,
    .table_data_account td:nth-child(7) input,
    .table_data_account td:nth-child(9) input,
    .table_data_account td:nth-child(11) input{
        width: 250px;

    }


    .table_data_account td:nth-child(3) input,
    .table_data_account td:nth-child(4) input,
    .table_data_account td:nth-child(5) input,
    .table_data_account td:nth-child(8) input,
    .table_data_account td:nth-child(10) input,
    .table_data_account td:nth-child(12) input,
    .table_data_account td:nth-child(14) input,
    .table_data_account td:nth-child(15) input,
    .table_data_account td:nth-child(16) input,
    .table_data_account td:nth-child(17) input,
    .table_data_account td:nth-child(18) input{
        width: 150px;
    }

    .table_data_account td:nth-child(15) input,
    .table_data_account td:nth-child(16) input,
    .table_data_account td:nth-child(17) input,
    .table_data_account td:nth-child(18) input{
        width: 200px;
    }

    
</style>


<body class="" style="">
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

            <!-- headtab -->
            
            <div class="card">
                <div class="card-header">
                    <h4>Bank Account</h4>
                </div>
                <div class="card-body">
                    <div>
                        <div class="form-group">
                            <button class="btn btn-outline-primary btn-sm" onclick="function_bac.function_add()"><i class="bi bi-plus"></i> Add</button>
                            <button class="btn btn-outline-success btn-sm"><i class="bi bi-save"></i> Save</button>
                            <button class="btn btn-outline-warning btn-sm"><i class="bi bi-printer"></i> Print</button>
                        </div>
                    </div>
                    <div class="bd-example">
                        <h5>Filter : </h5>
                        <!-- <div class="row g-3">
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Bill to</label>
                                <input type="text" class="form-control form-control-sm inp_data_bill_to" list="bill_to_list">
                                <datalist class="bill_to_list_option" id="bill_to_list">
                                </datalist>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Job number</label>
                                <input type="text" class="form-control form-control-sm inp_data_job_number" list="job_number_list">
                                <datalist class="job_number_list_option" id="job_number_list">
                                </datalist>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">B/L No.</label>
                                <input type="text" class="form-control form-control-sm inp_hbl" list="hbl_list">
                                <datalist class="hbl_list_option" id="hbl_list">
                                </datalist>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Container No.</label>
                                <input type="text" class="form-control form-control-sm inp_container" list="container_list">
                                <datalist class="container_list_option" id="container_list">
                                </datalist>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Billing Code 费用简称</label>
                                <input type="text" class="form-control form-control-sm inp_billing_code" list="billing_code_list">
                                <datalist class="billing_code_option" id="billing_code_list">
                                </datalist>
                            </div>
                        </div> -->
                    </div>
                    <div class="bd-example mt-3 table-responsive">
                        <div class="bd-example table-responsive">
                        <table class="table table-hover table_data_account" style="zoom: 70%">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Country Code</th>
                                    <th>Country</th>
                                    <th>*payment method</th>
                                    <th>Bank Code</th>
                                    <th>Company Name</th>
                                    <th>Bank b</th>
                                    <th>Currency</th>
                                    <th>Bank Brunch</th>
                                    <th>Bank address</th>
                                    <th>Swift code</th>
                                    <th>Bank telephone</th>
                                    <th>Commercial number</th>
                                    <th>Tax number</th>
                                    <th>Founder</th>
                                    <th>Creation time</th>
                                    <th>Modified person</th>
                                    <th>Change the time</th>
                                </tr>
                                <tr class="text-center">
                                    <th>序号</th>
                                    <th>*收付地点</th>
                                    <th>*国家名</th>
                                    <th>*支付方式</th>
                                    <th>银行简码</th>
                                    <th>公司名称</th>
                                    <th>银行账号</th>
                                    <th>币种</th>
                                    <th>开户行全称</th>
                                    <th>银行地址</th>
                                    <th>SWIFT CODE</th>
                                    <th>银行电话</th>
                                    <th>工商登记号</th>
                                    <th>税务登记号</th>
                                    <th>创建人</th>
                                    <th>创建时间</th>
                                    <th>修改人</th>
                                    <th>修改时间</th>
                                </tr>
                                <tr class="text-center">
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>11</th>
                                    <th>12</th>
                                    <th>13</th>
                                    <th>14</th>
                                    <th>15</th>
                                    <th>16</th>
                                    <th>17</th>
                                    <th>18</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                    <td><input type="text" class="form-control form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MAIN BODY END -->


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
<script src="js/bank_account/setting_first.js"></script>
<script src="js/bank_account/function_bac.js"></script>
<!-- <script src="js/account_payable/setting_default.js"></script>
<script src="js/account_payable/ap_function.js"></script> -->
<!-- <script src="js/currency_rate/currency_rate.js"></script> -->




<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        setting_first.first_set();
        // setting_first.first_set();
        // setting_default.setting_default();
        // job_detail.set_header_page();
    });
</script>