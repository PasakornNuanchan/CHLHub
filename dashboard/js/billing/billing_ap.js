const billing_ap = {
    set_preview_data_ap : async function (job_number){
        let html_des_ar = '';
        sl_des_ap = $('.sel_description_ap').parent().html();
        sl_bill_ap = $('.sel_bill_to_ap').parent().html();
        sl_cur_ap = $('.sel_cur_description_ap').parent().html();
        
        let res_data = await billing_ap.ajax_set_preview_ap(job_number);
        console.log(res_data);
        $('[name = billing-ap-tbl] tbody').html('');
    
        $.each(res_data['ap'], function (i, v) {
            let u_price_ap = parseFloat(v['unit_price']);
            let ar_amt_ap = parseFloat(v['amount']);
            let vat_ap = parseFloat(v['vat']);
            let amtincvat_ap = parseFloat(v['amtinclvat']);
            let id_val_ap = v['ID'];
            //let payblecheck = parseInt(v['payble']);
            let payble_ap = '';
            let action_payble_ap = '';
            let action_del_ap = '';

            if (v['payble'] == '0') {
                payble_ap = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Unpaid</span>'
                action_payble_ap = '';
                action_del_ap = '';
                action_readonly_ap = '';
            } else {
                payble_ap = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Paid</span>'
                action_payble_ap = 'disabled';
                action_del_ap = 'hidden';
                action_readonly_ap = 'readonly';
            }

            if (v['check_by'] == null) {
                check_status_ap = 'unchecked';
            } else {
                check_status_ap = 'checked disabled';
            }

            html_des_ap = `
            <tr class="text-center des_ar${i}">
                <td><div class="db_sel_des sel_des${i}">${sl_des}</div></td>
                <td><div class="db_sel_bill sel_bill${i}">${sl_bill}</div></td>
                <td>${payble_ap}</td>
                <td><div class="db_sel_cur sel_cur${i}">${sl_cur}</div></td>
                <td><input type="text" class="form-control inp_qty_ap" onchange="billing.change_amount_qty_ar(this);" value="${v['qty']}" style="text-align:right;" ${action_readonly_ap}></td>
                <td><input type="number" class="form-control inp_unit_price_ap" onchange="billing.change_amount_unit_ar(this);" value="${u_price_ap.toFixed(2)}" style="text-align:right;" ${action_readonly_ap}></td>
                <td><input type="text" class="form-control inp_amt_ap" value="${number_format(ar_amt_ap.toFixed(2))}" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control vat_change_ap vat_cal_ap inp_vat_ap" value="${vat_ap}%" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control inp_amt_icv_ap" value="${number_format(amtincvat_ap.toFixed(2))}" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control inp_remark_ap" value="${v['remark']}"></td>
                <td><input type="checkbox" class="form-check-input" onclick="billing.push_check(${v['ID']});" ${check_status_ap}></td>
                <td>
                    <button type="button" class="btn btn-success rounded-pill btn-xs" ${action_payble_ap} onclick ="billing.push_paid(${v['ID']})" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
                </td>
                <td>
                <button type="button" class="btn btn-primary rounded-pill btn-xs" onclick="billing.push_save_ar_row(this,${id_val_ap});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> save</button>
                <button type="button" class="btn btn-danger rounded-pill btn-xs" ${action_del_ap} onclick="billing.push_del_ar_row(${v['ID']});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
                </td>
            </tr>
            `;
            $('[name = billing-ap-tbl] tbody').append(html_des_ap);

            if (v['payble'] == '0') {
                console.log(1)
                $(`.sel_des${i} > select`).val(v['billing_number']);
                $(`.sel_bill${i} > select`).val(v['consignee_number']);
                $(`.sel_cur${i} > select`).val(v['currency']);

            } else {
                console.log(2)
                $(`.sel_des${i} > select`).val(v['billing_number']).attr('disabled',true);
                $(`.sel_bill${i} > select`).val(v['consignee_number']).attr('disabled',true);
                $(`.sel_cur${i} > select`).val(v['currency']).attr('disabled',true);
            }
            
        });
       
    },

    ajax_set_preview_ap : async function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_data_ap.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    ap_total_currency : async function(){
        
        var inputs = $('.inp_amt_icv_ap');
        
        var currency = $('.sel_cur_description');
        let thb_cur = 0;
        let usd_cur = 0;
        let rmb_cur = 0;

        for (var i = 0; i < inputs.length; i++) {
            let amount =  $(inputs[i]).val().replace(",",'');
            let currencyz = $(currency[i]).val();
            
            if (currencyz == "THB") {
                thb_cur = parseFloat(thb_cur) + parseFloat(amount)
            } else if (currencyz == "USD") {
                usd_cur = parseFloat(usd_cur) + parseFloat(amount)
            } else if (currencyz == "RMB") {
                rmb_cur = parseFloat(rmb_cur) + parseFloat(amount)
            }
        }
        
        now_usd = 1;
        now_thb = 34.42;
        now_rmb = 6.86;

        total_val_usd = usd_cur + thb_cur / now_thb + rmb_cur / now_rmb
        total_val_thb = thb_cur + usd_cur * now_thb + (rmb_cur / now_rmb) * now_thb
        total_val_rmb = rmb_cur + usd_cur * now_rmb + (thb_cur / now_thb) * now_rmb

        $('.inp_thb_total').val(number_format(thb_cur))
        $('.inp_usd_total').val(number_format(usd_cur))
        $('.inp_rmb_total').val(number_format(rmb_cur))

        $('.inp_thb_total_cur').val(number_format(total_val_thb.toFixed(2)))
        $('.inp_usd_total_cur').val(number_format(total_val_usd.toFixed(2)))
        $('.inp_rmb_total_cur').val(number_format(total_val_rmb.toFixed(2)))

    },
}