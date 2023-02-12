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
    

    
    set_preview_data: async function (job_number){
        
        
        
        let res_data = await transport.ajax_set_preview_data(job_number);

    
    //head menu and breadcrumb
    $('.head-of-menu').html(`Transport`);
    $('.bcpage').html('');
    html_bdpage = `
    <li class="breadcrumb-item"><a href="CHL-transport-list.php" target="" style="color:white;">Transport List</a></li>
    <li class="breadcrumb-item active page-item" aria-current="page">Transport (Job number ${res_data['booking']['job_number']})</li>`;
    $('.bcpage').append(html_bdpage);
    $('[name = "data_table_list"] tbody').html('');



        console.log(res_data);
        
        job_global = res_data['booking']['job_number'];
        // container&driver

        let html_select_supplier = $('.sel-supplier').parent().html();
        let html_select_cur = $('.sel-cur').parent().html();
        let html_select_truck = $('.sel-type_truck').parent().html();
        route =1;
        rows_c = 1;
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
                <tr container_data_id=${v['ID']}>
                    <td>${rows_c}</td>
                    <td>${container_type_name} (${v['container_type']})</td>
                    <td><input type="text" class="form-control form-control-sm inp-container_number" value="${v['container_number']}"></td>
                    <td><input type="text" class="form-control form-control-sm inp-seal_number" value="${v['seal_number']}"></td>
                    <td><input type="text" class="form-control form-control-sm inp-gw" style="text-align:right;" value="${gross_weight.toFixed(1)}"></td>
                    <td><input type="text" class="form-control form-control-sm inp-cbm" style="text-align:right;" value="${cbm.toFixed(2)}"></td>
                    <td><input type="checkbox" class="form-check-input" ${soc} disabled></td>
                    <td><input type="checkbox" class="form-check-input" ${ow} disabled></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${v['cy']}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled  value="${v['rtn']}"></td>
                </tr>
                `;
                rows_c++;
            $('[name = container-tbl] tbody').append(html_container);

            
            
        }
        });

        // transport
        $('.add-card-transport').html('');
        let html_transport ='';   
        
        $.each(res_data['tran'],async function(i , v){
             
            let budget = parseFloat(v['budget']);
            let pcea = v['pick_con_empty_address'] || '';
            let pcer = v['pick_con_empty_remark'] || '';
            let pca = v['pick_con_address'] || '';
            let pcr = v['pick_con_remark'] || '';
            let dca = v['drop_con_address'] || '';
            let dcr = v['drop_con_remark'] || '';
            let dcea = v['drop_con_empty_address']  || '';
            let dcer = v['drop_con_empty_remark'] || '';
            let sldt = v['sent_line_datetime'] || '';
            let scf = v['sup_confirm'] || '';
            let bud = v['budget'] || '';
            let type_truck = !! v['type_truck'] ? v['type_truck'] : '';
            let remark = v['remark'] || '';
            
            let sup_n = !!v['sup_number'] ? v['sup_number'] : '';
            let cur_n = !!v['cur'] ? v['cur'] : '';
            let truck_quantity = !! v['truck_quantity'] ? v['truck_quantity'] : '';

           
            
            
            
            

            html_transport = `
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
                                <input type="text" class="form-control form-control-sm inp-pick_emp" value="${pcea}" >
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_emp_remark" value="${pcer}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Pickup Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_con" value="${pca}" >
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-pick_con_remark" value="${pcr}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Container Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_con" value="${dca}" >
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_con_reamrk" value="${dcr}" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Drop off Empty Containe Address:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_emp" value="${dcea}" >
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0">Remark :</label>
                            <div class="col">
                                <input type="text" class="form-control form-control-sm inp-drop_emp_remark" value="${dcer}" >
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
                                <input type="text" class="form-control form-control-sm inp-remark_truck" value="${remark}"> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2  align-self-center mb-0">Truck Quantity:</label>
                    <div class="col-sm-3 col-lg-1">
                        <input type="text" class="form-control form-control-sm inp-truck_quantity" style="text-align:right;" value="${truck_quantity}">
                    </div>
                </div>       
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center mb-3">Budget:</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-lg-2">
                                <input type="input" style="text-align:right;" class="form-control form-control-sm inp-budget" value="${bud}" >
                            </div>
                            <div class="col-lg-2">
                                <div class="db-sel-cur db-sel-cur${i}">
                                    ${html_select_cur} 
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <label class="control-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="row-lg-11">
                        <div style="float: right">
                            <button class="btn btn-danger rounded-pill btn-sm" onclick="transport.del_transport(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Delete </button>
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
                
        await $('.add-card-transport').append(html_transport);
        
        
        $(`.db-sel-sup${i} > select`).val(sup_n); 
        $(`.db-sel-cur${i} > select`).val(cur_n);
        $(`.db-sel-truck${i} > select`).val(type_truck);
        
        
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

     
        

        $('.inp-hscode').val(res_data['cninform']['hs_code']+' '+res_data['cninform']['hs_decription']).attr('disabled',true);
        $('.inp-cargo_type').val(res_data['cninform']['cargo_type']).attr('disabled',true);
        $('.inp-cargo_qty').val(res_data['cninform']['quantity']).attr('readonly',true);
        $('.inp-cargo_gw').val(res_data['cninform']['gw']).attr('readonly',true);
        $('.inp-cargo_vol').val(res_data['cninform']['volume']).attr('readonly',true);
        $('.inp-cargo_marks').val(res_data['cninform']['mark']).attr('readonly',true);


        // driver set route
        let html_tran_sel = '';
        let route_truck = '1';
        $.each(res_data['tran'], function (i, k) { 
            html_tran_sel += `
            <option value="${k['ID']}">Route ${route_truck} ${k['transport_sup_name']} / ${k['truck_quantity']} ${k['truck_name']}</option>
            `;  
            route_truck++;
        })
        
        $('.sel-route-driver').append(html_tran_sel);
        let route_driver = $('.sel-route-driver').parent().html();
        
        // driver

        let db_sel_container_for_driver ='';
        $.each(res_data['cont'], function (i, k) {
            db_sel_container_for_driver += `
            <option value="${k['ID']}">${k['container_type']} ${k['container_number']}</option>
            `;
        });
        $('.sel-container-for-driver').append(db_sel_container_for_driver);
        let container_for_driver = $('.sel-container-for-driver').parent().html();


        html_driver = '';
        num_driver = 1;
        $('.driver-part-add').html('');
        $.each(res_data['driver'],async function(i,v){

            
            if(driver_n = v['Driver_name'] != ""){
                driver_name_val = v['Driver_name'];
            }else{
                driver_name_val = "";
            }
            
            if(phone_n = v['phone_number'] != ""){
                phone_number_val = v['phone_number'];
            }else{
                phone_number_val = "";
            }
            if(container_n = v['container_number'] != ""){
                container_number_val = v['container_number']
            }else{
                container_number_val = "";
            }
            if(seal_n = v['seal_number'] != ""){
                seal_number_val = v['seal_number'];
            }else{
                seal_number_val = "";
            }
            

            html_driver = `
            <div class="driver-part-del driver-part-del${v['ID']}" driver-part-del=${v['ID']}>
                <div class="card-body" >
                    <h5>Driver (person ${num_driver})</h5>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Route number:</label>
                        <div class="col-lg-4">
                            <div class="db-sel-route db-sel-route${i}">
                           ${route_driver}
                           </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Driver name:</label>
                        <div class="col-sm-9 col-lg-9">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="text" class="form-control inp-driver_name_val" value="${driver_name_val}" >
                                </div>
                                <label class="control-label col-sm-2 col-lg-2 align-self-center ">Phone Number :</label>
                                <div class="col-lg-2">
                                    <input type="text" class="form-control inp-driver_phone_val" value="${phone_number_val}" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Container number:</label>
                        <div class="col-lg-4">
                            <div class="db-sel-route db-sel-con_drive${i}">
                            ${container_for_driver}
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Seal number:</label>
                        <div class="col-sm-9 col-lg-9">   
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="input" class="form-control form-control-sm inp-seal_number_driver" value="${seal_number_val}" readonly>    
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
                $(`.db-sel-route${i} > select`).val(v['route_id']); 
                $(`.db-sel-con_drive${i} > select`).val(v['container_id']); 
        });
        
    },
    adddriverhtml : function(e = null){
        let route_driver = $('.sel-route-driver').parent().html();
        let container_for_driver = $('.sel-container-for-driver').parent().html();
        html_add_driver = '';
        html_add_driver =`
        
        <div class="driver-part-del">
            <div class="card-body" >
            <h5>Driver (person ${num_driver})</h5>
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-lg-2 align-self-center ">Route number:</label>
                    <div class="col-lg-4">
                        <div class="db-sel-route ">
                        ${route_driver}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2 align-self-center ">Driver name:</label>
                    <div class="col-sm-9 col-lg-9">
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="text" class="form-control inp-driver_name_val" >
                            </div>
                            <label class="control-label col-sm-2 col-lg-2 align-self-center ">Phone Number :</label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control inp-driver_phone_val" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2 align-self-center ">Container number:</label>
                    <div class="col-lg-4">
                        <div class="db-sel-route">
                        ${container_for_driver}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                <label class="control-label col-sm-3 col-lg-2 align-self-center ">Seal number:</label>
                    <div class="col-sm-9 col-lg-9">   
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="input" class="form-control form-control-sm inp-seal_number_driver" readonly>    
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
        
    },del_driver: function (e=null) {
        num_driver--;
        let driver_arr_del = [];
        let driver_arr_tep_del = {};
        let val = $(e).closest('.driver-part-del');
        test = val.find('.driver-part-del');
        
        console.log(test)
        
       
        $(e).closest('.driver-part-del').remove();

        
    },

    driver_seal_number_change : async function(e){
        let val = $(e).val();
        let parent = $(e).closest('.driver-part-del');

        let res_data_container = await transport.ajax_seal_change(val);
        console.log(res_data_container['seal_number'])
        $('.inp-seal_number_driver',parent).val(res_data_container['seal_number']); 
    },
    ajax_seal_change : function(val){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/get_value_seal.php",
                data: {'val' : val},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    addpthtml: function (e = null) {
        let html_select_supplier = $('.db-sel-sup').parent().html();
        let html_select_cur = $('.sel-cur').parent().html();

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
                        ${html_select_supplier}
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
                            <div class="col-lg-2">
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
                            <button class="btn btn-danger rounded-pill btn-sm" onclick="transport.del_transport(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> Delete </button>
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

    },del_transport: function (e) {
        route--;
        $(e).closest('.add-card-transport').remove();
        console.log
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
                await transport.save_container()
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
       let res = await transport.ajax_save_container(container_arr);
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
    push_action_save_driver: async function (){
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
                await transport.save_driver()
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
               
            }
          }) 
    },

    save_driver : async function(i,e){
        let driver_arr = [];
        let driver_arr_tmp = {};
        
        $('.driver-part-del').each(function (i,e){
            
            let ID = $(this).attr('driver-part-del');
            let route_number = $('.sel-route-driver',this).val();
            let name_val = $('.inp-driver_name_val',this).val();
            let phone_val = $('.inp-driver_phone_val',this).val();
            let container_val = $('.sel-container-for-driver',this).val(); 
            
            driver_arr_tmp = {
                ID : ID,
                job_global : job_global,
                route_number : route_number,
                name_val : name_val,
                phone_val : phone_val,
                container_val : container_val
            }

            driver_arr.push(driver_arr_tmp)
        })
       console.log(driver_arr);
       await transport.ajax_save_driver(driver_arr)
    },
    ajax_save_driver : function(driver_arr){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport/save_driver.php",
                data: {'driver_arr' : driver_arr},
                dataType: "json",
                success: function (res) {
                    
                    resolve(res);
                    
                },
            });
        });
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


