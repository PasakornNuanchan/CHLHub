const sub_billing = {
    first_post_data_ar: async function (id_number) {
        let res_data = await this.ajax_setting_data_first_ar(id_number)
        console.log(res_data)
        let html_data_ar = '';

        $('.table_billing_ar > tbody').html('')
        if (res_data['get_data_ar'] != "0 results") {
            
            $.each(res_data['get_data_ar'], function (i, v) {
                let id_list = v['ID'] ? v['ID'] : '';
                let billing_description = v['billing_description'] ? v['billing_description'] : '';
                let bill_to = v['bill_to'] ? v['bill_to'] : '';
                let payble = v['payble'] ? v['payble'] : '';
                let qty = v['qty'] ? parseFloat(v['qty']) : '';
                let unit_price = v['unit_price'] ? parseFloat(v['unit_price']) : '';
                let add_on = v['add_on'] ? parseFloat(v['add_on']) : '';
                let cb = v['cbfn'] == null ? '' : v['cbfn'] + ' ' + v['cbln'];
                let ccb = v['ccbfn'] == null ? '' : v['ccbfn'] + ' ' + v['ccbln'];
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                let remark = v['remark'] ? v['remark'] : '';

                let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                let last_update_datetime = v['last_update_datetime'] ? v['last_update_datetime'] : '';

                let vat = v['vat'] ? v['vat'] : '';
                let apb = v['apbfn'] == null ? '' : v['apbfn'] + ' ' + v['apbln']
                let lub = v['lubfn'] == null ? '' : v['lubfn'] + ' ' + v['lubln']
                let res_ar_amt = parseFloat((qty * unit_price) + add_on);
                let res_ar_inc = parseFloat(((res_ar_amt * vat) / 100) + res_ar_amt);
                let res_ar_amt_t = res_ar_amt.toFixed(2);
                let res_ar_inc_t = res_ar_inc.toFixed(2);
                let currency = v['currency'] ? v['currency'] : '';
                let bc_pay = payble == '1' ? '<span class="badge rounded-pill bg-success" >Paid</span>' : '<span class="badge rounded-pill bg-danger" >Unpiad</span>'



                html_data_ar = `
            <tr list_id = ${id_list} type_data = "AR">
                <td><input type="text" class="form-control form-control-sm inp_des inp_des_ar inp_des_ar${i} " value="${billing_description}"></td> <!-- Description -->
                <td><input type="text" class="form-control form-control-sm inp_billing_to inp_billing_to_ar inp_billing_to_ar${i}" value="${bill_to}"></td> <!-- Bill to -->
                <td align="center"><input type="checkbox" class="form-input-check inp_payble_checkbox inp_payble_checkbox${i}" onclick="function_sub_billing.check_box_status(this)"></td> <!-- Payble -->
                <td><select class="form-select form-select-sm inp_currency inp_currency_ar inp_currency${i}" onchange="function_sub_billing.cal_billing_data_vat(this)">
                        <option value="THB">THB</option>
                        <option value="USD">USD</option>
                        <option value="RMB">RMB</option>
                    </select></td> <!-- Currency -->
                <td><input type="number" class="form-control form-control-sm inp_qty inp_qty_ar inp_qty_ar${i}" onchange="function_sub_billing.cal_billing_data_vat(this)" value="${qty}"></td> <!-- QTY. -->
                <td><input type="number" class="form-control form-control-sm inp_unit_price inp_unit_price_ar inp_unit_price_ar${i}" onchange="function_sub_billing.cal_billing_data_vat(this)" value="${unit_price}"></td><!-- Unit Price -->
                <td><input type="number" class="form-control form-control-sm inp_add_on inp_add_on_ar inp_add_on_ar${i}" onchange="function_sub_billing.cal_billing_data_vat(this)" value="${add_on}"></td><!-- Add on profit -->
                <td><input type="number" class="form-control form-control-sm inp_amt inp_amt_ar inp_amt_ar${i}" value="${res_ar_amt_t}"></td><!-- AR AMT -->
                <td><input type="number" class="form-control form-control-sm inp_vat inp_vat_ar inp_vat_ar${i}" onchange="function_sub_billing.cal_billing_data_vat(this)" value="${vat}"></td><!-- AR VAT% -->
                <td><input type="number" class="form-control form-control-sm inp_amtincv inp_amtincv${i} inp_amtincv_ar" value="${res_ar_inc_t}"></td><!-- AMT(INCL.vat) -->
                <td><input type="text" class="form-control form-control-sm inp_remark" value="${remark}"></td><!-- remark -->
                <td align="center"><input type="checkbox" class="form-input-check inp_check_list_box inp_check_list_box${i}" onclick="function_sub_billing.check_box_status(this)"></td> <!-- CHECK -->
                <td>${bc_pay}</td><!-- PAID -->
                <td><button class="btn btn-success btn-sm m-1" onclick="function_sub_billing.save_list(this)">Save</button><button class="btn btn-danger btn-sm btn_delete_list${i}" onclick="function_sub_billing.delete_list(this)">Del</button></td><!-- ACTION -->
                <td>${cb}</td><!-- Create by. -->
                <td>${create_data_time}</td><!-- Create datetime -->
                <td>${ccb}</td><!-- Check by. -->
                <td>${check_date_time}</td><!-- Check datetime -->
                <td>${apb}</td><!-- Paid Check by. -->
                <td>${action_paid_date_time}</td><!-- Paid Check datetime -->
                <td>${lub}</td><!-- Last update by. -->
                <td>${last_update_datetime}</td><!-- Last update datetime -->
            </tr>
            `;

                $('.table_billing_ar > tbody').append(html_data_ar)
                $(`.inp_amt_ar${i}`).attr('disabled', true)
                $(`.inp_amtincv${i}`).attr('disabled', true)
                $(`.inp_currency${i}`).val(currency)

                if (payble == '1') {
                    $(`.inp_payble_checkbox${i}`).attr({ 'checked': true, 'disabled': true })
                    $(`.btn_delete_list${i}`).remove()

                }

                if (payble = '1' && check_date_time != '') {
                    $(`.inp_des_ar${i}`).attr('disabled', true)
                    $(`.inp_billing_to_ar${i}`).attr('disabled', true)
                    $(`.inp_currency${i}`).attr('disabled', true)
                    $(`.inp_qty_ar${i}`).attr('disabled', true)
                    $(`.inp_unit_price_ar${i}`).attr('disabled', true)
                    $(`.inp_des_ar${i}`).attr('disabled', true)
                    $(`.inp_add_on_ar${i}`).attr('disabled', true)
                    $(`.inp_vat_ar${i}`).attr('disabled', true)

                }

                if (check_date_time != '') {
                    $(`.inp_check_list_box${i}`).attr({ 'checked': true, 'disabled': true })
                }
            })
        }else{
            html_data_ar = `
            <tr type_data = "AR">
                <td><input type="text" class="form-control form-control-sm inp_des inp_des_ar"></td> <!-- Description -->
                <td><input type="text" class="form-control form-control-sm inp_billing_to inp_billing_to_ar"></td> <!-- Bill to -->
                <td align="center"><input type="checkbox" class="form-input-check inp_payble_checkbox" onclick="function_sub_billing.check_box_status(this)"></td> <!-- Payble -->
                <td><select class="form-select form-select-sm inp_currency inp_currency_ar" onchange="function_sub_billing.cal_billing_data_vat(this)">
                        <option value="THB">THB</option>
                        <option value="USD">USD</option>
                        <option value="RMB">RMB</option>
                    </select></td> <!-- Currency -->
                <td><input type="number" class="form-control form-control-sm inp_qty inp_qty_ar" onchange="function_sub_billing.cal_billing_data_vat(this)"></td> <!-- QTY. -->
                <td><input type="number" class="form-control form-control-sm inp_unit_price inp_unit_price_ar" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- Unit Price -->
                <td><input type="number" class="form-control form-control-sm inp_add_on inp_add_on_ar" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- Add on profit -->
                <td><input type="number" class="form-control form-control-sm inp_amt inp_amt_ar" disabled></td><!-- AR AMT -->
                <td><input type="number" class="form-control form-control-sm inp_vat inp_vat_ar" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- AR VAT% -->
                <td><input type="number" class="form-control form-control-sm inp_amtincv inp_amtincv_ar" disabled></td><!-- AMT(INCL.vat) -->
                <td><input type="text" class="form-control form-control-sm inp_remark"></td><!-- remark -->
                <td align="center"><input type="checkbox" class="form-input-check inp_check_list_box" onclick="function_sub_billing.check_box_status(this)"></td> <!-- CHECK -->
                <td><span class="badge rounded-pill bg-danger" >Unpiad</span></td><!-- PAID -->
                <td><button class="btn btn-success btn-sm m-1" onclick="function_sub_billing.save_list(this)">Save</button><button class="btn btn-danger btn-sm" onclick="function_sub_billing.delete_list(this)">Del</button></td><!-- ACTION -->
                <td></td><!-- Create by. -->
                <td></td><!-- Create datetime -->
                <td></td><!-- Check by. -->
                <td></td><!-- Check datetime -->
                <td></td><!-- Paid Check by. -->
                <td></td><!-- Paid Check datetime -->
                <td></td><!-- Last update by. -->
                <td></td><!-- Last update datetime -->
            </tr>
            `;
                $('.table_billing_ar > tbody').append(html_data_ar)
        }


        // currency
        let val_usd = 34.55;
        let val_th = 1;
        let val_rmb = 4.84;

        // sub total
        let amt_rmb = 0;
        let amt_usd = 0;
        let amt_thb = 0;
        $('.table_billing_ar > tbody > tr').each(function (e) {
            let type_cur = $('.inp_currency_ar', this).val();
            let amt_ar = parseFloat($('.inp_amt_ar', this).val())

            if (type_cur == "THB") {
                amt_thb = parseFloat(amt_thb) + parseFloat(amt_ar)
            } else if (type_cur == "USD") {
                amt_usd = parseFloat(amt_usd) + parseFloat(amt_ar)
            } else if (type_cur == "RMB") {
                amt_rmb = parseFloat(amt_rmb) + parseFloat(amt_ar)
            }
        })

        let cal_to_thb = parseFloat(amt_usd * val_usd) + parseFloat(amt_thb * val_th) + parseFloat(amt_rmb * val_rmb)
        let tof_all_amt_ar =  cal_to_thb.toFixed(2)
        $('.inp_sub_total_ar').val(tof_all_amt_ar).attr('disabled', true)



        let amtincv_rmb = 0;
        let amtincv_usd = 0;
        let amtincv_thb = 0;

        $('.table_billing_ar > tbody > tr').each(function (e) {
            let type_cur = $('.inp_currency_ar', this).val();
            let amt_incv_ar = parseFloat($('.inp_amtincv_ar', this).val())

            if (type_cur == "THB") {
                amtincv_thb = parseFloat(amtincv_thb) + parseFloat(amt_incv_ar)
            } else if (type_cur == "USD") {
                amtincv_usd = parseFloat(amtincv_usd) + parseFloat(amt_incv_ar)
            } else if (type_cur == "RMB") {
                amtincv_rmb = parseFloat(amtincv_rmb) + parseFloat(amt_incv_ar)
            }
        })
        let cal_to_thb_incv = parseFloat(amtincv_usd * val_usd) + parseFloat(amtincv_thb * val_th) + parseFloat(amtincv_rmb * val_rmb)

        let tof_all_amt_incv_ar = cal_to_thb_incv.toFixed(2)
        $('.inp_total').val(tof_all_amt_incv_ar).attr('disabled', true)


        let vat_all = tof_all_amt_incv_ar - tof_all_amt_ar;
        let tof_vat_all = vat_all.toFixed(2)
        $('.inp_vat_inc').val(tof_vat_all).attr('disabled', true)

    },

    ajax_setting_data_first_ar: async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_billing_ar.php",
                data: {
                    id_number: id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    first_post_data_ap: async function (id_number) {
        let res_data = await this.ajax_setting_data_first_ap(id_number)
        console.log(res_data)
        let html_data_ap = '';

        
        $('.table_billing_ap > tbody').html('')

        if (res_data['get_data_ap'] != "0 results") {
        $.each(res_data['get_data_ap'], function (i, v) {
            let billing_description = v['billing_description'] ? v['billing_description'] : '';
            let bill_to = v['bill_to'] ? v['bill_to'] : '';
            let payble = v['payble'] ? v['payble'] : '';
            let qty = v['qty'] ? parseFloat(v['qty']) : '';
            let unit_price = v['unit_price'] ? parseFloat(v['unit_price']) : '';
            let cb = v['cbfn'] == null ? '' : v['cbfn'] + ' ' + v['cbln'];
            let ccb = v['ccbfn'] == null ? '' : v['ccbfn'] + ' ' + v['ccbln'];
            let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
            let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
            let remark = v['remark'] ? v['remark'] : '';

            let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
            let last_update_datetime = v['last_update_datetime'] ? v['last_update_datetime'] : '';

            let vat = v['vat'] ? v['vat'] : '';
            let apb = v['apbfn'] == null ? '' : v['apbfn'] + ' ' + v['apbln']
            let lub = v['lubfn'] == null ? '' : v['lubfn'] + ' ' + v['lubln']
            let res_ap_amt = parseFloat((qty * unit_price));
            let res_ap_inc = parseFloat(((res_ap_amt * vat) / 100) + res_ap_amt);
            let res_ap_amt_t = res_ap_amt.toFixed(2);
            let res_ap_inc_t = res_ap_inc.toFixed(2);
            let currency = v['currency'] ? v['currency'] : '';
            let bc_pay = payble == '1' ? '<span class="badge rounded-pill bg-success" >Paid</span>' : '<span class="badge rounded-pill bg-danger" >Unpiad</span>'
            let id_list = v['ID'] ? v['ID'] : '';
            // check_date_time == '' ? '' : $('.inp_check_list_box').attr('checked',true);
            html_data_ap = `
            <tr list_id = ${id_list} type_data = "AP">
                <td><input type="text" class="form-control form-control-sm inp_des inp_des_ap inp_des_ap${i} " value="${billing_description}"></td> <!-- Description -->
                <td><input type="text" class="form-control form-control-sm inp_billing_to inp_billing_to_ap inp_billing_to_ap${i}" value="${bill_to}"></td> <!-- Bill to -->
                <td align="center"><input type="checkbox" class="form-input-check inp_payble_checkbox inp_payble_checkbox${i}" onclick="function_sub_billing.check_box_status(this)"></td> <!-- Payble -->
                <td><select class="form-select form-select-sm inp_currency inp_currency_ap inp_currency${i}" onchange="function_sub_billing.cal_billing_data_vat(this)">
                        <option value="THB">THB</option>
                        <option value="USD">USD</option>
                        <option value="RMB">RMB</option>
                    </select></td> <!-- Currency -->
                <td><input type="number" class="form-control form-control-sm inp_qty inp_qty_ap inp_qty_ap${i}" onchange="function_sub_billing.cal_billing_data_vat(this)" value="${qty}"></td> <!-- QTY. -->
                <td><input type="number" class="form-control form-control-sm inp_unit_price inp_unit_price_ap inp_unit_price_ap${i}" onchange="function_sub_billing.cal_billing_data_vat(this)" value="${unit_price}"></td><!-- Unit Price -->
                <td><input type="number" class="form-control form-control-sm inp_amt inp_amt_ap inp_amt_ap${i}" value="${res_ap_amt_t}"></td><!-- AP AMT -->
                <td><input type="number" class="form-control form-control-sm inp_vat inp_vat_ap inp_vat_ap${i}" onchange="function_sub_billing.cal_billing_data_vat(this)" value="${vat}"></td><!-- AP VAT% -->
                <td><input type="number" class="form-control form-control-sm inp_amtincv inp_amtincv_ap inp_amtincv${i}" value="${res_ap_inc_t}"></td><!-- AMT(INCL.vat) -->
                <td><input type="text" class="form-control form-control-sm inp_remark" value="${remark}"></td><!-- remark -->
                <td align="center"><input type="checkbox" class="form-input-check inp_check_list_box" onclick="function_sub_billing.check_box_status(this)"></td><!-- CHECK -->
                <td>${bc_pay}</td><!-- PAID -->
                <td><button class="btn btn-success btn-sm m-1" onclick="function_sub_billing.save_list(this)">Save</button><button class="btn btn-danger btn-sm btn_delete_list${i}" onclick="function_sub_billing.delete_list(this)">Del</button></td><!-- ACTION -->
                <td>${cb}</td><!-- Create by. -->
                <td>${create_data_time}</td><!-- Create datetime -->
                <td>${ccb}</td><!-- Check by. -->
                <td>${check_date_time}</td><!-- Check datetime -->
                <td>${apb}</td><!-- Paid Check by. -->
                <td>${action_paid_date_time}</td><!-- Paid Check datetime -->
                <td>${lub}</td><!-- Last update by. -->
                <td>${last_update_datetime}</td><!-- Last update datetime -->
            </tr>
            `;

            $('.table_billing_ap > tbody').append(html_data_ap)
            $(`.inp_amt_ap${i}`).attr('disabled', true)
            $(`.inp_amtincv${i}`).attr('disabled', true)
            $(`.inp_currency${i}`).val(currency)


            if (payble == '1') {
                $(`.inp_payble_checkbox${i}`).attr({ 'checked': true, 'disabled': true })
                $(`.btn_delete_list${i}`).remove()

            }

            if (payble = '1' && check_date_time != '') {
                $(`.inp_des_ap${i}`).attr('disabled', true)
                $(`.inp_billing_to_ap${i}`).attr('disabled', true)
                $(`.inp_currency${i}`).attr('disabled', true)
                $(`.inp_qty_ap${i}`).attr('disabled', true)
                $(`.inp_unit_price_ap${i}`).attr('disabled', true)
                $(`.inp_des_ap${i}`).attr('disabled', true)
                $(`.inp_add_on_ap${i}`).attr('disabled', true)
                $(`.inp_vat_ap${i}`).attr('disabled', true)

            }

            if (check_date_time != '') {
                $(`.inp_check_list_box${i}`).attr({ 'checked': true, 'disabled': true })
            }
        })
    }else{
        html_data_ap = `
            <tr type_data = "AP">
                <td><input type="text" class="form-control form-control-sm inp_des inp_des_ap"></td> <!-- Description -->
                <td><input type="text" class="form-control form-control-sm inp_billing_to inp_billing_to_ap"></td> <!-- Bill to -->
                <td align="center"><input type="checkbox" class="form-input-check inp_payble_checkbox" onclick="function_sub_billing.check_box_status(this)"></td> <!-- Payble -->
                <td><select class="form-select form-select-sm inp_currency inp_currency_ap" onchange="function_sub_billing.cal_billing_data_vat(this)">
                        <option value="THB">THB</option>
                        <option value="USD">USD</option>
                        <option value="RMB">RMB</option>
                    </select></td> <!-- Currency -->
                <td><input type="number" class="form-control form-control-sm inp_qty inp_qty_ap" onchange="function_sub_billing.cal_billing_data_vat(this)"></td> <!-- QTY. -->
                <td><input type="number" class="form-control form-control-sm inp_unit_price inp_unit_price_ap" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- Unit Price -->
                <td><input type="number" class="form-control form-control-sm inp_amt inp_amt_ap" disabled></td><!-- AP AMT -->
                <td><input type="number" class="form-control form-control-sm inp_vat inp_vat_ap" onchange="function_sub_billing.cal_billing_data_vat(this)"></td><!-- AP VAT% -->
                <td><input type="number" class="form-control form-control-sm inp_amtincv inp_amtincv_ap" disabled></td><!-- AMT(INCL.vat) -->
                <td><input type="text" class="form-control form-control-sm inp_remark"></td><!-- remark -->
                <td align="center"><input type="checkbox" class="form-input-check inp_check_list_box" onclick="function_sub_billing.check_box_status(this)"></td><!-- CHECK -->
                <td><span class="badge rounded-pill bg-danger" >Unpiad</span></td><!-- PAID -->
                <td><button class="btn btn-success btn-sm m-1" onclick="function_sub_billing.save_list(this)">Save</button><button class="btn btn-danger btn-sm " onclick="function_sub_billing.delete_list(this)">Del</button></td><!-- ACTION -->
                <td></td><!-- Create by. -->
                <td></td><!-- Create datetime -->
                <td></td><!-- Check by. -->
                <td></td><!-- Check datetime -->
                <td></td><!-- Paid Check by. -->
                <td></td><!-- Paid Check datetime -->
                <td></td><!-- Last update by. -->
                <td></td><!-- Last update datetime -->
            </tr>
            `;

            $('.table_billing_ap > tbody').append(html_data_ap)
    }
        // currency
        let val_usd = 34.55;
        let val_th = 1;
        let val_rmb = 4.84;

        // sub total
        let amt_rmb = 0;
        let amt_usd = 0;
        let amt_thb = 0;
        $('.table_billing_ap > tbody > tr').each(function (e) {
            let type_cur = $('.inp_currency_ap', this).val();
            let amt_ar = parseFloat($('.inp_amt_ap', this).val())

            if (type_cur == "THB") {
                amt_thb = parseFloat(amt_thb) + parseFloat(amt_ar)
            } else if (type_cur == "USD") {
                amt_usd = parseFloat(amt_usd) + parseFloat(amt_ar)
            } else if (type_cur == "RMB") {
                amt_rmb = parseFloat(amt_rmb) + parseFloat(amt_ar)
            }
        })

        let cal_to_thb = parseFloat(amt_usd * val_usd) + parseFloat(amt_thb * val_th) + parseFloat(amt_rmb * val_rmb)
        let tof_all_amt_ar = cal_to_thb.toFixed(2)
        $('.inp_sub_total_ap').val(tof_all_amt_ar).attr('disabled', true)



        let amtincv_rmb = 0;
        let amtincv_usd = 0;
        let amtincv_thb = 0;

        $('.table_billing_ap > tbody > tr').each(function (e) {
            let type_cur = $('.inp_currency_ap', this).val();
            let amt_incv_ar = parseFloat($('.inp_amtincv_ap', this).val())

            if (type_cur == "THB") {
                amtincv_thb = parseFloat(amtincv_thb) + parseFloat(amt_incv_ar)
            } else if (type_cur == "USD") {
                amtincv_usd = parseFloat(amtincv_usd) + parseFloat(amt_incv_ar)
            } else if (type_cur == "RMB") {
                amtincv_rmb = parseFloat(amtincv_rmb) + parseFloat(amt_incv_ar)
            }
        })
        let cal_to_thb_incv = parseFloat(amtincv_usd * val_usd) + parseFloat(amtincv_thb * val_th) + parseFloat(amtincv_rmb * val_rmb)

        let tof_all_amt_incv_ar = cal_to_thb_incv.toFixed(2)
        $('.inp_total_ap').val(tof_all_amt_incv_ar).attr('disabled', true)


        let vat_all = tof_all_amt_incv_ar - tof_all_amt_ar;
        let tof_vat_all = vat_all.toFixed(2)
        $('.inp_vat_inc_ap').val(tof_vat_all).attr('disabled', true)
    },

    ajax_setting_data_first_ap: async function (id_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/job_detail/get_data_billing_ap.php",
                data: {
                    id_number: id_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}