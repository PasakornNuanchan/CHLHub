const start = {
    start_setting : async function (){
        $('.head-of-menu').html('Receipts / payment Processing')
    },


    start_setting_table : async function (){
        let res_data = await this.ajax_setting_data();

        $('.table tbody').html('');
        
        $.each(res_data['table'],function(i,v){
            let id_number = v['ID'] ? v['ID'] : '';
            let billing_description = v['billing_description'] ? v['billing_description'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let bill_to_type = v['bill_to_type'] ? v['bill_to_type'] : '';
            let bill_to = v['bill_to'] ? v['bill_to'] : '';
            let billing_des_id = v['billing_des_id'] ? v['billing_des_id'] : '';
            let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
            let payble = v['payble'] ? v['payble'] : '';
            let currency = v['currency'] ? v['currency'] : '';
            let qty = v['qty'] ? v['qty'] : '';
            let unit_price = v['unit_price'] ? v['unit_price'] : '';
            let amount = v['amount'] ? v['amount'] : '';
            let vat = v['vat'] ? v['vat'] : '';
            let amtinclvat = v['amtinclvat'] ? v['amtinclvat'] : '';
            let remark = v['remark'] ? v['remark'] : '';
            let type = v['type'] ? v['type'] : '';
            let create_by_f = v['create_by_f'] ? v['create_by_f'] : '';
            let create_by_l = v['create_by_l'] ? v['create_by_l'] : '';
            let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
            let check_by = v['check_by'] ? v['check_by'] : '';
            let check_by_f = v['check_by_f'] ? v['check_by_f'] : '';
            let check_by_l = v['check_by_l'] ? v['check_by_l'] : '';
            let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
            let action_paid_by = v['action_paid_by'] ? v['action_paid_by'] : '';
            let action_paid_by_f = v['action_paid_by_f'] ? v['action_paid_by_f'] : '';
            let action_paid_by_l = v['action_paid_by_l'] ? v['action_paid_by_l'] : '';
            let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
            let approve_by = v['approve_by'] ? v['approve_by'] : '';
            let approve_date_time = v['approve_date_time'] ? v['approve_date_time'] : '';
            let delete_date_time = v['delete_date_time'] ? v['delete_date_time'] : '';
            let delete_by = v['delete_by'] ? v['delete_by'] : '';
            let status = v['status'] ? v['status'] : '';
            let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
            let add_on = v['add_on'] ? v['add_on'] : '';
            let last_update_by = v['last_update_by'] ? v['last_update_by'] : '';
            let last_update_datetime = v['last_update_datetime'] ? v['last_update_datetime'] : '';
            let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
            let Billing_date = v['Billing_date'] ? v['Billing_date'] : '';
            let sys_rate_currency = v['sys_rate_currency'] ? v['sys_rate_currency'] : '';
            let tax_with_hold_by = v['tax_with_hold_by'] ? v['tax_with_hold_by'] : '';
            let commit_sale = v['commit_sale'] ? v['commit_sale'] : '';
            let tax_with_hold_date_time = v['tax_with_hold_date_time'] ? v['tax_with_hold_date_time'] : '';
            let currency_main = v['currency_main'] ? v['currency_main'] : '';
            let need_vat = v['need_vat'] ? v['need_vat'] : '';
            let refer = v['refer'] ? v['refer'] : '';
            let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '';
            let paid_amt = v['paid_amt'] ? v['paid_amt'] : '';
            let pre_approve_by = v['pre_approve_by'] ? v['pre_approve_by'] : '';
            let pre_approve_dt = v['pre_approve_dt'] ? v['pre_approve_dt'] : '';
            let pre_approve_status = v['pre_approve_status'] ? v['pre_approve_status'] : '';
            let cs_support_f = v['cs_support_f'] ? v['cs_support_f'] : '';
            let cs_support_l = v['cs_support_l'] ? v['cs_support_l'] : '';
            let sale_support_f = v['sale_support_f'] ? v['sale_support_f'] : '';
            let sale_support_l = v['sale_support_l'] ? v['sale_support_l'] : '';
            let approve_by_f = v['approve_by_f'] ? v['approve_by_f'] : '';
            let approve_by_l = v['approve_by_l'] ? v['approve_by_l'] : '';
            let booking_no = v['booking_no'] ? v['booking_no'] : '';
            let container = v['container'] ? v['container'] : '';
            i++
            let html_data = ``;
            html_data = `
            <tr class="id_number${id_number}" id_number="${id_number}">
                <td class="text-center">${i}</td><!-- No -->
                <td><input type="text" class="form-control form-control-sm inp_cashing"></td><!-- Cashing -->
                <td><input type="text" class="form-control form-control-sm inp_cus_code"></td><!-- Cust.Code -->
                <td><input type="text" class="form-control form-control-sm inp_cur text-center"></td><!-- Curr. -->
                <td><input type="text" class="form-control form-control-sm inp_occurred text-center"></td><!-- Occurred Date -->
                <td><input type="text" class="form-control form-control-sm inp_amt text-end"></td><!-- Amount -->
                <td><input type="text" class="form-control form-control-sm inp_gainsnloss"></td><!-- Ex.gains and Losses -->
                <td><input type="text" class="form-control form-control-sm inp_"></td><!-- ??? -->
                <td><input type="text" class="form-control form-control-sm inp_ text-end"></td><!-- ??? -->
                <td><input type="text" class="form-control form-control-sm inp_job_number text-center"></td><!-- Job -->
                <td><input type="text" class="form-control form-control-sm inp_dncn"></td><!-- DNCN -->
                <td><input type="text" class="form-control form-control-sm inp_cus_inv"></td><!-- Cus.inv -->
                <td><input type="text" class="form-control form-control-sm inp_bank text-end"></td><!-- Bank Chg -->
                <td><input type="text" class="form-control form-control-sm inp_method"></td><!-- Mehtod -->
                <td class="text-center"><input type="checkbox" class="form-input-check" style="zoom:150%"></td><!-- TR/TP Offset -->
            </tr>
            `;

            $('.table tbody').append(html_data)


            if(amount != 0 || amount != null || amount != ''){
                amount = parseFloat(amount)
                amount = amount.toFixed(2)
            }
            

            // $(`.table > tbody > .id_number${id_number} > td > .inp_cashing`).val().attr('disabled',true)
            $(`.table > tbody > .id_number${id_number} > td > .inp_cus_code`).val(bill_to_c).attr('disabled',true)
            $(`.table > tbody > .id_number${id_number} > td > .inp_cur`).val(currency).attr('disabled',true)
            // $(`.table > tbody > .id_number${id_number} > td > .inp_occurred`).val().attr('disabled',true)
            $(`.table > tbody > .id_number${id_number} > td > .inp_amt`).val(amount).attr('disabled',true)
            // $(`.table > tbody > .id_number${id_number} > td > .inp_gainsnloss`).val().attr('disabled',true)
            // $(`.table > tbody > .id_number${id_number} > td > .inp_`).val().attr('disabled',true)
            // $(`.table > tbody > .id_number${id_number} > td > .inp_`).val().attr('disabled',true)
            $(`.table > tbody > .id_number${id_number} > td > .inp_job_number`).val(job_number).attr('disabled',true)
            // $(`.table > tbody > .id_number${id_number} > td > .inp_dncn`).val().attr('disabled',true)
            // $(`.table > tbody > .id_number${id_number} > td > .inp_cus_inv`).val().attr('disabled',true)
            // $(`.table > tbody > .id_number${id_number} > td > .inp_bank`).val().attr('disabled',true)
            // $(`.table > tbody > .id_number${id_number} > td > .inp_method`).val().attr('disabled',true)
        })



        
    },

    ajax_setting_data : async function(){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_receiptnpayment/get_data_table.php",
                dataType: "json",
                data: {},
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    mark_active: async function (e) {
        $('.active_side').removeClass('active_side');
        $(e).addClass("active_side")
        await this.select_filter()
    },

    select_filter: async function () {
        
        let data_radio_process = $('input[name="radio_process"]:checked').val();
        let data_radio_select_type = $('input[name="radio_function_paid"]:checked').val();
    
        let data_data_id = '';
        let data_data_type = '';
        let data_name_type = '';
        let job_number = $('.inp_job_number').val() ? $('.inp_job_number').val() : '';
        let dn_cn = $('.inp_dn_cn').val() ? $('.inp_dn_cn').val() : '';
        // let job_number = $('.inp_job_number').val() ? $('.inp_job_number').val() : '';
        // let billing_code = $('.inp_billing_code').val() ? $('.inp_billing_code').val() : '';

        // billing_code = $(`.data_list_billing_list option[billing_item_name="${billing_code}"]`).attr('number_des')
        
        
        $.each($('.data_sic > div > button'), function () {
            let data_hasclass = $(this).hasClass('active_side')
            if (data_hasclass == true) {
                data_data_id = $(this).attr('data_id')
                data_data_type = $(this).attr('data_type')
                data_name_type = $(this).attr('name_type')
            }

        })


        console.log(data_radio_process)
        console.log(data_radio_select_type)
        console.log(data_data_id)
        console.log(data_data_type)
        console.log(data_name_type)
        console.log(job_number)
        console.log(dn_cn)
        // let res_data = await this.ajax_setting_data_table(data_radio_process, data_radio_select_type, data_data_id, data_data_type, data_name_type, job_number, billing_code,data_radio_act)
        // console.log(res_data)
        // if(data_radio_act == "check"){
        //     $('.table').removeClass("table_apply")
        //     $('.table').addClass("table_check")
        //     await this.data_start(res_data)

        // }else{
        //     await start_apply.data_start_apply(res_data)
        //     $('.table').removeClass("table_check")
        //     $('.table').addClass("table_apply")


        // }
    },
}