<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account payable Check</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />





</head>

<style>
   
   .table_data_account td:nth-child(2) input{
        width: 150px;
   }


   .table_data_account td:nth-child(3) input,
   .table_data_account td:nth-child(4) input{
        width: 250px;
   }



    .table_data_account td:nth-child(15) input,
    .table_data_account td:nth-child(16) input,
    .table_data_account td:nth-child(17) input,
    .table_data_account td:nth-child(18) input,
    .table_data_account td:nth-child(19) input,
    .table_data_account td:nth-child(20) input,
    .table_data_account td:nth-child(21) input,
    .table_data_account td:nth-child(22) input,
    .table_data_account td:nth-child(23) input,
    .table_data_account td:nth-child(24) input {
        width: 200px;
    
    }

    
    .table_data_account td:nth-child(14) input {
        width: 200px;
    }
    .table_data_account td:nth-child(5) input,
    .table_data_account td:nth-child(6) input,
    .table_data_account td:nth-child(9) input,
    .table_data_account td:nth-child(10) input {
        width: 80px;
    }
    
    .table_data_account td:nth-child(7) input,
    .table_data_account td:nth-child(8) input,
    .table_data_account td:nth-child(11) input,
    .table_data_account td:nth-child(12) input {
        width: 130px;
    }

   

    .table_data_account td:nth-child(1) ,
    .table_data_account td:nth-child(2) ,
    .table_data_account td:nth-child(3) ,
    .table_data_account td:nth-child(4) ,
    .table_data_account td:nth-child(5) ,
    .table_data_account td:nth-child(6) ,
    .table_data_account td:nth-child(7) ,
    .table_data_account td:nth-child(8) ,
    .table_data_account td:nth-child(9) ,
    .table_data_account td:nth-child(10) ,
    .table_data_account td:nth-child(11) ,
    .table_data_account td:nth-child(12) ,
    .table_data_account td:nth-child(14) ,
    .table_data_account td:nth-child(15) ,
    .table_data_account td:nth-child(16) ,
    .table_data_account td:nth-child(17) ,
    .table_data_account td:nth-child(18) ,
    .table_data_account td:nth-child(19) ,
    .table_data_account td:nth-child(20) ,
    .table_data_account td:nth-child(21) ,
    .table_data_account td:nth-child(22) ,
    .table_data_account td:nth-child(23) ,
    .table_data_account td:nth-child(24) {
        
        padding-left: 2px;
        padding-right: 2px;
    }

    .table_data_account td:nth-child(13){
        padding-left: 10px;
        padding-right: 10px;
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
            <!-- <div class="card">
                <div class="card-body card_body_head_nav">
                    <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded active" id="job_detail_tab" data-bs-toggle="pill" data-bs-target="#job_detail_tab_target" type="button" role="tab" aria-controls="pills-home" aria-selected="false">Job detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="transport_tab" data-bs-toggle="pill" data-bs-target="#transport_tab_target" type="button" role="tab" aria-controls="pills-pettycash" aria-selected="false">Transport</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded " id="reportcs_tab" data-bs-toggle="pill" data-bs-target="#reportcs_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">Report cs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="customs_tab" data-bs-toggle="pill" data-bs-target="#customs_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Customs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="billing_tab" data-bs-toggle="pill" data-bs-target="#billing_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Billing</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded" id="withdraw_tab" data-bs-toggle="pill" data-bs-target="#withdraw_tab_target" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Withdraw</button>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="card">
                <div class="card-header">
                    <h4>Account payable (Acc)</h4>
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
                        </div>
                    </div>

                    <h5 class="mt-2">Status</h5>
                    
                    <div class="form-group mt-2 row">
                        <label for="" class="col-lg-2">Filter payment status : </label>
                        <div class="bd-example col-lg-10">
                            <!-- <div class="form-check form-check-inline"> -->
                                <!-- <input type="checkbox" class="form-check-input cb_st_1" name="bsradio2" name_data="6" checked> -->
                                <!-- <label for="radio3" class="form-check-label pl-2">All</label> -->
                            <!-- </div> -->
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input sel_st_1 input_first" onclick="ap_function.select_data('1')"name="bsradio2" name_data="1">
                                <label for="radio3" class="form-check-label pl-2">Unpaid</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input sel_st_2" onclick="ap_function.select_data('2')"name="bsradio2" name_data="2">
                                <label for="radio3" class="form-check-label pl-2">Uncheck</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input sel_st_3" onclick="ap_function.select_data('3')"name="bsradio2" name_data="4">
                                <label for="radio3" class="form-check-label pl-2">Applied</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input sel_st_4" onclick="ap_function.select_data('4')"name="bsradio2" name_data="5">
                                <label for="radio3" class="form-check-label pl-2">Approve</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input sel_st_5" onclick="ap_function.select_data('5')"name="bsradio2" name_data="6">
                                <label for="radio3" class="form-check-label pl-2">Paid</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input sel_st_6" onclick="ap_function.select_data('6')"name="bsradio2" name_data="7">
                                <label for="radio3" class="form-check-label pl-2">Reject</label>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group mt-2 row">
                        <label for="" class="col-lg-2">Accrued Liabilities(Paid) : </label>
                        <div class="bd-example col-lg-10">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input cb_st_5" name="bsradio2" name_data="5">
                                <label for="radio3" class="form-check-label pl-2">Payment</label>
                            </div>
                        </div>
                    </div> -->

                    <div class="bd-example">
                        <div class="row g-3">
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <label class="form-label">Select Search</label>
                                <select name="" id="" class="form-select form-select-sm sel_serach">
                                    <option value="">-- Select Search --</option>
                                    <option value="1">Create Date</option>
                                    <option value="2">Check Date</option>
                                    <option value="3">Apply Date</option>

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
                        <table class="table table-hover table_data_account table-lg" style="zoom: 60%">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Job No.</th>
                                    <th>Bill to</th>
                                    <th>Code</th>
                                    <th>Cur.</th>
                                    <th>QTY</th>
                                    <th>UNIT PRICE</th>
                                    <th>AP AMT</th>
                                    <th>VAT%</th>
                                    <th>WH%</th>
                                    <th>AMTINCV.</th>
                                    <th>AMT PAID</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                    <th>OP</th>
                                    <th>Sale</th>
                                    <th>Create Date</th>
                                    <th>Create By</th>
                                    <th>Create Datetime</th>
                                    <th>Checked by</th>
                                    <th>Checked Datetime</th>
                                    <th>Booking No.</th>
                                    <th>Container No.</th>
                                    <th>Client</th>
                                    <th>Request By.</th>
                                    <th>Payment Appliction</th>
                                    <th>Request payble</th>
                                </tr>
                                <tr class="text-center">
                                    <th>序号</th>
                                    <th>系统单号</th>
                                    <th>结算单位</th>
                                    <th>费用简称</th>
                                    <th>币种</th>
                                    <th>数量</th>
                                    <th>单价</th>
                                    <th>应付金额<br>
                                    (不含税)</th>
                                    <th></th>
                                    <th></th>
                                    <th>应付含税金额</th>
                                    <th>已付金额</th>
                                    <th>STATUS状态</th>
                                    <th>备注</th>
                                    <th>操作</th>
                                    <th>业务</th>
                                    <th>创建日期</th>
                                    <th>录入人</th>
                                    <th>录入时间</th>
                                    <th>审核人</th>
                                    <th>审核时间</th>
                                    <th>S/O或提单号</th>
                                    <th>柜号</th>
                                    <th>委托单位</th>
                                    <th>付款申请人</th>
                                    <th>付款申请</th>
                                    <th>付款申请时间</th>
                                </tr>
                                <!-- <tr class="text-center">
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
                                    <th>23</th>
                                    <th>24</th>
                                    <th>25</th>
                                    <th>26</th>
                                    <th>27</th>
                                    <th>28</th>
                                </tr> -->
                            </thead>
                            <tbody>
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

                    <div class="text-start">
                        <button class="btn btn-sm btn-outline-success" onclick="ap_function.approve_all('2')">Approve All 全选</button>
                        <button class="btn btn-sm btn-outline-warning" onclick="ap_function.approve_all('1')">Waiting All 全不选</button>
                        <!-- <button class="btn btn-sm btn-outline-primary" onclick="ap_function.select_action_table('approve')" >Approve only select</button> -->
                        <!-- <button class="btn btn-sm btn-outline-danger" onclick="ap_function.select_action_table('reject')" >Reject only select</button> -->
                    </div>
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
<script src="js/account_payable/setting_first.js"></script>
<script src="js/account_payable/setting_default.js"></script>
<script src="js/account_payable/ap_function.js"></script>
<!-- <script src="js/currency_rate/currency_rate.js"></script> -->




<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();
        setting_first.first_set();
        setting_default.setting_default();
        // job_detail.set_header_page();
    });
</script>