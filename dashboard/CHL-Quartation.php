<?php
require 'function/auth/get_session.php';
 
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
<style>
    #add_consignee_moda .modal-dialog{
        max-width: 1000px;
    }

</style>
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
        </div> <!-- Nav Header Component End -->
        <!--Nav End-->


        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div>
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Quartation Detail</h4>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Quartation number</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-4">
                                                <input type="text" class="form-control form-control-sm inp-quo_no" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-2 align-self-center " for="pwd2">sign status</label>
                                            <div class="col-lg-2 col-md-3">
                                                <input type="text" class="form-control form-control-sm inp-sign_st" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Consignee</label>
                                    <div class="col-sm-9 col-md-4 col-lg-4">
                                        <select class="form-select form-select-sm sel_consignee" >
                                            <option value="" selected>Plese select Congsignee</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <button type="button" onclick="quartation.html_modal_add_consignee();" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Consignee</button>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Term :</label>
                                    <div class="col-sm-1 col-md-4 col-lg-4">
                                        <select class="select form-select form-select-sm sel_term" id="">
                                            <option value="" selected>Plese select Term</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Commodity :</label>
                                    <div class="col-sm-1 col-md-5 col-lg-4">
                                        <input type="text" class="form-control form-control-sm inp-commodity">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Type:</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm sel-type-title">
                                            <option value="" selected>Plese select type</option>
                                            <option value="Import">Import</option>
                                            <option value="Export">Export</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4> BASE SERVICE </h4>
                                <button type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" onclick="quartation.addhtmlbase_server(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Route</button>

                            </div>
                            <hr>

                            <div class="card-body">
                                <div class="base-row">
                                    <div class="base-add">
                                        <H4>Base Service</H4>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center sel-carrier" for="pwd2">Carrier :</label>
                                            <div class="col-lg-5 col-md-5">
                                                <div class="db-select-carrier">
                                                    <select class="form-select form-select-sm inp-carrier" onchange ="quartation.fillter_route_carrier(this);">
                                                        <?php
                                                        $carrier_select = "SELECT * FROM carrier";
                                                        $result_carrier = mysqli_query($con, $carrier_select);
                                                        ?>
                                                        <option selected value="">Please select carrier</option>
                                                        <?php
                                                        while ($result_carrier_total = mysqli_fetch_assoc($result_carrier)) {
                                                        ?>
                                                            <option value="<?= $result_carrier_total['carrier_number'] ?>"><?php echo $result_carrier_total['carrier_name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Container size :</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-4">
                                                        <select class="form-select form-select-sm inp-carrier-type ">
                                                            <?php
                                                            $carrier_select = "SELECT DISTINCT `container_type` FROM `route`";
                                                            $result_carrier = mysqli_query($con, $carrier_select);
                                                            ?>
                                                            <option selected value="">Please select carrier</option>
                                                            <?php
                                                            while ($result_carrier_total = mysqli_fetch_assoc($result_carrier)) {
                                                            ?>
                                                                <option value="<?= $result_carrier_total['container_type'] ?>"><?php echo $result_carrier_total['container_type'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label class="control-label col-sm-2 col-md-4 col-lg-2 align-self-center mb-0" for="">Container Quantity</label>
                                                    <div class="col-lg-2 col-md-2 ">
                                                        <input type="text" class="form-control form-control-sm inp_qty">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Port of loading</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4">
                                                        <div class="db-select-pol">
                                                            <select class="form-select form-select-sm inp-port_load">
                                                                <?php
                                                                $area_select = "SELECT * FROM area";
                                                                $result_area = mysqli_query($con, $area_select);
                                                                ?>
                                                                <option selected value="">Please select Port of Loading</option>
                                                                <?php
                                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                                ?>
                                                                    <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['provice'] . " ," . $result_area_total['country'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label class="control-label col-sm-2 col-md-3 col-lg-2 align-self-center mb-0" for="pwd2">Port of Delivery</label>
                                                    <div class="col-md-4 col-lg-4 ">
                                                        <div class="db-select-pod">
                                                            <select class="form-select form-select-sm inp-port_del">
                                                                <?php
                                                                $area_select = "SELECT * FROM area";
                                                                $result_area = mysqli_query($con, $area_select);
                                                                ?>
                                                                <option selected value="">Please select Port of Delivery</option>
                                                                <?php
                                                                while ($result_area_total = mysqli_fetch_assoc($result_area)) {
                                                                ?>
                                                                    <option value="<?= $result_area_total['ID'] ?>"><?php echo $result_area_total['location_name'] . " ," . $result_area_total['provice'] . " ," . $result_area_total['country'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Budget :</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4">
                                                        <input type="text" class="form-control form-control-sm inp-budget" readonly>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3">
                                                        <select name="" class="form-select form-select-sm" id="" disabled>
                                                            <option value="">THB</option>
                                                            <option value="">USD</option>
                                                            <option value="">RMB</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5> Trucking Fee (Import) </h5>
                                <button onclick="quartation.add_truck_fee_import(this);" type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Import</button>

                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="truck_fee_import">
                                    <div class="truck_fee_import_row">
                                        <h5>Trucking Fee (Import)</h5>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " on>Pickup :</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-5">
                                                        <input type="text" class="form-control form-control-sm inp-truck_fee_pickup">
                                                    </div>
                                                    <label class="control-label col-sm-2 col-md-2 col-lg-1 align-self-center mb-0">Dropoff :</label>
                                                    <div class="col-lg-3 col-md-5">
                                                        <input type="text" class="form-control form-control-sm inp-truck_fee_drop">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center inp-tr_fee_budget">Budget :</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4">
                                                        <input type="text" class="form-control form-control-sm inp-truck_fee_budget">
                                                    </div>
                                                    <div class="col-lg-2 col-md-3">
                                                        <select name="" class="form-select form-select-sm sel-tr_fee_import_currency " id="">
                                                            <option value="THB" selected>THB</option>
                                                            <option value="USD">USD</option>
                                                            <option value="RMB">RMB</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                                        <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="quartation.del_truck_fee_export(this);"><i class="bi bi-dash-lg"></i> Delete Route</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5> Trucking Fee (Export) </h5>
                                <button onclick="quartation.add_truck_fee_export(this);" type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add Export</button>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="truck_fee_export">
                                    <div class="truck_fee_export_row">
                                        <h5>Export 1</h5>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Pickup :</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-5">
                                                        <input type="text" class="form-control form-control-sm inp-truck_exp_pickup">
                                                    </div>
                                                    <label class="control-label col-sm-2 col-lg-1 align-self-center mb-0" for="pwd2">Dropoff :</label>
                                                    <div class="col-lg-3 col-md-5">
                                                        <input type="text" class="form-control form-control-sm inp-truck_exp_dropoff">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-sm-3 col-lg-2 align-self-center " for="pwd2">Budget :</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4">
                                                        <input type="text" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="col-lg-2 col-md-3">
                                                        <select name="" class="form-select form-select-sm select-currency sel-tr_fee_export_currency" id="">
                                                            <option value="THB" selected>THB</option>
                                                            <option value="USD">USD</option>
                                                            <option value="RMB">RMB</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                                        <button type="button" target="_blank" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-plus"></i> Add route</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <H4>Sub service</H4>
                            <div class="table-responsive mt-4">
                                <table id="basic-table" name="sub-tbl" class="table table-striped mb-0" role="grid">
                                    <thead>
                                        <tr align="center">
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Unit Price</th>
                                            <th>Cur.</th>
                                            <th>remark</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <tr class="sub_des">
                                            <td class="select_des_sup">
                                                <select name="" class="form-select form-select-sm sel-sup_des_service" id="">
                                                    <?php
                                                    $sup_service_sql = "SELECT * FROM quotation_sup_service";
                                                    $result_sup_service = mysqli_query($con, $sup_service_sql);
                                                    ?>
                                                    <option selected value="">Please select carrier</option>
                                                    <?php
                                                    while ($result = mysqli_fetch_assoc($result_sup_service)) {
                                                    ?>
                                                        <option value="<?= $result['ID'] ?>"><?php echo $result['description'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                            <td><select name="" id="" class="form-select form-select-sm">
                                                    <option value="Import">Import</option>
                                                    <option value="Export">Export</option>
                                                    <option value="Other" selected>Other service</option>
                                                </select></td>
                                            <td><input type="input" class="form-control form-control-sm " id="" placeholder=""></td>
                                            <td><select name="" class="form-select form-select-sm" id="">
                                                    <option value="">THB</option>
                                                </select></td>
                                            <td><input type="input" class="form-control form-control-sm " id="" placeholder=""></td>
                                            <td onclick="">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.7688 8.71387H16.2312C18.5886 8.71387 20.5 10.5831 20.5 12.8885V17.8254C20.5 20.1308 18.5886 22 16.2312 22H7.7688C5.41136 22 3.5 20.1308 3.5 17.8254V12.8885C3.5 10.5831 5.41136 8.71387 7.7688 8.71387ZM11.9949 17.3295C12.4928 17.3295 12.8891 16.9419 12.8891 16.455V14.2489C12.8891 13.772 12.4928 13.3844 11.9949 13.3844C11.5072 13.3844 11.1109 13.772 11.1109 14.2489V16.455C11.1109 16.9419 11.5072 17.3295 11.9949 17.3295Z" fill="currentColor"></path>
                                                    <path opacity="0.4" d="M17.523 7.39595V8.86667C17.1673 8.7673 16.7913 8.71761 16.4052 8.71761H15.7447V7.39595C15.7447 5.37868 14.0681 3.73903 12.0053 3.73903C9.94257 3.73903 8.26594 5.36874 8.25578 7.37608V8.71761H7.60545C7.20916 8.71761 6.83319 8.7673 6.47754 8.87661V7.39595C6.4877 4.41476 8.95692 2 11.985 2C15.0537 2 17.523 4.41476 17.523 7.39595Z" fill="currentColor"></path>
                                                </svg>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-link btn-soft-light rounded-pill" onclick="quartation.addhtmlsub_tbl();">add new</button>
                        </div>
                        <div style="color:red;">* if unit price it is null system will chage to at cost if any </div>
                        <div style="float: right">
                            <button class="btn btn-warning rounded-pill bg-gradient btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-line"></i> Export Document</button>
                            <button class="btn btn-success rounded-pill bg-gradient btn-sm" onclick="quartation.quotation_save();" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save</button>
                            <button class="btn btn-primary rounded-pill bg-gradient btn-sm" onclick="quartation.quick_markup();" target="_blank" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Go to markup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </main>
    <!-- Footer Section Start -->
    <?php include 'include/footermain.php'; ?>
    <!-- Footer Section End -->
    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <?php include 'include/offcanvas.php'; ?>
    <?php include '../assets/include/theme_include_js.php'; ?>
</body>

</html>




<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    // document.getElementById("defaultOpen").click();
</script>

<script src="js/quartation/quartation.js"></script>
<script>
    $(document).ready(function(){
        sidebar_main.set_data_rows();
    });
</script>