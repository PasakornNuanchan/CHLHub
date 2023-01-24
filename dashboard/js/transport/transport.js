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

        let db_sel_cargo ='';
        $.each(set_data['cargo'], function (i, k) {
            db_sel_cargo += `
            <option value="${k['ID']}">${k['cargo_type_name']}</option>
            `;
        });
        $('.inp-cargo_type',).append(db_sel_cargo);
        
    },
    set_preview_data: async function (job_number){
        
        
        
        let res_data = await transport.ajax_set_preview_data(job_number);

    
    //head menu and breadcrumb
    $('.head-of-menu').html('Transport');
    $('.bcpage').html('');
    html_bdpage = `
    <li class="breadcrumb-item"><a href="CHL-transport-list.php" target="" style="color:white;">Transport List</a></li>
    <li class="breadcrumb-item active page-item" aria-current="page">Transport (Job number ${res_data['booking']['job_number']})</li>`;
    $('.bcpage').append(html_bdpage);
    $('[name = "data_table_list"] tbody').html('');



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
        $('.inp-shper').val(res_data['booking']['shipper_number']).attr('disabled',true);
        $('.inp-shptrm').val(res_data['booking']['st_number']).attr('disabled',true);

        $('.inp-carrier').val(res_data['booking']['carrier_number']).attr('disabled',true);
        $('.inp-prtrecieve').val(res_data['booking']['port_of_receipt_number']).attr('disabled',true);
        $('.inp-prtload').val(res_data['booking']['port_of_loading_number']).attr('disabled',true);
        $('.inp-ts_port').val(res_data['booking']['ts_port_number']).attr('disabled',true);
        $('.inp-delivery').val(res_data['booking']['port_of_delivery_number']).attr('disabled',true);



        $('.inp-jobno').val(res_data['booking']['job_number']).attr('readonly',true);
        $('.inp-bkno').val(res_data['booking']['booking_number']).attr('readonly',true);
        
        $('.inp-rmk').val(res_data['booking']['remark']).attr('readonly',true);
       
        $('.inp-M_vessel').val(res_data['booking']['mother_vessel']).attr('readonly',true);
        $('.inp-mother-voy-no').val(res_data['booking']['voy_no_mother']).attr('readonly',true);
        $('.inp-feeder_vessel').val(res_data['booking']['feeder_vessel']).attr('readonly',true);
        $('.inp-feeder_voy_no').val(res_data['booking']['voy_no_feeder']).attr('readonly',true);
        $('.inp-etd').val(res_data['booking']['etd']).attr('readonly',true);
        $('.inp-eta').val(res_data['booking']['eta']).attr('readonly',true);
        
        $('.inp-cargodes').val(res_data['cninform']['cargo']).attr('readonly',true);

        let db_sel_hs ='';
        $.each(res_data['hscode'], function (i, k) {
            db_sel_hs += `
            <option value="${k['hs_code']}">${k['hs_code']} ${k['hs_decription']}</option>
            `;
        });
        $('.inp-hscode').append(db_sel_hs);

        $('.inp-hscode').val(res_data['cninform']['hs_code']+' '+res_data['cninform']['hs_decription']).attr('disabled',true);
        $('.inp-cargo_type').val(res_data['cninform']['cargo_type']).attr('disabled',true);
        $('.inp-cargo_qty').val(res_data['cninform']['quantity']).attr('readonly',true);
        $('.inp-cargo_gw').val(res_data['cninform']['gw']).attr('readonly',true);
        $('.inp-cargo_vol').val(res_data['cninform']['volume']).attr('readonly',true);
        $('.inp-cargo_marks').val(res_data['cninform']['mark']).attr('readonly',true);

        // driver
        html_driver = '';
        num_driver = 1;
        $('.driver-part-add').html('');
        $.each(res_data['driver'],async function(i,v){
            if(driver_n = v['Driver_name'] == ""){
                driver_name_val = v['Driver_name'];
            }else{
                driver_name_val = "";
            }
            if(phone_n = v['phone_number'] == ""){
                phone_number_val = v['Driver_name'];
            }else{
                phone_number_val = "";
            }
            if(container_n = v['container_number'] == ""){
                container_number_val = v['container_number']
            }else{
                container_number_val = "";
            }
            if(seal_n = v['seal_number'] == ""){
                seal_number_val = v['seal_number'];
            }else{
                seal_number_val = "";
            }
            
            
            html_driver = `
            <div class="driver-part-del">
                <div class="card-body" >
                    <h5>Driver (person ${num_driver})</h5>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Driver name:</label>
                        <div class="col-sm-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" value="${driver_name_val}" >
                                </div>
                                <label class="control-label col-sm-2 col-lg-2 align-self-center ">Phone Number :</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control" value="${phone_number_val}" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Container number:</label>
                        <div class="col-lg-4">
                            <input type="input" class="form-control form-control-sm" value="${container_number_val}" >
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Seal number:</label>
                        <div class="col-sm-9 col-lg-9">   
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="input" class="form-control form-control-sm" value="${seal_number_val}" readonly>    
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="transport.del_driver(this);" style=""><i class="bi bi-dash-lg"></i> Delete Driver</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
                num_driver++;
                await $('.driver-part-add').append(html_driver);
        });
        
    },
    adddriverhtml : function(e=null){
        html_add_driver = '';
        html_add_driver =`
        
        <div class="driver-part-del">
        <div class="card-body" >
            <h5>Driver (person ${num_driver})</h5>
            <div class="form-group row">
            <label class="control-label col-sm-3 col-lg-2 align-self-center ">Driver name:</label>
                <div class="col-sm-9 col-lg-9">
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="" >
                        </div>
                        <label class="control-label col-sm-2 col-lg-2 align-self-center ">Phone Number :</label>
                        <div class="col-lg-2">
                            <input type="text" class="form-control" value="" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
            <label class="control-label col-sm-3 col-lg-2 align-self-center ">Container number:</label>
                <div class="col-lg-4">
                    <input type="input" class="form-control form-control-sm" value="" >
                </div>
            </div>
            <div class="form-group row">
            <label class="control-label col-sm-3 col-lg-2 align-self-center ">Seal number:</label>
                <div class="col-sm-9 col-lg-9">   
                    <div class="row">
                        <div class="col-lg-4">
                            <input type="input" class="form-control form-control-sm" value="" readonly>    
                        </div>
                        <div class="col-lg-2">
                            <button type="button" target="_blank" class="btn btn-danger rounded-pill btn-sm bg-gradient" onclick="transport.del_driver(this);" style=""><i class="bi bi-dash-lg"></i> Delete Driver</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
        `;
        num_driver++;
        $('.driver-part-add').append(html_add_driver);
        
    },del_driver: function (e = null) {
        num_driver--;
        $(e).closest('.driver-part-del').remove();
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
