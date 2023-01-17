const customs ={
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
    },
    set_preview_data: async function (job_number){
        let res_data = await customs.ajax_set_preview_data(job_number);
        $('.head-of-menu').html('Customs Clearance');
        
        console.log(res_data);
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

        $('[name = tbl_job_status] tbody').html('');
        
        //status
        if(res_data['dts']['INV_check_by'] == " " ){
            inv_status = '';
        }else{
            inv_status = 'disabled';
        }
        if(res_data['dts']['BL_check_by'] == " " ){
            bl_status = '';
        }else{
            bl_status = 'disabled';
        }
        if(res_data['dts']['PL_check_by'] == " " ){
            pl_status = '';
        }else{
            pl_status = 'disabled';
        }
        if(res_data['dts']['ID_check_by'] == " " ){
            id_status = '';
        }else{
            id_status = 'disabled';
        }
        if(res_data['dts']['IL_check_by'] == " " ){
            il_status = '';
        }else{
            il_status = 'disabled';
        }

            html_detail_des = `
                    <tr>
                        <td>Invoice : </td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['INV_receiv_by']}</td>
                        <td align="center">${res_data['dts']['inv_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['INV_check_by']}</td>
                        <td align="center">${res_data['dts']['inv_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${inv_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Bill of lading</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['BL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['bl_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['BL_check_by']}</td>
                        <td align="center">${res_data['dts']['bl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${bl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Packing list</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['PL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['pl_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['PL_check_by']}</td>
                        <td align="center">${res_data['dts']['pl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${pl_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Declaration</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['ID_receiv_by']}</td>
                        <td align="center">${res_data['dts']['id_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['ID_check_by']}</td>
                        <td align="center">${res_data['dts']['pl_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${id_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                    <tr>
                        <td>Import Licence</td>
                        <td align="center"><div class="fs-5 mb-1"><i class="bi bi-file-earmark-image"></i></div></td>
                        <td align="center">${res_data['dts']['IL_receiv_by']}</td>
                        <td align="center">${res_data['dts']['il_receiv_datetime']}</td>
                        <td align="center">${res_data['dts']['IL_check_by']}</td>
                        <td align="center">${res_data['dts']['il_check_datetime']}</td>
                        <td align="center"><button type="button" class="btn btn-success rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ${il_status}><i class="bi bi-check-square"></i> Confirm</button></td>
                    </tr>
                `;
                $('[name = tbl_job_status] tbody').html(html_detail_des);
                $('.inp-etd').val(res_data['dts']['']).attr('readonly',true);
                $('.inp-clearance_by').val(res_data['dts']['custom_by']).attr('readonly',true);
                $('.inp-datetime_success').val(res_data['dts']['Cus_suc_datatime']).attr('readonly',true);
    
        //transport 
        
        
        
        
        
        
        
        
        // bg = parseFloat(res_data['tran']['budget']);
        
        
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
        
        //$('.sel-cur').val(res_data['tran']['cur']).attr('disabled',true);
        //$('.sel-supplier').val(res_data['tran']['sup_number']).attr('disabled',true);

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
