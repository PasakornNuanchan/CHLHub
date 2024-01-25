const start = {
    start_setting: async function () {
        $('.head-of-menu').html('OP Review')
        $('.bcpage > .breadcrumb-item > a').html('OP Review Check')
    },

    data_start: async function (e) {
        let res_data = '';
        if (e != undefined) {
            res_data = e
        } else {
            res_data = await this.ajax_setting_data_table()
        }
        $('.table thead').html('');
        // console.log(res_data)


        let html_head = `
        <tr class="text-center">
            <th class="sticky-top">Check</th>
            <th class="sticky-top">Reverse</th>
            <th class="sticky-top">No</th>
            <th class="sticky-top">Job Number</th>
            <th class="sticky-top">Bill to</th>
            <th class="sticky-top">Description</th>
            <th class="sticky-top">Cur.</th>
            <th class="sticky-top">Qty</th>
            <th class="sticky-top">unit price</th>
            <th class="sticky-top">Vat%</th>
            <th class="sticky-top">W/H</th>
            <th class="sticky-top">Total</th>
            <th class="sticky-top">Bank <br> payment</th>
            <th class="sticky-top">Payment <br> Term</th>
            <th class="sticky-top">Create By</th>
            <th class="sticky-top">Create Datetime</th>
            <th class="sticky-top">Apply By</th>
            <th class="sticky-top">Apply Datetime</th>
            <th class="sticky-top">Check by</th>
            <th class="sticky-top">Check Datetime</th>
        </tr>
       
        `;

        $('.table thead').html(html_head)
        $('.table tbody').html('')

        let radio_type = $('input[name="radio_type"]:checked').val();
        let res_data_bank = ''
        if(radio_type == "AP"){
            res_data_bank = await this.ajax_request_bank_data_ap();
        }else{
            res_data_bank = await this.ajax_request_bank_data_ar();
        }
        // console.log(res_data_bank)


        $.each(res_data['table'], function (i, v) {
            if (v.length > 1) {
                let data_head_html = `
                    <tr class="main_table${i} main_table table_data_main${i}" main_table="${i}" style="background-color:#E4E4E4" >
                        <td class="sticky-left text-center" style="background-color:#E4E4E4"><input type="checkbox" onclick="start.check_sub_table(this)" class="data_check" onchange="start.cal_currency()" style="zoom:200%"></td>
                        <td class="sticky-left text-center" style="background-color:#E4E4E4"><button class="btn btn-outline-secondary" data-bs-toggle="collapse" data-bs-target="#collapse${i}" aria-expanded="false" aria-controls="collapse${i}">List</button></td>
                        <td class="sticky-left text-center" style="background-color:#E4E4E4"></td>
                        <td class="sticky-left" style="background-color:#E4E4E4"><input type="text" class="form-control form-control-sm text-start inp_job_number_main" disabled></td>
                        <td class="sticky-left" style="background-color:#E4E4E4"><input type="text" class="form-control form-control-sm text-start inp_bill_to_main" disabled></td>
                        <td class="sticky-left" style="background-color:#E4E4E4"><input type="text" class="form-control form-control-sm text-start inp_description_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-center inp_cur_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-end inp_qty_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-end inp_unit_price_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-center inp_vat_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-center inp_wh_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-end inp_total_main" disabled></td>
                        <td><select class="form-select form-select-sm sel_bank_number" onchange="start.bank_select(this)">
                        </select></td>
                        <td><input type="date" class="form-control form-control-sm inp_payment_term" onchange="start.payment_select_select(this)"></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_create_b_mainy" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_apply_by_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_check_by_main" disabled></td>
                        <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime_main" disabled></td>
                    </tr>`;
                $('.card_table tbody').append(data_head_html)
                let get_data_amt = 0;

                let arr_job_number_main = []
                let arr_bill_to_main = []
                let arr_description_main = []
                let arr_cur_main = []
                let html_sel_bank = []
                let main_bank = '';
                let main_term = '';
                let main_check_by = '';
                // let main_approve = '';
                $.each(v, function (i1, v1) {
                    let id_number = v1['ID'] ? v1['ID'] : '';
                    let billing_description = v1['billing_description'] ? v1['billing_description'] : '';
                    let ref_job_id = v1['ref_job_id'] ? v1['ref_job_id'] : '';
                    let job_number = v1['job_number'] ? v1['job_number'] : '';
                    let bill_to_c = v1['bill_to_c'] ? v1['bill_to_c'] : '';
                    let currency = v1['currency'] ? v1['currency'] : '';
                    let qty = v1['qty'] ? v1['qty'] : '';
                    let unit_price = v1['unit_price'] ? v1['unit_price'] : '';
                    let vat = v1['vat'] ? v1['vat'] : '';
                    let amtinclvat = v1['amtinclvat'] ? v1['amtinclvat'] : '';
                    let with_holding_tax = v1['with_holding_tax'] ? v1['with_holding_tax'] : '';
                    let create_data_time = v1['create_data_time'] ? v1['create_data_time'] : '';
                    let check_date_time = v1['check_date_time'] ? v1['check_date_time'] : '';
                    let action_paid_date_time = v1['action_paid_date_time'] ? v1['action_paid_date_time'] : '';
                    let create_by_f = v1['create_by_f'] ? v1['create_by_f'] : '';
                    let create_by_l = v1['create_by_l'] ? v1['create_by_l'] : '';
                    let check_by_f = v1['check_by_f'] ? v1['check_by_f'] : '';
                    let check_by_l = v1['check_by_l'] ? v1['check_by_l'] : '';
                    let action_paid_by_f = v1['action_paid_by_f'] ? v1['action_paid_by_f'] : '';
                    let action_paid_by_l = v1['action_paid_by_l'] ? v1['action_paid_by_l'] : '';
                    let check_by = v1['check_by'] ? v1['check_by'] : '';
                    let payment_term = v1['payment_term'] ? v1['payment_term'] : '';
                    let bank_number = v1['bank_number'] ? v1['bank_number'] : '';
                    let type_bill = v1['type_bill'] ? v1['type_bill'] : '';
                    let bill_to = v1['bill_to'] ? v1['bill_to'] : '';
                    let data_select_bank = ``;
                    let approve_by = v1['approve_by'] ? v1['approve_by'] : '';

                    if (!arr_job_number_main.find(x => x === job_number)) {
                        arr_job_number_main.push(job_number)
                    }
                    if (!arr_bill_to_main.find(x => x === bill_to_c)) {
                        arr_bill_to_main.push(bill_to_c)
                    }
                    if (!arr_description_main.find(x => x === billing_description)) {
                        arr_description_main.push(billing_description)
                    }
                    if (!arr_cur_main.find(x => x === currency)) {
                        arr_cur_main.push(currency)
                    }

                    amtinclvat = parseFloat(amtinclvat)
                    get_data_amt = parseFloat(get_data_amt + amtinclvat)

                    qty = parseFloat(qty)
                    unit_price = parseFloat(unit_price)
                    amtinclvat = parseFloat(amtinclvat)

                    qty = qty.toFixed(2)
                    unit_price = unit_price.toFixed(2)
                    amtinclvat = amtinclvat.toFixed(2)
                    let data_html = `
                        <tr id_number="${id_number}" id="collapse${i}" sub_table="${i}" class="table_number_${id_number} sub_table${i} collapse collapse_data_${i} main_table${i}" style="background-color:#B5CAFF">
                            <td class="sticky-left text-center" style="background-color:#B5CAFF"><input type="checkbox" class="data_check" onclick="start.check_and_uncheck_sub(this)" onchange="start.cal_currency()"  style="zoom:200%"></td>
                            <td class="sticky-left text-center" style="background-color:#B5CAFF"><button class="btn btn-sm btn-warning btn_sent_job" onclick="start.sent_to_job_detail('${ref_job_id}','${id_number}')">reverse</button></td>
                            <td class="sticky-left text-center" style="background-color:#B5CAFF"></td>
                            <td class="sticky-left" style="background-color:#B5CAFF"><input type="text" class="form-control form-control-sm text-start inp_job_number" disabled></td>
                            <td class="sticky-left" style="background-color:#B5CAFF"><input type="text" class="form-control form-control-sm text-start inp_bill_to" disabled></td>
                            <td class="sticky-left" style="background-color:#B5CAFF"><input type="text" class="form-control form-control-sm text-start inp_description" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-center inp_cur" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-end inp_qty" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-end inp_unit_price" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-center inp_vat" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-center inp_wh" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-end inp_total" disabled></td>
                            <td><select class="form-select form-select-sm sel_bank_number">
                            </select></td>
                            <td><input type="date" class="form-control form-control-sm inp_payment_term"></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_create_by" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_apply_by" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_check_by" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime" disabled></td             
                        </tr>`
                    $('.card_table tbody').append(data_html)
                    $(`.table_number_${id_number} > td > .inp_job_number`).val(job_number)
                    $(`.table_number_${id_number} > td > .inp_bill_to`).val(bill_to_c)
                    $(`.table_number_${id_number} > td > .inp_description`).val(billing_description)
                    $(`.table_number_${id_number} > td > .inp_cur`).val(currency)
                    $(`.table_number_${id_number} > td > .inp_qty`).val(qty)
                    $(`.table_number_${id_number} > td > .inp_unit_price`).val(unit_price)
                    $(`.table_number_${id_number} > td > .inp_vat`).val(vat)
                    $(`.table_number_${id_number} > td > .inp_wh`).val(with_holding_tax)
                    $(`.table_number_${id_number} > td > .inp_total`).val(amtinclvat)
                    $(`.table_number_${id_number} > td > .inp_create_by`).val(create_by_f + " " + create_by_l)
                    $(`.table_number_${id_number} > td > .inp_create_datetime`).val(create_data_time)
                    $(`.table_number_${id_number} > td > .inp_apply_by`).val(action_paid_by_f + " " + action_paid_by_l)
                    $(`.table_number_${id_number} > td > .inp_apply_datetime`).val(action_paid_date_time)
                    $(`.table_number_${id_number} > td > .inp_check_by`).val(check_by_f + " " + check_by_l)
                    $(`.table_number_${id_number} > td > .inp_check_datetime`).val(check_date_time)

                   
                    let html_data_sel = '';
                    if(res_data_bank['bank_data'][`${bill_to}`] != undefined){
                        $.each(res_data_bank['bank_data'][`${bill_to}`],function(k,b){
                            let carrier_id = b['bank_id'] ? b['bank_id'] : '';
                            let bank_abb = b['bank_abb'] ? b['bank_abb'] : '';
                            let bank_number = b['bank_number'] ? b['bank_number'] : '';
                            html_data_sel += `<option value="${carrier_id}">${bank_abb} / ${bank_number}</option>`
                        })
                    }
                    if(html_data_sel != ''){
                        html_data_sel = `<option value="" selected>-- select data bank --</option>`+html_data_sel
                    }else{
                        html_data_sel = `<option value="" selected>-- data not found -- </option>`
                    }
                    html_sel_bank = html_data_sel
                    $(`.table_number_${id_number} > td > .sel_bank_number`).append(html_data_sel)
                    $(`.table_number_${id_number} > td > .sel_bank_number`).val(bank_number)
                    // console.log(payment_term)
                    $(`.table_number_${id_number} > td > .inp_payment_term`).val(payment_term)
                    main_bank = bank_number
                    main_term = payment_term
                    if(check_by != ''){
                        $(`.table_number_${id_number} > td > .data_check`).prop('checked',true).attr('disabled',true)
                        $(`.table_number_${id_number} > td > .sel_bank_number`).attr('disabled',true)
                        $(`.table_number_${id_number} > td > .inp_payment_term`).attr('disabled',true)
                    }
                    main_check_by = check_by
                    // main_approve = approve_by
                    if(approve_by != ''){
                        $(`.table_number_${id_number} > td > .btn_sent_job`).remove()                        
                    }
                })



                let data_arr_job_number_main = arr_job_number_main.join(',')
                let data_arr_bill_to_main = arr_bill_to_main.join(',')
                let data_arr_description_main = arr_description_main.join(',')
                let data_arr_cur_main = arr_cur_main.join(',')
                get_data_amt = parseFloat(get_data_amt)
                get_data_amt = get_data_amt.toFixed(2)
                
                $(`.table_data_main${i} > td > .inp_job_number_main`).val(data_arr_job_number_main)
                $(`.table_data_main${i} > td > .inp_bill_to_main`).val(data_arr_bill_to_main)
                $(`.table_data_main${i} > td > .inp_description_main`).val(data_arr_description_main)
                $(`.table_data_main${i} > td > .inp_cur_main`).val(data_arr_cur_main)
                $(`.table_data_main${i} > td > .inp_total_main`).val(get_data_amt)
                $(`.table_data_main${i} > td > .sel_bank_number`).append(html_sel_bank)
                $(`.table_data_main${i} > td > .sel_bank_number`).val(main_bank)
                $(`.table_data_main${i} > td > .inp_payment_term`).val(main_term)
                if(main_check_by != ''){
                    $(`.table_data_main${i} > td > .data_check`).prop('checked',true).attr('disabled',true)
                    $(`.table_data_main${i} > td > .sel_bank_number`).attr('disabled',true)
                    $(`.table_data_main${i} > td > .inp_payment_term`).attr('disabled',true)
                }
                

            } else {
                $.each(v, function (i1, v1) {
                    let id_number = v1['ID'] ? v1['ID'] : '';
                    let billing_description = v1['billing_description'] ? v1['billing_description'] : '';
                    let ref_job_id = v1['ref_job_id'] ? v1['ref_job_id'] : '';
                    let job_number = v1['job_number'] ? v1['job_number'] : '';
                    let bill_to_c = v1['bill_to_c'] ? v1['bill_to_c'] : '';
                    let currency = v1['currency'] ? v1['currency'] : '';
                    let qty = v1['qty'] ? v1['qty'] : '';
                    let unit_price = v1['unit_price'] ? v1['unit_price'] : '';
                    let vat = v1['vat'] ? v1['vat'] : '';
                    let amtinclvat = v1['amtinclvat'] ? v1['amtinclvat'] : '';
                    let with_holding_tax = v1['with_holding_tax'] ? v1['with_holding_tax'] : '';
                    let create_data_time = v1['create_data_time'] ? v1['create_data_time'] : '';
                    let check_date_time = v1['check_date_time'] ? v1['check_date_time'] : '';
                    let action_paid_date_time = v1['action_paid_date_time'] ? v1['action_paid_date_time'] : '';
                    let create_by_f = v1['create_by_f'] ? v1['create_by_f'] : '';
                    let create_by_l = v1['create_by_l'] ? v1['create_by_l'] : '';
                    let check_by_f = v1['check_by_f'] ? v1['check_by_f'] : '';
                    let check_by_l = v1['check_by_l'] ? v1['check_by_l'] : '';
                    let action_paid_by_f = v1['action_paid_by_f'] ? v1['action_paid_by_f'] : '';
                    let action_paid_by_l = v1['action_paid_by_l'] ? v1['action_paid_by_l'] : '';
                    let check_by = v1['check_by'] ? v1['check_by'] : '';
                    let payment_term = v1['payment_term'] ? v1['payment_term'] : '';
                    let bank_number = v1['bank_number'] ? v1['bank_number'] : '';
                    let type_bill = v1['type_bill'] ? v1['type_bill'] : '';
                    let bill_to = v1['bill_to'] ? v1['bill_to'] : '';
                    let data_select_bank = ``;
                    let approve_by = v1['approve_by'] ? v1['approve_by'] : '';


                    qty = parseFloat(qty)
                    unit_price = parseFloat(unit_price)
                    amtinclvat = parseFloat(amtinclvat)

                    qty = qty.toFixed(2)
                    unit_price = unit_price.toFixed(2)
                    amtinclvat = amtinclvat.toFixed(2)
                    let data_html = `
                        <tr id_number="${id_number}"  class="table_number_${id_number}" >
                            <td class="sticky-left text-center"><input type="checkbox" class="data_check" onclick="start.check_and_uncheck_sub(this)" onchange="start.cal_currency()"  style="zoom:200%"></td>
                            <td class="sticky-left text-center"><button class="btn btn-sm btn-warning btn_sent_job" onclick="start.sent_to_job_detail('${ref_job_id}','${id_number}')">reverse</button></td>
                            <td class="sticky-left text-center"></td>
                            <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_job_number" disabled></td>
                            <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_bill_to" disabled></td>
                            <td class="sticky-left"><input type="text" class="form-control form-control-sm text-start inp_description" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-center inp_cur" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-end inp_qty" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-end inp_unit_price" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-center inp_vat" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-center inp_wh" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-end inp_total" disabled></td>
                            <td><select class="form-select form-select-sm sel_bank_number">
                            </select></td>
                            <td><input type="date" class="form-control form-control-sm inp_payment_term"></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_create_by" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_create_datetime" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_apply_by" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_apply_datetime" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_check_by" disabled></td>
                            <td><input type="text" class="form-control form-control-sm text-start inp_check_datetime" disabled></td             
                        </tr>`
                    $('.card_table tbody').append(data_html)
                    $(`.table_number_${id_number} > td > .inp_job_number`).val(job_number)
                    $(`.table_number_${id_number} > td > .inp_bill_to`).val(bill_to_c)
                    $(`.table_number_${id_number} > td > .inp_description`).val(billing_description)
                    $(`.table_number_${id_number} > td > .inp_cur`).val(currency)
                    $(`.table_number_${id_number} > td > .inp_qty`).val(qty)
                    $(`.table_number_${id_number} > td > .inp_unit_price`).val(unit_price)
                    $(`.table_number_${id_number} > td > .inp_vat`).val(vat)
                    $(`.table_number_${id_number} > td > .inp_wh`).val(with_holding_tax)
                    $(`.table_number_${id_number} > td > .inp_total`).val(amtinclvat)
                    $(`.table_number_${id_number} > td > .inp_create_by`).val(create_by_f + " " + create_by_l)
                    $(`.table_number_${id_number} > td > .inp_create_datetime`).val(create_data_time)
                    $(`.table_number_${id_number} > td > .inp_apply_by`).val(action_paid_by_f + " " + action_paid_by_l)
                    $(`.table_number_${id_number} > td > .inp_apply_datetime`).val(action_paid_date_time)
                    $(`.table_number_${id_number} > td > .inp_check_by`).val(check_by_f + " " + check_by_l)
                    $(`.table_number_${id_number} > td > .inp_check_datetime`).val(check_date_time)

                    $(`.table_number_${id_number} > td > .inp_payment_term`).val(payment_term)

                    if (check_by != '') {
                        $(`.table_number_${id_number} > td > .data_check`).prop('checked', true).attr('disabled', true)
                        $(`.table_number_${id_number} > td > .sel_bank_number`).attr('disabled',true)
                        $(`.table_number_${id_number} > td > .inp_payment_term`).attr('disabled',true)
                    }

                    let html_data_sel ='';
                    if(res_data_bank['bank_data'][`${bill_to}`] != undefined){
                        $.each(res_data_bank['bank_data'][`${bill_to}`],function(k,b){
                            let carrier_id = b['bank_id'] ? b['bank_id'] : '';
                            let bank_abb = b['bank_abb'] ? b['bank_abb'] : '';
                            let bank_number = b['bank_number'] ? b['bank_number'] : '';
                            html_data_sel += `<option value="${carrier_id}">${bank_abb} / ${bank_number}</option>`
                        })
                    }
                    if(html_data_sel != ''){
                        html_data_sel = `<option value="" selected>-- select data bank --</option>`+html_data_sel
                    }else{
                        html_data_sel = `<option value="" selected>-- data not found -- </option>`
                    }

                    $(`.table_number_${id_number} > td > .sel_bank_number`).append(html_data_sel)
                    $(`.table_number_${id_number} > td > .sel_bank_number`).val(bank_number)
                    $(`.table_number_${id_number} > td > .inp_payment_term`).val(payment_term)
                    if(approve_by != ''){
                        $(`.table_number_${id_number} > td > .btn_sent_job`).remove()
                    }
                })

            }


        })




        await this.cal_currency();
    },

    ajax_request_bank_data_ap: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_approve/request_bank_data_ap.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    ajax_request_bank_data_ar: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_approve/request_bank_data_ar.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    sent_to_job_detail: async function (data, id_number) {
        window.location = "job_detail.php" + "?job_number=" + data + "&action=invoice_mode&mode_check=check&id_number=" + id_number;
    },

    select_filter: async function () {



        // let data_radio_process = $('input[name="radio_process"]:checked').val();
        // let data_radio_select_type = $('input[name="radio_function_select"]:checked').val();
        // let data_radio_act = $('input[name="radio_select_act"]:checked').val();

        let data_data_id = '';
        let data_data_type = '';
        let data_name_type = '';

        let job_number = $('.inp_job_number').val() ? $('.inp_job_number').val() : '';
        let data_applied_person = $('.inp_applied_person').val()
        data_applied_person = $(`.data_list_applied_person option[item_search="${data_applied_person}"]`).attr('id_search')
        data_applied_person = data_applied_person ? data_applied_person : '';

        let data_date_applied = $('.inp_date_applied').val()
        let radio_p = $('input[name="radio_p"]:checked').val();
        let radio_type = $('input[name="radio_type"]:checked').val();
        
        let billing_code = $('.inp_billing_code').val() ? $('.inp_billing_code').val() : '';
        // console.log(billing_code)

        // billing_code = $(`.data_list_billing_list option[billing_item_name="${billing_code}"]`).attr('number_des')
        // billing_code = billing_code ? billing_code : '';

        $.each($('.data_sic > div > button'), function () {
            let data_hasclass = $(this).hasClass('active_side')
            if (data_hasclass == true) {
                data_data_id = $(this).attr('data_id')
                data_data_type = $(this).attr('data_type')
                data_name_type = $(this).attr('name_type')
            }

        })


        let res_data = await this.ajax_setting_data_table(data_data_id, data_data_type, data_name_type, job_number, billing_code, data_applied_person, data_date_applied, radio_p,radio_type)

        await this.data_start(res_data)

    },

    ajax_setting_data_table: async function (data_data_id, data_data_type, data_name_type, job_number, billing_code, data_applied_person, data_date_applied, radio_p,radio_type) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_approve/get_data_table.php",
                data: {
                    data_data_id: data_data_id,
                    data_data_type: data_data_type,
                    data_name_type: data_name_type,
                    job_number: job_number,
                    billing_code: billing_code,
                    data_applied_person: data_applied_person,
                    data_date_applied: data_date_applied,
                    radio_p: radio_p,
                    radio_type : radio_type
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    start_default: async function () {
        let res_data_default = await this.ajax_default_data();
        let data_default = '';
        $.each(res_data_default['default'], function (i, v) {
            let name_type = v['name_type'] ? v['name_type'] : '';
            let TYPE = v['TYPE'] ? v['TYPE'] : '';
            let ID = v['ID'] ? v['ID'] : '';
            let NAME = v['NAME'] ? v['NAME'] : '';
            data_default += `
            <div class="form-group">
                <button class="btn btn-sm" data_id="${ID}" data_type="${TYPE}" name_type="${NAME}" onclick="start.mark_active(this)"><i class="bi bi-folder text-warning" style="zoom:135%"></i> ${NAME}</button>
            </div>
            `;
        })

        $('.data_sic').append(data_default)


        let html_data_job = '';
        let html_data_des = '';
        let html_data_search = '';
        $.each(res_data_default['job_number'], function (i, v) {
            html_data_job += `<option realdata="${v['job_number']}">${v['job_number']}</option>`;
        })
        $.each(res_data_default['description'], function (i, v) {
            html_data_des += `<option number_des="${v['ID']}" billing_item_name="${v['billing_code']}">${v['billing_code']}</option>`;
        })
        $.each(res_data_default['user_search'], function (i, v) {
            html_data_search += `<option item_search="${v['first_name'] + ' ' + v['last_name']}" id_search="${v['ID']}">${v['first_name'] + ' ' + v['last_name']}</option>`
        })

        $('.data_list_job_number').append(html_data_job)
        $('.data_list_billing_list').append(html_data_des)
        $('.data_list_applied_person').append(html_data_search)
    },

    mark_active: async function (e) {

        $('.active_side').removeClass('active_side');
        $(e).addClass("active_side")
        await this.select_filter()
    },

    ajax_default_data: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_check_approve/get_data_default.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    cal_currency: async function () {

        let data_radio_select_type = $('input[name="radio_select_act"]:checked').val();
        // console.log(data_radio_select_type)



        let e_path = $('.table > tbody > tr');


        let data_currency_usd = 0;
        let data_currency_thb = 0;
        let data_currency_rmb = 0;
        let data_currency_yen = 0;
        let data_currency_hkd = 0;

        let data_currency_usd_review = 0;
        let data_currency_thb_review = 0;
        let data_currency_rmb_review = 0;
        let data_currency_yen_review = 0;
        let data_currency_hkd_review = 0;

        $.each(e_path, function () {
            let inp_cur = $(this).find('.inp_cur').val()
            let inp_unit_price = $(this).find('.inp_total').val()
            inp_unit_price = parseFloat(inp_unit_price)

            if (inp_cur == "USD") {
                data_currency_usd = data_currency_usd + inp_unit_price;
            } else if (inp_cur == "THB") {
                data_currency_thb = data_currency_thb + inp_unit_price;
            } else if (inp_cur == "RMB") {
                data_currency_rmb = data_currency_rmb + inp_unit_price;
            } else if (inp_cur == "YEN") {
                data_currency_yen = data_currency_yen + inp_unit_price;
            } else if (inp_cur == "HKD") {
                data_currency_hkd = data_currency_hkd + inp_unit_price;
            }
        })

        $.each(e_path, function () {
            let inp_cur = $(this).find('.inp_cur').val()
            let inp_unit_price = $(this).find('.inp_total').val()
            let data_check = '';


            data_check = $(this).find('.data_check').prop("checked") ? '1' : '0';


            inp_unit_price = parseFloat(inp_unit_price)

            if (data_check == '1') {
                if (inp_cur == "USD") {
                    data_currency_usd_review = data_currency_usd_review + inp_unit_price;
                } else if (inp_cur == "THB") {
                    data_currency_thb_review = data_currency_thb_review + inp_unit_price;
                } else if (inp_cur == "RMB") {
                    data_currency_rmb_review = data_currency_rmb_review + inp_unit_price;
                } else if (inp_cur == "YEN") {
                    data_currency_yen_review = data_currency_yen_review + inp_unit_price;
                } else if (inp_cur == "HKD") {
                    data_currency_hkd_review = data_currency_hkd_review + inp_unit_price;
                }
            }

        })
        data_currency_usd = data_currency_usd.toFixed(2)
        data_currency_thb = data_currency_thb.toFixed(2)
        data_currency_rmb = data_currency_rmb.toFixed(2)
        data_currency_yen = data_currency_yen.toFixed(2)
        data_currency_hkd = data_currency_hkd.toFixed(2)

        $('.data_currency_usd').html(data_currency_usd)
        $('.data_currency_thb').html(data_currency_thb)
        $('.data_currency_rmb').html(data_currency_rmb)
        $('.data_currency_yen').html(data_currency_yen)
        $('.data_currency_hkd').html(data_currency_hkd)

        data_currency_usd_review = data_currency_usd_review.toFixed(2)
        data_currency_thb_review = data_currency_thb_review.toFixed(2)
        data_currency_rmb_review = data_currency_rmb_review.toFixed(2)
        data_currency_yen_review = data_currency_yen_review.toFixed(2)
        data_currency_hkd_review = data_currency_hkd_review.toFixed(2)


        $('.data_currency_review_usd').html(data_currency_usd_review)
        $('.data_currency_review_thb').html(data_currency_thb_review)
        $('.data_currency_review_rmb').html(data_currency_rmb_review)
        $('.data_currency_review_yen').html(data_currency_yen_review)
        $('.data_currency_review_hkd').html(data_currency_hkd_review)
    },

    select_all: async function (e) {
        let e_path = $('.table > tbody > tr')
        $.each(e_path, function () {
            let data_dis = $(this).find('.data_check').attr('disabled') ? '1' : '0';
            if (data_dis == '0') {
                if (e == "select") {
                    $(this).find('.data_check').attr('checked', true)
                } else {
                    $(this).find('.data_check').attr('checked', false)

                }
            }
        })
    },

    check_sub_table: async function (e) {
        let data_main_table = $(e).closest('tr').attr('main_table');
        let data_main_attr = $(e).prop('checked') ? '1' : '0';
        if (data_main_attr == '1') {
            $(`.sub_table${data_main_table} > td > .data_check`).prop('checked', true)
        } else {
            $(`.sub_table${data_main_table} > td > .data_check`).prop('checked', false)
        }
    },

    check_and_uncheck_sub: async function (e) {
        let data_sub_table = $(e).closest('tr').attr('sub_table')
        let data_prop = $(e).prop('checked') ? '1' : '0';

        if (data_prop == '1') {
            $(`.main_table${data_sub_table}`).find('.data_check').prop('checked', true)
            $(`.sub_table${data_sub_table}`).find('.data_check').prop('checked', true)
        } else {
            $(`.main_table${data_sub_table}`).find('.data_check').prop('checked', false)
            $(`.sub_table${data_sub_table}`).find('.data_check').prop('checked', false)

        }
        // console.log(data_sub_table)
    },

    bank_select: async function (e) {
        let data_select = $(e).val()
        let data_main_table = $(e).closest('.main_table').attr('main_table')
        $(`.sub_table${data_main_table} > td > .sel_bank_number`).val(data_select)

    },

    payment_select_select: async function (e) {
        let data_select = $(e).val()
        let data_main_table = $(e).closest('.main_table').attr('main_table')
        $(`.sub_table${data_main_table} > td > .inp_payment_term`).val(data_select)

    }

}