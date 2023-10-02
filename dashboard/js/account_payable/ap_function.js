const ap_function = {


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
        let data_action_status = $('input[name="bsradio2"]:checked').attr('name_data');
        //console.log(data_action_status)
        //let data_radio_filter = $('input[name="bsradio1"]:checked').attr('id');

        let sale_data_search = $(`#sale_support_list option[value="${data_sale}"]`).attr('id_number')
        let cs_data_search = $(`#cs_support_list option[value="${data_cs}"]`).attr('id_number')

        
        let data_bill_to_serach = $(`#bill_to_list option[value="${bill_to}"]`).attr('data_id')
        let type_bill_to_serach = $(`#bill_to_list option[value="${bill_to}"]`).attr('type_data')
        



        let job_number_data_serach = $(`#job_number_list option[value="${data_job_number}"]`).attr('id_number')
        let hbl_data_serach = $(`#hbl_list option[value="${data_hbl}"]`).attr('id_number')
        let container_data_serach = $(`#container_list option[value="${data_container}"]`).attr('id_number')
        let billing_data_serach = $(`#billing_code_list option[value="${data_billing_code}"]`).attr('id_number')

        
        console.log(data_bill_to_serach)
        console.log(type_bill_to_serach)
        console.log(job_number_data_serach)
        console.log(hbl_data_serach)
        console.log(container_data_serach)
        console.log(billing_data_serach)

        //console.log(data_radio_filter)

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
            data_action_status: data_action_status,
        }
        arr_data.push(obj_data)

        let res_data = await this.ajax_query_set(arr_data)
        $('.table_data_account tbody').html('');
        //console.log(res_data['table'])
        let html_append_data = '';
        let currency_thb = 0;
        let currency_usd = 0;
        let currency_rmb = 0;
        let currency_hkd = 0;

        if (res_data['table'] != "0 results") {
            $.each(res_data['table'], function (i, v) {
                i++
        
                let job_number = v['job_number'] ? v['job_number'] : '';
                let id_number = v['ID'] ? v['ID'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let qty = v['qty'] ? v['qty'] : 0;
                let unit_price = v['unit_price'] ? v['unit_price'] : 0;
                let vat = v['vat'] ? v['vat'] : 0;
                let remark = v['remark'] ? v['remark'] : '';
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                let action_paid_by = v['action_paid_by'] ? v['action_paid_by'] : '';
                let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '';
                let vat_show = vat != '' ? vat + "%" : '';
                let with_holding_tax_show = with_holding_tax != '' ? with_holding_tax + "%" : '';
                let hbl_data = v['hbl_data'] ? v['hbl_data'] : '';
                let booking_number = v['booking_number'] ? v['booking_number'] : '';
                let billing_item_name = v['billing_des_name'] ? v['billing_des_name'] : '';
                let create_by_name = v['create_by_name'] ? v['create_by_name'] : '';
                let check_by_name = v['check_by_name'] ? v['check_by_name'] : '';
                let cs_support_name = v['cs_support_name'] ? v['cs_support_name'] : '';
                let sale_support_name = v['sale_support_name'] ? v['sale_support_name'] : '';
                let container_data = v['container_data'] ? v['container_data'] : '';
                let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
                let create_date = v['create_date'] ? v['create_date'] : '';
                let ap_amt = qty * unit_price;
                let ap_amt_incvat = (ap_amt * (vat / 100)) + ap_amt;
                let amt_cal = parseFloat(qty) * parseFloat(unit_price);
                let ap_amt_incvat_cal = parseFloat(amt_cal * parseFloat(vat / 100)) + amt_cal
                ap_amt_incvat_cal = ap_amt_incvat_cal.toFixed(2)
                ap_amt_incvat_cal = parseFloat(ap_amt_incvat_cal)
                ap_amt = ap_amt.toFixed(2)
                ap_amt_incvat = ap_amt_incvat.toFixed(2)

                if (currency == "THB") {
                    currency_thb = currency_thb + ap_amt_incvat_cal
                }
                if (currency == "USD") {
                    currency_usd = currency_usd + ap_amt_incvat_cal
                }
                if (currency == "RMB") {
                    currency_rmb = currency_rmb + ap_amt_incvat_cal
                }
                if (currency == "HKD") {
                    currency_hkd = currency_hkd + ap_amt_incvat_cal
                }

                html_append_data = `
                <tr class="text-center data_id${id_number}" data_id = "${id_number}">
                    <td><input type="checkbox" class="form-input-check chx_select_data"></td>
                    <td>${i}</td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${job_number}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${bill_to_c}" disabled></td>                                    Bill to
                    <td><input type="text" class="form-control form-control form-control-sm" value="${billing_item_name}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-center" value="${currency}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${qty}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${unit_price}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${ap_amt}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${vat_show}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${with_holding_tax_show}" disabled> </td>                                    WH%
                    <td><input type="text" class="form-control form-control form-control-sm text-end" value="${ap_amt_incvat}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm"></td>
                    <td>
                        <input type="radio" class="form-check-input" name="bsradio1_${id_number}" id="radio1" name_data="" checked="">
                        <label for="radio1" class="form-check-label pl-2">Waiting</label>
                        <input type="radio" class="form-check-input" name="bsradio1_${id_number}" id="radio2" name_data="">
                        <label for="radio2" class="form-check-label pl-2">Approve</label>
                        <input type="radio" class="form-check-input" name="bsradio1_${id_number}" id="radio3" name_data="">
                        <label for="radio3" class="form-check-label pl-2">Reject</label>
                    </td>                              
                    <td><input type="text" class="form-control form-control form-control-sm" value="${remark}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${cs_support_name}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${sale_support_name}" disabled></td>
                    <td><input type="date" class="form-control form-control form-control-sm" value="${create_date}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${create_by_name}" disabled></td>
                    <td><input type="datetime" class="form-control form-control form-control-sm" value="${create_data_time}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${check_by_name}" disabled></td>
                    <td><input type="datetime" class="form-control form-control form-control-sm" value="${check_date_time}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${booking_number}" disabled></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="${container_data}" disabled></td>                                    Container No.
                    <td><input type="text" class="form-control form-control form-control-sm" value="${hbl_data}" disabled></td>                         
                    <td><input type="checkbox" class="form-input-check tb_in_tb"></td>
                    <td><input type="text" class="form-control form-control form-control-sm" value="" disabled></td>                                    
                    <td><input type="text" class="form-control form-control form-control-sm" value="${action_paid_date_time}" disabled></td>                                    Request payble
                </tr>
                `;

                $('.table_data_account tbody').append(html_append_data)

                if (action_paid_by != '') {
                    $(`.data_id${id_number} > td >.tb_in_tb`).prop('checked', true)
                }
            })

            currency_thb = currency_thb.toFixed(2)
            currency_usd = currency_usd.toFixed(2)
            currency_rmb = currency_rmb.toFixed(2)
            currency_hkd = currency_hkd.toFixed(2)
            $('.total_payble_usd').val(currency_usd)
            $('.total_payble_thb').val(currency_thb)
            $('.total_payble_rmb').val(currency_rmb)
            $('.total_payble_hkd').val(currency_hkd)
        }else{
            
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Data not found. please change setting search data',
            })
        }
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


    checked_select_all: async function () {
        $('.table_data_account > tbody > tr > td .chx_select_data').prop('checked', true)
    },

    unchecked_select_all: async function () {
        $('.table_data_account > tbody > tr > td .chx_select_data').prop('checked', false)
    },


    select_action_table: async function (e) {
        let arr_data_save = []
        $('.table_data_account > tbody > tr ').each(function () {
            let chx_select_data = $('.chx_select_data', this).is(':checked') ? '1' : '0';
            if (chx_select_data == '1') {
                let data_id = $(this).attr('data_id')
                let obj_data = {
                    data_id: data_id,
                    type: e,
                }
                arr_data_save.push(obj_data)
            }

        })






    }


}