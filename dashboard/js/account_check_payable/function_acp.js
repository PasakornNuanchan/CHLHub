const function_acp = {
    select_all : async function(e){
        e == 'select' ? $('.table_data_account tbody > tr > td > .cbx_sel').prop('checked',true) : $('.table_data_account tbody > tr > td > .cbx_sel').prop('checked',false);
    },

    get_select_paid : async function(){
        let oobj = {}
        let arr_data = []
        $('.table_data_account > tbody > tr').each(function(e){
            let data_check_sel = $(this).find('.cbx_sel').is(':checked') ? '1' : '0';
            if(data_check_sel == '1'){
                let data_id = $(this).attr('id_number')
                let ref_job_id = $(this).attr('ref_job_id')
                oobj = {
                    data_id : data_id,
                    ref_job_id : ref_job_id,
                }
                arr_data.push(oobj)
            }
        })
        // console.log(arr_data)
        let res_data = await this.ajax_request_paid(arr_data)
        console.log(res_data)
    },

    ajax_request_paid : async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_payable/payment_update.php",
                dataType: "json",
                data : {arr_data : arr_data},
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    filter_select : async function(){
        let oobj_data = {}
        let arr_data = []
        let data_bill_to = $('.inp_data_bill_to').val()
        let data_job_number = $('.inp_data_job_number').val()
        let data_currency = $('.sel_currency').val()

        let data_type = $(`#bill_to_list option[value="${data_bill_to}"]`).attr('data_type')
        let data_id = $(`#bill_to_list option[value="${data_bill_to}"]`).attr('data_id')

        let data_job = $(`#job_number_list [value="${data_job_number}"]`).attr('real_data')
        
        oobj_data = {
            data_type : data_type,
            data_id : data_id,
            data_job : data_job,
            data_currency : data_currency,
        }
        arr_data.push(oobj_data)

        let res_data = await this.ajax_request_filter(arr_data)
        await first_setting.setting_data_table(res_data);
    },

    ajax_request_filter : async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_payable/get_data_table.php",
                dataType: "json",
                data : {arr_data : arr_data},
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}

