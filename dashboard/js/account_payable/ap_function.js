const ap_function = {





    select_data : async function(e){
        if(e == '6'){
            $('.sel_st_1').prop('checked',false)
            $('.sel_st_2').prop('checked',false)
            $('.sel_st_3').prop('checked',false)
            $('.sel_st_4').prop('checked',false)
            $('.sel_st_5').prop('checked',false)
        }else if(e == '1'){
            $('.sel_st_5').prop('checked',false)  
            $('.sel_st_6').prop('checked',false)  
        }else if(e == '5'){
            $('.sel_st_1').prop('checked',false)  
            $('.sel_st_6').prop('checked',false)
            $('.sel_st_2').prop('checked',true)
            $('.sel_st_3').prop('checked',true)
            $('.sel_st_4').prop('checked',true)
            $('.sel_st_5').prop('checked',true)
        }else if(e == '2' || e == '3' | e == '4'){
            $('.sel_st_6').prop('checked',false)  
        }

    },
    search_function: async function () {
        let arr_data = []

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

        // let data_action_status = $('input[name="bsradio2"]:checked').attr('name_data');

        let st_1 = $('.sel_st_1').prop('checked') ? '1' : '0';
        let st_2 = $('.sel_st_2').prop('checked') ? '1' : '0';
        let st_3 = $('.sel_st_3').prop('checked') ? '1' : '0';
        let st_4 = $('.sel_st_4').prop('checked') ? '1' : '0';
        let st_5 = $('.sel_st_5').prop('checked') ? '1' : '0';
        let st_6 = $('.sel_st_6').prop('checked') ? '1' : '0';
        



        let sale_data_search = $(`#sale_support_list option[value="${data_sale}"]`).attr('id_number')  ? $(`#sale_support_list option[value="${data_sale}"]`).attr('id_number')  : '';
        let cs_data_search = $(`#cs_support_list option[value="${data_cs}"]`).attr('id_number') ? $(`#cs_support_list option[value="${data_cs}"]`).attr('id_number') : '';
        let data_bill_to_serach = $(`#bill_to_list option[value="${bill_to}"]`).attr('data_id') ? $(`#bill_to_list option[value="${bill_to}"]`).attr('data_id') : '';
        let type_bill_to_serach = $(`#bill_to_list option[value="${bill_to}"]`).attr('type_data') ? $(`#bill_to_list option[value="${bill_to}"]`).attr('type_data') : '';
        let job_number_data_serach = $(`#job_number_list option[value="${data_job_number}"]`).attr('id_number') ? $(`#job_number_list option[value="${data_job_number}"]`).attr('id_number') : '';
        let hbl_data_serach = $(`#hbl_list option[value="${data_hbl}"]`).attr('id_number') ? $(`#hbl_list option[value="${data_hbl}"]`).attr('id_number') : '';
        let container_data_serach = $(`#container_list option[value="${data_container}"]`).attr('id_number') ? $(`#container_list option[value="${data_container}"]`).attr('id_number') : '';
        let billing_data_serach = $(`#billing_code_list option[value="${data_billing_code}"]`).attr('id_number') ? $(`#billing_code_list option[value="${data_billing_code}"]`).attr('id_number') : '';

        let obj_data = {
            data_status: 1,
            data_bill_to_serach: data_bill_to_serach,
            type_bill_to_serach: type_bill_to_serach,
            job_number_data_serach: job_number_data_serach,
            hbl_data_serach: hbl_data_serach,
            container_data_serach: container_data_serach,
            billing_data_serach: billing_data_serach,
            data_search: data_search,
            data_start_date: data_start_date,
            data_end_date: data_end_date,
            sale_data_search: sale_data_search,
            cs_data_search: cs_data_search,
            st_1 : st_1,
            st_2 : st_2,
            st_3 : st_3,
            st_4 : st_4,
            st_5 : st_5,
            st_6 : st_6,  
        }
        arr_data.push(obj_data)

        // console.log(arr_data)
        let res_data = await this.ajax_query_set(arr_data)
        console.log(res_data['table'])
        await setting_first.first_set(res_data);
        await ap_function.setting_data_result();
    },

    ajax_query_set: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payable/get_data_table.php",
                data: { arr_data: arr_data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    setting_data_result: async function () {


        $(`.table_data_account > tbody > tr`).each(function () {
            let currency = $(this).find('.inp_currency').val()
            let ap_amt = $(this).find('.inp_ap_amt_incvat').val()


        })


    },

    select_action_table: async function (e) {
        let arr_data_save = []

        let data_setting = e == 'approve' ? '1' : '2';
        $('.table_data_account > tbody > tr ').each(function () {
            let chx_select_data = $('.chx_select_data', this).is(':checked') ? '1' : '0';
            if (chx_select_data == '1') {
                let data_id = $(this).attr('data_id')
                let obj_data = {
                    data_id: data_id,
                    type: data_setting,
                }
                arr_data_save.push(obj_data)

            }

        })
        console.log(arr_data_save)

        // let res_data = this.ajax_set_status_data(arr_data_sent);
        // if(res_data['res_arr'] == '1'){
        //     Swal.fire(
        //         'Save it!',
        //         'Your file has been save.',
        //         'success'
        //     )
        // }else{
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Oops...',
        //         text: 'Data is problem pls. contact to tech team',
        //     })
        // }

    },


    select_approve: async function (e) {
        let data_id = $(e).closest('tr').attr('data_id');
        //let data_amt_incv = $(e).closest('tr').find('td > .inp_ap_amt_incvat').val()

        Swal.fire({
            title: 'Are you sure?',
            html:
                `are you sure do not revesrs this`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, got it!'
        }).then (async(result) => {
            if (result.isConfirmed) {
                let name_data = $(e).attr('name_data')

                let obj_data = {
                    data_id: data_id,
                    name_data: name_data,
                }

                let arr_data_sent = []
                arr_data_sent.push(obj_data)

                let res_data = await this.ajax_set_status_data(arr_data_sent);
                console.log(res_data)
                if (res_data['res_arr'] == '1') {
                    Swal.fire(
                        'Save it!',
                        'Your file has been save.',
                        'success'
                    )
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data is problem pls. contact to tech team',
                    })
                }

            } else if (result.dismiss) {

                let data_finded = $.grep(setting_first.get_res_data_table, function (obj) {
                    return obj.ID === data_id;
                })

                if (data_finded[0]['status'] == '1') {
                    $(e).closest('tr').find(`.data_sela_1`).prop('checked', true)
                } else if (data_finded[0]['status'] == '3') {
                    $(e).closest('tr').find(`.data_sela_3`).prop('checked', true)
                }
            }
        })
    },

    ajax_set_status_data: async function (arr_data_sent) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payable/set_status.php",
                data: { arr_data_sent: arr_data_sent },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    approve_all: async function (a) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, got it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let arr_data_chl = []
                $('.table_data_account tbody tr').each(function (e) {
                    let obj_data = {}
                    let data_id = $(this).attr('data_id')
                    let data_checked = $(this).find(`td > input[name="bsradio1_${data_id}"]:checked`).attr('name_data');
                    let get_check = $(this).find('.data_sela_1').prop('disabled') == false ? '1' : '0'

                    if (get_check == '1' && data_checked != a) {
                        obj_data = {
                            name_data: a,
                            data_id: data_id,
                        }

                        arr_data_chl.push(obj_data)
                    }
                })

                
                let res_data = await this.ajax_set_status_data(arr_data_chl)
                
                if (res_data['res_arr'] == '1') {
                    Swal.fire(
                        'Save it!',
                        'Your file has been save.',
                        'success'
                    )

                $.each(arr_data_chl,function(i,v){
                    $(`.table_data_account > tbody > .data_id${v['data_id']} > td > .data_sela_${a}`).prop('checked',true)
                })
                    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data is problem pls. contact to tech team',
                    })
                }

            }
        })

    },













}