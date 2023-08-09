const sub_customs = {
    first_post_data: async function (id_number) {
        let res_data = await this.ajax_setting_data_first(id_number)
        
        $('.inp_customs_plan').val(res_data['get_data_status']['clearlance_date']).attr('disabled',true)


        let revby_inv = res_data['get_data_table_reportcs']['f_recinv'] ? res_data['get_data_table_reportcs']['f_recinv'] + ' ' + res_data['get_data_table_reportcs']['l_recinv'] : '';
        let revby_bl = res_data['get_data_table_reportcs']['f_recbl'] ? res_data['get_data_table_reportcs']['f_recbl'] + ' ' + res_data['get_data_table_reportcs']['l_recbl'] : '';
        let revby_pl = res_data['get_data_table_reportcs']['f_recpl'] ? res_data['get_data_table_reportcs']['f_recpl'] + ' ' + res_data['get_data_table_reportcs']['l_recpl'] : '';
        let revby_id = res_data['get_data_table_reportcs']['f_recid'] ? res_data['get_data_table_reportcs']['f_recid'] + ' ' + res_data['get_data_table_reportcs']['l_recid'] : '';
        let revby_il = res_data['get_data_table_reportcs']['f_recil'] ? res_data['get_data_table_reportcs']['f_recil'] + ' ' + res_data['get_data_table_reportcs']['l_recil'] : '';

        let cheby_inv = res_data['get_data_table_reportcs']['f_cheinv'] ? res_data['get_data_table_reportcs']['f_cheinv'] + ' ' + res_data['get_data_table_reportcs']['l_checinv'] : ''; 
        let cheby_bl = res_data['get_data_table_reportcs']['f_chebl'] ? res_data['get_data_table_reportcs']['f_chebl'] + ' ' + res_data['get_data_table_reportcs']['l_chebl'] : ''; 
        let cheby_pl = res_data['get_data_table_reportcs']['f_chepl'] ? res_data['get_data_table_reportcs']['f_chepl'] + ' ' + res_data['get_data_table_reportcs']['l_chepl'] : ''; 
        let cheby_id = res_data['get_data_table_reportcs']['f_cheid'] ? res_data['get_data_table_reportcs']['f_cheid'] + ' ' + res_data['get_data_table_reportcs']['l_cheid'] : ''; 
        let cheby_il = res_data['get_data_table_reportcs']['f_cheil'] ? res_data['get_data_table_reportcs']['f_cheil'] + ' ' + res_data['get_data_table_reportcs']['l_cheil'] : ''; 

        let revtime_inv = res_data['get_data_table_reportcs']['inv_receiv_datetime'] ? res_data['get_data_table_reportcs']['inv_receiv_datetime'] : '';
        let revtime_bl = res_data['get_data_table_reportcs']['bl_receiv_datetime'] ? res_data['get_data_table_reportcs']['bl_receiv_datetime'] : '';
        let revtime_pl = res_data['get_data_table_reportcs']['pl_receiv_datetime'] ? res_data['get_data_table_reportcs']['pl_receiv_datetime'] : '';
        let revtime_id = res_data['get_data_table_reportcs']['id_receiv_datetime'] ? res_data['get_data_table_reportcs']['id_receiv_datetime'] : '';
        let revtime_il = res_data['get_data_table_reportcs']['il_receiv_datetime'] ? res_data['get_data_table_reportcs']['il_receiv_datetime'] : '';

        let chetime_inv =  res_data['get_data_table_reportcs']['inv_check_datetime'] ? res_data['get_data_table_reportcs']['inv_check_datetime'] : '';
        let chetime_bl =  res_data['get_data_table_reportcs']['bl_check_datetime'] ? res_data['get_data_table_reportcs']['bl_check_datetime'] : '';
        let chetime_pl =  res_data['get_data_table_reportcs']['pl_check_datetime'] ? res_data['get_data_table_reportcs']['pl_check_datetime'] : '';
        let chetime_id =  res_data['get_data_table_reportcs']['id_check_datetime'] ? res_data['get_data_table_reportcs']['id_check_datetime'] : '';
        let chetime_il =  res_data['get_data_table_reportcs']['il_check_datetime'] ? res_data['get_data_table_reportcs']['il_check_datetime'] : '';


        let act_inv = revtime_inv != '' ? `<button class="btn btn-success btn-sm btn_inv_customs" onclick="function_sub_customs.checked_set_data_on_table('inv','${res_data['get_data_table_reportcs']['ID']}')">Checked</button>` : '';
        let act_bl = revtime_bl != '' ? `<button class="btn btn-success btn-sm btn_bl_customs" onclick="function_sub_customs.checked_set_data_on_table('bl','${res_data['get_data_table_reportcs']['ID']}')">Checked</button>` : '';
        let act_pl = revtime_pl != '' ? `<button class="btn btn-success btn-sm btn_pl_customs" onclick="function_sub_customs.checked_set_data_on_table('pl','${res_data['get_data_table_reportcs']['ID']}')">Checked</button>` : '';
        let act_id = revtime_id != '' ? `<button class="btn btn-success btn-sm btn_id_customs" onclick="function_sub_customs.checked_set_data_on_table('id','${res_data['get_data_table_reportcs']['ID']}')">Checked</button>` : '';
        let act_il = revtime_il != '' ? `<button class="btn btn-success btn-sm btn_il_customs" onclick="function_sub_customs.checked_set_data_on_table('il','${res_data['get_data_table_reportcs']['ID']}')">Checked</button>` : '';


        if(res_data['get_data_table_reportcs']['inv_receiv_datetime'] != null){
            $('.pic_inv').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('inv','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }
        if(res_data['get_data_table_reportcs']['bl_receiv_datetime'] != null){
            $('.pic_bl').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('bl','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }
        if(res_data['get_data_table_reportcs']['pl_receiv_datetime'] != null){
            $('.pic_pl').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('pl','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }
        if(res_data['get_data_table_reportcs']['id_receiv_datetime'] != null){
            $('.pic_id').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('id','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }
        if(res_data['get_data_table_reportcs']['il_receiv_datetime'] != null){
            $('.pic_il').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('il','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }



        $('.revby_inv').html(revby_inv)
        $('.revtime_inv').html(revtime_inv)
        $('.checkdocby_inv').html(cheby_inv)
        $('.checkdoctime_inv').html(chetime_inv)
        $('.act_inv').html(act_inv)

        $('.revby_bl').html(revby_bl)
        $('.revtime_bl').html(revtime_bl)
        $('.checkdocby_bl').html(cheby_bl)
        $('.checkdoctime_bl').html(chetime_bl)
        $('.act_bl').html(act_bl)

        $('.revby_pl').html(revby_pl)
        $('.revtime_pl').html(revtime_pl)
        $('.checkdocby_pl').html(cheby_pl)
        $('.checkdoctime_pl').html(chetime_pl)
        $('.act_pl').html(act_pl)
 
        $('.revby_id').html(revby_id)
        $('.revtime_id').html(revtime_id)
        $('.checkdocby_id').html(cheby_id)
        $('.checkdoctime_id').html(chetime_id)
        $('.act_id').html(act_id)
        
        $('.revby_il').html(revby_il)
        $('.revtime_il').html(revtime_il)
        $('.checkdocby_il').html(cheby_il)
        $('.checkdoctime_il').html(chetime_il)
        $('.act_il').html(act_il)

        revtime_inv != '' && chetime_inv != '' ? $('.btn_inv_customs').remove() : '';
        revtime_bl != '' && chetime_bl != '' ? $('.btn_bl_customs').remove() : '';
        revtime_pl != '' && chetime_pl != '' ? $('.btn_pl_customs').remove() : '';
        revtime_id != '' && chetime_id != '' ? $('.btn_id_customs').remove() : '';
        revtime_il != '' && chetime_il != '' ? $('.btn_il_customs').remove() : '';
        

        let ship_arrived_by = res_data['get_data_status']['fn_ship'] == null ? '' : res_data['get_data_status']['fn_ship']+' '+res_data['get_data_status']['ln_ship'];
        let ship_arrived_datetime = res_data['get_data_status']['ship_arrievd_st'] == null ? '' : res_data['get_data_status']['ship_arrievd_st'];
        let ship_arrived_status = res_data['get_data_status']['ship_arrived_status'] != '' ? res_data['get_data_status']['ship_arrived_status']: '';
        let ship_arrived_problem = res_data['get_data_status']['ship_pro'] == null ? '' : res_data['get_data_status']['ship_pro'];

        let drop_off_by = res_data['get_data_status']['fn_drop'] == null ? '' : res_data['get_data_status']['fn_drop']+' '+res_data['get_data_status']['ln_drop'];
        let drop_off_datetime = res_data['get_data_status']['drop_datetime'] == null ? '' : res_data['get_data_status']['drop_datetime'];
        let drop_off_status = res_data['get_data_status']['drop_status'] == null ? '' : res_data['get_data_status']['drop_status'];
        let drop_off_problem = res_data['get_data_status']['drop_pro'] == null ? '': res_data['get_data_status']['drop_pro'];

        let customs_clearance_by = res_data['get_data_status']['fn_cus'] == null ? '' : res_data['get_data_status']['fn_cus']+' '+res_data['get_data_status']['ln_cus'];
        let customs_clearance_datetime = res_data['get_data_status']['Cus_suc_datetime'] == null ? '' : res_data['get_data_status']['Cus_suc_datetime'];
        let customs_clearance_status = res_data['get_data_status']['Cus_status'] == null ? '' : res_data['get_data_status']['Cus_status'];
        let customs_clearance_problem = res_data['get_data_status']['cus_pro'] == null ? '': res_data['get_data_status']['cus_pro'];



        $('.inp_sa_cb').val(ship_arrived_by).attr('disabled',true)
        $('.inp_sa_dc').val(ship_arrived_datetime).attr('disabled',true)

        $('.cf_sa').attr('onclick',`function_sub_customs.modal_ship('cf_sa','${res_data['get_data_status']['ID']}')`)
        $('.tb_sa').attr('onclick',`function_sub_customs.modal_ship('tb_sa','${res_data['get_data_status']['ID']}')`)

        if(ship_arrived_status == '2'){
            $('.tb_sa').attr('hidden',true)
            $('.cf_sa').attr('hidden',false)
        }else if(ship_arrived_status == '1'){
            $('.tb_sa').attr('hidden',false)
            $('.cf_sa').attr('hidden',true)
        }else{
            $('.cf_sa').attr('hidden',false)
            $('.tb_sa').attr('hidden',false)
        }

        $('.inp_sa_pro').val(ship_arrived_problem).attr('disabled',true)


        $('.inp_dr_cb').val(drop_off_by).attr('disabled',true)
        $('.inp_dr_dc').val(drop_off_datetime).attr('disabled',true)

        $('.cf_dr').attr('onclick',`function_sub_customs.modal_ship('cf_dr','${res_data['get_data_status']['ID']}')`)
        $('.tb_dr').attr('onclick',`function_sub_customs.modal_ship('tb_dr','${res_data['get_data_status']['ID']}')`)

        if(drop_off_status == '2'){
            $('.tb_dr').attr('hidden',true)
            $('.cf_dr').attr('hidden',false)
        }else if(drop_off_status == '1'){
            $('.tb_dr').attr('hidden',false)
            $('.cf_dr').attr('hidden',true)
        }else{
            $('.cf_dr').attr('hidden',false)
            $('.tb_dr').attr('hidden',false)
        }
        $('.inp_dr_pro').val(drop_off_problem).attr('disabled',true)


        $('.inp_cc_cb').val(customs_clearance_by).attr('disabled',true)
        $('.inp_cc_dc').val(customs_clearance_datetime).attr('disabled',true)

        $('.cf_cc').attr('onclick',`function_sub_customs.modal_ship('cf_cc','${res_data['get_data_status']['ID']}')`)
        $('.tb_cc').attr('onclick',`function_sub_customs.modal_ship('tb_cc','${res_data['get_data_status']['ID']}')`)

        if(customs_clearance_status == '2'){
            $('.tb_cc').attr('hidden',true)
            $('.cf_cc').attr('hidden',false)
        }else if(customs_clearance_status == '1'){
            $('.tb_cc').attr('hidden',false)
            $('.cf_cc').attr('hidden',true)
        }else{
            $('.cf_cc').attr('hidden',false)
            $('.tb_cc').attr('hidden',false)
        }
        $('.inp_cc_pro').val(customs_clearance_problem).attr('disabled',true)

        let container_upload_html = "";
        $('.contaienr_status_container_upload').html('')
        $('.contaienr_status_container_arrived').html('')
        $('.contaienr_status_container_cy').html('')
        if(res_data['get_data_container'] !=  "0 results"){
            $.each(res_data['get_data_container'],function(i,v){
                i++;
                let container_number = v['container_number'] != '' ? v['container_number'] : '';
                let check_by = v['fn_up'] != '' ? v['fn_up']+' '+v['ln_up'] : '';
                let check_date_time = v['up_datetime_cntr'] == '' || v['up_datetime_cntr'] == null ? 'Not responds' : v['up_datetime_cntr'];
                let problem_check = v['up_pro_cntr'] == '' || v['up_pro_cntr'] == null  ? 'No Problem.' : v['up_pro_cntr'] ;
                let up_status_cntr = v['up_status_cntr'] == '' || v['up_status_cntr'] == '2'  ? '2' : v['up_status_cntr'] ;
                let id_number = v['ID']
                container_upload_html = `
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">CNTR Unload : ${container_number}</label>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-lg-3 col-md-5 ">
                                <input type="text" class="form-control form-control-sm inp_container_upload_by${i}" value="${check_by}"placeholder="check by.">
                            </div>
                            <div class="col-lg-3 col-md-5 ">
                                <input type="datetime" class="form-control form-control-sm inp_conatiner_upload_datetime${i}" value="${check_date_time}">
                            </div>
                            <div class="col-lg-3 col-md-5 text-center">
                                <button class="btn btn-success btn-sm cf_up${i}" onclick="function_sub_customs.modal_ship('cf_up','${id_number}')">Confirm</button>
                                <button class="btn btn-danger btn-sm tb_up${i}" onclick="function_sub_customs.modal_ship('tb_up','${id_number}')">Troubleshoot</button>
                            </div>
                            <div class="col-lg-3 col-md-5 ">
                                <input type="text" class="form-control form-control-sm inp_container_upload_problem${i}" value="${problem_check}" placeholder="check by.">
                            </div>
                        </div>
                    </div>
                </div>
                `;
    
                //console.log(up_status_cntr)
                $('.contaienr_status_container_upload').append(container_upload_html)
                if(up_status_cntr == '1'){
                    $(`.cf_up${i}`).attr('hidden',true)
                }else if(up_status_cntr == '2'){
                    $(`.tb_up${i}`).attr('hidden',true)
                }
                $(`.inp_container_upload_by${i}`).attr('disabled',true)
                $(`.inp_conatiner_upload_datetime${i}`).attr('disabled',true)
                $(`.inp_container_upload_problem${i}`).attr('disabled',true)
            })
        }
        
        let container_arrived_html ='';
        if(res_data['get_data_container'] != "0 results"){
            $.each(res_data['get_data_container'],function(i,v){
                i++;
                let container_number = v['container_number'] != '' ? v['container_number'] : '';
                let check_by = v['fn_cntr'] == '' || v['fn_cntr'] == null ? 'Waitting respond' : v['fn_cntr']+' '+v['ln_cntr'];
                let check_date_time = v['cntr_datetime'] == '' || v['cntr_datetime'] == null ? 'Not responds' : v['cntr_datetime'];
                let problem_check = v['cntr_pro'] == '' || v['cntr_pro'] == null  ? 'No Problem.' : v['cntr_pro'] ;
                let up_status_cntr = v['cntr_status_ar'] == '' || v['cntr_status_ar'] == '2'  ? '2' : v['cntr_status_ar'] ;
                let id_number = v['ID']
    
                container_arrived_html = `
                <div class="form-group row">
                    <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">CNTR Delivery : ${container_number}</label>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col-lg-3 col-md-5 ">
                                <input type="text" class="form-control form-control-sm inp_container_arrived_by${i}" value="${check_by}">
                            </div>
                            <div class="col-lg-3 col-md-5 ">
                                <input type="datetime" class="form-control form-control-sm inp_conatiner_arrived_datetime${i}" value="${check_date_time}">
                            </div>
                            <div class="col-lg-3 col-md-5 text-center">
                                <button class="btn btn-success btn-sm cf_ar${i}"  onclick="function_sub_customs.modal_ship('cf_ar','${id_number}')" >Confirm</button>
                                <button class="btn btn-danger btn-sm tb_ar${i}"  onclick="function_sub_customs.modal_ship('tb_ar','${id_number}')">Troubleshoot</button>
                            </div>
                            <div class="col-lg-3 col-md-5 ">
                                <input type="text" class="form-control form-control-sm inp_container_arrived_problem${i}" value="${problem_check}"">
                            </div>
                        </div>
                    </div>
                </div>
                `;
    
                //console.log(up_status_cntr)
                $('.contaienr_status_container_arrived').append(container_arrived_html)
                if(up_status_cntr == '1'){
                    $(`.cf_ar${i}`).attr('hidden',true)
                }else if(up_status_cntr == '2'){
                    $(`.tb_ar${i}`).attr('hidden',true)
                }
                $(`.inp_container_arrived_by${i}`).attr('disabled',true)
                $(`.inp_conatiner_arrived_datetime${i}`).attr('disabled',true)
                $(`.inp_container_arrived_problem${i}`).attr('disabled',true)
            })
        }
        

        let container_cy_html ='';
        if (res_data['get_data_container'] != "0 results") {
            $.each(res_data['get_data_container'], function (i, v) {
                i++;
                let container_number = v['container_number'] != '' ? v['container_number'] : '';
                let check_by = v['fn_cy'] == '' || v['fn_cy'] == null ? 'Waitting respond' : v['fn_cy'] + ' ' + v['ln_cy'];
                let check_date_time = v['cy_datetime_cntr'] == '' || v['cy_datetime_cntr'] == null ? 'Not responds' : v['cy_datetime_cntr'];
                let problem_check = v['cy_pro_cntr'] == '' || v['cy_pro_cntr'] == null ? 'No Problem.' : v['cy_pro_cntr'];
                let up_status_cntr = v['cy_status_cntr'] == '' || v['cy_status_cntr'] == '2' ? '2' : v['cy_status_cntr'];
                let id_number = v['ID']
                container_cy_html = `
            <div class="form-group row">
                <label class="control-label col-sm-3 col-md-2 col-lg-2 align-self-center">CNTR Reverse: ${container_number}</label>
                <div class="col-sm-10 col-md-10 col-lg-10">
                    <div class="row">
                        <div class="col-lg-3 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_container_cy_by${i}" value="${check_by}">
                        </div>
                        <div class="col-lg-3 col-md-5 ">
                            <input type="datetime" class="form-control form-control-sm inp_conatiner_cy_datetime${i}" value="${check_date_time}">
                        </div>
                        <div class="col-lg-3 col-md-5 text-center">
                            <button class="btn btn-success btn-sm cf_cy${i}" onclick="function_sub_customs.modal_ship('cf_cy','${id_number}')">Confirm</button>
                            <button class="btn btn-danger btn-sm tb_cy${i}" onclick="function_sub_customs.modal_ship('tb_cy','${id_number}')">Troubleshoot</button>
                        </div>
                        <div class="col-lg-3 col-md-5 ">
                            <input type="text" class="form-control form-control-sm inp_container_cy_problem${i}" value="${problem_check}"">
                        </div>
                    </div>
                </div>
            </div>
            `;

                //console.log(up_status_cntr)
                $('.contaienr_status_container_cy').append(container_cy_html)
                if (up_status_cntr == '1') {
                    $(`.cf_cy${i}`).attr('hidden', true)
                } else if (up_status_cntr == '2') {
                    $(`.tb_cy${i}`).attr('hidden', true)
                }
                $(`.inp_container_cy_by${i}`).attr('disabled', true)
                $(`.inp_conatiner_cy_datetime${i}`).attr('disabled', true)
                $(`.inp_container_cy_problem${i}`).attr('disabled', true)
            })
        }
        
        

    },

    ajax_setting_data_first : async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_customs.php",
                data: {
                    id_number : id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}