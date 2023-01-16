const transport ={
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
            transport.set_data_default();
            transport.set_preview_data(job_number);
           
        } else {

        }
    },
    ajax_set_preview_data : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/get_preview_data.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    ajax_set_data : function(){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/get_transport.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    set_data_default: async function (){
        let set_data = await transport.ajax_set_data();
        console.log(set_data);
        //transport supplier
        let html_supplier = '';
        $.each(set_data['supplier'], function (i, k) { 
            html_supplier += `
            <option value="${k['transport_sup_number']}">${k['transport_sup_name']}</option>
            `;  
        });
        $('.sel-supplier').append(html_supplier);

        // booking set select
        // shipper 
        let db_sel_shipper='';
        $.each(set_data['shipper'], function (i, k) {
            db_sel_shipper += `
            <option value="${k['shipper_number']}">${k['shipper_name']}</option>
            `;
        });
        $('.inp-shper').append(db_sel_shipper);

        let db_sel_shipment ='';
        $.each(set_data['shipment'], function (i, k) {
            db_sel_shipment += `
            <option value="${k['st_number']}">${k['st_name']}</option>
            `;
        });

        $('.inp-shptrm').append(db_sel_shipment);
        let db_sel_carrier ='';
        $.each(set_data['carrier'], function (i, k) {
            db_sel_carrier += `
            <option value="${k['carrier_number']}">${k['carrier_name']}</option>
            `;
        });
        $('.inp-carrier').append(db_sel_carrier);
        let db_sel_area ='';
        $.each(set_data['area'], function (i, k) {
            db_sel_area += `
            <option value="${k['area_number']}">${k['location_name']},${k['country']}</option>
            `;
        });
        $('.inp-prtrecieve',).append(db_sel_area);
        $('.inp-prtload',).append(db_sel_area);
        $('.inp-ts_port',).append(db_sel_area);
        $('.inp-delivery',).append(db_sel_area);


        let db_sel_hs ='';
        $.each(set_data['hs'], function (i, k) {
            db_sel_hs += `
            <option value="${k['hs_code']}">${k['hs_code']} ${k['hs_decription']}</option>
            `;
        });
        $('.inp-hscode').append(db_sel_hs);
    },
    set_preview_data: async function (job_number){
        let res_data = await transport.ajax_set_preview_data(job_number);
        console.log(res_data);
        html_transport ='';
        
        // container&driver
        html_select_supplier = $('.sel-supplier').parent().html();
        html_select_cur = $('.sel-cur').parent().html();
        route =1;
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
        // transport
        $.each(res_data['tran'],async function(i,v){
            $('.card-transport').html('');
            budget = parseFloat(v['budget']);
            if((pcea=v['pick_con_empty_address']) == null){
                pcea = '';
            }
            if((pcer=v['pick_con_empty_remark'])== null){
                pcer = '';
            }
            if((pca=v['pick_con_address'])== null){
                pca = '';
            }
            if((pcr=v['pick_con_remark'])== null){
                pcr = '';
            }
            if((dca=v['drop_con_address'])== null){
                dca = '';
            }
            if((dcr=v['drop_con_remark'])== null){
                dcr = '';
            }
            if((dcea=v['drop_con_empty_address'])== null){
                dcea = '';
            }
            if((dcer=v['drop_con_empty_remark'])== null){
                dcer = '';
            }
            if((sldt=v['sent_line_datetime'])== null){
                sldt = '';
            }
            if((scf=v['sup_confirm'])== null){
                scf = '';
            }
            if((bud=v['budget'])== null){
                bud = '';
            }
            if((sup_n=v['sup_number'])== null){
                sup_n = '';
            }
            if((cur_n=v['cur'])== null){
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
                <div class="form-group row">
                    <div class="row-lg-11">
                        <div style="float: right">
                            <button class="btn btn-primary rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save </button>
                            <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-line"></i> Sent to line group</button>
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <h4 class="mb-4">Supplier detail</h4>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0"  >Sent Request Line :</label>
                    <div class="col-sm-3 col-lg-3">
                        <input type="input" class="form-control form-control-sm" value="${sldt}"  readonly>
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

        $(`.db-sel-sup${i} > select`).val(sup_n).attr('disabled',true); 
        $(`.db-sel-cur${i} > select`).val(cur_n).attr('disabled', true);
        
        //$('.sel-cur').val(res_data['tran']['cur']).attr('disabled',true);
        //$('.sel-supplier').val(res_data['tran']['sup_number']).attr('disabled',true);

        });


        

        

        // booking set (booking detail)
        $('.inp-shper').val(res_data['booking']['shipper_number']);
        $('.inp-shptrm').val(res_data['booking']['st_number']);

        $('.inp-carrier').val(res_data['booking']['carrier_number']);
        $('.inp-prtrecieve').val(res_data['booking']['port_of_receipt_number']);
        $('.inp-prtload').val(res_data['booking']['port_of_loading_number']);
        $('.inp-ts_port').val(res_data['booking']['ts_port_number']);
        $('.inp-delivery').val(res_data['booking']['port_of_delivery_number']);



        $('.inp-jobno').val(res_data['booking']['job_number']).attr('readonly',true);
        $('.inp-bkno').val(res_data['booking']['booking_number']).attr('readonly',true);
        
        $('.inp-rmk').val(res_data['booking']['remark']).attr('readonly',true);
       
        $('.inp-M_vessel').val(res_data['booking']['mother_vessel']).attr('readonly',true);
        $('.inp-mother-voy-no').val(res_data['booking']['voy_no_mother']).attr('readonly',true);
        $('.inp-feeder_vessel').val(res_data['booking']['feeder_vessel']).attr('readonly',true);
        $('.inp-feeder_voy_no').val(res_data['booking']['voy_no_feeder']).attr('readonly',true);
        $('.inp-etd').val(res_data['booking']['etd']).attr('readonly',true);
        $('.inp-eta').val(res_data['booking']['eta']).attr('readonly',true);
        

     
        



        

    },
    addpthtml: function (e = null) {
        
        console.log(html_select_supplier);
        html_add_transport = `
        <div class="card-transport">
        <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Booking Transport Detail (Route ${route} )</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Supplier:</label>
                <div class="col-sm-3">
                    <div class="db-sel-sup >
                        ${html_select_supplier}
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Empty Container Address:</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control form-control-sm inp-pick_emp">
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm inp-pick_emp_remark" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Container Address:</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control inp-pick_con" >
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                        <div class="col">
                            <input type="text" class="form-control inp-pick_con_remark" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Container Address:</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control inp-drop_con"  >
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                        <div class="col">
                            <input type="text" class="form-control inp-drop_con_reamrk"  >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Empty Containe Address:</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control inp-drop_emp" " >
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                        <div class="col">
                            <input type="text" class="form-control inp-drop_emp_remark"" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-3">Budget:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-3">
                                <input type="input" style="text-align:right;" class="form-control form-control-sm inp-budget">
                            </div>
                            <div class="col-lg-1">
                            <div class="db-sel-cur ">
                                ${html_select_cur}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="form-group row">
                    <div class="row-lg-11">
                        <div style="float: right">
                            <button class="btn btn-primary rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Save </button>
                            <button class="btn btn-success rounded-pill btn-sm" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-line"></i> Sent to line group</button>
                        </div>
                    </div>
                </div>
            <hr class="mb-4">
            <h4 class="mb-4">Supplier detail</h4>
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0"  >Sent Request Line :</label>
                <div class="col-sm-3 col-lg-3">
                    <input type="input" class="form-control form-control-sm" " readonly>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2 align-self-center mb-0">Supplier Confirm DateTime :</label>
                <div class="col-sm-3 col-lg-3">
                    <input type="input" class="form-control form-control-sm inp-supplier_firm" readonly>
                </div>
            </div>
        </div>
        </div>
        `;
        route++;
        $('.add-card-transport').append(html_add_transport);

    },
    
};


function number_format(nStr)
{
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
