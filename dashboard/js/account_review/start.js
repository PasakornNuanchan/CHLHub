const start = {
    res_data_table_main: '',
    start_page: async function () {
        $('.head-of-menu').html('Account Review (Approve)');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="account_check_payable.php" target="" style="color:white;">Account Review (Approve)</a></li>
        `;
        $('.bcpage').append(html_bdpage);
    },

    start_setting_table: async function (e) {

        $('.table tbody').html('');
        let res_data = '';
        if (e == undefined) {
            res_data = await this.ajax_get_data_table()
        } else {
            res_data = e;
        }
        // console.log(res_data)
        this.res_data_table_main = '';
        this.res_data_table_main = res_data
        if (res_data['table'] != "0 results") {
            
                $.each(res_data['table'], function (i, v) {
                    let id_number = v['ID'] ? v['ID'] : '';
                    let billing_description = v['billing_description'] ? v['billing_description'] : '';
                    let job_number = v['job_number'] ? v['job_number'] : '';
                    let bill_to_type = v['bill_to_type'] ? v['bill_to_type'] : '';
                    let bill_to = v['bill_to'] ? v['bill_to'] : '';
                    let billing_des_id = v['billing_des_id'] ? v['billing_des_id'] : '';
                    let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
                    let payble = v['payble'] ? v['payble'] : '';
                    let currency = v['currency'] ? v['currency'] : '';
                    let qty = v['qty'] ? v['qty'] : '';
                    let unit_price = v['unit_price'] ? v['unit_price'] : '';
                    let amount = v['amount'] ? v['amount'] : '';
                    let vat = v['vat'] ? v['vat'] : '';
                    let amtinclvat = v['amtinclvat'] ? v['amtinclvat'] : '';
                    let remark = v['remark'] ? v['remark'] : '';
                    let type = v['type'] ? v['type'] : '';
                    let create_by_f = v['create_by_f'] ? v['create_by_f'] : '';
                    let create_by_l = v['create_by_l'] ? v['create_by_l'] : '';
                    let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';
                    let check_by = v['check_by'] ? v['check_by'] : '';
                    let check_by_f = v['check_by_f'] ? v['check_by_f'] : '';
                    let check_by_l = v['check_by_l'] ? v['check_by_l'] : '';
                    let check_date_time = v['check_date_time'] ? v['check_date_time'] : '';
                    let action_paid_by = v['action_paid_by'] ? v['action_paid_by'] : '';
                    let action_paid_by_f = v['action_paid_by_f'] ? v['action_paid_by_f'] : '';
                    let action_paid_by_l = v['action_paid_by_l'] ? v['action_paid_by_l'] : '';
                    let action_paid_date_time = v['action_paid_date_time'] ? v['action_paid_date_time'] : '';
                    let approve_by = v['approve_by'] ? v['approve_by'] : '';
                    let approve_date_time = v['approve_date_time'] ? v['approve_date_time'] : '';
                    let delete_date_time = v['delete_date_time'] ? v['delete_date_time'] : '';
                    let delete_by = v['delete_by'] ? v['delete_by'] : '';
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
                    let pre_approve_by = v['pre_approve_by'] ? v['pre_approve_by'] : '';
                    let pre_approve_dt = v['pre_approve_dt'] ? v['pre_approve_dt'] : '';
                    let pre_approve_status = v['pre_approve_status'] ? v['pre_approve_status'] : '';

                    let cs_support_f = v['cs_support_f'] ? v['cs_support_f'] : '';
                    let cs_support_l = v['cs_support_l'] ? v['cs_support_l'] : '';
                    let sale_support_f = v['sale_support_f'] ? v['sale_support_f'] : '';
                    let sale_support_l = v['sale_support_l'] ? v['sale_support_l'] : '';
                    let approve_by_f = v['approve_by_f'] ? v['approve_by_f'] : '';
                    let approve_by_l = v['approve_by_l'] ? v['approve_by_l'] : '';
                    let booking_no = v['booking_no'] ? v['booking_no'] : '';
                    let container = v['container'] ? v['container'] : '';

                    let create_job = v['create_job'] ? v['create_job'] : '';

                    let amount_paid = v['amount_paid'] ? v['amount_paid'] : '0';
                    let currency_paid = v['currency_paid'] ? v['currency_paid'] : '';


                    i++

                    let html_data = ``;
                    html_data = `
                <tr class="row_id${id_number}" id_number="${id_number}">
                    <td class="text-center sticky-column">${i}</td><!-- No -->
                    <td class="text-center sticky-column"><input type="text" class="form-control form-control-sm inp_job_number" readonly></td><!-- Job number -->
                    <td class="text-center sticky-column"><input type="text" class="form-control form-control-sm inp_bill_to" readonly></td><!-- Bill to -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_description" readonly></td><!-- Code -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_currency text-center" readonly></td><!-- Cur. -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_qty text-center" readonly></td><!-- QTY -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_unit_price text-end" readonly></td><!-- UNIT PRICE -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_amt text-end" readonly></td><!-- AP AMT -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_vat text-center" readonly></td><!-- VAT% -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_wh text-center" readonly></td><!-- WH% -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_amtincv text-end" readonly></td><!-- AMTINCV -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_amtpaid text-end "  readonly></td><!-- AMTPAID -->
                    <td class="text-center">
                        <input type="radio" class="form-check-input radio_act_w radio_act" onclick="start.cal_currency();" name="radio_act${id_number}" id="radio1_${id_number}" value="0">
                        <label for="radio1_${id_number}" class="form-check-label pl-2">Waiting</label>
                        <input type="radio" class="form-check-input radio_act_a radio_act" onclick="start.cal_currency();" name="radio_act${id_number}" id="radio2_${id_number}" value="2">
                        <label for="radio2_${id_number}" class="form-check-label pl-2">Approve</label>
                        <input type="radio" class="form-check-input radio_act_r radio_act" onclick="start.cal_currency();" name="radio_act${id_number}" id="radio3_${id_number}" value="3">
                        <label for="radio3_${id_number}" class="form-check-label pl-2">Reject</label>
                    </td><!-- STATUS -->
                    
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_remark" readonly ></td><!-- REMARK -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_op" readonly ></td><!-- OP -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_sale" readonly ></td><!-- SALE -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_create_date text-center" readonly ></td><!-- SALE -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_creater" readonly ></td><!-- create by. -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_billing_date " readonly ></td><!-- CREATE DATE -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_check_by" readonly ></td><!-- check by. -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_check_datetime" readonly ></td><!-- check datetime -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_apply_by" readonly ></td><!-- apply by. -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_apply_datetime" readonly ></td><!-- apply datetime -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_approve_by" readonly ></td><!-- approve by. -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_approve_datetime" readonly ></td><!-- approve datetime -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_booking_no" readonly ></td><!-- booking no -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_container_no" readonly ></td><!-- container no -->
                    <td class="text-center"><input type="text" class="form-control form-control-sm inp_payment_status" readonly ></td><!-- payment status  -->
                </tr>
                `;

                    $('.table > tbody').append(html_data)
                    //<!-- <td class="text-center"><button class="btn btn-sm btn-warning" onclick="start.sent_to_job_detail(${ref_job_id},${id_number})">rewise</button></td> -->
                    parseFloat(amount_paid)
                    if (amount_paid == 0) {
                        // console.log(id_number)
                        $(`.table > tbody > .row_id${id_number} > td > .inp_amtpaid`).css("color", "red")
                    }
                    $(`.table > tbody > .row_id${id_number} > td > .inp_job_number`).val(job_number)

                    amount_paid = amount_paid != 0 ? amtinclvat : 0;
                    amount_paid = parseFloat(amount_paid)
                    amount_paid = amount_paid.toFixed(2)

                    unit_price = parseFloat(unit_price)
                    qty = parseFloat(qty)
                    amtinclvat = parseFloat(amtinclvat)
                    let data_amt = unit_price * qty
                    data_amt = data_amt.toFixed(2)
                    unit_price = unit_price.toFixed(2)
                    amtinclvat = amtinclvat.toFixed(2)





                    $(`.table > tbody > .row_id${id_number} > td > .inp_bill_to`).val(bill_to_c)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_description`).val(billing_description)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_currency`).val(currency)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_qty`).val(qty)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_unit_price`).val(unit_price)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_amt`).val(data_amt)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_vat`).val(vat + "%")
                    $(`.table > tbody > .row_id${id_number} > td > .inp_wh`).val(with_holding_tax + "%")
                    $(`.table > tbody > .row_id${id_number} > td > .inp_amtincv`).val(amtinclvat)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_amtpaid`).val(amount_paid)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_remark`).val(remark)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_op`).val(cs_support_f + ' ' + cs_support_l)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_sale`).val(sale_support_f + ' ' + sale_support_l)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_create_date`).val(create_job)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_creater`).val(create_by_f + ' ' + create_by_l)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_billing_date`).val(create_data_time)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_check_by`).val(check_by_f + ' ' + check_by_l)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_check_datetime`).val(check_date_time)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_apply_by`).val(action_paid_by_f + ' ' + action_paid_by_l)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_apply_datetime`).val(action_paid_date_time)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_approve_by`).val(approve_by_f + ' ' + approve_by_l)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_approve_datetime`).val(approve_date_time)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_booking_no`).val(booking_no)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_container_no`).val(container)
                    $(`.table > tbody > .row_id${id_number} > td > .inp_payment_status`).val()

                    if (status == '0' || status == '1' || status == null) {
                        $(`.table > tbody > .row_id${id_number} > td > .radio_act_w`).prop('checked', true)
                    } else if (status == '2') {
                        $(`.table > tbody > .row_id${id_number} > td > .radio_act_a`).prop('checked', true)
                    } else if (status == '3') {
                        $(`.table > tbody > .row_id${id_number} > td > .radio_act_r`).prop('checked', true)
                    }

                    let data_radio_process = $('input[name="radio_process"]:checked').val();
                    if (data_radio_process == "process") {
                        if (status == '2') {
                            $(`.table > tbody > .row_id${id_number} > td > .radio_act`).attr('disabled', true)
                        } else if (status == '3') {
                            $(`.table > tbody > .row_id${id_number} > td > .radio_act`).attr('disabled', true)
                        } else if (check_by == ''){
                            $(`.table > tbody > .row_id${id_number} > td > .radio_act`).attr('disabled', true)
                        }
                    }




                })
                await this.cal_currency();
            
        }


    },

    ajax_get_data_table: async function (data_radio_process,
        data_radio_select_type,
        radio_function_select,
        data_data_id,
        data_data_type,
        data_name_type,
        cb_check,
        cb_apply,
        cb_appove,
        job_number,
        billing_code,
        data_option_sale,
        data_option_cs,
        data_select_search,
        inp_date_start,
        inp_data_end) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_review/get_data_table.php",
                dataType: "json",
                data: {
                    data_radio_process: data_radio_process,
                    data_radio_select_type: data_radio_select_type,
                    data_data_id: data_data_id,
                    radio_function_select: radio_function_select,
                    data_data_type: data_data_type,
                    data_name_type: data_name_type,
                    cb_check: cb_check,
                    cb_apply: cb_apply,
                    cb_appove: cb_appove,
                    job_number: job_number,
                    billing_code: billing_code,
                    data_option_sale: data_option_sale,
                    data_option_cs: data_option_cs,
                    data_select_search: data_select_search,
                    inp_date_start: inp_date_start,
                    inp_data_end: inp_data_end,
                },
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    select_filter: async function () {

        let data_radio_process = $('input[name="radio_process"]:checked').val();
        let data_radio_select_type = $('input[name="radio_select_act"]:checked').val();
        let radio_function_select = $('input[name="radio_function_select"]:checked').val();

        let cb_check = $('.cb_check').prop('checked') ? '1' : '0';
        let cb_apply = $('.cb_apply').prop('checked') ? '1' : '0';
        let cb_appove = $('.cb_appove').prop('checked') ? '1' : '0';

        let data_data_id = '';
        let data_data_type = '';
        let data_name_type = '';

        let job_number = $('.inp_job_number').val()
        let billing_code = $('.inp_billing_code').val()

        billing_code = $(`.data_list_billing_list option[billing_item_name="${billing_code}"]`).attr('number_des') ? $(`.data_list_billing_list option[billing_item_name="${billing_code}"]`).attr('number_des') : '';

        let inp_sale_code = $('.inp_sale_code').val()
        let data_option_sale = $(`.data_list_sale_list option[data_name="${inp_sale_code}"]`).attr('real_data') ? $(`.data_list_sale_list option[data_name="${inp_sale_code}"]`).attr('real_data') : '';

        let inp_cs_code = $('.inp_cs_code').val()
        let data_option_cs = $(`.data_list_cs_list option[data_name="${inp_cs_code}"]`).attr('real_data') ? $(`.data_list_cs_list option[data_name="${inp_cs_code}"]`).attr('real_data') : '';

        let data_select_search = $('.data_select_search').val()
        let inp_date_start = $('.inp_date_start').val()
        let inp_data_end = $('.inp_data_end').val()




        $.each($('.data_sic > div > button'), function () {
            let data_hasclass = $(this).hasClass('active_side')
            if (data_hasclass == true) {
                data_data_id = $(this).attr('data_id')
                data_data_type = $(this).attr('data_type')
                data_name_type = $(this).attr('name_type')

            }

        })



        // console.log(data_radio_process)
        // console.log(data_radio_select_type)
        // console.log(radio_function_select)
        // console.log(data_data_id)
        // console.log(data_data_type)
        // console.log(data_name_type)
        // console.log(cb_check)
        // console.log(cb_apply)
        // console.log(cb_appove)
        // console.log(job_number)
        // console.log(billing_code)

        let res_data = await this.ajax_get_data_table(
            data_radio_process,
            data_radio_select_type,
            radio_function_select,
            data_data_id,
            data_data_type,
            data_name_type,
            cb_check,
            cb_apply,
            cb_appove,
            job_number,
            billing_code,
            data_option_sale,
            data_option_cs,
            data_select_search,
            inp_date_start,
            inp_data_end
        )

        await this.start_setting_table(res_data)
        // if(data_radio_act == "check"){
        //     $('.table').removeClass("table_apply")
        //     $('.table').addClass("table_check")
        //     await this.data_start(res_data)

        // }else{
        //     await start_apply.data_start_apply(res_data)
        //     $('.table').removeClass("table_check")
        //     $('.table').addClass("table_apply")


        // }
    },

    mark_active: async function (e) {

        $('.active_side').removeClass('active_side');
        $(e).addClass("active_side")
        await this.select_filter()
    },

    select_type: async function () {
        let data_radio_process = $('input[name="radio_process"]:checked').val();
        let data_radio_select_type = $('input[name="radio_select_act"]:checked').val();
        if (data_radio_process == "process") {
            if (data_radio_select_type == "All") {
                $('.cb_check').prop('checked', false).attr('disabled', true)
                $('.cb_apply').prop('checked', false).attr('disabled', true)
                $('.cb_appove').prop('checked', false).attr('disabled', true)
            } else if (data_radio_select_type == "Unpaid") {
                $('.cb_check').attr('disabled', false)
                $('.cb_apply').attr('disabled', false)
                $('.cb_appove').attr('disabled', false)
            } else if (data_radio_select_type == "Paid") {
                $('.cb_check').attr('disabled', false)
                $('.cb_apply').attr('disabled', false)
                $('.cb_appove').attr('disabled', false)
            } else if (data_radio_select_type == "Reject") {
                $('.cb_check').attr('disabled', false)
                $('.cb_apply').attr('disabled', false)
                $('.cb_appove').attr('disabled', false)
            }
        } else {
            if (data_radio_select_type == "All") {
                $('.cb_check').prop('checked', false).attr('disabled', true)
                $('.cb_apply').prop('checked', false).attr('disabled', true)
                $('.cb_appove').prop('checked', false).attr('disabled', true)
            } else if (data_radio_select_type == "Unpaid") {
                $('.cb_check').attr('disabled', false)
                $('.cb_apply').attr('disabled', false)
                $('.cb_appove').attr('checked', false).attr('disabled', true)
            } else if (data_radio_select_type == "Paid") {
                $('.cb_check').attr('disabled', false)
                $('.cb_apply').attr('disabled', false)
                $('.cb_appove').attr('checked', false).attr('disabled', true)
            } else if (data_radio_select_type == "Reject") {
                $('.cb_check').prop('checked', false).attr('disabled', true)
                $('.cb_apply').prop('checked', false).attr('disabled', true)
                $('.cb_appove').prop('checked', false).attr('disabled', true)
            }
        }

        if (data_radio_select_type == "Paid") {
            $('.cb_check').attr('disabled', true).prop('checked', true)
            $('.cb_apply').attr('disabled', true).prop('checked', true)
            $('.cb_appove').attr('disabled', true).prop('checked', true)
        }
        if (data_radio_select_type == "unpaid") {
            $('.cb_check').attr('disabled', false).prop('checked', false)
            $('.cb_apply').attr('disabled', false).prop('checked', false)
            $('.cb_appove').attr('disabled', false).prop('checked', false)
        }
    },

    cal_currency: async function () {
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
            let inp_cur = $(this).find('.inp_currency').val()
            let inp_unit_price = $(this).find('.inp_amtincv').val()
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
            let inp_cur = $(this).find('.inp_currency').val()
            let inp_unit_price = $(this).find('.inp_amtincv').val()
            let data_check = '';

            let id_number = $(this).attr('id_number');
            let data_radio_select_type = $(`input[name="radio_act${id_number}"]:checked`).val();

            // console.log(data_radio_select_type)
            // console.log($(this).find('input > .radio_act :checked').val())
            inp_unit_price = parseFloat(inp_unit_price)

            if (data_radio_select_type == '2') {
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

    sent_to_job_detail: async function (data, id_number) {
        window.location = "job_detail.php" + "?job_number=" + data + "&action=invoice_mode&mode_check=approve&id_number=" + id_number;
    },




}