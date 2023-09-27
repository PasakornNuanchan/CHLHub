const setting_first = {
    first_set: async function () {


        $('.head-of-menu').html('Account Payable (CHECK)');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="account_payable.php" target="" style="color:white;">Account Payable (Check)</a></li>
        `;
        $('.bcpage').append(html_bdpage);



        let res_data = await this.ajax_first_set();
        console.log(res_data)
        $('.table_data_account tbody').html('')

            let currency_thb = 0;        
            let currency_usd = 0;
            let currency_rmb = 0;
            let currency_hkd = 0; 

        if (res_data['table'] != "0 results") {
            let html_append_data = '';
            $.each(res_data['table'], function (i, v) {
                i++

                let job_number = v['job_number'] ? v['job_number'] : '';

                let id_number = v['ID'] ? v['ID'] : '';

                let billing_description = v['billing_description'] ? v['billing_description'] : '';
                let bill_to_type = v['bill_to_type'] ? v['bill_to_type'] : '';
                let bill_to = v['bill_to'] ? v['bill_to'] : '';
                let payble = v['payble'] ? v['payble'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let qty = v['qty'] ? v['qty'] : 0;
                let unit_price = v['unit_price'] ? v['unit_price'] : 0;
                let amount = v['amount'] ? v['amount'] : '';
                let vat = v['vat'] ? v['vat'] : 0;
                let amtinclvat = v['amtinclvat'] ? v['amtinclvat'] : '';
                let remark = v['remark'] ? v['remark'] : '';
                let type = v['type'] ? v['type'] : '';
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                let create_by = v['create_by'] ? v['create_by'] : '';
                let delete_date_time = v['delete_date_time'] ? v['delete_date_time'] : '';
                let delete_by = v['delete_by'] ? v['delete_by'] : '';
                let action_paid_by = v['action_paid_by'] ? v['action_paid_by'] : '';
                let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                let check_by = v['check_by'] ? v['check_by'] : '';
                let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                let status = v['status'] ? v['status'] : '';
                let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                let add_on = v['add_on'] ? v['add_on'] : '';
                let last_update_by = v['last_update_by'] ? v['last_update_by'] : '';
                let last_update_datetime = v['last_update_datetime'] ? v['last_update_datetime'] : '';
                let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
                let Billing_date = v['Billing_date'] ? v['Billing_date'] : '';
                let sys_rate_currency = v['sys_rate_currency'] ? v['sys_rate_currency'] : '';
                let tax_with_hold_by = v['tax_with_hold_by'] ? v['tax_with_hold_by'] : '';
                let commit_sale = v['commit_sale'] ? v['commit_sale'] : '';
                let tax_with_hold_date_time = v['tax_with_hold_date_time'] ? v['tax_with_hold_date_time'] : '';
                let currency_main = v['currency_main'] ? v['currency_main'] : '';
                let need_vat = v['need_vat'] ? v['need_vat'] : '';
                let refer = v['refer'] ? v['refer'] : '';
                let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '';
                let paid_amt = v['paid_amt'] ? v['paid_amt'] : '';

                let vat_show = vat != '' ? vat+"%" : '';
                let with_holding_tax_show = with_holding_tax != '' ? with_holding_tax+"%" : '';
                let hbl_data = v['hbl_data'] ? v['hbl_data'] : '';
                let booking_number = v['booking_number'] ? v['booking_number'] : '';
                let billing_item_name = v['billing_des_name'] ? v['billing_des_name'] : '';
                let create_by_name = v['create_by_name'] ? v['create_by_name'] : '';
                let check_by_name = v['check_by_name'] ? v['check_by_name'] : '';
                let cs_support_name = v['cs_support_name'] ? v['cs_support_name'] : '';
                let sale_support_name = v['sale_support_name'] ? v['sale_support_name'] : '';
                let container_data = v['container_data'] ? v['container_data'] : '';
                let bill_to_c =  v['bill_to_c'] ? v['bill_to_c'] : '';

                let create_date = v['create_date'] ? v['create_date'] : '';

                let ap_amt = qty * unit_price;
                let ap_amt_incvat = (ap_amt*(vat/100))+ap_amt;


                let amt_cal = parseFloat(qty) * parseFloat(unit_price);
                let ap_amt_incvat_cal = parseFloat(amt_cal*parseFloat(vat/100))+amt_cal
                ap_amt_incvat_cal = ap_amt_incvat_cal.toFixed(2)
                ap_amt_incvat_cal = parseFloat(ap_amt_incvat_cal)

                ap_amt = ap_amt.toFixed(2)
                ap_amt_incvat = ap_amt_incvat.toFixed(2)


                if(currency == "THB"){
                    currency_thb = currency_thb + ap_amt_incvat_cal
                }
                if(currency == "USD"){
                    currency_usd = currency_usd + ap_amt_incvat_cal
                }
                if(currency == "RMB"){
                    currency_rmb = currency_rmb + ap_amt_incvat_cal
                }
                if(currency == "HKD"){
                    currency_hkd = currency_hkd + ap_amt_incvat_cal
                }

                


                //let create_data_time_format = create_data_time.substr(0,10)

                html_append_data = `
                <tr class="text-center data_id${id_number}" data_id = "${id_number}">
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

                if(action_paid_by != ''){
                    $(`.data_id${id_number} > td >.tb_in_tb`).prop('checked',true)
                }
            })
        }
        currency_thb = currency_thb.toFixed(2)
        currency_usd = currency_usd.toFixed(2)
        currency_rmb = currency_rmb.toFixed(2)
        currency_hkd = currency_hkd.toFixed(2)
        $('.total_payble_usd').val(currency_usd)
        $('.total_payble_thb').val(currency_thb)
        $('.total_payble_rmb').val(currency_rmb)
        $('.total_payble_hkd').val(currency_hkd)



    },

    ajax_first_set: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payable/get_data_table.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


}


