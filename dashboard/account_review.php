<?php
include 'core/conn.php';
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Account review approve</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <?php include 'include/lang_lib.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<style>
    .card {
        margin-left: 2px;
        margin-right: 2px;
    }

    .card_list {
        height: 775px;
        /* ความสูงของ card ที่ต้องการ */
        overflow-y: auto;
        /* เพิ่มการเลื่อนในแนวตั้ง */
    }

    .card_table {
        height: 775px;
        overflow-y: auto;

    }


    .active_side {
        font-weight: bold;
        color: red;
    }

    .card_list>.card-body>.data_sic>.form-group>button {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;

        /* zoom:120%; */
    }

    .active_side:hover {
        color: red;
    }

    .table>tbody td:nth-child(-n+29) {
        padding-left: 1px;
        padding-right: 1px;
    }

    .table_ar td:nth-child(2) input,
    .table_ar td:nth-child(3) input,
    .table_ar td:nth-child(4) input {
        width: 200px;
    }

    .table_ar td:nth-child(5) input,
    .table_ar td:nth-child(6) input,
    .table_ar td:nth-child(9) input,
    .table_ar td:nth-child(10) input {
        width: 90px;
    }

    .table_ar td:nth-child(7) input,
    .table_ar td:nth-child(8) input,
    .table_ar td:nth-child(11) input,
    .table_ar td:nth-child(12) input {
        width: 150px;

    }

    .table_ar td:nth-child(14) input,
    .table_ar td:nth-child(15) input,
    .table_ar td:nth-child(16) input,
    .table_ar td:nth-child(17) input,
    .table_ar td:nth-child(18) input,
    .table_ar td:nth-child(19) input,
    .table_ar td:nth-child(20) input,
    .table_ar td:nth-child(21) input,
    .table_ar td:nth-child(22) input,
    .table_ar td:nth-child(23) input,
    .table_ar td:nth-child(24) input,
    .table_ar td:nth-child(25) input,
    .table_ar td:nth-child(26) input,
    .table_ar td:nth-child(27) input,
    .table_ar td:nth-child(28) input {
        width: 200px;
    }

    .table_ar th.sticky-top {
        z-index: 4;
        background-color: #fff;

    }

    .table_ar th.sticky-column {
        position: sticky;
        left: 0;
        top: 0;
        z-index: 5;
        background-color: #fff;
    }

    td.sticky-column {
        position: sticky;
        left: 0;
        z-index: 2;
        background-color: #fff;
    }


    tr.sticky_super_top {
        position: sticky;
        z-index: 2;
        background-color: #fff;
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
            <!-- <div class="card col-xl-12 col-lg-12">
                <div class="card-body">
                    test
                </div>
            </div> -->

            <div class="row">
                <div class="col-lg-2 col-xl-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <input type="radio" class="form-check-input  check_start" onchange="start.select_filter()" onclick="start.select_type()" name="radio_process" id="process" value="process">
                            <label class="form-check-label pl-2">Process</label>
                            <input type="radio" class="form-check-input " onchange="start.select_filter()" onclick="start.select_type()" name="radio_process" id="Rprocess" value="Rprocess">
                            <label class="form-check-label pl-2">Reverse Process</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-2 text-center">
                    <div class="card">
                        <div class="card-body">
                            <input type="radio" class="form-check-input check_start" onchange="start.select_filter() " name="radio_function_select" id="radio1" value="receivable">
                            <label class="form-check-label pl-2">Receivable</label>
                            <input type="radio" class="form-check-input" onchange="start.select_filter() " name="radio_function_select" id="radio2" value="payable">
                            <label class="form-check-label pl-2">Payable</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <input type="radio" class="form-check-input " onchange="start.select_filter()" onclick="start.select_type()" name="radio_select_act" id="radio1" value="All">
                            <label class="form-check-label pl-2">ALL</label>
                            <input type="radio" class="form-check-input check_start" onchange="start.select_filter()" onclick="start.select_type()" name="radio_select_act" id="radio1" value="Unpaid">
                            <label class="form-check-label pl-2">Unpaid</label>
                            <input type="radio" class="form-check-input" onchange="start.select_filter()" onclick="start.select_type()" name="radio_select_act" id="radio2" value="Paid">
                            <label class="form-check-label pl-2">Paid</label>
                            <input type="radio" class="form-check-input" onchange="start.select_filter()" onclick="start.select_type()" name="radio_select_act" id="radio2" value="Reject">
                            <label class="form-check-label pl-2">Reject</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-2">
                    <div class="card">
                        <div class="card-body text-center">
                            <!-- <input type="checkbox" class="form-check-input cb_all" onchange="start.select_filter()" name="radio_type_act" id="radio1" value="all">
                            <label class="form-check-label pl-2">All</label> -->
                            <input type="checkbox" class="form-check-input cb_apply " onchange="start.select_filter()" name="radio_type_act" id="radio2" value="apply">
                            <label class="form-check-label pl-2">Apply</label>
                            <input type="checkbox" class="form-check-input cb_check " onchange="start.select_filter()" name="radio_type_act" id="radio1" value="check">
                            <label class="form-check-label pl-2">Check</label>
                            <input type="checkbox" class="form-check-input cb_appove " onchange="start.select_filter()" name="radio_type_act" id="radio2" value="approve">
                            <label class="form-check-label pl-2">Approve</label>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-2 col-xl-2"> -->
                <!-- </div> -->
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Job number</label>
                                    <input type="text" class="form-control form-control-sm inp_job_number" onchange="start.select_filter()" list="job_number_list">
                                    <datalist id="job_number_list" class="data_list_job_number">

                                    </datalist>
                                </div>
                                <!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <label class="form-label">B/L No.</label>
                                    <input type="text" class="form-control form-control-sm inp_bl" list="bl_list">
                                    <datalist id="bl_list">
                                        
                                    </datalist>
                                </div> -->
                                <div class="col">
                                    <label class="form-label">Billing Code</label>
                                    <input type="text" class="form-control form-control-sm inp_billing_code" onchange="start.select_filter()" list="billing_list">
                                    <datalist id="billing_list" class="data_list_billing_list">

                                    </datalist>
                                </div>

                                <div class="col">
                                    <label class="form-label">Sale support</label>
                                    <input type="text" class="form-control form-control-sm inp_sale_code" onchange="start.select_filter()" list="sale_support_list">
                                    <datalist id="sale_support_list" class="data_list_sale_list">

                                    </datalist>
                                </div>

                                <div class="col">
                                    <label class="form-label">CS Support</label>
                                    <input type="text" class="form-control form-control-sm inp_cs_code" onchange="start.select_filter()" list="cs_support_list">
                                    <datalist id="cs_support_list" class="data_list_cs_list">

                                    </datalist>
                                </div>

                                <div class="col">
                                    <label class="form-label">Select Search</label>
                                    <select class="form-select form-select-sm data_select_search" onchange="start.select_filter()" name="" id="">
                                        <option value="">-- Select Search --</option>
                                        <option value="create_job">Create Date</option>
                                        <option value="check_date_time">Check Date</option>
                                        <option value="action_paid_date_time">Apply Date</option>
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="form-label">Date start</label>
                                    <input type="date" class="form-control form-control-sm inp_date_start" onchange="start.select_filter()">
                                </div>
                                <div class="col">
                                    <label class="form-label">Date end</label>
                                    <input type="date" class="form-control form-control-sm inp_data_end" onchange="start.select_filter()">
                                </div>
                                <!-- <button class="btn btn-success" onclick="start.select_filter()">search</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-2 col-xl-2">
                    <div class="card card_list">
                        <div class="card-body">
                            <div class="data_sic">
                                <div class="form-group">
                                    <button class="btn btn-sm active_side" data_id="0" data_type="0" name_type="0" onclick="start.mark_active(this)"><i class="bi bi-folder text-warning" style="zoom:135%"></i> ALL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10 col-xl-10">
                    <div class="card card_list">
                        <div class="card-body">
                            <div class="table-responsive" style="height: 470px;">
                                <table class="table table-hover table_ar" style="zoom:75%;overflow: scroll;">
                                    <thead class="">
                                        <tr class="text-center">
                                            <th class="sticky-column sticky-top ">No</th>
                                            <th class="sticky-column sticky-top ">Job number</th>
                                            <th class="sticky-column sticky-top ">Bill to</th>
                                            <th class="sticky-top">Code</th>
                                            <th class="sticky-top">Cur.</th>
                                            <th class="sticky-top">QTY</th>
                                            <th class="sticky-top">UNIT PRICE</th>
                                            <th class="sticky-top">AP AMT</th>
                                            <th class="sticky-top">VAT%</th>
                                            <th class="sticky-top">WH%</th>
                                            <th class="sticky-top">AMTINCV</th>
                                            <th class="sticky-top">AMTPAID</th>
                                            <th class="sticky-top">STATUS</th>
                                            <th class="sticky-top">REMARK</th>
                                            <th class="sticky-top">OP</th>
                                            <th class="sticky-top">SALE</th>
                                            <th class="sticky-top">Create Date</th>
                                            <th class="sticky-top">Creater</th>
                                            <th class="sticky-top">Biiling Date</th>
                                            <th class="sticky-top">apply by.</th>
                                            <th class="sticky-top">apply date</th>
                                            <th class="sticky-top">check by.</th>
                                            <th class="sticky-top">check date</th>
                                            <th class="sticky-top">approve by.</th>
                                            <th class="sticky-top">approve date</th>
                                            <th class="sticky-top">booking no</th>
                                            <th class="sticky-top">container no</th>
                                            <th class="sticky-top">payment status </th>
                                        </tr>
                                        <!-- <tr class="text-center">
                                            <td>1</td>
                                            <td>2</td>
                                            <td>3</td>
                                            <td>4</td>
                                            <td>5</td>
                                            <td>6</td>
                                            <td>7</td>
                                            <td>8</td>
                                            <td>9</td>
                                            <td>10</td>
                                            <td>11</td>
                                            <td>12</td>
                                            <td>13</td>
                                            <td>14</td>
                                            <td>15</td>
                                            <td>16</td>
                                            <td>17</td>
                                            <td>18</td>
                                            <td>19</td>
                                            <td>20</td>
                                            <td>21</td>
                                            <td>22</td>
                                            <td>23</td>
                                            <td>24</td>
                                            <td>25</td>
                                            <td>26</td>
                                            <td>27</td>
                                        </tr> -->
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="sticky-column text-center">1</td><!-- No -->
                                            <td class="sticky-column text-center"><input type="text" class="form-control form-control-sm" readonly value="T23112012"></td><!-- Job number -->
                                            <td class="sticky-column text-center"><input type="text" class="form-control form-control-sm" readonly value="Thai customs"></td><!-- Bill to -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- Code -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- Cur. -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- QTY -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- UNIT PRICE -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- AP AMT -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- VAT% -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- WH% -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- AMTINCV -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- AMTPAID -->
                                            <td class="text-center">
                                                <input type="radio" class="form-check-input" name="radio_select_act" id="radio1" value="check">
                                                <label class="form-check-label pl-2">Waiting</label>
                                                <input type="radio" class="form-check-input" name="radio_select_act" id="radio2" value="apply">
                                                <label class="form-check-label pl-2">Approve</label>
                                                <input type="radio" class="form-check-input" name="radio_select_act" id="radio2" value="apply">
                                                <label class="form-check-label pl-2">Reject</label>
                                            </td><!-- STATUS -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- REMARK -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- OP -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- SALE -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- create date -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- Creater. -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- billing date -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- check by. -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- check datetime -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- apply by. -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- apply datetime -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- approve by. -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- approve datetime -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- booking no -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- container no -->
                                            <td class="text-center"><input type="text" class="form-control form-control-sm" readonly value=""></td><!-- payment status  -->
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group p-2 m-2">
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-sm btn-warning" onclick="function_act.waiting_all()">Waiting All</button>
                                    <button class="btn btn-sm btn-success" onclick="function_act.approve_all()">Approve All</button>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="btn btn-sm btn-success" onclick="function_act.save_data()">Save</button>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="form-group p-2 m-2">
                            <div class="row">
                                <div class="col">
                                    <label for="">Total pay/rcvd</label>
                                </div>
                                <div class="col">USD : <div class="data_currency_usd"></div>
                                </div>
                                <div class="col">THB : <div class="data_currency_thb"></div>
                                </div>
                                <div class="col">RMB : <div class="data_currency_rmb"></div>
                                </div>
                                <div class="col">YEN : <div class="data_currency_yen"></div>
                                </div>
                                <div class="col">HKD : <div class="data_currency_hkd"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group p-2 m-2">
                            <div class="row">
                                <div class="col">
                                    <label for="">Total review</label>
                                </div>
                                <div class="col">USD : <div class="data_currency_review_usd"></div>
                                </div>
                                <div class="col">THB : <div class="data_currency_review_thb"></div>
                                </div>
                                <div class="col">RMB : <div class="data_currency_review_rmb"></div>
                                </div>
                                <div class="col">YEN : <div class="data_currency_review_yen"></div>
                                </div>
                                <div class="col">HKD : <div class="data_currency_review_hkd"></div>
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
<!-- <script src="js/account_check_payable/first_setting.js"></script> -->
<!-- <script src="js/account_check_payable/function_acp.js"></script> -->
<!-- <script src="js/account_check_approve/start.js"></script> -->
<!-- <script src="js/account_check_approve/function_act.js"></script> -->
<!-- <script src="js/account_check_approve/start_apply.js"></script> -->
<script src="js/account_review/start.js"></script>
<script src="js/account_review/start_default.js"></script>
<script src="js/account_review/function_act.js"></script>



<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();

        start.start_page();
        $('.check_start').prop('checked', true)
        // $('.sidebar').addClass('sidebar-mini')
        start.select_filter();
        // first_setting.start_page();
        // start.start_setting();
        // start.data_start()
        start_default.start_default()

    });
</script>