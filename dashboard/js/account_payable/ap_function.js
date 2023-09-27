const ap_function = {
    search_function : async function(){
        let arr_data = {}
        let bill_to = $('.inp_data_bill_to').val();
        let data_job_number = $('.inp_data_job_number').val()
        let data_hbl = $('.inp_hbl').val()
        let data_container = $('.inp_container').val()
        let data_billing_code = $('.inp_billing_code').val()
        let data_start_date = $('.inp_start_date').val()
        let data_end_date = $('.inp_end_date').val()
        let data_search = $('.sel_serach').val()
        let data_sale = $('.inp_sale').val()
        let data_cs = $('.inp_cs').val()
        let data_action_paid = $('.cb_st_1').is(':checked') ? '1' : '0';
        let data_action_unpaid = $('.cb_st_2').is(':checked') ? '1' : '0';
        let data_action_created = $('.cb_st_3').is(':checked') ? '1' : '0';
        let data_action_applied = $('.cb_st_4').is(':checked') ? '1' : '0';
        let data_action_approved = $('.cb_st_5').is(':checked') ? '1' : '0';
        
        
        let data_radio_filter = $('input[name="bsradio1"]:checked').attr('id');

        let sale_data_search = $(`#sale_support_list option[value="${data_sale}"]`).attr('id_number')
        let cs_data_search = $(`#cs_support_list option[value="${data_cs}"]`).attr('id_number')
    
        let data_bill_to_serach = $(`#bill_to_list option[value="${bill_to}"]`).attr('data_id')
        let type_bill_to_serach = $(`#bill_to_list option[value="${bill_to}"]`).attr('type_data')
        let job_number_data_serach = $(`#job_number_list option[value="${data_job_number}"]`).attr('id_number')
        let hbl_data_serach = $(`#hbl_list option[value="${data_hbl}"]`).attr('id_number')
        let container_data_serach = $(`#container_list option[value="${data_container}"]`).attr('id_number')        
        let billing_data_serach = $(`#billing_code_list option[value="${data_billing_code}"]`).attr('id_number')
        
        //console.log(data_radio_filter)

        let obj_data = {
            data_status : 1,
            data_bill_to_serach : data_bill_to_serach,
            type_bill_to_serach : type_bill_to_serach,
            job_number_data_serach : job_number_data_serach,
            hbl_data_serach : hbl_data_serach,
            container_data_serach : container_data_serach,
            billing_data_serach : billing_data_serach,
            data_search : data_search,
            data_start_date : data_start_date,
            data_end_date : data_end_date,
            sale_data_search : sale_data_search,
            cs_data_search : cs_data_search,
            data_action_paid : data_action_paid ,
            data_action_unpaid : data_action_unpaid,
            data_action_created : data_action_created,
            data_action_applied : data_action_applied,
            data_action_approved : data_action_approved,
        }
        arr_data.push(obj_data)
        
        
        await this.ajax_query_set(arr_data)
        
    },

    ajax_query_set: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payable/get_data_table.php",
                data: {arr_data : arr_data},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}