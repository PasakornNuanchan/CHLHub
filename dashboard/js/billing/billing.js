const billing = {
    job_number_global: '',
    check_get: async function () {
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                }
            }
            return false;
        };
        let get_job_number = getUrlParameter('job_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job_number == false ? null : get_job_number;
        let action = get_action == false ? null : get_action;

        console.log(action);
        billing.job_number_global = job_number;
        if (action == 'preview') {

            await billing.set_preview_data(job_number);
            await billing.ar_total_currency();
            await billing_ap.ap_total_currency();
        } else {
        }
    },
    set_data_description: async function () {
        let html_description = '';
        let set_data = await billing.ajax_set_description();
        console.log(set_data)
        $.each(set_data['bl_description'], function (i, v) {
            html_description += `
            <option value="${v['ID']}">${v['billing_item_name']}</option>
            `;
        });
        $('.sel_description_ar').append(html_description);


        let html_bill_to = '';
        $.each(set_data['bl_bill'], function (i, v) {
            html_bill_to += `
            <option bill_to_type="${v['bill_to_type']}" value="${v['ID']}">${v['bill_to_name']}</option>
            `;
        });

        $('.sel_bill_to_ar').append(html_bill_to);

    },

    set_preview_data: async function (job_number) {
        $('.head-of-menu').html('Billing');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Billing List</a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Billing (Job number ${job_number})</li>`;
        $('.bcpage').append(html_bdpage);
        await billing.set_data_description();
        await billing_ap.set_data_description_ap();
        await billing.get_sl_ar();
        await billing.set_preview_data_ar(job_number);
        await billing_ap.get_sl_ap();
        await billing_ap.set_preview_data_ap(job_number);
    },
    get_sl_ar : async function(){
        sl_des = $('.sel_description_ar').parent().html();
        sl_bill = $('.sel_bill_to_ar').parent().html();
        sl_cur = $('.sel_cur_description_ar').parent().html();
    },

    set_preview_data_ar: async function (job_number) {
        let html_des_ar = '';
        let res_data = await billing.ajax_set_preview_ar(job_number);
        console.log(res_data);
        $('[name = billing-ar-tbl] tbody').html('');
        if (res_data['ar'] != "0 results") {
            $.each(res_data['ar'], function (i, v) {
                let u_price = parseFloat(v['unit_price']);
                let ar_amt = parseFloat(v['amount']);
                let vat = parseFloat(v['vat']);
                let amtincvat = parseFloat(v['amtinclvat']);
                let id_val = v['ID'];
                //let payblecheck = parseInt(v['payble']);
                let payble_ar = '';
               

                if (v['payble'] == '0') {
                    payble_ar = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Unpaid</span>'
                } else {
                    payble_ar = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Paid</span>'
                }
               
                html_des_ar = `
            <tr class="text-center des_ar${i}">
                <td><div class="db_sel_des sel_des${i}">${sl_des}</div></td>
                <td><div class="db_sel_bill sel_bill${i}">${sl_bill}</div></td>
                <td>${payble_ar}</td>
                <td><div class="db_sel_cur sel_cur${i}">${sl_cur}</div></td>
                <td><input type="text" class="form-control inp_qty_ar action_qty_ar${i}" onchange="billing.change_amount_qty_ar(this);" value="${v['qty']}" style="text-align:right;" ></td>
                <td><input type="number" class="form-control inp_unit_price_ar action_up_ar${i}" onchange="billing.change_amount_unit_ar(this);" value="${u_price.toFixed(2)}" style="text-align:right;"></td>
                <td><input type="text" class="form-control inp_amt_ar" value="${number_format(ar_amt.toFixed(2))}" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control vat_change vat_cal inp_vat" value="${vat}%" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control inp_amt_icv_ar"  value="${number_format(amtincvat.toFixed(2))}" style="text-align:right;" readonly></td>
                <td><input type="text" class="form-control inp_remark" value="${v['remark']}"></td>
                <td><input type="checkbox" class="form-check-input check_status_ar${i}" onclick="billing_all.push_check(${v['ID']},'tr');" ></td>
                <td>
                    <button type="button" class="btn btn-success rounded-pill btn-xs action_payble_ar${i}" onclick ="billing.push_paid(${v['ID']})" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
                </td>
                <td>
                <button type="button" class="btn btn-primary rounded-pill btn-xs" onclick="billing.push_save_ar_row(this,${id_val});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> save</button>
                <button type="button" class="btn btn-danger rounded-pill btn-xs action_del_ar${i}"  onclick="billing.push_del_ar_row(${v['ID']});" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
                </td>
            </tr>
            `;
                $('[name = billing-ar-tbl] tbody').append(html_des_ar);

                
                if (v['payble'] == '0') {
                    $(`.sel_des${i} > select`).val(v['billing_number']);
                    $('.sel_bill' + i + ' > select option[bill_to_type="' + v['bill_to_type'] + '"][value="' + v['bill_to'] + '"]').prop('selected', true);
                    $(`.sel_cur${i} > select`).val(v['currency']);

                } else {
                    $(`.sel_des${i} > select`).val(v['billing_number']).attr('disabled', true);
                    $('.sel_bill' + i + ' > select option[bill_to_type="' + v['bill_to_type'] + '"][value="' + v['consingee_id'] + '"]').prop('disabled', true);
                    $(`.sel_cur${i} > select`).val(v['currency']).attr('disabled', true);
                    $(`.action_payble_ar${i}`).attr('disabled',true)
                    $(`.action_del_ar${i}`).attr('hidden',true)
                    $(`.action_qty_ar${i}`).attr('disabled',true)
                    $(`.action_up_ar${i}`).attr('disabled',true)
                }

                if (v['check_by'] != null) {
                    $(`.check_status_ar${i}`).prop('checked',true).attr('disabled',true)
                }
            });
        }
    },
    push_save_ar_row: async function (e, val_id) {
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
                await billing.save_ar_row(e, val_id)
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                billing.set_preview_data_ar(billing.job_number_global);
            }
        })
    },
    save_ar_row: async function (e, val_id) {

        

        let parse = $(e).closest('tr')
        let sel_des = $(parse).find('.sel_description_ar').val();
        let sel_bill_to = $(parse).find('.sel_bill_to_ar').val();
        let sel_bill_to_type = $(parse).find('.sel_bill_to_ar option:selected').attr('bill_to_type');
        let sel_cur_description = $(parse).find('.sel_cur_description_ar').val();
        let inp_qty_ar = $(parse).find('.inp_qty_ar').val();
        let inp_unit_price_ar = $(parse).find('.inp_unit_price_ar').val();
        let inp_amt_ar = $(parse).find('.inp_amt_ar').val();
        let inp_vat = $(parse).find('.inp_vat').val();
        let inp_amt_icv_ar = $(parse).find('.inp_amt_icv_ar').val();
        let inp_remark = $(parse).find('.inp_remark').val();
        arr_save_ar = []
        arr_save_ar_tmp = {}
        arr_save_ar_tmp = {
            val_id: val_id,
            sel_des: sel_des,
            job_number: billing.job_number_global,
            sel_bill_to_type : sel_bill_to_type,
            sel_bill_to: sel_bill_to,
            sel_cur_description: sel_cur_description,
            inp_qty_ar: inp_qty_ar,
            inp_unit_price_ar: inp_unit_price_ar,
            inp_amt_ar: inp_amt_ar,
            inp_vat: inp_vat,
            inp_amt_icv_ar: inp_amt_icv_ar,
            inp_remark: inp_remark
        }
        
        arr_save_ar.push(arr_save_ar_tmp)
        await billing.ajax_save_ar(arr_save_ar)
    },
    ajax_save_ar: async function (arr_save_ar) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/save_list_ar.php",
                data: { 'arr_save_ar': arr_save_ar },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    ajax_set_description: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_billing.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    ajax_set_preview_ar: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_data_ar.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    ajax_set_preview_ap: function (job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_data_ar.php",
                data: { 'job_number': job_number },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },
    addarhtml: function () {
        html = `
        <tr class="text-center">
            <td><div class="db-sel-des">${sl_des}</div></td>
            <td>${sl_bill}</td>
            <td><span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Unpaid</span></td>
            <td>${sl_cur}</td>
            <td><input type="text" class="form-control inp_qty_ar" onchange="billing.change_amount_qty_ar(this);" style="text-align:right;"></td>
            <td><input type="number" class="form-control inp_unit_price_ar" onchange="billing.change_amount_unit_ar(this);"  style="text-align:right;" ></td>
            <td><input type="text" class="form-control inp_amt_ar" style="text-align:right;" readonly></td>
            <td><input type="text" class="form-control vat_change vat_cal inp_vat" style="text-align:right;" readonly></td>
            <td><input type="text" class="form-control inp_amt_icv_ar"  style="text-align:right;" readonly></td>
            <td><input type="text" class="form-control inp_remark" ></td>
            <td><input type="checkbox" class="form-check-input" disabled></td>
            <td>
                <button type="button" class="btn btn-success rounded-pill btn-xs" onclick ="billing.push_paid()" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" hidden><i class="bi bi-cash-coin"></i> Paid</button>
            </td>
            <td>
            <button type="button" class="btn btn-primary rounded-pill btn-xs" onclick="billing.push_save_ar_row(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-check-square"></i> save</button>
            <button type="button" class="btn btn-danger rounded-pill btn-xs"  onclick="billing.push_del_ar_row(this,'create');" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
        </td>
        `;
        $('[name="billing-ar-tbl"]>tbody').append(html);
    },
    push_del_ar_row: async function (id_des, check) {
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
                if (check == "create") {
                    $(id_des).closest("tr").remove()
                } else {
                    await billing.ajax_push_del_action_ar(id_des)
                    Swal.fire(
                        'saved!',
                        'Your file has been saved.',
                        'success'
                    )
                    await billing.set_preview_data_ar(billing.job_number_global);
                }
            }
        })
    },
    ajax_push_del_action_ar: function (id_des) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/del_list.php",
                data: { 'id_des': id_des },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    set_vat_description_ar: async function (e) {
        let parent = $(e).closest('tr')
        let des_number = $(e).val()
        let vat_res = await billing.get_vat_description(des_number);
        let vat_cal = vat_res['vat']
        let ap_amt = $(e).closest('tr').find('.inp_unit_price_ar').val();
        let qty = $(e).closest('tr').find('.inp_qty_ar').val();
        let amt_total = parseFloat((qty * ap_amt));
        let amt_total_icv = parseFloat((qty * ap_amt) + ((qty * ap_amt) * vat_cal / 100))
        $('.vat_change', parent).val(vat_res['vat'] + "%");
        $('.inp_amt_ar', parent).val(number_format(amt_total.toFixed(2)));
        $('.inp_amt_icv_ar', parent).val(number_format(amt_total_icv.toFixed(2)));
        await billing.ar_total_currency()
    },
    change_amount_qty_ar: async function (e) {
        let parent = $(e).closest('tr')
        let ap_amt = $(e).closest('tr').find('.inp_unit_price_ar').val();
        let vat_cal = $(e).closest('tr').find('.vat_cal').val();
        let qty = $(e).val()
        vat_cal = parseFloat(vat_cal.replace("%", ''));
        let amt_total = parseFloat((qty * ap_amt));
        let amt_total_icv = parseFloat((qty * ap_amt) + ((qty * ap_amt) * vat_cal / 100))

        $('.inp_amt_ar', parent).val(number_format(amt_total.toFixed(2)));
        $('.inp_amt_icv_ar', parent).val(number_format(amt_total_icv.toFixed(2)));
        await billing.ar_total_currency()

    },
    change_amount_unit_ar: async function (e) {
        let parent = $(e).closest('tr')
        let qty = $(e).closest('tr').find('.inp_qty_ar').val();
        let vat_cal = $(e).closest('tr').find('.vat_cal').val();
        let ap_amt = $(e).val()
        vat_cal = parseFloat(vat_cal.replace("%", ''));
        let amt_total = parseFloat((qty * ap_amt));
        let amt_total_icv = parseFloat((qty * ap_amt) + ((qty * ap_amt) * vat_cal / 100))

        $('.inp_amt_ar', parent).val(number_format(amt_total.toFixed(2)));
        $('.inp_amt_icv_ar', parent).val(number_format(amt_total_icv.toFixed(2)));
        await billing.ar_total_currency()

    },
    get_vat_description: async function (des_number) {
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
    ar_total_currency: async function () {
        var inputs = $('.inp_amt_icv_ar');
        var currency = $('.sel_cur_description_ar');
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
        $('.inp_thb_total_ar').val(number_format(thb_cur))
        $('.inp_usd_total_ar').val(number_format(usd_cur))
        $('.inp_rmb_total_ar').val(number_format(rmb_cur))
        $('.inp_thb_total_cur_ar').val(number_format(total_val_thb.toFixed(2)))
        $('.inp_usd_total_cur_ar').val(number_format(total_val_usd.toFixed(2)))
        $('.inp_rmb_total_cur_ar').val(number_format(total_val_rmb.toFixed(2)))
    },
    push_paid: async function (action_id) {
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
                let res = await billing.ajax_push_paid_action(action_id);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'

                )
                billing.set_preview_data_ar(billing.job_number_global);
            }
        })
    },
    ajax_push_paid_action: function (action_id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/push_paid_action.php",
                data: { 'action_id': action_id },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
};

function number_format(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}