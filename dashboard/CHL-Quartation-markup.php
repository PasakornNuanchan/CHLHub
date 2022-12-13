<?php
session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
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
                                    <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center " for="pwd2">Quartation number :</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-2 align-self-center " for="pwd2">sign status :</label>
                                            <div class="col-lg-2 col-md-3">
                                                <input type="text" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Consignee:</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm" disabled>
                                            <option value="" selected>Plese select Congsignee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Term :</label>
                                    <div class="col-sm-1 col-md-3 col-lg-4">
                                        <select class="select form-select form-select-sm" disabled>
                                            <option value="" selected>Plese select Term</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Commodity :</label>
                                    <div class="col-sm-1 col-md-6 col-lg-4">
                                        <input type="text" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Type:</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm" disabled>
                                            <option value="" selected>-- Plese select type --</option>
                                            <option value="">Import</option>
                                            <option value="">Export</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Sale:</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <input type="input" class="form-control form-control-sm" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <H4>Service Description</H4>
                                    <div class="table-responsive mt-4">
                                        <table id="basic-table" name="container-tbl" class="table table-striped mb-10" role="grid">
                                            <thead>
                                                <tr align="center">
                                                    <th>Item NO.</th>
                                                    <th>Description</th>
                                                    <th>Type</th>
                                                    <th>Unit Price</th>
                                                    <th>Cur.</th>
                                                    <th>remark</th>
                                                    <th>markup</th>
                                                    <th>markup result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="booking_container">
                                                    <td align="center">1</td>
                                                    <td><input type="input" class="form-control form-control-sm" readonly value="Ocean freight TSL Co,.ltd LCB to Osaka"></td>
                                                    <td><select name="" id="" class="form-select form-select-sm" disabled>
                                                            <option value="">Plese select type</option>
                                                            <option value="">Import</option>
                                                            <option value=""selected>Export</option>
                                                            <option value="">Other service</option>
                                                        </select></td>
                                                    <td><input type="input" class="form-control form-control-sm " id="" value="450" readonly></td>
                                                    <td><select name="" class="form-select form-select-sm" id="" disabled>
                                                            <option value="">THB</option>
                                                            <option value="" selected>USD</option>
                                                            <option value="">RMB</option>
                                                        </select></td>
                                                    <td><input type="input" class="form-control form-control-sm" id="" value="7*40HQ"></td>
                                                    <td><input type="input" class="form-control form-control-sm"></td>
                                                    <td><input type="input" class="form-control form-control-sm" readonly></td>
                                                </tr>
                                                <tr class="booking_container">
                                                    <td align="center">2</td>
                                                    <td><input type="input" class="form-control form-control-sm" id="" value="Trucking Fee (Import) Rama9 - LCB" readonly></td>
                                                    <td><select name="" id="" class="form-select form-select-sm" disabled>
                                                            <option value="">Plese select type</option>
                                                            <option value="">Import</option>
                                                            <option value=""selected>Export</option>
                                                            <option value="">Other service</option>
                                                        </select></td>
                                                    <td><input type="input" class="form-control form-control-sm " id="" value="17000" readonly></td>
                                                    <td><select name="" class="form-select form-select-sm" id="" disabled>
                                                            <option value="">THB</option>
                                                        </select></td>
                                                    <td><input type="input" class="form-control form-control-sm" id="" placeholder=""></td>
                                                    <td><input type="input" class="form-control form-control-sm"></td>
                                                    <td><input type="input" class="form-control form-control-sm" readonly></td>
                                                </tr>
                                                <tr class="booking_container">
                                                    <td align="center">3</td>
                                                    <td><input type="input" class="form-control form-control-sm " id="" value="Trucking Fee (Export) Osaka - Tokyo" readonly></td>
                                                    <td><select name="" id="" class="form-select form-select-sm" disabled>
                                                            <option value="">Plese select type</option>
                                                            <option value=""selected>Import</option>
                                                            <option value="">Export</option>
                                                            <option value="">Other service</option>
                                                        </select></td>
                                                    <td><input type="input" class="form-control form-control-sm " id="" value="500" readonly></td>
                                                    <td><select name="" class="form-select form-select-sm" id="" disabled>
                                                            <option value="">THB</option>
                                                            <option value="" selected>USD</option>
                                                            <option value="">RMB</option>
                                                        </select></td>
                                                    <td><input type="input" class="form-control form-control-sm" id="" placeholder=""></td>
                                                    <td><input type="input" class="form-control form-control-sm"></td>
                                                    <td><input type="input" class="form-control form-control-sm" readonly></td>
                                                </tr>
                                                <tr class="booking_container">
                                                    <td align="center">4</td>
                                                    <td class="col-lg-3"><select name="" class="form-select form-select-sm" disabled>
                                                            <option value="">Plese Select service</option>
                                                            <option value="">DF/DO Fee</option>
                                                            <option value="">THC</option>
                                                            <option value="">Seal Fee</option>
                                                            <option value="">Handling Charge</option>
                                                            <option value="" selected>Import Duty With Vat</option>
                                                            <option value="">Customs Clearance Charge</option>
                                                            <option value="">Customs fee</option>
                                                            <option value="">Customs Inspection Charge</option>
                                                            <option value="">Gate Charge</option>
                                                            <option value="">Pick-up Empty Container Fee</option>
                                                            <option value="">Return Laden Container Fee</option>
                                                            <option value="">Container Cleaning Charge</option>
                                                            <option value="">Equipment Maintenance Fee</option>
                                                            <option value="">Demurrage & Detention</option>
                                                            <option value="">Over time Charge for truck</option>
                                                            <option value="">Storage Charge</option>
                                                            <option value="">Over time charge for customer </option>
                                                            <option value="">insurance</option>
                                                            <option value="">Surrender BL Fee</option>
                                                            <option value="">AMS (amtomated manifest system)</option>
                                                            <option value="">Carrier Security Charge</option>
                                                            <option value="">Port Security Charge (PU)</option>
                                                        </select></td>
                                                    <td><select name="" id="" class="form-select form-select-sm" disabled>
                                                            <option value="">Plese select type</option>
                                                            <option value="">Import</option>
                                                            <option value="">Export</option>
                                                            <option value="" selected>Other service</option>
                                                        </select></td>
                                                    <td><input type="input" class="form-control form-control-sm " id="" value="1500" readonly></td>
                                                    <td><select name="" class="form-select form-select-sm" id="" disabled>
                                                            <option value="">THB</option>
                                                        </select></td>
                                                    <td><input type="input" class="form-control form-control-sm" id="" placeholder=""></td>
                                                    <td><input type="input" class="form-control form-control-sm"></td>
                                                    <td><input type="input" class="form-control form-control-sm" readonly></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <H4>Result</H4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">

                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-2 align-self-center mb-0">Description quantity :</label>
                                        <div class="col-sm-1 col-md-3 col-lg-4">
                                            <input type="text" class="form-control form-control-sm" value="4" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-lg-2 col-md-3 align-self-center mb-0" for="pwd2">Unit price after markup:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">USD</label>
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">THB</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-lg-2 col-md-3 align-self-center mb-0" for="pwd2">Markup total:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">USD</label>
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">THB</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-lg-2 col-md-3 align-self-center mb-0" for="pwd2">Percentage :</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">USD</label>
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">THB</label>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">Total</label>
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm" placeholder="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div style="color:red;">* if markup price it is null system will chage to at cost if any </div>
                                <div style="float: right">
                                    <button class="btn btn-primary rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save</button>
                                    <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-line"></i> Export Document</button>
                                    <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-line"></i> Sign</button>
                                </div>
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
    document.getElementById("defaultOpen").click();
</script>