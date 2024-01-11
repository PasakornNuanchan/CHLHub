const sub_billing = {
    select_billing_des_ap: '',
    select_bill_to_ap: '',
    html_select_code_billing_ar: '',
    html_select_bill_to_ar: '',
    data_list_ap: '',
    data_list_ar: '',


    first_post_data_ap: async function (id_number) {
        let res_data = await this.ajax_setting_data_first_ap(id_number)
        console.log(res_data)
        let html_data_ap = '';


        this.data_list_ap = res_data;

        let data_sel_billing_ap = $('.sel_data_billing_ap').parent().html()
        let data_sel_bill_to = $('.inp_billing_to_ap').parent().html()

        this.select_billing_des_ap = data_sel_billing_ap
        this.select_bill_to_ap = data_sel_bill_to
        $('.table_billing_ap > tbody').html('')

        if (res_data['get_data_ap'] != "0 results") {
            $.each(res_data['get_data_ap'], async function (i, v) {


                let currentURL = window.location.href;
                let url = new URL(currentURL);
                let action_data = url.searchParams.get("action");


                let billing_description = v['billing_description'] ? v['billing_description'] : '';
                let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
                let bill_to = v['bill_to'] ? v['bill_to'] : '';
                let bill_to_type = v['bill_to_type'] ? v['bill_to_type'] : '';
                let payble = v['payble'] ? v['payble'] : '';
                let qty = v['qty'] ? parseFloat(v['qty']) : '';
                let unit_price = v['unit_price'] ? parseFloat(v['unit_price']) : '';
                let cb = v['cbfn'] == null ? '' : v['cbfn'] + ' ' + v['cbln'];
                let ccb = v['ccbfn'] == null ? '' : v['ccbfn'] + ' ' + v['ccbln'];
                let cbb = v['cbb'] == null ? '' : v['cbb'];
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                let remark = v['remark'] ? v['remark'] : '';

                let paid_date_time = v['paid_date_time'] ? v['paid_date_time'] : '';
                let status_data = v['status'] ? v['status'] : '';
                let approve_date_time = v['approve_date_time'] ? v['approve_date_time'] : '';
                let billing_date = create_data_time.substring(0, 10);
                let action_paid_by = v['action_paid_by'] ? v['action_paid_by'] : '';
                let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                let check_by = v['check_by'] ? v['check_by'] : '';
                let last_update_datetime = v['last_update_datetime'] ? v['last_update_datetime'] : '';
                let tax_with_hold_by = v['tax_with_hold_by'] ? v['tax_with_hold_by'] : '';
                let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '';
                let commit_sale = v['commit_sale'] ? v['commit_sale'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                let apb = v['apbfn'] == null ? '' : v['apbfn'] + ' ' + v['apbln']
                let lub = v['lubfn'] == null ? '' : v['lubfn'] + ' ' + v['lubln']
                let app = v['appfn'] == null ? '' : v['appfn'] + ' ' + v['appln']
                

                
                let res_ap_amt = parseFloat((qty * unit_price));
                let res_ap_inc = parseFloat(((res_ap_amt * vat) / 100) + res_ap_amt);
                let res_ap_amt_t = res_ap_amt.toFixed(2);
                let res_ap_inc_t = res_ap_inc.toFixed(2);
                let currency = v['currency'] ? v['currency'] : '';
                let bc_pay = payble == '1' ? '<span class="badge rounded-pill bg-success" >Paid</span>' : '<span class="badge rounded-pill bg-danger" >Unpiad</span>'
                let id_list = v['ID'] ? v['ID'] : '';
                let currency_bpl = v['currency_bpl'] ? v['currency_bpl'] : '';

                let lcurrency = currency.toLowerCase();
                let lcurrency_bpl = currency_bpl.toLowerCase();

                let amount_bpl = v['amount_bpl'] ? v['amount_bpl'] : '0';
                let currency_aaa = ''
                if(amount_bpl != ''){
                    currency_aaa = v[`${lcurrency_bpl + '_' + lcurrency}`] ? v[`${lcurrency_bpl + '_' + lcurrency}`] : '1';
                    currency_aaa = parseFloat(currency_aaa)   
                }
                let data_amount_bpl = parseFloat(amount_bpl)
                data_amount_bpl = data_amount_bpl.toFixed(2)
                // let usd_rmb = v['usd_rmb'] ? v['usd_rmb'] : '';
                // let usd_yen = v['usd_yen'] ? v['usd_yen'] : '';
                // let thb_usd = v['thb_usd'] ? v['thb_usd'] : '';
                // let thb_rmb = v['thb_rmb'] ? v['thb_rmb'] : '';
                // let thb_yen = v['thb_yen'] ? v['thb_yen'] : '';
                // let rmb_usd = v['rmb_usd'] ? v['rmb_usd'] : '';
                // let rmb_thb = v['rmb_thb'] ? v['rmb_thb'] : '';
                // let rmb_yen = v['rmb_yen'] ? v['rmb_yen'] : '';
                // let yen_usd = v['yen_usd'] ? v['yen_usd'] : '';
                // let yen_thb = v['yen_thb'] ? v['yen_thb'] : '';
                // let yen_rmb = v['yen_rmb'] ? v['yen_rmb'] : '';
                i++;



                html_data_ap = `
            <tr class="text-center data_ap${i} data_ap_list${id_list}" id_list="${id_list}" type="AP" >
                <td><button class="btn btn-danger btn-sm rounded btn_delete btn_delete_ap${id_list} btn_delete_list_billing" onclick="function_sub_billing.delete_list(this)"><i class="bi bi-trash"></i></button></td><!--  action -->
                <td><input type="checkbox" class="form-input-check inp_box_select_ap inp_box_select${i}" id_data_billing ="${id_list}" ></td>
                <td>${i}</td>
                <td>${data_sel_billing_ap}</td>
                <td><input type="text" class="form-control form-control-sm inp_des_ap" disabled></td> <!-- Description -->
                <td>${data_sel_bill_to}</td> <!-- Bill to -->
                <!-- <td><div class="inp_payble"></div></td> -->  <!-- Payble --> 
                <td><select class="form-select form-select-sm text-center inp_currency_ap"  onchange="function_sub_billing.change_currency(this)">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                    <option value="YEN">YEN</option>
                    <option value="HKD">HKD</option>
                </select></td> <!-- Currency -->
                <td><input type="number" class="form-control form-control-sm  text-center inp_qty inp_qty_ap${i}" value="${qty}" onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td> <!-- QTY. -->
                <td><input type="number" class="form-control form-control-sm  text-end inp_unit_price inp_unit_price_ap${i}" value="${unit_price}" onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td><!-- Unit Price -->
                <td><input type="text" class="form-control form-control-sm  text-end inp_ap_amt inp_ap_amt${i}" disabled></td><!-- AR AMT -->
                <td><input type="number" class="form-control form-control-sm  text-center inp_vat inp_vat_ap${i}" value="${vat}" onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td><!-- AR VAT% -->
                <td>
                <!-- <input type="checkbox" class="form-input-check chb_tax_hold chb_tax_hold${i}"> -->
                <select class="form-select form-select-sm chb_tax_hold chb_tax_hold${i} text-center" onchange="function_sub_billing.billing_ap_function_cal_row(this)">
                    <option value="0">0%</option>
                    <option value="1">1%</option>
                    <option value="3">3%</option>
                    <option value="5">5%</option>
                    <option value="7">7%</option>
                </select>
                </td><!-- tax invoice with hole -->
                <td><input type="text" class="form-control form-control-sm text-end inp_vat_exl inp_vat_exl${i}" readonly></td>
                <td><input type="text" class="form-control form-control-sm text-end inp_amt_inc_vat_ap inp_amt_inc_vat_ap${i}" disabled ></td><!-- AMT(INCL.vat) -->
                <td><input type="text" class="form-control form-control-sm text-end inp_paid_amt inp_paid_amt${i}" disabled></td><!-- paid amt -->
                <td><input type="text" class="form-control form-control-sm inp_remark_ap" value="${remark}"></td><!-- remark -->

                <td><input type="text" class="form-control form-control-sm text-center" value="${billing_date}" disabled></td><!-- Billing Date -->
                <td><input type="text" class="form-control form-control-sm text-end inp_sys_rate_ap" disabled value="${currency_aaa}" disabled onchange="function_sub_billing.sys_rate_ap(this)"></td><!-- Sys rate -->
                <!-- <td><select class="form-select form-select-sm inp_sys_rate_currency_ap"  onchange="function_sub_billing.change_currency(this)">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                    <option value="HKD">HKD</option>
                    </select></td> --><!-- sysrate currency -->
                <td><input type="checkbox" class="form-input-check chb_apply chb_apply${i}"></td><!-- apply -->
                <td><input type="text" class="form-control form-control-sm inp_apply_by" disabled></td>
                <td><input type="text" class="form-control form-control-sm inp_apply_datetime" disabled></td><!-- apply date -->
                <td><input type="checkbox" class="form-input-check chb_check chb_check${i}" id="chb_check"></td><!-- CHECK -->
                <td><div class="inp_status"></div></td><!-- status -->
                <td><input type="text" class="form-control form-control-sm text-end inp_commit" disabled value="${commit_sale}"></td><!-- commision sale -->
                <td><input type="text" class="form-control form-control-sm text-center" value="${cbb}" disabled></td><!-- branch -->
                <td><input type="text" class="form-control form-control-sm" value="${cb}" disabled></td><!-- creater -->
                <td><input type="text" class="form-control form-control-sm inp_create_date_ap" value="${create_data_time}" disabled></td><!-- creater date -->
                <td><input type="text" class="form-control form-control-sm" value="${lub}" disabled></td><!-- last modifier -->
                <td><input type="text" class="form-control form-control-sm" value="${last_update_datetime}" disabled></td><!-- last modifier date -->
                <td><input type="text" class="form-control form-control-sm" value="${ccb}" disabled></td><!-- checker  -->
                <td><input type="text" class="form-control form-control-sm" value="${check_date_time}" disabled></td><!-- checker date -->
                <td><input type="text" class="form-control form-control-sm" value="${app}" disabled></td><!-- approve by  -->
                <td><input type="text" class="form-control form-control-sm" value="${approve_date_time}" disabled></td><!-- approve date -->
            </tr>
            `;

                $('.table_billing_ap > tbody').append(html_data_ap)



                let ap_amt = 0;
                let amt_inc_vat = 0;
                let data_qty = parseFloat($(`.inp_qty_ap${i}`).val())
                let data_unit_price = parseFloat($(`.inp_unit_price_ap${i}`).val())
                let vat_cal = parseFloat($(`.inp_vat_ap${i}`).val())

                $(`.data_ap${i} > td > .sel_data_billing_ap`).val(billing_description)

                $(`.data_ap${i} > td > .inp_billing_to_ap option[type="${bill_to_type}"][value="${bill_to}"]`).prop('selected', true);
                let data_requeset = '';
                $.each(setting_data_default.data_billing_des, function (i, v) {
                    if (billing_description == v['ID']) {
                        data_requeset = v['billing_item_name'];
                    }
                })
                $(`.data_ap${i} > td > .inp_des_ap`).val(data_requeset)


                if(action_data == "preview"){
                    $(`.data_ap${i} > td > .inp_apply_by`).val(apb)
                    $(`.data_ap${i} > td > .inp_apply_datetime`).val(action_paid_date_time)
                }
                
                // if(action_paid_by != ''){
                //     //$(`.chb_apply${i}`).attr({'checked':true,'disabled':true,"ischedkedon":'1'})
                //     $(`.data_ap${i} > td > .inp_payble`).html('Paid')
                //     $(`.data_ap${i} > td > .inp_status`).html('<span class="badge rounded-pill bg-success">Paid</span>')
                // }else{
                //     $(`.data_ap${i} > td > .inp_payble`).html('Prepaid')
                //     $(`.data_ap${i} > td > .inp_status`).html('<span class="badge rounded-pill bg-warning">Prepaid</span>')
                // }


               

                if (status_data == '0' || status_data == '1') {
                    $(`.data_ap${i} > td > .inp_status`).html('<span class="badge rounded-pill bg-warning">Waiting</span>')
                } else if (status_data == '2') {
                    $(`.data_ap${i} > td > .inp_status`).html('<span class="badge rounded-pill bg-success">Approve</span>')
                } else if (status_data == '3') {
                    $(`.data_ap${i} > td > .inp_status`).html('<span class="badge rounded-pill bg-danger">reject</span>')
                }

                if (action_paid_by != '') {
                    if(action_data == "preview"){
                        $(`.chb_apply${i}`).attr({ 'checked': true, 'disabled': true, "ischeckdone": '1' })
                    }else{
                        
                    }
                }

                if (check_by != '') {
                    $(`.chb_check${i}`).attr({ 'checked': true, 'disabled': true, "ischeckdone": '1' })
                }else{
                    $(`.chb_check${i}`).remove()
                }

                $(`.data_ap${i} > td > .inp_currency_ap`).val(currency)

                let vat_ex = 0;
                let whdt = 0;
                let vat_inc = 0;
                let vat_real = 0;
                // with_holding_tax

                ap_amt = qty * unit_price;

                if (with_holding_tax == 0) {
                    vat_ex = ap_amt * (vat / 100)
                    amt_inc_vat = vat_ex + ap_amt
                } else {
                    whdt = ap_amt * (with_holding_tax / 100)
                    vat_inc = ap_amt * (vat / 100)
                    vat_ex = vat_inc - whdt
                    vat_real = ap_amt * (vat / 100)
                    amt_inc_vat = ap_amt + vat_real - whdt
                }
                ap_amt = ap_amt.toFixed(2)
                amt_inc_vat = amt_inc_vat.toFixed(2)
                vat_ex = vat_ex.toFixed(2)
                $(`.inp_ap_amt${i}`).val(ap_amt)
                $(`.inp_vat_exl${i}`).val(vat_ex)
                $(`.data_ap${i} > td >.chb_tax_hold${i}`).val(with_holding_tax)
                $(`.inp_amt_inc_vat_ap${i}`).val(amt_inc_vat)

                if (paid_date_time == '') {
                    $(`.data_ap${i} > td > .inp_payble`).html('Prepaid')
                    $(`.data_ap${i} > td > .inp_paid_amt`).val(0)
                } else {
                    //$(`.chb_apply${i}`).attr({'checked':true,'disabled':true,"ischedkedon":'1'})
                    $(`.data_ap${i} > td > .inp_paid_amt`).val(amt_inc_vat).attr({ "style": "color:red; text-weight:bold" })
                    $(`.data_ap${i} > td > .inp_payble`).html('Paid')
                    $(`.data_ap${i} > td > .form-control`).attr('disabled', true)
                    $(`.data_ap${i} > td > .form-select`).attr('disabled', true)
                    $(`.data_ap${i} > td > .btn_delete`).remove()
                }

                
                if (action_paid_by != '') {
                    $(`.data_ap_list${id_list} > td > .form-control`).attr('disabled', true)
                    $(`.data_ap_list${id_list} > td > .form-select`).attr('disabled', true)

                    
                    if(action_data == "preview"){
                        $(`.btn_delete_ap${id_list}`).remove()
                    }
                }

               
               
                if(data_amount_bpl != 0){
                    $(`.data_ap${i} > td > .inp_paid_amt`).val(data_amount_bpl).attr({ "style": "color:red; text-weight:bold" })
                }
            })
        } else {
            html_data_ap = `
        <tr list_id = "" type = "AP">
            <td><button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button></td><!--  action -->
            <td></td>
            <td>1</td>
            <td>${sub_billing.select_billing_des_ap}</td>
            <td><input type="text" class="form-control form-control-sm inp_des_ap" disabled></td> <!-- Description -->
            <td>${sub_billing.select_bill_to_ap}</td> <!-- Bill to -->
            <td><select class="form-select form-select-sm inp_currency_ap" onchange="function_sub_billing.change_currency(this)">
                <option value="THB">THB</option>
                <option value="USD">USD</option>
                <option value="RMB">RMB</option>
                <option value="JP">JP</option>
            </select></td> <!-- Currency -->
            <td><input type="number" class="form-control form-control-sm text-center inp_qty " onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td> <!-- QTY. -->
            <td><input type="number" class="form-control form-control-sm text-end inp_unit_price "  onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td><!-- Unit Price -->
            <td><input type="text" class="form-control form-control-sm text-end inp_ap_amt " disabled></td><!-- AR AMT -->
            <td><input type="number" class="form-control form-control-sm text-center inp_vat "  onchange="function_sub_billing.billing_ap_function_cal_row(this)"></td><!-- AR VAT% -->
            <td class="text-center"><!--<input type="checkbox" class="form-input-check chb_tax_hold ">-->
            <select class="form-select form-select-sm chb_tax_hold text-center" onchange="function_sub_billing.billing_ap_function_cal_row(this)">
                    <option value="0">0%</option>
                    <option value="1">1%</option>
                    <option value="3">3%</option>
                    <option value="5">5%</option>
                    <option value="7">7%</option>
                </select>
            </td><!-- tax invoice with hole -->
            <td><input type="text" class="form-control form-control-sm text-end inp_vat_exl" readonly></td>

            <td><input type="text" class="form-control form-control-sm text-end inp_amt_inc_vat_ap " disabled ></td><!-- AMT(INCL.vat) -->
            <td><input type="text" class="form-control form-control-sm text-end inp_paid_amt " disabled></td><!-- paid amt -->
            <td><input type="text" class="form-control form-control-sm inp_remark_ap"></td><!-- remark -->
            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- Billing Date -->
            <td><input type="text" class="form-control form-control-sm text-end inp_sys_rate_ap"  disabled onchange="function_sub_billing.sys_rate_ap(this)"></td><!-- Sys rate -->
            <!-- <td><select class="form-select form-select-sm inp_sys_rate_currency_ar" onchange="function_sub_billing.change_currency(this)">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                    <option value="YEN">YEN</option>
                    </select></td>--><!-- sysrate currency -->
            <td><input type="checkbox" class="form-input-check chb_apply "></td><!-- apply -->
            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- apply date -->
            <td class="text-center"><input type="checkbox" class="form-input-check chb_check "></td><!-- CHECK -->
            <td></td><!-- status -->
            <td><input type="text" class="form-control form-control-sm inp_commit"></td><!-- commision sale -->
            <td><input type="text" class="form-control form-control-sm text-center"  disabled></td><!-- branch -->
            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- creater -->
            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- creater date -->
            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- last modifier -->
            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- last modifier date -->
            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- checker  -->
            <td><input type="text" class="form-control form-control-sm" disabled></td><!-- checker date -->
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


        // function_cal_result
        await function_sub_billing.cal_result_ap()








    },

    first_post_data_ar: async function (id_number) {

        let res_data = await this.ajax_setting_data_first_ar(id_number)

        this.data_list_ar = res_data
        console.log(res_data)
        let html_data_ar = '';
        let data_select_code_billing_ar = $('.select_code_billing_ar').parent().html()


        let data_select_bill_to_ar = $('.select_bill_to_ar').parent().html()

        this.html_select_code_billing_ar = data_select_code_billing_ar;
        this.html_select_bill_to_ar = data_select_bill_to_ar;
        $('.table_billing_ar > tbody').html('')
        if (res_data['get_data_ar'] != "0 results") {

            $.each(res_data['get_data_ar'], function (i, v) {
                let id_list = v['ID'] ? v['ID'] : '';
                let billing_description = v['billing_description'] ? v['billing_description'] : '';
                let bill_to = v['bill_to'] ? v['bill_to'] : '';
                let bill_to_type = v['bill_to_type'] ? v['bill_to_type'] : '';
                let payble = v['payble'] ? v['payble'] : '';
                let qty = v['qty'] ? parseFloat(v['qty']) : '';
                let unit_price = v['unit_price'] ? parseFloat(v['unit_price']) : '';
                let add_on = v['add_on'] ? parseFloat(v['add_on']) : '';
                let cb = v['cbfn'] == null ? '' : v['cbfn'] + ' ' + v['cbln'];
                let ccb = v['ccbfn'] == null ? '' : v['ccbfn'] + ' ' + v['ccbln'];
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                
                let remark = v['remark'] ? v['remark'] : '';
                let status_data = v['status'] ? v['status'] : '';
                let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                let last_update_datetime = v['last_update_datetime'] ? v['last_update_datetime'] : '';
                let need_vat = v['need_vat'] ? v['need_vat'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                let apb = v['apbfn'] == null ? '' : v['apbfn'] + ' ' + v['apbln']
                let lub = v['lubfn'] == null ? '' : v['lubfn'] + ' ' + v['lubln']
                let res_ar_amt = parseFloat((qty * unit_price) + add_on);
                let res_ar_inc = parseFloat(((res_ar_amt * vat) / 100) + res_ar_amt);
                let res_ar_amt_t = res_ar_amt.toFixed(2);
                let res_ar_inc_t = res_ar_inc.toFixed(2);
                let currency = v['currency'] ? v['currency'] : '';
                let bc_pay = payble == '1' ? '<span class="badge rounded-pill bg-success" >Paid</span>' : '<span class="badge rounded-pill bg-danger" >Unpiad</span>'
                let billing_date = create_data_time.substring(0, 10);
                let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
                let brunch = v['brunch'] ? v['brunch'] : '';
                let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '';
                let actpb = v['action_paid_by'] ? v['action_paid_by'] : '';
                let amount_bpl = v['amount_bpl'] ? v['amount_bpl'] : '0';
                let currency_bpl = v['currency_bpl'] ? v['currency_bpl'] : '';
                let paid_date_time = v['paid_date_time'] ? v['paid_date_time'] : '';
                let check_by = v['check_by'] ? v['check_by'] : '';
                i++;

                // if(amount_bpl != 0){

                // }

                html_data_ar = `
            <tr id_list = "${id_list}" class="data_ar${i} data_ar_list${id_list}" type = "AR">
                <td class="text-center headcol">
                    <button class="btn btn-danger btn-sm btn_del_ar btn_delete_ar${id_list} btn_delete_list_billing" onclick="function_sub_billing.delete_list(this)"><i class="bi bi-trash"></i></button>
                </td><!-- ACTION -->
                <td class="text-center headcol"><input type="checkbox" class="form-input-check inp_box_select_ar inp_box_select${i}" id_data_billing ="${id_list}"></td>
                <td class="text-center headcol">${i}</td> <!-- No -->
                <td class="headcol">${data_select_code_billing_ar}</td>
                <td class="headcol"><input type="text" class="form-control form-control-sm inp_data_item inp_data_item${i}"></td> <!-- item -->
                <td class="long">${data_select_bill_to_ar}</td>
                <!-- <td align="center"><div class="inp_payble"></div>--></td> <!-- Payble -->
                <td class="long"><select class="form-select form-select-sm inp_currency_ar inp_currency_ar${i}" onchange="function_sub_billing.change_currency(this)">
                        <option value="THB">THB</option>
                        <option value="USD">USD</option>
                        <option value="RMB">RMB</option>
                        <option value="YEN">YEN</option>
                        <option value="HKD">HKD</option>
                    </select></td> <!-- Currency -->
                <td class="long"><input type="number" class="form-control form-control-sm inp_qty_ar inp_qty text-center" value="${qty}" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)"></td> <!-- QTY. -->
                <td class="long"><input type="number" class="form-control form-control-sm inp_unit_price text-end" value="${unit_price}" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)"></td><!-- Unit Price -->
                <td class="long"><input type="text" class="form-control form-control-sm inp_data_amt inp_ar_amt text-end" disabled></td><!-- AR AMT -->
                <td class="long"><input type="number" class="form-control form-control-sm inp_vat_ar inp_vat text-center" value="${vat}" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)"></td><!-- VAT% -->
                <td class="text-center long"><select class="form-select form-select-sm inp_wt_percentage" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)">
                    <option value="0">0%</option>
                    <option value="1">1%</option>
                    <option value="3">3%</option>
                    <option value="5">5%</option>
                    <option value="7">7%</option>
                </select></td><!-- with holding tax -->
                <td class="text-center long"><input class="form-control form-control-sm text-end inp_vat_exc " disabled></td>
                <td class="long"><input type="text" class="form-control form-control-sm inp_amt_inc_vat_ar text-end" disabled></td><!-- AMT(INCL.vat) -->
                <td class="text-center long"><input type="text" class="form-control form-control-sm text-end ch_revd_amt_ar ch_revd_amt_ar${i}" disabled></td><!-- rcvd amt -->
                <td class="long"><input type="text" class="form-control form-control-sm inp_remark" value="${remark}"></td>  <!-- remark -->

                <td class="long"><input type="text" class="form-control form-control-sm" value="${billing_date}" disabled></td><!-- Billing Date -->
                <td class="long"><input type="text" class="form-control form-control-sm text-end inp_sys_rate_ar" disabled value="${sys_rate}" onchange="function_sub_billing.sys_rate_ap(this)"></td><!-- sysrate -->
                <!--<td><select class="form-select form-select-sm inp_sys_rate_currency_arf" onchange="function_sub_billing.change_currency(this)">
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                    <option value="YEN">YEN</option>
                    </select></td>--><!-- sysrate currency -->
                <td class="text-center long"><input type="checkbox" class="form-input-check text-center ch_need_vat_ar ch_need_vat_ar${i}"></td><!-- need vat -->
                
                <td class="long text-center"><input type="checkbox" class="form-input-check ch_check_ar"></td>
                <td class="long text-center"><div class="inp_status"></div></td>
                <td class="long text-center"><input class="form-control form-control-sm text-center" value="${brunch}" disabled></td><!-- brunch -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled value="${cb}"></td><!-- create by, -->
                <td class="long"><input type="text" class="form-control form-control-sm inp_create_datetime_ar" disabled value="${create_data_time}"></td><!-- create datetime. -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled value="${lub}"></td><!-- lastmo by -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled value="${last_update_datetime}"></td><!-- lastmo date -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled value="${apb}"></td><!--  checker by -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled value="${action_paid_date_time}"></td><!-- checker date -->
                
            </tr>
            `;



                $('.table_billing_ar > tbody').append(html_data_ar)


                $(`.data_ar${i} > td > .select_code_billing_ar`).val(billing_description)
                $(`.data_ar${i} > td > .inp_wt_percentage`).val(with_holding_tax)
                let data_target = $(`.data_ar${i} > td > .select_code_billing_ar`).val()
                let data_find = '';
                $.each(setting_data_default.data_billing_des_ar, function (i, v) {
                    // console.log(v['ID'])
                    if (v['ID'] == data_target) {
                        data_find = v['billing_item_name'];
                    }
                })
                $(`.inp_data_item${i}`).val(data_find).attr('disabled', true)

                if (need_vat == '1') {
                    $(`.ch_need_vat_ar${i}`).prop('checked', true)
                }

                if (actpb != '') {
                    $(`.ch_revd_amt_ar${i}`).prop('checked', true).attr('disabled', true)
                }



                if (status_data == '1' || status_data == '0') {
                    $(`.data_ar${i} > td > .inp_status`).html('<span class="badge rounded-pill bg-warning">Waiting</span>')
                } else if (status_data == '2') {
                    $(`.data_ar${i} > td > .inp_status`).html('<span class="badge rounded-pill bg-success">Approve</span>')
                } else if (status_data == '3') {
                    $(`.data_ar${i} > td > .inp_status`).html('<span class="badge rounded-pill bg-danger">Reject</span>')
                }

                if (ccb != '') {
                    $(`.data_ar${i} > td > .ch_check_ar`).prop('checked', true).attr({ 'disabled': true, "ischeckdone": '1' })
                }else{
                    $(`.data_ar${i} > td > .ch_check_ar`).remove()
                }

                $(`.data_ar${i} > td > .select_bill_to_ar`).val()
                $(`.data_ar${i} > td > .select_bill_to_ar option[type="${bill_to_type}"][value="${bill_to}"]`).prop('selected', true);
                $(`.data_ar${i} > td > inp_currency_ar${i}`).val(currency)
                // with_holding_tax
                // let data_qty = parseFloat($(`.data_ar${i} > td > .inp_qty_ar`).val())
                // let data_unit_price = parseFloat($(`.data_ar${i} > td > .inp_unit_price`).val())
                // let data_vat = $(`.data_ar${i} > td > .inp_vat_ar`).val()
                let amt = qty * unit_price
                let data_tax_withhold = 0;
                let data_vat = 0;
                let data_vatexcl = 0;
                let data_amtincl = 0;
                if (with_holding_tax == 0) {
                    data_vat = amt * (vat / 100)
                    data_vatexcl = data_vat
                    data_amtincl = (amt + data_vat)
                } else {
                    data_tax_withhold = amt * (with_holding_tax / 100)
                    data_vat = amt * (vat / 100)
                    data_vatexcl = data_vat - data_tax_withhold
                    data_amtincl = (amt + data_vat) - data_tax_withhold
                }





                amt = amt.toFixed(2)
                data_vatexcl = data_vatexcl.toFixed(2)
                data_amtincl = data_amtincl.toFixed(2)
                $(`.data_ar${i} > td > .inp_ar_amt`).val(amt)
                $(`.data_ar${i} > td > .inp_vat_exc`).val(data_vatexcl)
                $(`.data_ar${i} > td > .inp_amt_inc_vat_ar`).val(data_amtincl)


                amount_bpl = parseFloat(amount_bpl)
                if (amount_bpl != 0) {
                    $(`.data_ar${i} > td > .ch_revd_amt_ar`).css("color", "red")
                }
                amount_bpl = amount_bpl != 0 ? data_amtincl : 0;
                amount_bpl = parseFloat(amount_bpl)
                amount_bpl = amount_bpl.toFixed(2)
                $(`.data_ar${i} > td > .ch_revd_amt_ar`).val(amount_bpl)



                if (paid_date_time != '') {
                    // $(`.data_ar${i} > td > .inp_paid_amt`).val(data_amtincl)
                    $(`.data_ar${i} > td > .inp_payble`).html('Paid')
                    $(`.data_ar${i} > td > .form-control`).attr('disabled', true)
                    $(`.data_ar${i} > td > .form-select`).attr('disabled', true)
                    $(`.data_ar${i} > td > .btn_delete`).remove()
                } else {
                    $(`.data_ar${i} > td > .inp_payble`).html('Prepaid')
                    // $(`.data_ar${i} > td > .inp_paid_amt`).val(data_amtincl).attr({"style":"color:red; text-weight:bold"})

                }


                if (check_by != '') {
                    $(`.data_ar_list${id_list} > td > .form-control`).attr('disabled', true)
                    $(`.data_ar_list${id_list} > td > .form-select`).attr('disabled', true)
                    $(`.btn_delete_ar${id_list}`).remove()
                }
                
                
            })
        } else {

            html_data_ar = `
            <tr list_id = "" type = "AR">
                <td class="text-center headcol">
                    <button class="btn btn-danger btn-sm btn_del_ar btn_delete_list_billing" onclick="function_sub_billing.delete_list(this)"><i class="bi bi-trash"></i></button>
                </td>
                <td class="text-center"></td> <!-- No -->
                <td class="text-center">1</td>
                <td>${sub_billing.html_select_code_billing_ar}</td>
                <td><input type="text" class="form-control form-control-sm inp_data_item" disabled></td> <!-- item -->
                <td>${sub_billing.html_select_bill_to_ar}</td>
                <!-- <td align="center"></td>--> <!-- Payble -->
                <td><select class="form-select form-select-sm inp_currency_ar "  onchange="function_sub_billing.change_currency(this)">
                        <option value="THB">THB</option>
                        <option value="USD">USD</option>
                        <option value="RMB">RMB</option>
                    </select></td> <!-- Currency -->
                <td><input type="number" class="form-control form-control-sm inp_qty_ar inp_qty text-center" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)" ></td> <!-- QTY. -->
                <td><input type="number" class="form-control form-control-sm inp_unit_price text-end" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)"></td><!-- Unit Price -->
                <td><input type="text" class="form-control form-control-sm inp_data_amt text-end inp_ar_amt" disabled></td><!-- AR AMT -->
                <td><input type="number" class="form-control form-control-sm inp_vat_ar inp_vat text-center" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)"></td><!-- VAT% -->
                <td class="text-center"><select class="form-select form-select-sm inp_wt_percentage" onchange="function_sub_billing.billing_ap_function_cal_row_ar(this)">
                                            <option value="0">0%</option>
                                            <option value="1">1%</option>
                                            <option value="3">3%</option>
                                            <option value="5">5%</option>
                                            <option value="7">7%</option>
                                        </select></td><!-- with holding tax -->
                <td class="text-center"><input class="form-control form-control-sm text-end inp_vat_exc"></td>
                <td><input type="text" class="form-control form-control-sm inp_amt_inc_vat_ar  text-end " disabled></td><!-- AMT(INCL.vat) -->
                <td class="text-center long"><input type="checkbox" class="form-input-check text-center ch_revd_amt_ar " ></td><!-- rcvd amt -->
                <td class="long"><input type="text" class="form-control form-control-sm inp_remark"></td>  <!-- remark -->

                <td><input type="text" class="form-control form-control-sm" disabled></td><!-- Billing Date -->
                <td><input type="text" class="form-control form-control-sm inp_sys_rate_ar" disabled onchange="function_sub_billing.sys_rate_ar(this)" ></td><!-- sysrate -->
                <td class="text-center long"><input type="checkbox" class="form-input-check text-center ch_need_vat_ar"></td><!-- need vat -->

                <td class="long text-center"><input type="checkbox" class="form-input-check ch_check_ar"></td>
                <td class="long text-center"><div class="inp_status"></div></td>
                <td class="long text-center"><input class="form-control form-control-sm text-center" disabled></td><!-- brunch -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled></td><!-- create by, -->
                <td class="long"><input type="text" class="form-control form-control-sm inp_create_datetime_ar" disabled></td><!-- create datetime. -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled></td><!-- lastmo by -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled></td><!-- lastmo date -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled></td><!--  checker by -->
                <td class="long"><input type="text" class="form-control form-control-sm" disabled></td><!-- checker date -->
            </tr>
            `;
            $('.table_billing_ar > tbody').append(html_data_ar)
        }


        let data_qty_all = 0;
        let data_unit_price_all = 0;
        let data_vat_all = 0;
        let data_sys_rate_all = 0;

        let data_sub_total = 0;
        let data_value_tax = 0;
        let data_total = 0;
        data_obj = {}
        data_arr = []
        $('.table_billing_ar > tbody > tr').each(function (i, v) {
            let data_qty = parseFloat($('.inp_qty').val())
            let data_unit_price = parseFloat($('.inp_unit_price').val())
            let data_vat = parseFloat($('.inp_vat').val())
            let data_sys_rate = parseFloat($('.inp_sys_rate_ar').val())

            let data_sub_total = 0;
            let data_total = 0;
            let data_tax = 0;

            data_sub_total = data_qty * data_unit_price
            data_total = ((data_sub_total * data_vat) / 100) + data_sub_total

            data_obj = {
                data_sub_total: data_sub_total,
                data_total: data_total
            }
            data_arr.push(data_obj)
        })


        $.each(data_arr, function (i, v) {
            let data_sub = v['data_sub_total'] ? v['data_sub_total'] : 0;
            let data_total_a = v['data_total'] ? v['data_total'] : 0;
            data_sub_total = data_sub_total + data_sub
            data_total = data_total + data_total_a
        })

        data_value_tax = data_total - data_sub_total
        data_value_tax = data_value_tax.toFixed(2)
        data_sub_total = data_sub_total.toFixed(2)
        data_total = data_total.toFixed(2)

        $('.inp_sub_total_ar').val(data_sub_total).attr('disabled', true)
        $('.inp_vat_inc_ar').val(data_value_tax).attr('disabled', true)
        $('.inp_total_ar').val(data_total).attr('disabled', true)
        function_sub_billing.billing_ap_function_cal_row_ar();
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

    setting_ap_ar : async function(e) {
        let table_ap = $('.table_billing_ap > tbody > tr')
        $.each(table_ap,function(){
            let data_id_list_check = $(this).attr('id_list')

            if(e != data_id_list_check){
                $(this).remove()
            }
        })

        let table_ar = $('.table_billing_ar > tbody > tr')
        $.each(table_ar,function(){
            let data_id_list_check = $(this).attr('id_list')

            if(e != data_id_list_check){
                $(this).remove()
            }
        })
    }


}