<?php
require 'function/auth/get_session.php';

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Quotation Markup</title>
    <?php include '../assets/include/theme_include_css.php'; ?>
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
                                                <input type="text" class="form-control form-control-sm inp_quono" readonly>
                                            </div>
                                            <label class="control-label col-sm-3 col-lg-2 align-self-center " for="pwd2">sign status :</label>
                                            <div class="col-lg-2 col-md-3">
                                                <input type="text" class="form-control form-control-sm inp_sign_st" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Consignee:</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm sel_consignee" disabled>
                                            <option value="" selected>Plese select Congsignee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Term :</label>
                                    <div class="col-sm-1 col-md-3 col-lg-4">
                                        <select class="select form-select form-select-sm sel_term" disabled>
                                            <option value="" selected>Plese select Term</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Commodity :</label>
                                    <div class="col-sm-1 col-md-6 col-lg-4">
                                        <input type="text" class="form-control form-control-sm inp_commodity" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Type:</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <select class="form-select form-select-sm sel_title_type" disabled>
                                            <option value="" selected>-- Plese select type --</option>
                                            <option value="Import">Import</option>
                                            <option value="Export">Export</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Sale:</label>
                                    <div class="col-sm-9 col-md-5 col-lg-4">
                                        <input type="input" class="form-control form-control-sm inp_sale_user" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <H4>Service Description</H4>
                                    <div class="table-responsive mt-4">
                                        <table id="basic-table" name="container-tbl" class="table table-striped mb-10 tbl_service_desc" role="grid">
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

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <H4>Remark</H4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="remark_pdf"></div>

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
                                            <input type="text" class="form-control form-control-sm inp_desc_qty" value="0" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-lg-2 col-md-3 align-self-center mb-0" for="pwd2">Unit price after markup:</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm inp_sum_aftermarkup_usd" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">USD</label>
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm inp_sum_aftermarkup_thb" placeholder="" readonly>
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
                                                    <input type="text" class="form-control form-control-sm inp_sum_markup_usd" placeholder="" readonly>
                                                </div>
                                                <label class="control-label col-lg-1 col-md-2 align-self-center mb-0" for="pwd2">USD</label>
                                                <div class="col-lg-2 col-md-4">
                                                    <input type="text" class="form-control form-control-sm inp_sum_markup_thb" placeholder="" readonly>
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
                                    <button class="btn btn-primary rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="quartation_markup.save_markup();"><i class="bi bi-check-square"></i> Save</button>
                                    <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="quartation_markup.export_markup_pdf();"><i class="bi bi-line"></i> Export Document</button>
                                    <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="quartation_markup.sign_markup();"><i class="bi bi-line"></i> Sign</button>
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

<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script src="js/quartation/quartation_markup.js"></script>

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
</script>
<script>
    $(document).ready(function() {
        sidebar_main.set_data_rows();

        var MAX_ROWS = 12;
        var quill = new Quill('.remark_pdf', {
            theme: 'snow'
        });

        quill.on('text-change', function(delta, oldDelta, source) {
            var text = quill.getText();
            var numLines = text.split('\n').length;
            if (numLines > MAX_ROWS) {
                // Remove the last line if the number of rows exceeds the limit
                quill.deleteText(text.length - 1, 1);
            }
            var html = quill.root.innerHTML;
            console.log(html);

            // Get the content of the editor and save it to PDF_REMARK
            var remark = quill.getText();
            PDF_REMARK = html;
        });
    });
</script>