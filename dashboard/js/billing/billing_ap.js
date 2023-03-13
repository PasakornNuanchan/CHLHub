const billing_ap = {
    get_sl_ap : async function(){
        sl_des_ap = $('.sel_description_ap').parent().html();
        sl_bill_ap = $('.sel_bill_to_ap').parent().html();
        sl_cur_ap = $('.sel_cur_description_ap').parent().html();
    },

    set_preview_data_ap: async function (job_number) {
        let html_des_ar = '';
       
      
        let res_data = await billing_ap.ajax_set_preview_ap(billing.job_number_global);
        console.log(res_data);
        $('[name = billing-ap-tbl] tbody').html('');
        if (res_data['ap'] != "0 results") {
        $.each(res_data['ap'], function (i, v) {
            let u_price_ap = parseFloat(v['unit_price']);
            let ar_amt_ap = parseFloat(v['amount']);
            let vat_ap = parseFloat(v['vat']);
            let amtincvat_ap = parseFloat(v['amtinclvat']);
            let id_val_ap = v['ID'];
            //let payblecheck = parseInt(v['payble']);
            let payble_ap = '';

        
            if (v['payble'] == "0") {
                payble_ap = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Unpaid</span>'
            } else if(v['payble'] == "1"){
                payble_ap = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Paid</span>'
            }
            
          

            html_des_ap = `
            <tr class="text-center des_ar${i}">
                <td><div class="db_sel_des sel_des_ap${i}">${sl_des_ap}</div></td>
                <td><div class="db_sel_bill sel_bill_ap${i}" >${sl_bill_ap}</div></td>
                <td>${payble_ap}</td>
                <td><div class="db_sel_cur sel_cur_ap${i}">${sl_cur_ap} </div></td>
                <td><input type="text" class="form-control inp_qty_ap action_qty_ap${i}" onchange="billing_ap.change_amount_qty_ap(this);" value="${v['qty']}" style="text-align:right;"></td>
                <td><input type="number" class="form-control inp_unit_price_ap action_up_ap${i}" onchange="billing_ap.change_amount_unit_ap(this);" value="${u_price_ap.toFixed(2)}" style="text-align:right;"></td>
                <td><input type="text" class="form-control inp_amt_ap" value="${number_format(ar_amt_ap.toFixed(2))}" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control vat_change_ap vat_cal_ap inp_vat_ap" value="${vat_ap}%" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control inp_amt_icv_ap" value="${number_format(amtincvat_ap.toFixed(2))}" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control inp_remark_ap" value="${v['remark']}"></td>
                <td><input type="checkbox" class="form-check-input check_status_ap${i}" onclick="billing_all.push_check(${v['ID']},'tp');" ></td>
                <td>
                    <button type="button" class="btn btn-success rounded-pill btn-xs action_payble_ap${i}" onclick ="billing_ap.push_paid_ap(${v['ID']})" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
                </td>
                <td>
                <button type="button" class="btn btn-primary rounded-pill btn-xs" onclick="billing_ap.push_save_ap_row(this,${id_val_ap});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> save</button>
                <button type="button" class="btn btn-danger rounded-pill btn-xs action_del_ap${i}" onclick="billing_ap.push_del_ap_row(${v['ID']});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
                </td>
            </tr>
            `;
            $('[name = billing-ap-tbl] tbody').append(html_des_ap);

            

            if (v['payble'] == '0') {
                
                $(`.sel_des_ap${i} > select`).val(v['billing_number']);
                $(`.sel_bill_ap${i} > select`).val(v['consignee_number']);
                $(`.sel_cur_ap${i} > select`).val(v['currency']);
            } else if(v['payble'] == '1'){
                
                $(`.sel_des_ap${i} > select`).val(v['billing_number']).attr('disabled', true);
                $(`.sel_bill_ap${i} > select`).val(v['consignee_number']).attr('disabled', true);
                $(`.sel_cur_ap${i} > select`).val(v['currency']).attr('disabled', true);
                $(`.action_payble_ap${i}`).attr('disabled',true)
                $(`.action_del_ap${i}`).attr('hidden',true)
                $(`.action_qty_ap${i}`).attr('disabled',true)
                $(`.action_up_ap${i}`).attr('disabled',true)
                
                
            }

            if (v['check_by'] != null) {
                $(`.check_status_ap${i}`).prop('checked',true).attr('disabled',true)
            }
        });
    }

    
    },
    

    ajax_set_preview_ap: async function (job_number) {
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

    ap_total_currency: async function () {

        var inputs = $('.inp_amt_icv_ap');
        var currency = $('.sel_cur_description_ap');

        let thb_cur = 0;
        let usd_cur = 0;
        let rmb_cur = 0;

        for (var i = 0; i < inputs.length; i++) {
            let amount = $(inputs[i]).val().replace(",", '');
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

        $('.inp_thb_total_ap').val(number_format(thb_cur))
        $('.inp_usd_total_ap').val(number_format(usd_cur))
        $('.inp_rmb_total_ap').val(number_format(rmb_cur))

        $('.inp_thb_total_cur_ap').val(number_format(total_val_thb.toFixed(2)))
        $('.inp_usd_total_cur_ap').val(number_format(total_val_usd.toFixed(2)))
        $('.inp_rmb_total_cur_ap').val(number_format(total_val_rmb.toFixed(2)))

    },
    set_data_description_ap: async function () {
        let html_description = '';
        let set_data = await billing_ap.ajax_set_description_ap();
        $.each(set_data['bl_description'], function (i, v) {
            html_description += `
            <option value="${v['ID']}">${v['billing_item_name']}</option>
            `;
        });
        $('.sel_description_ap').append(html_description);


        let html_bill_to = '';
        $.each(set_data['bl_bill'], function (i, v) {
            html_bill_to += `
            <option bill_to_type="${v['bill_to_type']}" value="${v['ID']}">${v['bill_to_name']}</option>
            `;
        });

        $('.sel_bill_to_ap').append(html_bill_to);

    },
    ajax_set_description_ap: async function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_billing_ap.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    set_vat_description_ap: async function (e) {
        let parent = $(e).closest('tr')

        let des_number = $(e).val()
        
        let vat_res = await billing_ap.get_vat_description_ap(des_number);
        
        let vat_cal = vat_res['vat']
        let ap_amt = $(e).closest('tr').find('.inp_unit_price_ap').val();
        let qty = $(e).closest('tr').find('.inp_qty_ap').val();

        let amt_total = parseFloat((qty * ap_amt));
        let amt_total_icv = parseFloat((qty * ap_amt) + ((qty * ap_amt) * vat_cal / 100))


        $('.vat_change_ap', parent).val(vat_res['vat'] + "%");

        $('.inp_amt_ap', parent).val(number_format(amt_total.toFixed(2)));
        $('.inp_amt_icv_ap', parent).val(number_format(amt_total_icv.toFixed(2)));
        await billing_ap.ap_total_currency()
    },

    change_amount_qty_ap: async function (e) {
        let parent = $(e).closest('tr')
        let ap_amt = $(e).closest('tr').find('.inp_unit_price_ap').val();
        let vat_cal = $(e).closest('tr').find('.vat_cal_ap').val();
        let qty = $(e).val()
        vat_cal = parseFloat(vat_cal.replace("%", ''));
        let amt_total = parseFloat((qty * ap_amt));
        let amt_total_icv = parseFloat((qty * ap_amt) + ((qty * ap_amt) * vat_cal / 100))

        $('.inp_amt_ap', parent).val(number_format(amt_total.toFixed(2)));
        $('.inp_amt_icv_ap', parent).val(number_format(amt_total_icv.toFixed(2)));
        await billing_ap.ap_total_currency()

    },

    change_amount_unit_ap: async function (e) {
        let parent = $(e).closest('tr')
        let qty = $(e).closest('tr').find('.inp_qty_ap').val();
        let vat_cal = $(e).closest('tr').find('.vat_cal_ap').val();
        let ap_amt = $(e).val()
        vat_cal = parseFloat(vat_cal.replace("%", ''));
        let amt_total = parseFloat((qty * ap_amt));
        let amt_total_icv = parseFloat((qty * ap_amt) + ((qty * ap_amt) * vat_cal / 100))
        $('.inp_amt_ap', parent).val(number_format(amt_total.toFixed(2)));
        $('.inp_amt_icv_ap', parent).val(number_format(amt_total_icv.toFixed(2)));
        await billing_ap.ap_total_currency()

    },
    get_vat_description_ap: async function (des_number) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_des_vat.php",
                data: { 'des_number': des_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    push_save_ap_row: async function (e, val_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await billing_ap.save_ap_row(e, val_id)
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                billing_ap.set_preview_data_ap(billing.job_number_global);
            }
        })
    },
    save_ap_row: async function (e, val_id) {
        let parse = $(e).closest('tr')
        let sel_des = $(parse).find('.sel_description_ap').val();
        let sel_bill_to = $(parse).find('.sel_bill_to_ap').val();
        let sel_bill_to_type = $(parse).find('.sel_bill_to_ap option:selected').attr('bill_to_type');
        let sel_cur_description = $(parse).find('.sel_cur_description_ap').val();
        let inp_qty_ar = $(parse).find('.inp_qty_ap').val();
        let inp_unit_price_ar = $(parse).find('.inp_unit_price_ap').val();
        let inp_amt_ar = $(parse).find('.inp_amt_ap').val();
        let inp_vat = $(parse).find('.inp_vat_ap').val();
        let inp_amt_icv_ar = $(parse).find('.inp_amt_icv_ap').val();
        let inp_remark = $(parse).find('.inp_remark_ap').val();
        arr_save_ap = []
        arr_save_ap_tmp = {}
        arr_save_ap_tmp = {
            val_id: val_id,
            sel_des: sel_des,
            job_number: billing.job_number_global,
            sel_bill_to: sel_bill_to,
            sel_bill_to_type: sel_bill_to_type,
            sel_cur_description: sel_cur_description,
            inp_qty_ar: inp_qty_ar,
            inp_unit_price_ar: inp_unit_price_ar,
            inp_amt_ar: inp_amt_ar,
            inp_vat: inp_vat,
            inp_amt_icv_ar: inp_amt_icv_ar,
            inp_remark: inp_remark
        }
        arr_save_ap.push(arr_save_ap_tmp)
        
        await billing_ap.ajax_save_ap(arr_save_ap)

    },
    ajax_save_ap: async function (arr_save_ap) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/save_list_ap.php",
                data: { 'arr_save_ap': arr_save_ap },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    addaphtml: function () {
        html = `
        <tr class="text-center">
            <td><div class="db-sel-des">${sl_des_ap}</div></td>
            <td>${sl_bill_ap}</td>
            <td><span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Unpaid</span></td>
            <td>${sl_cur_ap}</td>
            <td><input type="text" class="form-control inp_qty_ap" onchange="billing_ap.change_amount_qty_ap(this);" style="text-align:right;"></td>
            <td><input type="number" class="form-control inp_unit_price_ap" onchange="billing_ap.change_amount_unit_ap(this);"  style="text-align:right;" ></td>
            <td><input type="text" class="form-control inp_amt_ap" style="text-align:right;" readonly></td>
            <td><input type="text" class="form-control vat_change_ap vat_cal vat_cal_ap inp_vat_ap" style="text-align:right;" readonly></td>
            <td><input type="text" class="form-control inp_amt_icv_ap"  style="text-align:right;" readonly></td>
            <td><input type="text" class="form-control inp_remark_ap" ></td>
            <td><input type="checkbox" class="form-check-input" disabled></td>
            <td>
                <button type="button" class="btn btn-success rounded-pill btn-xs" onclick ="billing_ap.push_paid_ap()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" hidden><i class="bi bi-cash-coin"></i> Paid</button>
            </td>
            <td>
            <button type="button" class="btn btn-primary rounded-pill btn-xs" onclick="billing_ap.push_save_ap_row(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> save</button>
            <button type="button" class="btn btn-danger rounded-pill btn-xs"  onclick="billing_ap.push_del_ap_row(this,'create');" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
        </td>
        `;
        $('[name="billing-ap-tbl"]>tbody').append(html);
        
    },
    push_del_ap_row : async function (id_des,check) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                if(check == "create"){
                    $(id_des).closest("tr").remove()
                }else{
                await billing_ap.ajax_push_del_action_ap(id_des)
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                await billing_ap.set_preview_data_ap(billing.job_number_global);
                }
            }
        })
    },
    ajax_push_del_action_ap : function (id_des) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/del_list.php",
                data: {'id_des' : id_des},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    
    push_paid_ap: async function (action_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                let res = await billing_ap.ajax_push_paid_ap_action(action_id);  
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'

                )
                billing_ap.set_preview_data_ap(billing.job_number_global);
            }
        })
    },
    ajax_push_paid_ap_action : function (action_id) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/push_paid_action.php",
                data: {'action_id' : action_id},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}