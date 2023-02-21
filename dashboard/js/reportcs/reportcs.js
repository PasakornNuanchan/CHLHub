const reportcs = {
    job_number_global : '',
    check_get: function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        let get_job_number = getUrlParameter('job_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job_number == false ? null : get_job_number;
        let action = get_action == false ? null : get_action;
        reportcs.job_number_global = job_number
        console.log(action);

        if (action == 'preview') {
            reportcs.set_preview_data(job_number);
            reportcs_set_default.set_data_default(job_number);
        } else {

        }
    },
    ajax_set_preview_data: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/reportcs/get_preview_data.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },



    set_preview_data: async function (job_number) {



        let res_data = await reportcs.ajax_set_preview_data(job_number);
        console.log(res_data);

        // head of menu and breadcrumb
        $('.head-of-menu').html('Report Customser Service');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-reportcs-list.php" target="" style="color:white;">Report Customer service List </a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Report Customer Service (Job Number ${res_data['de']['job_number']})</li>`;
        $('.bcpage').append(html_bdpage);



        // supplier
        let html_supplier = '';
        $.each(res_data['supplier'], function (i, k) {
            html_supplier += `
            <option value="${k['transport_sup_number']}">${k['transport_sup_name']}</option>
            `;
        });
        $('.sel-supplier').append(html_supplier);

        //job detail
        $('.inp-job_number').val(res_data['de']['job_number']).attr('readonly', true);
        $('.inp-inv').val(res_data['de']['inv']);
        $('.inp-consignee').val(res_data['de']['consignee_name']).attr('readonly', true);
        $('.inp-mbl').val(res_data['de']['mbl']);
        $('.inp-eth-job').val(res_data['de']['etd']);
        $('.inp-hbl').val(res_data['de']['hbl']);
        $('.inp-eta-job').val(res_data['de']['eta']);
        $('.inp-carrier').val(res_data['de']['carrier_name']).attr('readonly', true);
        $('.inp-pol').val(res_data['de']['pol']).attr('readonly', true);
        $('.inp-mother-vessel-job').val(res_data['de']['mvessel']).attr('readonly', true);
        $('.inp-vessel-job').val(res_data['de']['fvessel']).attr('readonly', true);
        $('.inp-pod').val(res_data['de']['pod']).attr('readonly', true);
        $('.inp-port').val(res_data['de']['port']).attr('readonly', true);
        $('.inp-invno').val(res_data['de']['inv']).attr('readonly', true);
        // Document date
        $('.inp-clearance_date').val(res_data['de']['clearlance_date']).attr('readonly', true);
        $('.inp-check_doc').val(res_data['de']['check_document']).attr('readonly', true);
        $('.inp-delivery').val(res_data['de']['delivery_date']).attr('readonly', true);
        $('.inp-enter').val(res_data['de']['enter_date']).attr('readonly', true);
        $('.inp-pick_do').val(res_data['de']['pickup_DO_date']).attr('readonly', true);

        //Document
        if (res_data['dej']['INV_receiv_by'] == "") {
            inv_status = '';
            inv_status_edit = 'hidden';

        } else {
            inv_status = 'hidden';
            inv_status_edit = '';
        }
        if (res_data['dej']['BL_receiv_by'] == "") {
            bl_status = '';
            bl_status_edit = 'hidden';

        } else {
            bl_status = 'hidden';
            bl_status_edit = '';
        }
        if (res_data['dej']['PL_receiv_by'] == "") {
            pl_status = '';
            pl_status_edit = 'hidden';

        } else {
            pl_status = 'hidden';
            pl_status_edit = '';
        }
        if (res_data['dej']['ID_receiv_by'] == "") {
            id_status = '';
            id_status_edit = 'hidden';

        } else {
            id_status = 'hidden';
            id_status_edit = '';
        }
        if (res_data['dej']['IL_receiv_by'] == "") {
            il_status = '';
            il_status_edit = 'hidden';

        } else {
            il_status = 'hidden';
            il_status_edit = '';
        }

        let inv_receiv_by = res_data['dej']['INV_receiv_by'];
        let inv_receiv_datetime = res_data['dej']['inv_receiv_datetime'];
        let inv_check_by = res_data['dej']['INV_check_by'];
        let inv_check_datetime = res_data['dej']['inv_check_datetime'];

        if (res_data['dej']['INV_receiv_by'] == null) {
            inv_receiv_by = "";
        } if (res_data['dej']['inv_receiv_datetime'] == null) {
            inv_receiv_datetime = "";
        } if (res_data['dej']['INV_check_by'] == null) {
            inv_check_by = "";
        } if (res_data['dej']['inv_check_datetime'] == null) {
            inv_check_datetime = "";
        }

        let BL_receiv_by = res_data['dej']['BL_receiv_by'];
        let BL_receiv_datetime = res_data['dej']['bl_receiv_datetime'];
        let BL_check_by = res_data['dej']['BL_check_by'];
        let BL_check_datetime = res_data['dej']['bl_check_datetime'];

        if (res_data['dej']['BL_receiv_by'] == null) {
            BL_receiv_by = "";
        } if (res_data['dej']['bl_receiv_datetime'] == null) {
            BL_receiv_datetime = "";
        } if (res_data['dej']['BL_check_by'] == null) {
            BL_check_by = "";
        } if (res_data['dej']['bl_check_datetime'] == null) {
            BL_check_datetime = "";
        }

        let PL_receiv_by = res_data['dej']['PL_receiv_by'];
        let PL_receiv_datetime = res_data['dej']['pl_receiv_datetime'];
        let PL_check_by = res_data['dej']['PL_check_by'];
        let PL_check_datetime = res_data['dej']['pl_check_datetime'];

        if (res_data['dej']['PL_receiv_by'] == null) {
            PL_receiv_by = "";
        } if (res_data['dej']['pl_receiv_datetime'] == null) {
            PL_receiv_datetime = "";
        } if (res_data['dej']['PL_check_by'] == null) {
            PL_check_by = "";
        } if (res_data['dej']['pl_check_datetime'] == null) {
            PL_check_datetime = "";
        }

        let ID_receiv_by = res_data['dej']['ID_receiv_by'];
        let ID_receiv_datetime = res_data['dej']['id_receiv_datetime'];
        let ID_check_by = res_data['dej']['ID_check_by'];
        let ID_check_datetime = res_data['dej']['id_check_datetime'];

        if (res_data['dej']['ID_receiv_by'] == null) {
            ID_receiv_by = "";
        } if (res_data['dej']['id_receiv_datetime'] == null) {
            ID_receiv_datetime = "";
        } if (res_data['dej']['ID_check_by'] == null) {
            ID_check_by = "";
        } if (res_data['dej']['id_check_datetime'] == null) {
            ID_check_datetime = "";
        }

        let IL_receiv_by = res_data['dej']['IL_receiv_by'];
        let IL_receiv_datetime = res_data['dej']['il_receiv_datetime'];
        let IL_check_by = res_data['dej']['IL_check_by'];
        let IL_check_datetime = res_data['dej']['il_check_datetime'];

        if (res_data['dej']['IL_receiv_by'] == null) {
            IL_receiv_by = "";
        } if (res_data['dej']['il_receiv_datetime'] == null) {
            IL_receiv_datetime = "";
        } if (res_data['dej']['IL_check_by'] == null) {
            IL_check_by = "";
        } if (res_data['dej']['il_check_datetime'] == null) {
            IL_check_datetime = "";
        }


        html_detail_des = `
                    <tr>
                        <td>Invoice : </td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${inv_receiv_by}</td>
                        <td align="center">${inv_receiv_datetime}</td>
                        <td align="center">${inv_check_by}</td>
                        <td align="center">${inv_check_datetime}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="reportcs.modal_doc('inv')" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${inv_status}><i class="bi bi-check-square"></i> receiv</button>
                        <button type="button" class="btn btn-warning rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${inv_status_edit}><i class="bi bi-pencil-square"></i> Edit</button></td>
                    </tr>
                    <tr>
                        <td>Bill of lading</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${BL_receiv_by}</td>
                        <td align="center">${BL_receiv_datetime}</td>
                        <td align="center">${BL_check_by}</td>
                        <td align="center">${BL_check_datetime}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="reportcs.modal_doc('bl')" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${bl_status}><i class="bi bi-check-square"></i> receiv</button>
                        <button type="button" class="btn btn-warning rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${bl_status_edit}><i class="bi bi-pencil-square"></i> Edit</button></td>
                    </tr>
                    <tr>
                        <td>Packing list</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${PL_receiv_by}</td>
                        <td align="center">${PL_receiv_datetime}</td>
                        <td align="center">${PL_check_by}</td>
                        <td align="center">${PL_check_datetime}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="reportcs.modal_doc('pl')" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${pl_status}><i class="bi bi-check-square"></i> receiv</button>
                        <button type="button" class="btn btn-warning rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${pl_status_edit}><i class="bi bi-pencil-square"></i> Edit</button></td>
                    </tr>
                    <tr>
                        <td>Import Declaration</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${ID_receiv_by}</td>
                        <td align="center">${ID_receiv_datetime}</td>
                        <td align="center">${ID_check_by}</td>
                        <td align="center">${ID_check_datetime}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="reportcs.modal_doc('id')" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${id_status}><i class="bi bi-check-square"></i> receiv</button>
                        <button type="button" class="btn btn-warning rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${id_status_edit}><i class="bi bi-pencil-square"></i> Edit</button></td>
                    </tr>
                    <tr>
                        <td>Import Licence</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${IL_receiv_by}</td>
                        <td align="center">${IL_receiv_datetime}</td>
                        <td align="center">${IL_check_by}</td>
                        <td align="center">${IL_check_datetime}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="reportcs.modal_doc('il')" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${il_status}><i class="bi bi-check-square"></i> receiv</button>
                        <button type="button" class="btn btn-warning rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${il_status_edit}><i class="bi bi-pencil-square"></i> Edit</button></td>
                    </tr>
                `;
        $('[name = tbl_job_status] tbody').html(html_detail_des);
        $('.inp-etd').val(res_data['dej']['']).attr('readonly', true);
        $('.inp-clearance_by').val(res_data['dej']['custom_by']).attr('readonly', true);
        $('.inp-datetime_success').val(res_data['dej']['Cus_suc_datetime']).attr('readonly', true);

        //container
        var html_container = '';
        var container_type_check = '';
        var container_type_name = '';
        $('[name = container-tbl] tbody').html('');
        var num_container_rows = '1';
        $.each(res_data['cont'], function (i, v) {

            if ((container_type_check = v['container_type']) == null) {
                $('[name = container-tbl] tbody').html('');
            } else {
                sub_container = container_type_check.substring(2);
                if (sub_container == "GP" || sub_container == "U9") {
                    container_type_name = "General Purpose";
                } if (sub_container == "HC") {
                    container_type_name = "High Cube";
                } if (sub_container == "RH") {
                    container_type_name = "Refrigerated High Cube";
                } if (sub_container == "OT") {
                    container_type_name = "Open Top";
                } if (sub_container == "FR") {
                    container_type_name = "Flat Rack ";
                } if (sub_container == "RF") {
                    container_type_name = "Refrigerated Container";
                } if (sub_container == "TK") {
                    container_type_name = "ISO Tank";
                }

                if ((soc = v['soc']) == 1) {
                    soc = "checked";
                } else {
                    soc = "";
                } if ((ow = v['ow']) == 1) {
                    ow = "checked";
                } else {
                    ow = "";
                }
                pcs = parseFloat(v['pcs']);
                gross_weight = parseFloat(v['gross_weight']);
                cbm = parseFloat(v['cbm']);
                sng = parseFloat(v['single_cnt']);
                html_container = `
                <tr container_data_id=${v['ID']}>
                    <td>${num_container_rows}</td>
                    <td>${container_type_name} (${v['container_type']})</td>
                    <td><input type="text" class="form-control form-control-sm inp-container_number" value="${v['container_number']}"></td>
                    <td><input type="text" class="form-control form-control-sm inp-seal_number" value="${v['seal_number']}"></td>
                    <td><input type="text" class="form-control form-control-sm inp-gw" style="text-align:right;" value="${gross_weight.toFixed(1)}"></td>
                    <td><input type="text" class="form-control form-control-sm inp-cbm" style="text-align:right;" value="${cbm.toFixed(2)}"></td>
                    <td><input type="checkbox" class="form-check-input" ${soc} disabled></td>
                    <td><input type="checkbox" class="form-check-input" ${ow} disabled></td>
                    <td><input type="text" class="form-control form-control-sm" value="${v['cy']}" readonly></td>
                    <td><input type="text" class="form-control form-control-sm" value="${v['rtn']}" readonly></td>
                </tr>
                `;
                num_container_rows++;
                $('[name = container-tbl] tbody').append(html_container);
            }
        });
        html_transport = '';
        var html_select_supplier = $('.sel-supplier').parent().html();
        var html_select_cur = $('.sel-cur').parent().html();
        var html_select_truck = $('.inp-type_truck').parent().html();

        route = 1;



        $.each(res_data['tran'], async function (i, v) {
            $('.card-transport').html('');
            //budget = parseFloat(v['budget']);


            //let budget = parseFloat(v['budget']);
            let pcea = v['pick_con_empty_address'] || '';
            let pcer = v['pick_con_empty_remark'] || '';
            let pca = v['pick_con_address'] || '';
            let pcr = v['pick_con_remark'] || '';
            let dca = v['drop_con_address'] || '';
            let dcr = v['drop_con_remark'] || '';
            let dcea = v['drop_con_empty_address'] || '';
            let dcer = v['drop_con_empty_remark'] || '';
            //let sldt = v['sent_line_datetime'] || '';
            let scf = v['sup_confirm'] || '';
            let type_truck = !!v['type_truck'] ? v['type_truck'] : '';
            let remark = v['remark'] || '';

            let sup_n = !!v['sup_number'] ? v['sup_number'] : '';
            let cur_n = !!v['cur'] ? v['cur'] : '';
            let truck_quantity = !!v['truck_quantity'] ? v['truck_quantity'] : '';

            let ID_test = v['ID'];
            html_driver_transport = '';
            let num_tran_driver = '1';
            $.each(res_data['transport_driver_arr'][ID_test], async function (i1, v1) {
                html_driver_transport += `
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Driver ${num_tran_driver}:</label>
                    <div class="col-sm-9 col-lg-10">
                        <div class="row">
                            <div class="col-sm-3 col-lg-2">
                                <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${v1['Driver_name']}" readonly>
                            </div>
                            <div class="col-sm-3 col-lg-2">
                                <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${v1['phone_number']}" readonly>
                            </div>
                            <label class="control-label col-sm-2 col-lg-2 align-self-center mb-0">container_number :</label>
                            <div class="col-sm-3 col-lg-2">
                                <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${v1['container_number']}" readonly>
                            </div>
                            <label class="control-label col-sm-2 col-lg-2 align-self-center mb-0">seal_number :</label>
                            <div class="col-sm-3 col-lg-2">
                            <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${v1['seal_number']}" readonly>
                        </div>
                        </div>
                    </div>
                </div>`;
                num_tran_driver++;
            })

            html_transport += `
        <div class="card-transport">
            <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Booking Transport Detail (Route ${route})</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-3 col-lg-2  align-self-center mb-0">Supplier:</label>
                    <div class="col-sm-3 col-md-5">
                        <div class="db-sel-sup db-sel-sup${i}">
                            ${html_select_supplier}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Empty Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_emp" value="${pcea}" readonly>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_emp_remark" value="${pcer}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control inp-pick_con" value="${pca}" readonly>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control inp-pick_con_remark" value="${pcr}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control inp-drop_con" value="${dca}" readonly>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control inp-drop_con_reamrk" value="${dcr}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Empty Containe Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control inp-drop_emp" value="${dcea}" readonly>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control inp-drop_emp_remark" value="${dcer}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Type Truck:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                            <div class="db-sel-truck db-sel-truck${i}">
                           ${html_select_truck}
                           </div>
                            </div>
                            <label class="control-label col-sm-2 col-lg-1 align-self-center ">Remark</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-remark_truck" value="${remark}" readonly> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Truck Quantity:</label>
                    <div class="col-sm-3 col-lg-1">
                        <input type="text" class="form-control form-control-sm inp-truck_quantity" style="text-align:right;" value="${truck_quantity}" readonly>
                    </div>
                </div>  
                <hr class="mb-4">
                <h4 class="mb-4">Driver detail</h4>
                ${html_driver_transport}
                <hr class="mb-4">
                <h4 class="mb-4">Supplier confirm</h4>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Supplier Confirm DateTime :</label>
                    <div class="col-sm-3 col-lg-3">
                        <input type="input" class="form-control form-control-sm inp-supplier_firm" value="${scf}" readonly>
                    </div>
                </div>
            </div>
        </div>  
    </div>    
                `;
            route++;
            await $('.card-transport').append(html_transport);

            $(`.db-sel-truck${i} > select`).val(type_truck).attr('disabled', true);
            $(`.db-sel-sup${i} > select`).val(sup_n).attr('disabled', true);
            $(`.db-sel-cur${i} > select`).val(cur_n).attr('disabled', true);


        });
        // booking set (booking detail)
        $('.inp-shper').val(res_data['booking']['shipper_number']).attr('disabled', true);
        $('.inp-shptrm').val(res_data['booking']['st_number']).attr('disabled', true);

        $('.inp-carrier-sel').val(res_data['booking']['carrier_number']).attr('disabled', true);
        $('.inp-prtrecieve').val(res_data['booking']['port_of_receipt_number']).attr('disabled', true);
        $('.inp-prtload').val(res_data['booking']['port_of_loading_number']).attr('disabled', true);
        $('.inp-ts_port').val(res_data['booking']['ts_port_number']).attr('disabled', true);
        $('.inp-delivery-sel-booking').val(res_data['booking']['port_of_delivery_number']).attr('disabled', true);



        $('.inp-jobno').val(res_data['booking']['job_number']).attr('readonly', true);
        $('.inp-bkno').val(res_data['booking']['booking_number']).attr('readonly', true);

        $('.inp-rmk').val(res_data['booking']['remark']).attr('readonly', true);

        $('.inp-M_vessel').val(res_data['booking']['mother_vessel']).attr('readonly', true);
        $('.inp-mother-voy-no').val(res_data['booking']['voy_no_mother']).attr('readonly', true);
        $('.inp-feeder_vessel').val(res_data['booking']['feeder_vessel']).attr('readonly', true);
        $('.inp-feeder_voy_no').val(res_data['booking']['voy_no_feeder']).attr('readonly', true);
        $('.inp-etd').val(res_data['booking']['etd']).attr('readonly', true);
        $('.inp-eta').val(res_data['booking']['eta']).attr('readonly', true);

        $('.inp-cargodes').val(res_data['cninform']['cargo']).attr('readonly', true);

        let db_sel_hs = '';
        $.each(res_data['hscode'], function (i, k) {
            db_sel_hs += `
             <option value="${k['hs_code']}">${k['hs_code']} ${k['hs_decription']}</option>
             `;
        });
        $('.inp-hscode').append(db_sel_hs);

        $('.inp-hscode').val(res_data['cninform']['hs_code'] + ' ' + res_data['cninform']['hs_decription']).attr('disabled', true);
        $('.inp-cargo_type').val(res_data['cninform']['cargo_type']).attr('disabled', true);
        $('.inp-cargo_qty').val(res_data['cninform']['quantity']).attr('readonly', true);
        $('.inp-cargo_gw').val(res_data['cninform']['gw']).attr('readonly', true);
        $('.inp-cargo_vol').val(res_data['cninform']['volume']).attr('readonly', true);
        $('.inp-cargo_marks').val(res_data['cninform']['mark']).attr('readonly', true);

    

        // html_dem_charge = '';
        //  db_dem_container = $('.sel-dem-container').parent().html()
        // let db_dem_cy = $('.inp-dem-cy').parent().html()
        // let db_dem_rtn = $('.inp-dem-rtn').parent().html()
        // $('.Demurrage-part-add').html('');

        // num_dem = '1';
        // $.each(res_data['dem'], async function (i, v) {

        //     container_id = v['container_id']

        //     $html_dem_rum = '';

        //     if(num_dem == 1){
        //         $html_dem_rum =  `<button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="reportcs.push_action_del_dem(${v['ID']},this);" disabled><i class="bi bi-dash-lg"></i> Delete Driver</button>`;
        //     }else{
        //         $html_dem_rum = `<button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="reportcs.push_action_del_dem(${v['ID']},this);" ><i class="bi bi-dash-lg"></i> Delete Driver</button>`;
        //     }


        //     html_dem_charge = `    
        // <div class="Demurrage-part-del Demurrage-part-del${v['ID']}" Demurrage_part_del="${v['ID']}">
        // <br>
        //     <h5>Demurrage No.${num_dem}</h5>
        //     <div class="form-group row">
        //         <label class="control-label col-sm-3 col-lg-2">Container number:</label>
        //         <div class="col-lg-10">
        //             <div class="row">
        //                 <div class="col-lg-4">
        //                     <div class="db-sel-dem db-sel-dem${i}">
        //                         ${db_dem_container}
        //                     </div>
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        //     <div class="form-group row">
        //         <label class="control-label col-sm-3 col-lg-2">CY :</label>
        //         <div class="col-lg-10">
        //             <div class="row">
        //                 <div class="col-lg-4">
        //                     <input type="input" class="form-control form-control-sm inp-cy-dem" value="${v['CY']}" readonly>
        //                 </div>
        //                 <label class="control-label col-sm-3 col-lg-1" style="text-align:center;">OLD RTN :</label>
        //                 <div class="col-lg-4">
        //                     <input type="input" class="form-control form-control-sm inp-rtn-dem" value="${v['RTN']}"readonly>
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        //     <div class="form-group row">
        //         <label class="control-label col-sm-3 col-lg-2">Demurrage To :</label>
        //         <div class="col-lg-10">
        //             <div class="row">
        //                 <div class="col-lg-4">
        //                     <input type="date" class="form-control form-control-sm inp-rtn-new-dem" value="${v['new_dem_time']}">
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        //     <div class="form-group row">
        //         <label class="control-label col-sm-3 col-lg-2">Document :</label>
        //         <div class="col-lg-10">
        //             <div class="row">
        //                 <div class="col-lg-4">
        //                     <input type="file" class="form-control form-control-sm inp-doc-dem">
        //                 </div>
        //                 <div class="col-lg-4">
        //                 ${$html_dem_rum}
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        // </div>`;
        //     num_dem++;
        //     $('.Demurrage-part-add').append(html_dem_charge);
        //     $(`.db-sel-dem${i} > select`).val(container_id)



        // })

        await reportcs_sub_container_dem.set_preview_data(job_number)
    },

    adddemhtml: function (e = null) {
        
        html_add_dem = '';
        html_add_dem = `
        <div class="Demurrage-part-del Demurrage-part-del" Demurrage-part-del="">
        <br>
            <h5>Demurrage No.${num_dem}</h5>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2">Container number:</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="db-sel-dem">
                                ${db_dem_container}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2">CY :</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="input" class="form-control form-control-sm inp-cy-dem"  readonly>
                        </div>
                        <label class="control-label col-sm-3 col-lg-1" style="text-align:center;">OLD RTN :</label>
                        <div class="col-lg-4">
                            <input type="input" class="form-control form-control-sm inp-rtn-dem" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2 ">Demurrage To :</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="date" class="form-control form-control-sm inp-rtn-new-dem">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2">Document :</label>
                <div class="col-lg-10">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="file" class="form-control form-control-sm inp-doc-dem">
                        </div>
                        <div class="col-lg-4">
                        <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="reportcs.push_action_del_dem();" ><i class="bi bi-dash-lg"></i> Delete Driver</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        
        $('.Demurrage-part-add').append(html_add_dem);
        num_dem++;
        num_count_del_delete = '1';
        
    }, 
    
    push_action_del_dem: async function (ID){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
          }).then(async (result) => {
            if (result.isConfirmed) {
                await reportcs.ajax_del_dem(ID)
                await Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
               await reportcs_sub_container_dem.set_preview_data(reportcs.job_number_global)
            }
          }) 
    },

    ajax_del_dem : async function(dem_arr_del){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/del_dem.php",
                data: {'dem_arr_del' : dem_arr_del},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    
    push_action_save_container: async function (){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
          }).then(async (result) => {
            if (result.isConfirmed) {
                await reportcs.save_container()
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
               
            }
          }) 
    },
    save_container : async function(i, e){
        let container_arr = [];
        let container_arr_tmp = {};

        $('[name = container-tbl] tbody > tr').each(function(i ,e ){

        let ID = $(this).attr('container_data_id');
        let container_nubmer = $('.inp-container_number', this).val();
        let seal_number = $('.inp-seal_number', this).val();
        let gw = $('.inp-gw', this).val();
        let cbm = $('.inp-cbm', this).val();

        container_arr_tmp = {
            ID:ID,
            container_nubmer: container_nubmer,
            seal_number: seal_number,
            gw: gw,
            cbm: cbm,
          }

          container_arr.push(container_arr_tmp)
        });


        //console.log(container_arr);
       let res = await reportcs.ajax_save_container(container_arr);
    //    if(res){
    //     alert("testd");
    //    }else{
    //     alert("แตก");
    //    }
       
    },
    ajax_save_container : function(container_arr){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/save_container.php",
                data: {'container_arr' : container_arr},
                dataType: "json",
                success: function (res) {
                    
                    resolve(res);
                    
                },
            });
        });
    },



    container_dem_change: async function (e) {
        let val = $(e).val();
        let parent = $(e).closest('.Demurrage-part-del');
        let res_data_dem = await reportcs.ajax_dem_change(val);
        $('.inp-cy-dem', parent).val(res_data_dem['CY']);
        $('.inp-rtn-dem', parent).val(res_data_dem['RTN']);
    },

    ajax_dem_change: function (val) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/reportcs/get_value_dem.php",
                data: { 'val': val },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    push_action_save_dem : async function (){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
          }).then(async (result) => {
            if (result.isConfirmed) {
                await reportcs.save_dem()
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
               
            }
          }) 
    },

    save_dem : async function(i, e){
        let dem_arr = [];
        let dem_arr_tmp = {};

        $('.Demurrage-part-del').each(function (i,e){
            
            let ID_dem = $(this).attr('demurrage_part_del')
            let containe_ID = $('.sel-dem-container',this).val();
            let old_dem = $('.inp-rtn-dem',this).val();
            let new_dem = $('.inp-rtn-new-dem',this).val();
            let doc = $('.inp-doc-dem',this).val(); 

            
            dem_arr_tmp = {
            ID_dem : ID_dem,
            containe_ID:containe_ID,
            old_dem: old_dem,
            new_dem:new_dem,
            doc:doc,
          }

          dem_arr.push(dem_arr_tmp)
        });
        
        console.log(dem_arr)
       let res = await reportcs.ajax_save_dem(dem_arr);
   
    },
    ajax_save_dem : function(dem_arr){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/reportcs/save_dem.php",
                data: {'dem_arr' : dem_arr},
                dataType: "json",
                success: function (res) {
                    
                    resolve(res);
                    
                },
            });
        });
    },

    ajax_save_container : function(container_arr){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/save_container.php",
                data: {'container_arr' : container_arr},
                dataType: "json",
                success: function (res) {
                    
                    resolve(res);
                    
                },
            });
        });
    },

    modal_doc: function (val_get) {
        if ($('#add_moda').length >= 1) {
          $('#add_moda').remove()
        }
            console.log(val_get)
        let head_modal = '';
        if(val_get == "inv"){
            head_modal = "invoice"
        }else if(val_get == "bl"){
            head_modal = "Bill of landing"
        }else if(val_get == "pl"){
            head_modal = "Packing list"
        }else if(val_get == "id"){
            head_modal = "Import Declaratio"
        }else if(val_get == "il"){
            head_modal = "Import Licence"
        }

        html = `
            <div class="modal fade" id="add_moda">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">${head_modal}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body ps-5">
                            <div class="form-group">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3" for="">upload file :</label>
                                    <div class="col-sm-11 col-lg-8 col-md-6">
                                        <input type="file" class="form-control form-control-sm inp-quo_no" >
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                
                    </div>
                </div>
            </div>`
    
        $('body').append(html)
        $('#add_moda').modal('show')
      },




};


function number_format(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}
