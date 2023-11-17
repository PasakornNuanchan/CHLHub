const function_acp = {
    // select_all : async function(e){
    //     e == 'select' ? $('.table_data_account tbody > tr > td > .cbx_sel').prop('checked',true) : $('.table_data_account tbody > tr > td > .cbx_sel').prop('checked',false);
    // },

    select_all : async function(e){
        
        let obj_data = {}
        let arr_data = []
        $('.table_data_account > tbody > tr ').each(function(a){
            let data_checked_prop = $(this).find('.cbx_sel').prop('checked') ? '1' : '0'
            let data_id_number = $(this).attr('id_number')
            let data_ref_id = $(this).attr('ref_id')

            console.log(data_checked_prop)

            if(e == "select"){
                if(data_checked_prop == '0'){
                    obj_data = {
                        data_id_number : data_id_number,
                        data_ref_id : data_ref_id,
                    }
                    arr_data.push(obj_data)
                }
            }else if(e == "deselect"){
                console.log(1)
                if(data_checked_prop == '0'){
                    $(this).find('.cbx_sel').attr('checked',false)
                }
            }
        })

        console.log(arr_data)
    },

    // get_select_paid : async function(){
    //     let oobj = {}
    //     let arr_data = []
    //     $('.table_data_account > tbody > tr').each(function(e){
    //         let data_check_sel = $(this).find('.cbx_sel').is(':checked') ? '1' : '0';
    //         if(data_check_sel == '1'){
    //             let data_id = $(this).attr('id_number')
    //             let ref_job_id = $(this).attr('ref_job_id')
    //             oobj = {
    //                 data_id : data_id,
    //                 ref_job_id : ref_job_id,
    //             }
    //             arr_data.push(oobj)
    //         }
    //     })
    //     // console.log(arr_data)
    //     let res_data = await this.ajax_request_paid(arr_data)
    //     // console.log(res_data)
    // },

    // ajax_request_paid : async function (arr_data) {
    //     return new Promise(function (resolve, reject) {
    //         $.ajax({
    //             type: "post",
    //             url: "php/account_check_receivable/payment_update.php",
    //             dataType: "json",
    //             data : {arr_data : arr_data},
    //             success: function (res) {
    //                 resolve(res);
    //             },
    //         });
    //     });
    // },

    select_checked : async function(e){
        let data_id_number = $(e).closest('tr').attr('id_number')
        let data_ref_job_id = $(e).closest('tr').attr('ref_id')
        
        let data_job_no = $(e).closest('tr').find('.inp_job_no').val()
        let data_bill_to = $(e).closest('tr').find('.inp_bill_to').val()
        let data_code = $(e).closest('tr').find('.inp_code').val()
        let data_currency_can = $(e).closest('tr').find('.inp_currency_can').val()
        let data_amt_incv_can = $(e).closest('tr').find('.inp_amt_incv_can').val()

        
        Swal.fire({
            title: "Are you sure?",
            html: `You won't be able to revert this! <br>
            job number : ${data_job_no} <br>
            bill to : ${data_bill_to} <br>
            CODE : ${data_code} <br>
            amount : ${data_amt_incv_can} ${data_currency_can}
            `,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Confirm!"
        }).then(async (result) => {
            if (result.isConfirmed) {

                let obj_data = {}
                let arr_data = []

                obj_data = {
                    id_number: data_id_number,
                    ref_job_id: data_ref_job_id,
                }
                arr_data.push(obj_data)
                
                let res_data = await this.ajax_data_request_paid(arr_data)
                if (res_data == '1') {
                    $(e).closest('tr').find('.cbx_sel').attr({ 'checked': true, 'disabled': true })
                    Swal.fire({
                        title: "Save it!",
                        text: "Your has been saved.",
                        icon: "success"
                    });
                } else {
                    // console.log(1)
                    $(e).closest('tr').find('.cbx_sel').attr('checked', false)
                    Swal.fire({
                        title: "error!",
                        text: "Please contact to tech team ",
                        icon: "error"
                    });
                }
            }
        });

    },

    ajax_data_request_paid : async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_receivable/payment_update.php",
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
        let paid_action = $('.sel_paid_action').val()

        let data_type = $(`#bill_to_list option[value="${data_bill_to}"]`).attr('data_type')
        let data_id = $(`#bill_to_list option[value="${data_bill_to}"]`).attr('data_id')

        let data_job = $(`#job_number_list [value="${data_job_number}"]`).attr('real_data')
        
        oobj_data = {
            data_type : data_type,
            data_id : data_id,
            data_job : data_job,
            data_currency : data_currency,
            paid_action : paid_action,
        }
        arr_data.push(oobj_data)

        let res_data = await this.ajax_request_filter(arr_data)
        await first_setting.setting_data_table(res_data);
    },

    ajax_request_filter : async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_receivable/get_data_table.php",
                dataType: "json",
                data : {arr_data : arr_data},
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}

