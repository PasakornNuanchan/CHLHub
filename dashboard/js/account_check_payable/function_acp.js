const function_acp = {




    filter_select: async function () {
        let oobj_data = {}
        let arr_data = []
        let data_bill_to = $('.inp_data_bill_to').val()
        let data_job_number = $('.inp_data_job_number').val()
        let data_currency = $('.sel_currency').val()
        let data_paid_action = $('.sel_paid_action').val()

        let data_type = $(`#bill_to_list option[value="${data_bill_to}"]`).attr('data_type')
        let data_id = $(`#bill_to_list option[value="${data_bill_to}"]`).attr('data_id')

        let data_job = $(`#job_number_list [value="${data_job_number}"]`).attr('real_data')

        oobj_data = {
            data_type: data_type,
            data_id: data_id,
            data_job: data_job,
            data_currency: data_currency,
            data_paid_action: data_paid_action,
        }
        arr_data.push(oobj_data)

        let res_data = await this.ajax_request_filter(arr_data)
        await first_setting.setting_data_table(res_data);
    },

    select_all: async function (e) {
        let obj_data = {}
        let arr_data = []
        $(`.table_data_account tbody tr`).each(function () {
            let check_disabled = $(this).find(`td > .cbx_sel`).prop('disabled') == false ? '1' : '0';
            // console.log(check_disabled)

            if (check_disabled == '1') {
                if (e == '1') {
                    $(this).find(`td > .cbx_sel`).prop('checked', true)
                    let id_number = $(this).attr('id_number')
                    let ref_job_id = $(this).attr('ref_job_id')

                    obj_data = {
                        id_number: id_number,
                        ref_job_id: ref_job_id,
                    }
                    arr_data.push(obj_data)

                } else {
                    $(this).find(`td > .cbx_sel`).prop('checked', false)

                }
            }
        })

        console.log(arr_data)

        if (e != '2') {


            Swal.fire({
                title: "Are you sure?",
                html: `You won't be able to revert this!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Confirm!"
            }).then(async (result) => {
                if (result.isConfirmed) {

                    // arr_data.push(obj_data)
                    console.log(arr_data)
                    let res_data = await this.ajax_data_request_paid(arr_data)
                    // let res_data = '1';
                    if (res_data == '1') {

                        $.each(arr_data, function (i, v) {
                            let id_number = v['id_number'] ? v['id_number'] : '';
                            $(`.table_data_account > tbody > .row_master_${id_number} > td > .cbx_sel`).attr({ 'disabled': true, 'checked': true })
                        })
                        Swal.fire({
                            title: "Save it!",
                            text: "Your has been saved.",
                            icon: "success"
                        });
                    } else {
                        $.each(arr_data, function (i, v) {
                            let id_number = v['id_number'] ? v['id_number'] : '';

                            $(`.table_data_account > tbody > .row_master_${id_number} > td > .cbx_sel`).attr({ 'disabled': false, 'checked': false })
                        })
                        Swal.fire({
                            title: "error!",
                            text: "Please contact to tech team ",
                            icon: "error"
                        });
                    }
                }
            });
        }

    },

    check_paid_data: async function (e) {
        let id_number = $(e).closest('tr').attr('id_number')
        let ref_job_id = $(e).closest('tr').attr('ref_job_id')
        let job_number = $(e).closest('tr').find('.inp_job_no').val()
        let bill_to = $(e).closest('tr').find('.inp_bill_to').val()
        let code = $(e).closest('tr').find('.inp_code').val()
        let currency_can = $(e).closest('tr').find('.inp_currency_can').val()
        let amt_inc_can = $(e).closest('tr').find('.inp_amt_incv_can').val()

        

        Swal.fire({
            title: "Are you sure?",
            html: `You won't be able to revert this! <br>
            job number : ${job_number} <br>
            bill to : ${bill_to} <br>
            CODE : ${code} <br>
            amount : ${amt_inc_can} ${currency_can}
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
                    id_number: id_number,
                    ref_job_id: ref_job_id,
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
            }else{
                $(e).prop('checked',false)
                
            }
        });

    },

    ajax_data_request_paid: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_payable/payment_update.php",
                dataType: "json",
                data: {
                    arr_data : arr_data
                },
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_request_filter: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_payable/get_data_table.php",
                dataType: "json",
                data: { arr_data: arr_data },
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}

