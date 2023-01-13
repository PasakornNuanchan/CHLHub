const reportcs = {
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

        console.log(action);

        if (action == 'preview') {
            reportcs.set_preview_data(job_number);

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
        $('.inp-inv').val(res_data['de']['inv']).attr('readonly', true);
        $('.inp-consignee').val(res_data['de']['consignee_name']).attr('readonly', true);
        $('.inp-mbl').val(res_data['de']['mbl']).attr('readonly', true);
        $('.inp-eth').val(res_data['de']['etd']).attr('readonly', true);
        $('.inp-hbl').val(res_data['de']['hbl']).attr('readonly', true);
        $('.inp-eta').val(res_data['de']['eta']).attr('readonly', true);
        $('.inp-carrier').val(res_data['de']['carrier_name']).attr('readonly', true);
        $('.inp-pol').val(res_data['de']['pol']).attr('readonly', true);
        $('.inp-vessel').val(res_data['de']['vessel']).attr('readonly', true);
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
        $('[name = tbl_job_status] tbody').html('');
        if (res_data['dej']['INV_receiv_by'] == " ") {
            inv_status = '';
        } else {
            inv_status = 'disabled';
        }
        if (res_data['dej']['BL_receiv_by'] == " ") {
            bl_status = '';
        } else {
            bl_status = 'disabled';
        }
        if (res_data['dej']['PL_receiv_by'] == " ") {
            pl_status = '';
        } else {
            pl_status = 'disabled';
        }
        if (res_data['dej']['ID_receiv_by'] == " ") {
            id_status = '';
        } else {
            id_status = 'disabled';
        }
        if (res_data['dej']['IL_receiv_by'] == " ") {
            il_status = '';
        } else {
            il_status = 'disabled';
        }

        html_detail_des = `
                    <tr>
                        <td>Invoice : </td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dej']['INV_receiv_by']}</td>
                        <td align="center">${res_data['dej']['inv_receiv_datetime']}</td>
                        <td align="center">${res_data['dej']['INV_check_by']}</td>
                        <td align="center">${res_data['dej']['inv_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${inv_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Bill of lading</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dej']['BL_receiv_by']}</td>
                        <td align="center">${res_data['dej']['bl_receiv_datetime']}</td>
                        <td align="center">${res_data['dej']['BL_check_by']}</td>
                        <td align="center">${res_data['dej']['bl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${bl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Packing list</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dej']['PL_receiv_by']}</td>
                        <td align="center">${res_data['dej']['pl_receiv_datetime']}</td>
                        <td align="center">${res_data['dej']['PL_check_by']}</td>
                        <td align="center">${res_data['dej']['pl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${pl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Declaration</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dej']['ID_receiv_by']}</td>
                        <td align="center">${res_data['dej']['id_receiv_datetime']}</td>
                        <td align="center">${res_data['dej']['ID_check_by']}</td>
                        <td align="center">${res_data['dej']['pl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${id_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Licence</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dej']['IL_receiv_by']}</td>
                        <td align="center">${res_data['dej']['il_receiv_datetime']}</td>
                        <td align="center">${res_data['dej']['IL_check_by']}</td>
                        <td align="center">${res_data['dej']['il_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${il_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                `;
        $('[name = tbl_job_status] tbody').html(html_detail_des);
        $('.inp-etd').val(res_data['dej']['']).attr('readonly', true);
        $('.inp-clearance_by').val(res_data['dej']['custom_by']).attr('readonly', true);
        $('.inp-datetime_success').val(res_data['dej']['Cus_suc_datatime']).attr('readonly', true);

        //container
        var html_container = '';
        var container_type_check = '';
        var container_type_name = '';
        $('[name = container-tbl] tbody').html('');

        $.each(res_data['cont'], function (i, v) {

            if((container_type_check = v['container_type']) == null) {
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
                <tr>
                    <td>1</td>
                    <td>${container_type_name} (${v['container_type']})</td>
                    <td><input type="text" class="form-control form-control-sm" value="${v['container_number']}"></td>
                    <td><input type="text" class="form-control form-control-sm" value="${v['seal_number']}"></td>
                    <td><input type="text" class="form-control form-control-sm" style="text-align:right;" value="${gross_weight.toFixed(1)}"></td>
                    <td><input type="text" class="form-control form-control-sm" style="text-align:right;" value="${cbm.toFixed(2)}"></td>
                    <td><input type="checkbox" class="form-check-input" ${soc} disabled></td>
                    <td><input type="checkbox" class="form-check-input" ${ow} disabled></td>
                    <td><input type="text" class="form-control form-control-sm" value="${v['cy']}"></td>
                    <td><input type="text" class="form-control form-control-sm" value="${v['rtn']}"></td>
                </tr>
                `;
            $('[name = container-tbl] tbody').append(html_container);
        }
        });
        html_transport = '';
        var html_select_supplier = $('.sel-supplier').parent().html();
        var html_select_cur = $('.sel-cur').parent().html();
        route = 1;
        $.each(res_data['tran'], async function (i, v) {
            $('.card-transport').html('');
            budget = parseFloat(v['budget']);
            if ((pcea = v['pick_con_empty_address']) == null) {
                pcea = '';
            }
            if ((pcer = v['pick_con_empty_remark']) == null) {
                pcer = '';
            }
            if ((pca = v['pick_con_address']) == null) {
                pca = '';
            }
            if ((pcr = v['pick_con_remark']) == null) {
                pcr = '';
            }
            if ((dca = v['drop_con_address']) == null) {
                dca = '';
            }
            if ((dcr = v['drop_con_remark']) == null) {
                dcr = '';
            }
            if ((dcea = v['drop_con_empty_address']) == null) {
                dcea = '';
            }
            if ((dcer = v['drop_con_empty_remark']) == null) {
                dcer = '';
            }
            if ((sldt = v['sent_line_datetime']) == null) {
                sldt = '';
            }
            if ((scf = v['sup_confirm']) == null) {
                scf = '';
            }
            if ((bud = v['budget']) == null) {
                bud = '';
            }
            if ((sup_n = v['sup_number']) == null) {
                sup_n = '';
            }
            if ((cur_n = v['cur']) == null) {
                cur_n = '';
            }

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
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Supplier:</label>
                    <div class="col-sm-3">
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
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-3">Budget:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="input" style="text-align:right;" class="form-control form-control-sm inp-budget" value="${bud}" readonly>
                            </div>
                            <div class="col-lg-1">
                            <div class="db-sel-cur db-sel-cur${i}">
                                ${html_select_cur}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-4">Supplier confirm</h4>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-">Sent Request Line DateTime :</label>
                    <div class="col-sm-3 col-lg-3">
                        <input type="input" class="form-control form-control-sm inp-sent_request_line" value="${sldt}" readonly>
                    </div>
                </div>
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

            $(`.db-sel-sup${i} > select`).val(sup_n).attr('disabled', true);
            $(`.db-sel-cur${i} > select`).val(cur_n).attr('disabled', true);


        });


    }

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
