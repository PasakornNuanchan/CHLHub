const sub_reportcs = {
    
    first_post_data : async function (id_number){
        let res_data = await this.ajax_setting_data_first(id_number)
        

        
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

        
        let act_inv = revtime_inv === '' ? `<button class="btn btn-success btn-sm" onclick="function_sub_reportcs.modal_doc('inv')">received</button>` : `<button class="btn btn-warning btn-sm" onclick="function_sub_reportcs.modal_doc('inv')">re-upload</button>`;
        let act_bl = revtime_bl === '' ? `<button class="btn btn-success btn-sm" onclick="function_sub_reportcs.modal_doc('bl')">received</button>` : `<button class="btn btn-warning btn-sm" onclick="function_sub_reportcs.modal_doc('bl')">re-upload</button>`;
        let act_pl = revtime_pl === '' ? `<button class="btn btn-success btn-sm" onclick="function_sub_reportcs.modal_doc('pl')">received</button>` : `<button class="btn btn-warning btn-sm" onclick="function_sub_reportcs.modal_doc('pl')">re-upload</button>`;
        let act_id = revtime_id === '' ? `<button class="btn btn-success btn-sm" onclick="function_sub_reportcs.modal_doc('id')">received</button>` : `<button class="btn btn-warning btn-sm" onclick="function_sub_reportcs.modal_doc('id')">re-upload</button>`;
        let act_il = revtime_il === '' ? `<button class="btn btn-success btn-sm" onclick="function_sub_reportcs.modal_doc('il')">received</button>` : `<button class="btn btn-warning btn-sm" onclick="function_sub_reportcs.modal_doc('il')">re-upload</button>`;

        
        if(res_data['get_data_table_reportcs']['inv_receiv_datetime'] != null){
            $('.pic_inv_r').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('inv','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }

        if(res_data['get_data_table_reportcs']['bl_receiv_datetime'] != null){
            $('.pic_bl_r').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('bl','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }

        if(res_data['get_data_table_reportcs']['pl_receiv_datetime'] != null){
            $('.pic_pl_r').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('pl','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }

        if(res_data['get_data_table_reportcs']['id_receiv_datetime'] != null){
            $('.pic_id_r').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('id','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }

        if(res_data['get_data_table_reportcs']['il_receiv_datetime'] != null){
            $('.pic_il_r').html(`<i class="bi bi-files" onclick="function_sub_reportcs.lunch_photo('il','${res_data['get_data_table_reportcs']['ID']}')"></i>`)
        }
        
        $('.revby_inv_r').html(revby_inv)
        $('.revtime_inv_r').html(revtime_inv)
        $('.checkdocby_inv_r').html(cheby_inv)
        $('.checkdoctime_inv_r').html(chetime_inv)
        $('.act_inv_r').html(act_inv)

        $('.revby_bl_r').html(revby_bl)
        $('.revtime_bl_r').html(revtime_bl)
        $('.checkdocby_bl_r').html(cheby_bl)
        $('.checkdoctime_bl_r').html(chetime_bl)
        $('.act_bl_r').html(act_bl)

        $('.revby_pl_r').html(revby_pl)
        $('.revtime_pl_r').html(revtime_pl)
        $('.checkdocby_pl_r').html(cheby_pl)
        $('.checkdoctime_pl_r').html(chetime_pl)
        $('.act_pl_r').html(act_pl)
        
        $('.revby_id_r').html(revby_id)
        $('.revtime_id_r').html(revtime_id)
        $('.checkdocby_id_r').html(cheby_id)
        $('.checkdoctime_id_r').html(chetime_id)
        $('.act_id_r').html(act_id)
        
        $('.revby_il_r').html(revby_il)
        $('.revtime_il_r').html(revtime_il)
        $('.checkdocby_il_r').html(cheby_il)
        $('.checkdoctime_il_r').html(chetime_il)
        $('.act_il_r').html(act_il)

        let pickup_do = res_data['get_data_status']['pickup_DO_date'] ? res_data['get_data_status']['pickup_DO_date'] : '';
        let check_doc = res_data['get_data_status']['check_document'] ? res_data['get_data_status']['check_document'] : '';
        let enter = res_data['get_data_status']['enter_date'] ? res_data['get_data_status']['enter_date'] : '';
        let clearance_plan = res_data['get_data_status']['clearlance_date'] ? res_data['get_data_status']['clearlance_date'] : '';
        let ats = res_data['get_data_status']['shipping_ass'] ? res_data['get_data_status']['shipping_ass'] : '';
        let clearlance_success = res_data['get_data_status']['Cus_suc_datetime'] ? res_data['get_data_status']['Cus_suc_datetime'] : '';
        let delivery = res_data['get_data_status']['delivery_date'] ? res_data['get_data_status']['delivery_date'] : '';
        let import_entry = res_data['get_data_status']['do_number'] ? res_data['get_data_status']['do_number'] : '';
        
        
        $('.inp_pick_do').val(pickup_do)
        $('.inp_check_doc').val(check_doc)
        $('.inp_enter').val(enter)
        $('.inp_clearance_date').val(clearance_plan)
        $('.inp_ats').val(ats)
        $('.inp_clearlance_success').val(clearlance_success).attr('disabled',true)
        $('.inp_delivery').val(delivery).attr('disabled',true)
        $('.inp_import_entry').val(import_entry)

        $('.btn_pick_do').attr('onclick',`function_sub_reportcs.update_document_date('do')`)
        $('.btn_check_doc').attr('onclick',`function_sub_reportcs.update_document_date('cd')`)
        $('.btn_enter').attr('onclick',`function_sub_reportcs.update_document_date('en')`)
        $('.btn_clear_date').attr('onclick',`function_sub_reportcs.update_clearance()`)
        $('.btn_ats').attr('onclick',`function_sub_reportcs.update_shipping_data()`)
        $('.btn_import_ent').attr('onclick',`function_sub_reportcs.update_import_entry()`)
    },


    ajax_setting_data_first : async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_reportcs.php",
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