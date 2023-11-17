<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account receivable report</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />





</head>

<style>
    .table_data_account td:nth-child(3) input,
    .table_data_account td:nth-child(4) input,
    .table_data_account td:nth-child(6) input,
    .table_data_account td:nth-child(8) input,
    .table_data_account td:nth-child(9) input,
    .table_data_account td:nth-child(10) input,
    .table_data_account td:nth-child(11) input,
    .table_data_account td:nth-child(12) input,
    .table_data_account td:nth-child(15) input,
    .table_data_account td:nth-child(16) input,
    .table_data_account td:nth-child(17) input,
    .table_data_account td:nth-child(18) input,
    .table_data_account td:nth-child(19) input,
    .table_data_account td:nth-child(20) input,
    .table_data_account td:nth-child(21) input,
    .table_data_account td:nth-child(22) input,
    .table_data_account td:nth-child(14) input {
        width: 220px;
    }

    .table_data_account td:nth-child(7) input {
        width: 150px;

    }

    .table_data_account td:nth-child(5) input {
        width: 250px;

    }



    .table_data_account td:nth-child(1),
    .table_data_account td:nth-child(2),
    .table_data_account td:nth-child(3),
    .table_data_account td:nth-child(4),
    .table_data_account td:nth-child(5),
    .table_data_account td:nth-child(6),
    .table_data_account td:nth-child(7),
    .table_data_account td:nth-child(8),
    .table_data_account td:nth-child(9),
    .table_data_account td:nth-child(10),
    .table_data_account td:nth-child(11),
    .table_data_account td:nth-child(12),
    .table_data_account td:nth-child(13),
    .table_data_account td:nth-child(14),
    .table_data_account td:nth-child(15),
    .table_data_account td:nth-child(16),
    .table_data_account td:nth-child(17),
    .table_data_account td:nth-child(18),
    .table_data_account td:nth-child(19),
    .table_data_account td:nth-child(20),
    .table_data_account td:nth-child(21),
    .table_data_account td:nth-child(22),
    .table_data_account td:nth-child(23),
    .table_data_account td:nth-child(24),
    .table_data_account td:nth-child(25),
    .table_data_account td:nth-child(26),
    .table_data_account td:nth-child(27),
    .table_data_account td:nth-child(28),
    .table_data_account td:nth-child(29),
    .table_data_account td:nth-child(30){
        padding-left: 2px;
        padding-right: 2px;
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
                    <h4>Account receivable report</h4>
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
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Select currency</label>
                                <select name="" id="" class="form-select form-select-sm sel_currency">
                                    <option value="">-- Select currency --</option>
                                    <option value="USD">USD</option>
                                    <option value="THB">THB</option>
                                    <option value="RMB">RMB</option>
                                    <option value="HKD">HKD</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="bd-example mt-3">
                        <div class="row g-3">
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Select type filter</label>
                                <select name="" id="" class="form-select form-select-sm sel_type_date">
                                    <option value="">-- Select type --</option>
                                    <option value="cred">Create Date</option>
                                    <option value="ched">Chedked Date</option>
                                    <option value="appd">Appliet Date</option>
                                    <option value="prod">Approve Date</option>
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
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input cb_st_6" name="bsradio2" name_data="1">
                                    <label for="radio3" class="form-check-label pl-2">All</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input cb_st_1" name="bsradio2" name_data="1">
                                    <label for="radio3" class="form-check-label pl-2">Unpayment</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input cb_st_2" name="bsradio2" name_data="2">
                                    <label for="radio3" class="form-check-label pl-2">Payment</label>
                                </div>
                            </div>

                            <!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
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
                            </div> -->
                            <button class="btn btn-outline-primary btn-sm" onclick="function_acp.filter_select();"><i class="bi bi-search"></i> search</button>
                        </div>
                    </div>
                    <div class="bd-example mt-3 table-responsive">
                        <table class="table table-hover table_data_account" style="zoom: 60%">
                            <thead>
                                <tr class="text-center">
                                    <th>NO.</th>
                                    <th>select</th>
                                    <th>JOB NO</th>
                                    <th>BILL TO</th>
                                    <th>CODE</th>
                                    <th>amount</th>
                                    <th>currency</th>
                                    <th>USD</th>
                                    <th>THB</th>
                                    <th>CNY</th>
                                    <th>HKD</th>
                                    <th>amount<br>currency</th>
                                    <th>exchage<br>rate</th>
                                    <th>S/O</th>
                                    <th>BL</th>
                                    <th>Sailing date</th>
                                    <th>vessel</th>
                                    <th>ETD</th>
                                    <th>ETA</th>
                                    <th>Requester</th>
                                    <th>customer address</th>
                                    <th>Customer phone</th>
                                </tr>
                                <tr class="text-center">
                                    <th>NO.</th>
                                    <th>选择</th>
                                    <th>JOB NO</th>
                                    <th>BILL TO</th>
                                    <th>CODE</th>
                                    <th>应付</th>
                                    <th>币种</th>
                                    <th>USD</th>
                                    <th>THB</th>
                                    <th>CNY</th>
                                    <th>HKD</th>
                                    <th>折合本位币</th>
                                    <th>汇率</th>
                                    <th>S/O</th>
                                    <th>提单号</th>
                                    <th>开船日期</th>
                                    <th>船名</th>
                                    <th>ETD</th>
                                    <th>ETA</th>
                                    <th>委托单位 </th>
                                    <th>客户地址</th>
                                    <th>客户电话</th>
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
                                    <th>19</th>
                                    <th>20</th>
                                    <th>21</th>
                                    <th>22</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center"><input type="checkbox" class="form-check-input cbx_select"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_job_number"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_bill_to"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_code"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_amount"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_currency"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_usd"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_thb"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_rmb"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_hkd"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_amount_currency"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_exchage_rate"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_so"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_bl"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_sailing_date"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_vessel"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_etd"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_eta"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_request_by"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_customer_address"></td>
                                    <td class="text-center"><input type="text" class="form-control form-control inp_customer_phone"></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <!-- <div class="text-start">
                        <button class="btn btn-sm btn-success" onclick="function_arp.select_all('select')">select all 全选</button>
                        <button class="btn btn-sm btn-warning" onclick="function_arp.select_all('deselect')">deselect all 全不选</button>
                        <button class="btn btn-sm btn-outline-primary" onclick="function_acp.get_select_paid()">Approve only select</button>
                        <button class="btn btn-sm btn-outline-danger" onclick="ap_function.select_action_table('reject')">Reject only select</button>
                    </div> -->
                    <div style="zoom: 80%">
                        <div class="form-group row text-center mt-3">
                            <label class="col-xl-2">Total Amount Including Tax: 含税合计：</label>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>USD</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm total_incv_usd text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>THB</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm total_incv_thb text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>RMB</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm total_incv_rmb text-end" disabled>
                                </div>
                            </div>

                            <div class="col-xl-2 col-sm-12 col-sx-12 row">
                                <div class="col-xs-2 col-sm-2 col-xl-2">
                                    <label>HKD</label>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-xl-10">
                                    <input type="text" class="form-control form-control-sm total_incv_hkd text-end" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group row text-center">
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
                        </div> -->
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
<script src="js/account_res_receivable/first_setting.js"></script>
<script src="js/account_res_receivable/function_arp.js"></script>



<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        first_setting.start_page()
        first_setting.default_setting()
        first_setting.setting_data_table()
    });
</script>