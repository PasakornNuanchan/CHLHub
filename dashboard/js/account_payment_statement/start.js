const start = {
    data_table: '',
    data_res_data_currency: '',
    data_get_table_reverse: '',
    start_setting: async function () {
        $('.head-of-menu').html('Account payment statement')
    },


    start_setting_table: async function (e) {
        console.log(e)
        $('.table_payment > tbody').html('')
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
                    <td><input type="text" class="form-control form-control-sm inp_document_payment" disabled value="${document_payment}"></td>
                    <td><input type="text" class="form-control form-control-sm " disabled value="${data_docuemnt}"></td>
                    <td><input type="text" class="form-control form-control-sm text-center" disabled value="${payment_date}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${consignee_name}"></td>
                    <td><input type="text" class="form-control form-control-sm inp_job_number" disabled value="${job_number}"></td>
                    <td><input type="text" class="form-control form-control-sm text-center" disabled value="${currency}"></td>
                    <td><input type="text" class="form-control form-control-sm text-end" disabled value="${amount}"></td>
                    <td><input type="text" class="form-control form-control-sm text-center inp_bank_account" disabled value="${bank_account_data}"></td>
                    <td><input type="text" class="form-control form-control-sm" disabled value="${remark}"></td>

                </tr>
                `;
            
            $('.table_payment > tbody').append(html_data)
        })
    },


    gen_default : async function(){
        let path = $('.table_payment tbody tr')
        let arr_data_document_payment = []
        let arr_data_bank_account = []
        let arr_data_job_number = []

        $.each(path,function(){
            let data_document = $(this).find('.inp_document_payment').val()
            if(!arr_data_document_payment.includes(data_document)){
                arr_data_document_payment.push(data_document)
            }

            
            let job_number =  $(this).find('.inp_job_number').val()
            if(job_number != ''){
                if(!arr_data_job_number.includes(job_number)){
                    arr_data_job_number.push(job_number)
                }
            }
            
        })

        let html_data_document_payment = '';
        let html_data_bank_account = '';
        let html_data_job_number = '';

        $.each(arr_data_document_payment,function(i,v){
            html_data_document_payment += `<option>${v}</option>`;
        })
        $('.list_document_number').append(html_data_document_payment)


        $.each(arr_data_job_number,function(i,v){
            html_data_job_number += `<option>${v}</option>`;
        })
        $('.list_job_number').append(html_data_job_number)
        
    },

    append_data_bank_detail : async function(){

        let res_data = await this.ajax_get_bank_detail()
        let html_data = ''
        $.each(res_data['bank'],function(i,v){
            let id_number = v['ID'] ? v['ID'] : '';
            let bank_code = v['bank_code'] ? v['bank_code'] : '';
            html_data += `<option value="${id_number}">${bank_code}</option>`;
        })
        $('.inp_bank_account_search').append(html_data)


    },

    ajax_get_bank_detail : async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment_statement/get_bank_detail.php",
                dataType: "json",
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
        let data_radio_select_type = $('input[name="radio_function_paid"]:checked').val() == 'ALL' ? '' : $('input[name="radio_function_paid"]:checked').val();
        let data_document_number_search = $('.inp_document_number_search').val()
        let data_job_number_search = $('.inp_job_number_search').val()
        let data_currency_search = $('.inp_currency_search').val() == 'ALL' ? '' : $('.inp_currency_search').val();
        let data_bank_account_search = $('.inp_bank_account_search').val()
        let data_active_cnee = $('.active_side').attr('name_type') == '0' ? '' : $('.active_side').attr('name_type');

        let data_sent = {
            data_radio_select_type : data_radio_select_type,
            data_document_number_search : data_document_number_search,
            data_job_number_search : data_job_number_search,
            data_currency_search : data_currency_search,
            data_bank_account_search : data_bank_account_search,
            data_active_cnee : data_active_cnee,
        }

        console.log(data_sent)
        // let data_data_id = '';
        // let data_data_type = '';
        // let data_name_type = '';
        // $.each($('.data_sic > div > button'), function () {
        //     let data_hasclass = $(this).hasClass('active_side')
        //     if (data_hasclass == true) {
        //         data_data_id = $(this).attr('data_id')
        //         data_data_type = $(this).attr('data_type')
        //         data_name_type = $(this).attr('name_type')
        //     }
        // })
        let res_data = await this.ajax_setting_data(data_sent)
        await this.start_setting_table(res_data)
    },

    ajax_setting_data: async function (data_sent) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment_statement/get_data_table.php",
                dataType: "json",
                data: {data_sent:data_sent},
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