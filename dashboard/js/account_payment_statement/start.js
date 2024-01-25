const start = {
    data_table: '',
    data_res_data_currency: '',
    data_get_table_reverse: '',
    start_setting: async function () {
        $('.head-of-menu').html('Account payment statement')
    },


    start_setting_table: async function (e) {

        $('.table_payment > tbody').html('')
        console.log(e)
        $.each(e['table'], function (i, v) {
            i++;
            let type_document = v['type_document'] ? v['type_document'] : '';
            let document_payment = v['document_payment'] ? v['document_payment'] : '';
            let data_docuemnt = v['data_docuemnt'] ? v['data_docuemnt'] : '';
            let payment_date = v['payment_date'] ? v['payment_date'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let job_number = v['job_number'] ? v['job_number'] : '';
            let currency = v['currency'] ? v['currency'] : '';
            let amount = v['amount'] ? v['amount'] : '';
            let bank_account_data = v['bank_account_data'] ? v['bank_account_data'] : '';
            let remark = v['remark'] ? v['remark'] : '';

            let html_data = `
                <tr>
                    <td class="text-center">${i}</td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${type_document}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${document_payment}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${data_docuemnt}"></td>
                    <td><input type="text" class="form-control form-control-sm text-center" disabled value="${payment_date}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${consignee_name}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${job_number}"></td>
                    <td><input type="text" class="form-control form-control-sm text-center" disabled value="${currency}"></td>
                    <td><input type="text" class="form-control form-control-sm text-end" disabled value="${amount}"></td>
                    <td><input type="text" class="form-control form-control-sm text-center" disabled value="${bank_account_data}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${remark}"></td>

                </tr>
                `;
            
            $('.table_payment > tbody').append(html_data)
        })

    },



    mark_active: async function (e) {
        $('.active_side').removeClass('active_side');
        $(e).addClass("active_side")
        await this.select_filter()
    },

    select_filter: async function () {
        let data_radio_select_type = $('input[name="radio_function_paid"]:checked').val();
        let job_number = $('.inp_job_number_filter').val() ? $('.inp_job_number_filter').val() : '';
        // $('.table_payment thead').html('')
        let data_data_id = '';
        let data_data_type = '';
        let data_name_type = '';
        $.each($('.data_sic > div > button'), function () {
            let data_hasclass = $(this).hasClass('active_side')
            if (data_hasclass == true) {
                data_data_id = $(this).attr('data_id')
                data_data_type = $(this).attr('data_type')
                data_name_type = $(this).attr('name_type')
            }
        })
        let res_data = await this.ajax_setting_data(
            data_radio_select_type,
            data_data_id,
            data_data_type,
            data_name_type,
            job_number
        )
        await this.start_setting_table(res_data)
    },

    ajax_setting_data: async function (
        data_radio_select_type,
        data_data_id,
        data_data_type,
        data_name_type,
        job_number
    ) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment_statement/get_data_table.php",
                dataType: "json",
                data: {
                    data_radio_select_type: data_radio_select_type,
                    data_data_id: data_data_id,
                    data_data_type: data_data_type,
                    data_name_type: data_name_type,
                    job_number: job_number,
                },
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

   

}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $('#blah').attr('src', e.target.result);
            $('#blah').addClass("text-primary")
        };

        reader.readAsDataURL(input.files[0]);
    }
}

async function convert_file(data) {

    const base64String = await toBase64(data);
    return (base64String);
}

function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}