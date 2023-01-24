const customs ={
    job_number_global :  '' ,
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

       customs.job_number_global = job_number;

        console.log(action);
        
        if (action == 'preview') {
            customs.set_data_default();
            customs.set_preview_data(job_number);
           
        } else {

        }
    },
    ajax_set_preview_data : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/get_preview_data.php",
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
                url: "php/customs/get_customs.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    set_data_default: async function (){
        let set_data = await customs.ajax_set_data();
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
        let res_data = await customs.ajax_set_preview_data(job_number);
        //breadcrumb
        $('.head-of-menu').html('Customs Clearance');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-Customs-list.php" target="" style="color:white;">Customs Clearance List </a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Customs Clearance (Job Number ${res_data['dts']['job_number']})</li>`;
        $('.bcpage').append(html_bdpage);


        console.log(res_data);

        // Petty Cash&Advance
        $('[name =cash_payment_table] tbody').html('');
        html_description_payment = '';
        let num=1;
        $.each(res_data['pay'], function(i, v){
            let amount = parseFloat(v['amount']);
            html_description_payment = `
            <tr>
                <td>${num}</td>
                <td>${v['type']}</td>
                <td>${v['billing_item_name']}</td>
                <td>${v['pay_to']}</td>
                <td></td>
                <td align="right">${number_format(amount.toFixed(2))}</td>
                <td>${v['first_name']} ${v['last_name']}</td>
                <td>
                    <button type="button" class="btn btn-danger rounded-pill btn-xs"><i class="bi bi-pencil-fill"></i> Delete</button>
                </td>
            </tr>
            `;

            num++;
            $('[name =cash_payment_table] tbody').append(html_description_payment);
        });

        // sub page Customs&Document
        $('[name = tbl_job_status] tbody').html('');
        //status
        
        if(res_data['dts']['INV_receiv_by'] != "" && res_data['dts']['INV_check_by'] != "" || res_data['dts']['INV_receiv_by'] == ""){
            inv_status = 'disabled';
        }else{
            inv_status = '';

        }
      
        if(res_data['dts']['BL_receiv_by'] != "" && res_data['dts']['BL_check_by'] != "" || res_data['dts']['BL_receiv_by'] == ""){
            bl_status = 'disabled';
        }else{
            bl_status = '';
        }

        
        if(res_data['dts']['PL_receiv_by'] != "" && res_data['dts']['PL_check_by'] != "" || res_data['dts']['PL_receiv_by'] == ""){
            pl_status = 'disabled';
        }else{
            pl_status = '';
        }
        
       
        if(res_data['dts']['ID_receiv_by'] != "" && res_data['dts']['ID_check_by'] != "" || res_data['dts']['ID_receiv_by'] == ""){
            id_status = 'disabled';
        }else{
            id_status = '';
        }

        
        if(res_data['dts']['IL_receiv_by'] != "" && res_data['dts']['IL_check_by'] != "" || res_data['dts']['IL_receiv_by'] == ""){
            il_status = 'disabled';
        }else{
            il_status = '';
        }
            html_detail_des = `
                    <tr>
                        <td>Invoice : </td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['INV_receiv_by']}</td>
                        <td align="center">${res_data['dts']['inv_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['INV_check_by']}</td>
                        <td align="center">${res_data['dts']['inv_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs.push_action_inv()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${inv_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Bill of lading</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['BL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['bl_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['BL_check_by']}</td>
                        <td align="center">${res_data['dts']['bl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs.push_action_bl()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${bl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Packing list</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['PL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['pl_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['PL_check_by']}</td>
                        <td align="center">${res_data['dts']['pl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs.push_action_pl()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${pl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Declaration</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['ID_receiv_by']}</td>
                        <td align="center">${res_data['dts']['id_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['ID_check_by']}</td>
                        <td align="center">${res_data['dts']['id_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs.push_action_id()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${id_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Licence</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['IL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['il_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['IL_check_by']}</td>
                        <td align="center">${res_data['dts']['il_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs.push_action_il()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${il_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                `;
                $('[name = tbl_job_status] tbody').html(html_detail_des);
                $('.inp-etd').val(res_data['dts']['']).attr('readonly',true);
                $('.inp-clearance_by').val(res_data['dts']['custom_by']).attr('readonly',true);
                $('.inp-datetime_success').val(res_data['dts']['Cus_suc_datetime']).attr('readonly',true);
        if(res_data['dts']['custom_by'] != null){
            status_btn = 'hidden';
        }else{
            status_btn = '';
        }

        //clearance
        $('.add_btn_clearance').html('');
        html_btn = `
        <div style="float: right">
            <button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" onclick="customs.push_action_clearance()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${status_btn}><i class="bi bi-check-square"></i> Clearance success</button>
        </div>`;
        $('.add_btn_clearance').append(html_btn);
    
        // sub Page booking transport 
        html_transport ='';
        var html_select_supplier = $('.sel-supplier').parent().html();
        var html_select_cur = $('.sel-cur').parent().html();
        route =1;
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
                <hr class="mb-4">
                <h4 class="mb-4">Supplier detail</h4>
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
        });


        // sub page booking (Booking Detail)
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
        // sub page booking (Container Information)
        $('.inp-cargodes').val(res_data['cninform']['cargo']).attr('readonly',true);

        $('.inp-hscode').val(res_data['cninform']['hs_code']+' '+res_data['cninform']['hs_decription']).attr('disabled',true);
        $('.inp-cargo_type').val(res_data['cninform']['cargo_type']).attr('disabled',true);
        $('.inp-cargo_qty').val(res_data['cninform']['quantity']).attr('readonly',true);
        $('.inp-cargo_gw').val(res_data['cninform']['gw']).attr('readonly',true);
        $('.inp-cargo_vol').val(res_data['cninform']['volume']).attr('readonly',true);
        $('.inp-cargo_marks').val(res_data['cninform']['mark']).attr('readonly',true);

      
    },
    // clerance
    push_action_clearance: async function (save_data){
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
                let res = await customs.ajax_save_push_clearance(customs.job_number_global)
                console.log(res);
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
            }
          }) 
    },

    //push description
    push_action_inv: async function (save_data){
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
                let res = await customs.ajax_save_push_inv(customs.job_number_global)
                console.log(res);
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
            }
          }) 
    },
    push_action_bl: async function (save_data){
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
                let res = await customs.ajax_save_push_bl(customs.job_number_global)
                console.log(res);
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
            }
          }) 
    },
    push_action_pl: async function (save_data){
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
                let res = await customs.ajax_save_push_pl(customs.job_number_global)
                console.log(res);
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
            }
          }) 
    },
    push_action_id: async function (save_data){
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
                let res = await customs.ajax_save_push_id(customs.job_number_global)
                console.log(res);
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
            }
          }) 
    },
    push_action_il: async function (save_data){
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
                let res = await customs.ajax_save_push_il(customs.job_number_global)
                console.log(res);
                Swal.fire(
                  'saved!',
                  'Your file has been saved.',
                  'success'
                )
            }
          }) 
    },

    ajax_save_push_clearance : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_clearance.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    

    ajax_save_push_inv : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_inv.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_push_bl : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_bl.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_push_pl : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_pl.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_push_id : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_id.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_save_push_il : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/push_il.php",
                data: {'job_number' : job_number},
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
