const log_job_check = {
    lock_job_checl: async function () {
        let data_create = $('.inp_create_date').val()
        let data_create_date = new Date(data_create)
        let data_create_date_done = data_create_date.toISOString().split('T')[0];

        let date_check = new Date();
        let check_new_date = new Date(data_create_date);
        check_new_date.setDate(data_create_date.getDate() + 15);
        let data_check_new_date = check_new_date.toISOString().split('T')[0];
        


        var currentDate = new Date();
        var newDate = new Date(currentDate);

        let data_currenct_date = newDate.toISOString().split('T')[0];


        if(data_currenct_date > data_check_new_date){
            console.log("lock")
            $('.form-control').attr('disabled',true)
            $('.form-select').attr('disabled',true)
            //job_detail
            $('.btn_load_date').remove()
            $('.btn_add_hbl').remove()
            $('.btn_add_new_route').remove()
            // $('.btn-success').remove()
            $('.btn_delete_hbl').remove()
            $('.btn_delete_container').remove()
            $('.btn_add_new_driver').remove()

            $('.btn_delete_route').remove()
            $('.btn_re_update').remove()
            $('.btn_receive_docu').remove()
            $('.btn_save_job_detail').remove()
            $('.btn_save_transport').remove()
            $('.btn_check_doc').remove()
            $('.btn_enter').remove()
            $('.btn_pick_do').remove()
            $('.btn_import_ent').remove()
            $('.btn_clear_date').remove()
            $('.btn_ats').remove()
            $('.btn_delivery').remove()

            $('.btn_inv_customs').remove()
            $('.btn_bl_customs').remove()
            $('.btn_pl_customs').remove()
            $('.btn_id_customs').remove()
            $('.btn_il_customs').remove()
            $('.tb_sa').remove()
            $('.tb_dr').remove()
            $('.tb_cc').remove()
            $('.cf_up').remove()
            $('.tb_up').remove()
            $('.cf_ar').remove()
            $('.tb_ar').remove()
            $('.cf_cy').remove()
            $('.tb_cy').remove()
            $('.btn_save_all_billing').remove()
            $('.btn_delete_list_billing').remove()
            $('.btn_address_consignee').remove()
            $('.btn_select_bl_container').remove()
            $('.btn_save_bl').remove()
            $('.hbl_data_selected').attr('disabled',true)
            $('.container_data_selected').attr('disabled',true)
            $('.btn_transport_delete_driver').remove()
            $('.btn_delete_transport').remove()
            $('.btn_gen_task').remove()
            $('.btn_add_container_job_detail').remove()
            $('.btn_add_new_list_ar').remove()
            $('.btn_add_new_list_ap').remove()
        }else{
            console.log("unlock")

        }
        // console.log("วันที่ วันนี้ :"+data_currenct_date)

        // console.log("วันที่ lock :"+data_check_new_date)
        

    }
}