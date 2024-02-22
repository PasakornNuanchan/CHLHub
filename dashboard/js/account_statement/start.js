const start = {
    start_setting: async function () {
        $('.head-of-menu').html('Account payment statement')
        $('.breadcrumb-item > a').html('Account payment statement')
    },

    setting_table : async function(e){
        // console.log(e)
        $('.table_payment tbody').html('')
        $.each(e['table'],function(i,v){
            let type_document = v['type_document'] ? v['type_document'] : '';
            let document_payment = v['document_payment'] ? v['document_payment'] : '';
            let data_docuemnt = v['data_docuemnt'] ? v['data_docuemnt'] : '';
            let payment_date = v['payment_date'] ? v['payment_date'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let ref_billing_payment = v['ref_billing_payment'] ? v['ref_billing_payment'] : '';
            let currency_receipt = v['currency_receipt'] ? v['currency_receipt'] : '';
            let bank_account_name = v['bank_account_name'] ? v['bank_account_name'] : '';
            let actual_payment = v['actual_payment'] ? v['actual_payment'] : '';
            let remark = v['remark'] ? v['remark'] : '';
            let id_number = v['ID'] ? v['ID'] : '';
            let data_job_number = v['data_job_number'] ? v['data_job_number'] : '';

            let html_table = `
            <tr>
                <td><div class="number_run text-center"></div></td>
                <td><input type="text" class="form-control form-control-sm" readonly value="${type_document}"></td>
                <td><input type="text" class="form-control form-control-sm inp_data_payment" readonly value="${document_payment}"></td>
                <td><input type="text" class="form-control form-control-sm" readonly value="${data_docuemnt}"></td>
                <td><input type="text" class="form-control form-control-sm text-center" readonly value="${payment_date}"></td>
                <td><input type="text" class="form-control form-control-sm" readonly value="${consignee_name}"></td>
                <td><input type="text" class="form-control form-control-sm job_number_data" readonly value="${data_job_number}"></td>
                <td><input type="text" class="form-control form-control-sm text-center" readonly value="${currency_receipt}"</td>
                <td><input type="text" class="form-control form-control-sm text-end" readonly value="${actual_payment}"</td>
                <td><input type="text" class="form-control form-control-sm text-center" readonly value="${bank_account_name}"</td>
                <td><input type="text" class="form-control form-control-sm" readonly value="${remark}"</td>
                <td><div class="text-center" onclick="start.open_pic('${id_number}')"><i class="bi bi-image text-primary"></i></div></td>
            </tr>
            `;

            $('.table_payment tbody').append(html_table)

        })
        await start.setting_number_table();
    },

    setting_number_table : async function(){
        let data_number_run = 0
        $('.table_payment tbody tr').each(function(){
            data_number_run++;
            $(this).find('.number_run').html(data_number_run)
        })
    },


    select_filter : async function (){
        console.log('8888')
        let data_radio_select_type = $('input[name="radio_function_paid"]:checked').val() == 'ALL' ? '' : $('input[name="radio_function_paid"]:checked').val();
        let data_document_number_search = $('.inp_document_number_search').val()
        let data_job_number_search = $('.inp_job_number_search').val()
        let data_currency_search = $('.inp_currency_search').val() == 'ALL' ? '' : $('.inp_currency_search').val();
        let data_bank_account_search = $('.inp_bank_account_search').val()
        let data_active_cnee = $('.active_side').attr('name_type') == '0' ? '' : $('.active_side').attr('name_type');
        let select_data_start = $('.inp_select_date_start').val()
        let select_data_end = $('.inp_select_date_end').val()

        obj_data_filter = {
            data_radio_select_type : data_radio_select_type,
            data_document_number_search : data_document_number_search,
            data_job_number_search : data_job_number_search,
            data_currency_search : data_currency_search,
            data_bank_account_search : data_bank_account_search,
            data_active_cnee : data_active_cnee,
            select_data_start : select_data_start,
            select_data_end : select_data_end,
        }
        // console.log(obj_data_filter)
        let res_data = await this.ajax_setting_data(obj_data_filter)
        await this.setting_table(res_data)
        await this.list_data_select()
    },

    list_data_select : async function(){
        $('.list_document_number').html('')
        $('.inp_job_number_search').html('')

        let docuemnt_number_arr = []
        let number_run_arr = []
        $('.table_payment tbody tr').each(function(){
            let document_number = $(this).find('.inp_data_payment').val()
            docuemnt_number_arr.push(document_number)

            let number_data = $(this).find('.job_number_data').val()
            number_run_arr.push(number_data)

        })
        docuemnt_number_arr = $.unique(docuemnt_number_arr)
        number_run_arr = $.unique(number_run_arr)

        let document_arr = '';
        let number_arr = '';
        $.each(docuemnt_number_arr,function(i,v){
            document_arr += `<option value="${v}">${v}</option>`;
        })
        $.each(number_run_arr,function(i,v){
            number_arr += `<option value="${v}">${v}</option>`;
        })

        $('.list_document_number').append(document_arr)
        $('.list_job_number').append(number_arr)
    },

    ajax_setting_data: async function (data_sent) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_statement/get_data_table.php",
                dataType: "json",
                data: {data_sent:data_sent},
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

    open_pic: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_statement/get_pic.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

}