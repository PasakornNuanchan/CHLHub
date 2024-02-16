const start = {
    data_on_modal_setting: '',
    setting_header: async function () {
        $('.head-of-menu').html('Incentive Management')
        $('.breadcrumb-item > a').html('Incentive Management')
    },

    setting_data_table: async function (res_data) {

        $('.table_process tbody').html('');

        console.log(res_data)
       
        $.each(res_data['table_data'],function(i,v){
            i++;
            let id_job_number = v['ID'] ? v['ID'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
            let f_name_sale = v['f_name_sale'] ? v['f_name_sale'] : '';
            let l_name_sale = v['l_name_sale'] ? v['l_name_sale'] : '';
            let ar_amt = v['ar_amt'] ? v['ar_amt'] : '0';
            let rcvd_amt = v['rcvd_amt'] ? v['rcvd_amt'] : '0';
            let ap_amt = v['ap_amt'] ? v['ap_amt'] : '0';
            let paid_amt = v['paid_amt'] ? v['paid_amt'] : '0';
            let create_date = v['create_date'] ? v['create_date'] : '';
            let rcvd_date = v['rcvd_date'] ? v['rcvd_date'] : '';
            let paid_date = v['paid_date'] ? v['paid_date'] : '';
            let voy_no_mother = v['mother_vessel'] ? v['mother_vessel'] : '';


            html_data_table_proces = `
             <tr class="text-center row_id${id_job_number}" id_job_number="${id_job_number}">
                 <td>${i}</td>
                 <td><input type="checkbox" class="form-input-check" style="zoom:150%"></td>
                 <td><input type="text" class="form-control form-control-sm inp_job_number"></td>
                 <td><input type="text" class="form-control form-control-sm inp_client"></td>
                 <td><input type="text" class="form-control form-control-sm inp_sale_name"></td>
                 <td><input type="text" class="form-control form-control-sm text-end inp_ar_amt"></td>
                 <td><input type="text" class="form-control form-control-sm text-end inp_rcvd_amt"></td>
                 <td><input type="text" class="form-control form-control-sm text-end inp_ap_amt"></td>
                 <td><input type="text" class="form-control form-control-sm text-end inp_paid_amt"></td>
                 <td><input type="text" class="form-control form-control-sm text-end inp_profit"></td>
                 <td><input type="text" class="form-control form-control-sm text-end inp_total"></td>
                 <td><input type="text" class="form-control form-control-sm text-center inp_op_date"></td>
                 <td><input type="text" class="form-control form-control-sm text-center inp_rcvd_date"></td>
                 <td><input type="text" class="form-control form-control-sm text-center inp_paid_date"></td>
                 <td><input type="text" class="form-control form-control-sm text-center inp_ar_settld"></td>
                 <td><input type="text" class="form-control form-control-sm inp_so"></td>
                 <td><input type="text" class="form-control form-control-sm inp_vsl"></td>
             </tr>
             `;

            ar_amt = parseFloat(ar_amt)
            rcvd_amt = parseFloat(rcvd_amt)
            ap_amt = parseFloat(ap_amt)
            paid_amt = parseFloat(paid_amt)
            ar_amt = ar_amt.toFixed(2)
            rcvd_amt = rcvd_amt.toFixed(2)
            ap_amt = ap_amt.toFixed(2)
            paid_amt = paid_amt.toFixed(2)

            $('.table_process > tbody').append(html_data_table_proces)
            $(`.row_id${id_job_number} td > .inp_job_number`).val(job_number).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_client`).val(bill_to_c).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_sale_name`).val(f_name_sale+' '+l_name_sale).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_ar_amt`).val(ar_amt).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_rcvd_amt`).val(rcvd_amt).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_ap_amt`).val(ap_amt).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_paid_amt`).val(paid_amt).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_profit`).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_total`).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_op_date`).val(create_date).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_rcvd_date`).val(rcvd_date).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_paid_date`).val(paid_date).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_ar_settld`).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_so`).attr('disabled',true)
            $(`.row_id${id_job_number} td > .inp_vsl`).val(voy_no_mother).attr('disabled',true)
            
        })
        await this.cal_total();
        
    },


    ajax_request_data_table: async function (data_sent) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/incentive_management/get_data_table.php",
                data : {'data_sent' : data_sent},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    cal_total: async function () {
        let e_path = $('.table_process > tbody > tr')
        $.each(e_path, function () {
            let data_ar_amt = $(this).find('.inp_ar_amt').val()
            let data_ap_amt = $(this).find('.inp_ap_amt').val()

            let rcvd_amt = $(this).find('.inp_rcvd_amt').val()
            let paid_amt = $(this).find('.inp_paid_amt').val()

            data_ar_amt = parseFloat(data_ar_amt);
            data_ap_amt = parseFloat(data_ap_amt);

            rcvd_amt = parseFloat(rcvd_amt);
            paid_amt = parseFloat(paid_amt);

            let data_profit = data_ar_amt - data_ap_amt
            data_profit = data_profit.toFixed(2)

            let data_total = rcvd_amt - paid_amt
            data_total = data_total.toFixed(2)

            $(this).find('.inp_profit').val(data_profit)
            $(this).find('.inp_total').val(data_total)
        })
    },

    filter_incentive: async function () {
        let date_select = $('.inp_date_select').val()
        let sale = $('.sel_sale').val()
        let client = $('.sel_client').val()
        let date_start = $('.inp_date_start').val()
        let date_end = $('.inp_date_end').val()
        let job_number = $('.inp_job_number').val()
        let have_ar = $('.inp_have_ar').prop('checked') ? '1' : '0';
        let no_ap = $('.inp_no_ap').prop('checked') ? '1' : '0';
        let unfinish = $('.inp_unfinish').prop('checked') ? '1' : '0';
        let all_co = $('.inp_all_co').prop('checked') ? '1' : '0';
        let commition = $('.inp_commition').prop('checked') ? '1' : '0';
        let currency = $('.inp_currency').val()
        let co_op = $('.inp_co_op').val()

        let obj_data = {
            date_select : date_select,
            sale : sale,
            client : client,
            date_start : date_start,
            date_end : date_end,
            job_number : job_number,
            have_ar : have_ar,
            no_ap : no_ap,
            unfinish : unfinish,
            all_co : all_co,
            commition : commition,
            currency : currency,
            co_op : co_op,
        }
        console.log(obj_data)

        let res_data = await this.ajax_request_data_table(obj_data);
        await this.setting_data_table(res_data)
    },

    modal_setting_incentive: async function () {
        if ($('#modal_account_payment').length >= 1) {
            $('#modal_account_payment').remove()
        }

        let res_data = await this.ajax_request_data_modal();
        console.log(res_data)
        this.data_on_modal_setting = res_data;
        let html_data_data_modal = '';
        $.each(res_data['user_data_modal'], function (i, v) {
            i++
            let id_incen = v['id_incen'] ? v['id_incen'] : '';
            let incetive_per = v['incetive_per'] ? v['incetive_per'] : '';
            html_data_data_modal += `
            <tr id_number="${v['ID']}" id_incen="${id_incen}">
                <td class="text-center">${i}</td>
                <td>${v['first_name']} ${v['last_name']}</td>
                <td class="department_data">${v['department']}</td>
                <td><input type="number" class="form-control form-control-sm text-center inp_percentage" value="${incetive_per}"></td>
            </tr>
            `;
        })


        html = `
        <div class="modal" id="modal_account_payment" data-bs-backdrop="true">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72); ">
                    <div class="modal-header">
                        <h4 class="modal-title">Data processing</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body " style="zoom:90%">
                        <h5>Filter</h5>
                        <div class="row m-3">
                            <div class="col-6">
                                <div class="col-4"><label>department</label></div>
                                <div class="col-8"><select class="form-select form-select-sm sel_department_modal" onchange="start.filter_on_modal()">
                                </select></div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table_on_modal">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>user</th>
                                        <th>department</th>
                                        <th>commission percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${html_data_data_modal}
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick="start.save_incentive_manage()">Save</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
            `;
        $('body').append(html)

        $('#modal_account_payment').modal('show')


        // default fillter 
        let e_path = $('.table_on_modal tbody tr');
        let arr_data_depart = []
        $.each(e_path, function () {
            let data_department = $(this).find('.department_data').html()
            arr_data_depart.push(data_department)
        })
        arr_data_depart = $.unique(arr_data_depart);
        let html_data_department = '<option value="All">All</option>';
        $.each(arr_data_depart, function (i, v) {
            html_data_department += `<option value="${v}">${v}</option>`;
        })
        $('.sel_department_modal').append(html_data_department)

    },

    filter_on_modal: async function () {
        let depart_filter = $('.sel_department_modal').val()
        $('.table_on_modal tbody').html('')
        let html_modal_filter = ``;
        $.each(this.data_on_modal_setting['user_data_modal'], function (i, v) {
            let id_incen = v['id_incen'] ? v['id_incen'] : '';
            let incetive_per = v['incetive_per'] ? v['incetive_per'] : '';

            if (depart_filter != "All") {
                if (depart_filter == v['department']) {
                    i++;
                    html_modal_filter += `
                    <tr id_number="${v['ID']}" id_incen="${id_incen}">
                        <td class="text-center">${i}</td>
                        <td>${v['first_name']} ${v['last_name']}</td>
                        <td class="department_data">${v['department']}</td>
                        <td><input type="number" class="form-control form-control-sm text-center inp_percentage" value="${incetive_per}"></td>
                    </tr>`;
                }
            } else {
                i++;
                html_modal_filter += `
                    <tr id_number="${v['ID']}" id_incen="${id_incen}">
                        <td class="text-center">${i}</td>
                        <td>${v['first_name']} ${v['last_name']}</td>
                        <td class="department_data">${v['department']}</td>
                        <td><input type="number" class="form-control form-control-sm text-center inp_percentage" value="${incetive_per}"></td>
                    </tr>`;
            }

        })
        $('.table_on_modal tbody').append(html_modal_filter)
    },

    save_incentive_manage: async function () {
        let e_path = $('.table_on_modal tbody tr')
        let arr_data = []
        $.each(e_path, function () {
            let id_number = $(this).attr('id_number')
            let id_incen = $(this).attr('id_incen')
            let percentage = $(this).find('.inp_percentage').val()
            let obj_data = {
                id_number: id_number,
                percentage: percentage,
                id_incen:id_incen,
            }
            arr_data.push(obj_data)
        })

        let data_arr_user_save = []
        $.each(this.data_on_modal_setting['user_data_modal'], function (i1, v1) {
            $.each(arr_data, function (i, v) {
                if (v1['ID'] == v['id_number']) {
                    if (v1['incetive_per'] != v['percentage']) {

                        percentage = v['percentage'] ? v['percentage'] : '0';
                        let obj_arr_user_save = {
                            id_number: v['id_number'],
                            percentage: percentage,
                            id_incen : v['id_incen'],
                        }
                        data_arr_user_save.push(obj_arr_user_save)
                    }
                }
            })
        })
        console.log(data_arr_user_save)

        let res_data = await this.ajax_save_data_setting_incentive(data_arr_user_save)
        if(res_data == '1'){
            Swal.fire(
                'saved!',
                'Your data has been saved.',
                'success'
            )
        }
    },

    ajax_save_data_setting_incentive: async function (arr_data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/incentive_management/save_setting.php",
                data: { arr_data: arr_data },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_request_data_modal: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/incentive_management/get_data_modal.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}