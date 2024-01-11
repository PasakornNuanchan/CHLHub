const start_apply = {
    data_start_apply : async function(e){
        res_data = e
        $('.table thead').html('');
        
        let html_head = `
        <tr class="text-center">
            <th>Apply</th>
            <th>Check</th>
            <th>No</th>
            <th>Job Number</th>
            <th>Bill to</th>
            <th>Description</th>
            <th>Cur.</th>
            <th>Qty</th>
            <th>unit price</th>
            <th>Vat%</th>
            <th>W/H</th>
            <th>Total</th>
            <th>Create By</th>
            <th>Create Datetime</th>
            <th>Check by</th>
            <th>Check Datetime</th>
            <th>Apply By</th>
            <th>Apply Datetime</th>
            
        </tr>
        `;

        $('.table thead').html(html_head)

        $('.table tbody').html('')
        if (res_data['table'] != "0 results") {
            $.each(res_data['table'], function (i, v) {
                i++;
                let id_number = v['ID'] ? v['ID'] : '';
                let billing_description = v['billing_description'] ? v['billing_description'] : '';
                let billing_des_id = v['billing_des_id'] ? v['billing_des_id'] : '';
                let job_number = v['job_number'] ? v['job_number'] : '';
                let bill_to_type = v['bill_to_type'] ? v['bill_to_type'] : '';
                let bill_to = v['bill_to'] ? v['bill_to'] : '';
                let payble = v['payble'] ? v['payble'] : '';

                let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let qty = v['qty'] ? v['qty'] : '';
                let unit_price = v['unit_price'] ? v['unit_price'] : '';
                let amount = v['amount'] ? v['amount'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                let amtinclvat = v['amtinclvat'] ? v['amtinclvat'] : '';
                let remark = v['remark'] ? v['remark'] : '';
                let type = v['type'] ? v['type'] : '';
                let create_by = v['create_by'] ? v['create_by'] : '';
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                let check_by = v['check_by'] ? v['check_by'] : '';
                let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                let action_paid_by = v['action_paid_by'] ? v['action_paid_by'] : '';
                let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                let approve_by = v['approve_by'] ? v['approve_by'] : '';
                let approve_date_time = v['approve_date_time'] ? v['approve_date_time'] : '';
                let delete_date_time = v['delete_date_time'] ? v['delete_date_time'] : '';
                let delete_by = v['delete_by'] ? v['delete_by'] : '';
                let status_data = v['status'] ? v['status'] : '';
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
                let pre_approve_by = v['pre_approve_by'] ? v['pre_approve_by'] : '';
                let pre_approve_dt = v['pre_approve_dt'] ? v['pre_approve_dt'] : '';
                let pre_approve_statu = v['pre_approve_statu'] ? v['pre_approve_statu'] : '';

                let create_by_f = v['create_by_f'] ? v['create_by_f'] : '';
                let create_by_l = v['create_by_l'] ? v['create_by_l'] : '';
                let check_by_f = v['check_by_f'] ? v['check_by_f'] : '';
                let check_by_l = v['check_by_l'] ? v['check_by_l'] : '';
                let action_paid_by_f = v['action_paid_by_f'] ? v['action_paid_by_f'] : '';
                let action_paid_by_l = v['action_paid_by_l'] ? v['action_paid_by_l'] : '';

                amtinclvat = parseFloat(amtinclvat)
                amtinclvat = amtinclvat.toFixed(2)
                let data_html = ``;

                data_html = `
                <tr id_number="${id_number}" class="table_number_${i}">
                    <td class="text-center"><input type="checkbox" class="data_check_apply" onchange="start.cal_currency()" style="zoom:200%"></td>
                    <td class="text-center"><input type="checkbox" class="data_check" style="zoom:200%"></td>
                    <td class="text-center">${i}</td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_job_number" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_bill_to" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_description" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-center inp_cur" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-end inp_qty" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-end inp_unit_price" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-center inp_vat" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-center inp_wh" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-end inp_total" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_create_by" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_check_by" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_apply_by" disabled></td>
                    <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime" disabled></td>
                </tr>
                `;


                $(`.table > tbody`).append(data_html)
                
                if(check_by != ''){
                    $(`.table > tbody > .table_number_${i} > td > .data_check`).prop('checked',true)
                }

                if(action_paid_by != ''){
                    $(`.table > tbody > .table_number_${i} > td > .data_check_apply`).prop('checked',true)
                }

                $(`.table > tbody > .table_number_${i} > td > .inp_job_number`).val(job_number).attr('job_number_data', `${job_number}`)
                $(`.table > tbody > .table_number_${i} > td > .inp_bill_to`).val(bill_to_c).attr({ 'bill_to_type': `${bill_to_type}`, 'bill_to': `${bill_to}` })
                $(`.table > tbody > .table_number_${i} > td > .inp_description`).val(billing_description).attr({ 'billing_des_id': `${billing_des_id}` })
                $(`.table > tbody > .table_number_${i} > td > .inp_cur`).val(currency)
                $(`.table > tbody > .table_number_${i} > td > .inp_qty`).val(qty)
                $(`.table > tbody > .table_number_${i} > td > .inp_unit_price`).val(unit_price)
                $(`.table > tbody > .table_number_${i} > td > .inp_vat`).val(vat)
                $(`.table > tbody > .table_number_${i} > td > .inp_wh`).val(with_holding_tax)
                $(`.table > tbody > .table_number_${i} > td > .inp_total`).val(amtinclvat)
                $(`.table > tbody > .table_number_${i} > td > .inp_create_by`).val(create_by_f + " " + create_by_l)
                $(`.table > tbody > .table_number_${i} > td > .inp_create_datetime`).val(create_data_time)
                $(`.table > tbody > .table_number_${i} > td > .inp_check_by`).val(check_by_f + " " + check_by_l)
                $(`.table > tbody > .table_number_${i} > td > .inp_check_datetime`).val(check_date_time)
                $(`.table > tbody > .table_number_${i} > td > .inp_apply_by`).val(action_paid_by_f + " " + action_paid_by_l)
                $(`.table > tbody > .table_number_${i} > td > .inp_apply_datetime`).val(action_paid_date_time)
                if (check_by != '') {
                    $(`.table > tbody > .table_number_${i} > td > .data_check`).prop('checked', true)
                }
                $(`.table > tbody > .table_number_${i} > td > .data_check`).attr('disabled',true)
            })




        }
        await start.cal_currency();

    }
}