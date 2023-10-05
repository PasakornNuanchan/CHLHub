<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account payable reject</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />





</head>

<style>
    /* .table_data_account td:nth-child(3) input,
    .table_data_account td:nth-child(4) input,
    .table_data_account td:nth-child(5) input,
    .table_data_account td:nth-child(6) input,
    .table_data_account td:nth-child(7) input,
    .table_data_account td:nth-child(8) input,
    .table_data_account td:nth-child(9) input,
    .table_data_account td:nth-child(10) input,
    .table_data_account td:nth-child(11) input,
    .table_data_account td:nth-child(12) input,
    .table_data_account td:nth-child(13) input,
    .table_data_account td:nth-child(14) input {
        width: 150px;
    } */
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
                    <h4>Account Payable Reject</h4>
                </div>

                <div class="card-body">
                    <div class="bd-example">
                        <h5>Filter</h5>
                        <div class="row g-3">
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
                        </div>
                    </div>

                    <div class="bd-example mt-3">
                        <div class="row g-3">
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Select Search</label>
                                <select name="" id="" class="form-select form-select-sm sel_currency">
                                    <option value="">-- Select currency --</option>
                                    <option value="USD">USD</option>
                                    <option value="THB">THB</option>
                                    <option value="RMB">RMB</option>
                                    <option value="HKD">HKD</option>
                                </select>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Date Start 开始日期</label>
                                <input type="date" class="form-control form-control-sm inp_start_date">
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Date End 结束日期</label>
                                <input type="date" class="form-control form-control-sm inp_end_date">
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Sale support 业务员</label>
                                <input type="text" class="form-control form-control-sm inp_sale" list="sale_support_list">
                                <datalist class="sale_support_data_option" id="sale_support_list">
                                </datalist>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">CS support 操作员</label>
                                <input type="text" class="form-control form-control-sm inp_cs" list="cs_support_list">
                                <datalist class="cs_support_data_option" id="cs_support_list">
                                </datalist>
                            </div>
                            <button class="btn btn-outline-primary btn-sm" onclick="ap_function.search_function();"><i class="bi bi-search"></i> search</button>
                        </div>
                    </div>
                    <div class="bd-example mt-3 table-responsive">
                        <table class="table table-hover table_data_account" style="zoom: 60%">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>select</th>
                                    <th>Job No.</th>
                                    <th>Bill to</th>
                                    <th>Code</th>
                                    <th>Currency</th>
                                    <th>AMT.INCV</th>
                                    <th>exchange rate</th>
                                    <th>currency cancle</th>
                                    <th>AMT INCV cancle</th>
                                    <th>Remark</th>
                                    <th>create by</th>
                                    <th>create datetime</th>
                                    <th>Sale</th>
                                </tr>
                                <tr class="text-center">
                                    <th>序号</th>
                                    <th>选择</th>
                                    <th>系统单号</th>
                                    <th>结算单位</th>
                                    <th>费用简称</th>
                                    <th>币种</th>
                                    <th>应付含税金额</th>
                                    <th>核销汇率</th>
                                    <th>核销币种</th>
                                    <th>含税核销金额</th>
                                    <th>备注</th>
                                    <th>录入人</th>
                                    <th>录入时间</th>
                                    <th>业务</th>
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
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center"><input type="checkbox" class="form-check-input cbx_sel"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_job_no"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_bill_to"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_code"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_currency"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_amt_incv"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_rate"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_currency_can"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_amt_incv_can"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_remark"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_create_by"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_create_datetime"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_sale"></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- <div class="text-start"> -->
                        <!-- <button class="btn btn-sm btn-success" onclick="ap_function.checked_select_all()">Checked all 全选</button> -->
                        <!-- <button class="btn btn-sm btn-warning" onclick="ap_function.unchecked_select_all()">Unchecked all 全不选</button> -->
                        <!-- <button class="btn btn-sm btn-outline-primary" onclick="ap_function.select_action_table('approve')" >Approve only select</button> -->
                        <!-- <button class="btn btn-sm btn-outline-danger" onclick="ap_function.select_action_table('reject')" >Reject only select</button> -->
                    <!-- </div> -->
                    <div style="zoom: 80%">
                        <div class="form-group row text-center mt-3">
                            <label class="col-xl-2">Total Payables 应付合计</label>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>USD</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm total_payble_usd text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>THB</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm total_payble_thb text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>RMB</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm total_payble_rmb text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>HKD</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm total_payble_hkd text-end" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <label class="col-xl-2">Verified Total Payables 应付已审合计：</label>
                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>USD</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm verfied_usd text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>THB</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm verfied_thb text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>RMB</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm verfied_rmb text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>HKD</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm verfied_hkd text-end" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row text-center">
                            <label class="col-xl-2">Total Payment Requests 付款申请合计：</label>
                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>USD</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm inp_paid_usd text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>THB</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm inp_paid_thb text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>RMB</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm inp_paid_rmb text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>HKD</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm inp_paid_hkd text-end" disabled>
                                </div>
                            </div>
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
<!-- <script src="js/account_payable/setting_first.js"></script> -->
<!-- <script src="js/account_payable/setting_default.js"></script> -->
<!-- <script src="js/account_payable/ap_function.js"></script> -->
<!-- <script src="js/currency_rate/currency_rate.js"></script> -->




<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        // setting_first.first_set();
        // setting_default.setting_default();
        // job_detail.set_header_page();
    });
</script>