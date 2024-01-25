const start = {
    data_table: '',
    data_res_data_currency: '',
    data_get_table_reverse: '',
    start_setting: async function () {
        $('.head-of-menu').html('Account payment')
    },


    start_setting_table: async function (e) {

        let res_data = '';
        if (e == undefined) {
            res_data = await this.ajax_setting_data();
        } else {
            res_data = e;
        }

        this.data_table = res_data
        $('.table tbody').html('');


        let arr_data_sys_rate = []
        if (res_data['table'] != "0 results") {
            $.each(res_data['table'], function (i, v) {
                arr_data_sys_rate.push("'" + v['job_number'] + "'")
            })
        }
        arr_data_sys_rate = $.unique(arr_data_sys_rate)
        arr_data_sys_rate = arr_data_sys_rate.join(',')
        let res_data_currency = await this.ajax_setting_main_currency(arr_data_sys_rate)
        this.data_res_data_currency = '';
        this.data_res_data_currency = res_data_currency;

        
        // res_data['table']['billing_description'].sort();
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
                i++
                let html_data = ``;
                html_data = `
                    <tr class="row_data${id_number}" id_number="${id_number}">
                        <td class="text-center sticky-column">${i}</td><!-- No -->
                        <td class="text-center sticky-column"><input type="checkbox" class="cbx_data" name="cbx_data${id_number}" style="zoom:200%;" onchange="start.cal_currency()"></td><!-- check -->
                        <td class="text-center sticky-column"><input type="text" class="form-control form-control-sm inp_job_number" ></td><!-- Job number -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_bill_to" ></td><!-- bill to -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_cur text-center" ></td><!-- currency -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_total_amt text-end" ></td><!-- ??? -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_writen text-end" ></td><!-- ??? -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_write_off text-end" ></td><!-- ??? -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_sysrate" onchange="start.data_cal_sysrate()"></td><!-- sysrate -->
                        <td class="text-center">
                        <select class="form-select form-select-sm inp_sysrate_to">
                            <option value="">-</option>
                            <option value="USD">USD</option>
                            <option value="THB">THB</option>
                            <option value="RMB">RMB</option>
                            <option value="YEN">YEN</option>
                            <option value="HKD">HKD</option>
                        </select>
                        </td><!-- to curr -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_amt_incv_write_off text-end" ></td><!-- ??? -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_amt text-end" ></td><!-- ??? -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_vat text-center" ></td><!-- ???Vat -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_amt_excv text-center" ></td><!-- ??? -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_description" ></td><!-- description -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_status_paid text-center" ></td><!-- stauts paid -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_remark text-center" ></td><!-- remark -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_sales text-center" ></td><!-- sales -->
                        <td class="text-center"><input type="text" class="form-control form-control-sm inp_billing_date text-center" ></td><!-- billing date -->
                    </tr>
                    `;

                $('.table tbody').append(html_data)




                if (amount != 0 || amount != null || amount != '') {
                    amount = parseFloat(amount)
                    amount = amount.toFixed(2)
                }
                let data_amt_not_vat = qty * unit_price
                data_amt_not_vat = data_amt_not_vat.toFixed(2)

                // console.log(data_amt_not_vat)
                amtinclvat = parseFloat(amtinclvat)
                amtinclvat = amtinclvat.toFixed(2)
                $(`.table > tbody > .row_data${id_number} > td > .inp_job_number`).val(job_number).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_bill_to`).val(billing_description).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_cur`).val(currency).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_total_amt`).val(amtinclvat).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_writen`).val(amtinclvat).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_write_off`).val(amtinclvat).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_sysrate`).val(sys_rate).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_sysrate_to`).val(currency_main).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_amt_incv_write_off`).val(amtinclvat).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_amt`).val(data_amt_not_vat).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_vat`).val(vat).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_amt_excv`).val(with_holding_tax).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_description`).val(bill_to_c).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_status_paid`).val()
                $(`.table > tbody > .row_data${id_number} > td > .inp_remark`).val(remark).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_sales`).val(sale_support_f + ' ' + sale_support_l).attr('disabled', true)
                $(`.table > tbody > .row_data${id_number} > td > .inp_billing_date`).val(create_data_time).attr('disabled', true)


                // currency_select_main
                // console.log(res_data_currency)




            })

        }
        await this.cal_currency();
        await this.data_cal_sysrate();
        await start.change_currency();

    },

    change_currency: async function () {
        let data_val = $(`.inp_currency_main_change`).val()
        $(`.table tbody tr td .inp_sysrate_to`).val(data_val)
        let res_data_currency = this.data_res_data_currency
        // console.log(res_data_currency)
        // console.log(res_data_currency)
        let e_path = $('.table_payment > tbody tr')
        // console.log(e_path)
        $.each(e_path, function () {
            let currency = $(this).find('.inp_cur').val()
            let currency_to = $(this).find('.inp_sysrate_to').val()
            let job_number = $(this).find('.inp_job_number').val()
            let write_off = $(this).find('.inp_write_off').val()
            let lcurrency = currency.toLowerCase();
            let lcurrency_to = currency_to.toLowerCase();
            let data_find = 0;
            let data_cal = 0;
            let data_currency_id = '';
            // console.log(lcurrency + "_" + lcurrency_to)
            $.each(res_data_currency['currency'], function (i, v) {
                if (v['job_number'] == job_number) {
                    data_find = v[`${lcurrency + "_" + lcurrency_to}`] ? v[`${lcurrency + "_" + lcurrency_to}`] : 1 ;
                    // console.log(data_find)
                    data_cal = parseFloat(data_find * write_off)
                    data_cal = data_cal.toFixed(2)
                    data_currency_id = v['data_currency_id'];
                    return;
                }
            })
            $(this).find('.inp_sysrate').val(data_find).attr("data_currency_id", `${data_currency_id}`)
            $(this).find('.inp_amt_incv_write_off').val(data_cal)
        })


        // $.each(res_data_currency['currency'],function(i1,va){
        //     lcurrency = currency.toLowerCase();
        //     lcurrency_select_main = currency_select_main.toLowerCase();


        //     let job_number_va = va['job_number'] ? va['job_number'] : '';

        //     let data_find = '';
        //     if(job_number_va == job_number){
        //         data_find = va[`${lcurrency+"_"+lcurrency_select_main}`]




        //     }

        // })


        await this.cal_currency();

    },

    ajax_setting_main_currency: async function (arr_data_sys_rate) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/get_payment_currency.php",
                dataType: "json",
                data: { arr_data_sys_rate: arr_data_sys_rate },
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    ajax_setting_data: async function (
        data_radio_process,
        data_radio_select_type,
        data_data_id,
        data_data_type,
        data_name_type,
        job_number,
        dn_cn
    ) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/get_data_table.php",
                dataType: "json",
                data: {
                    data_radio_process: data_radio_process,
                    data_radio_select_type: data_radio_select_type,
                    data_data_id: data_data_id,
                    data_data_type: data_data_type,
                    data_name_type: data_name_type,
                    job_number: job_number,
                    dn_cn: dn_cn
                },
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    mark_active: async function (e) {
        $('.active_side').removeClass('active_side');
        $(e).addClass("active_side")
        await this.select_filter()
    },

    select_filter: async function () {

        let data_radio_process = $('input[name="radio_process"]:checked').val();
        let data_radio_select_type = $('input[name="radio_function_paid"]:checked').val();
        let job_number = $('.inp_job_number_filter').val() ? $('.inp_job_number_filter').val() : '';

        if (data_radio_process == "Rprocess") {
            $('.table_payment thead').html('')
            let thead_rprocess = `
            
                <tr class="text-center" style="zoom:90%">
                    <th class="sticky-column">No</th>
                    <th class="sticky-column">select</th>
                    <th class="sticky-column">Job#</th>
                    <th>Code</th>
                    <th>Cur</th>
                    <th>AMTINCV</th>
                    <th>Outstanding</th>
                    <th>settlement</th>
                    <th>actual
                        <br>ex.rate
                    </th>
                    <th>actual<br>curr.</th>
                    <th>Total</th>
                    <th>Amt</th>
                    <th>Vat(%)</th>
                    <th>WHT</th>
                    <th>Customer</th>
                    <th>Finish</th>
                    <th>Remark</th>
                    <th>Sales</th>
                    <th>billing date</th>
                </tr>
            
            `;
            $('.table_payment thead').append(thead_rprocess)

            let data_data_id = '';
            let data_data_type = '';
            let data_name_type = '';
            let dn_cn = $('.inp_dn_cn').val() ? $('.inp_dn_cn').val() : '';
            $.each($('.data_sic > div > button'), function () {
                let data_hasclass = $(this).hasClass('active_side')
                if (data_hasclass == true) {
                    data_data_id = $(this).attr('data_id')
                    data_data_type = $(this).attr('data_type')
                    data_name_type = $(this).attr('name_type')
                }

            })
            let res_data = await this.ajax_setting_data(
                data_radio_process,
                data_radio_select_type,
                data_data_id,
                data_data_type,
                data_name_type,
                job_number,
                dn_cn
            )

            await this.start_setting_table(res_data)
        } else {


            await this.setting_processing(data_radio_select_type, job_number);
        }

    },

    setting_processing: async function (data_radio_select_type, job_number) {
        let res_data = await this.ajax_request_data_payment(data_radio_select_type, job_number)
        // console.log(res_data)
        $('.table_payment thead').html('')
        $('.data_currency_usd').html('')
        $('.data_currency_thb').html('')
        $('.data_currency_rmb').html('')
        $('.data_currency_hkd').html('')
        $('.data_currency_yen').html('')

        let thead_rprocess = `
        <tr class="text-center" style="zoom:90%">
        <th class="sticky-column">序号</th>
        <th class="sticky-column">收付单号</th>
        <th class="sticky-column">结算单位</th>
        <th>销账日期</th>
        <th>系统销账币种</th>
        <th>系统销账总金额</th>
        <th>系统单号</th>
        <th>实际收款币种</th>
        <th>实际收款总金额</th>
        <th>备注</th>
        <th>经手人</th>
        <th>业务员</th>
        <th></th>
        <tr>
        
        <tr class="text-center" style="zoom:90%">
        <th class="sticky-column">No</th>
        <th class="sticky-column">PAYMENT/RECEIPT<br>NUMBER</th>
        <th class="sticky-column">NUMBER</th>
        <th>Write-off date</th>
        <th>CURR</th>
        <th>The total amount of<br>system write-offs</th>
        <th>JOB NO.</th>
        <th>CURR.</th>
        <th>Actual total <br> amount received</th>
        <th>REMARK</th>
        <th>Handler</th>
        <th>SALEMEN</th>
        <th>Action</th>
        </tr>
            `;
        $('.table_payment thead').append(thead_rprocess)
        $('.table_payment tbody').html('')
        // console.log(res_data)
        $.each(res_data['table'], function (i, v) {
            let id_number = v['ID'] ? v['ID'] : '';
            let ref_billing_id = v['ref_billing_id'] ? v['ref_billing_id'] : '';
            let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
            let paid_by = v['paid_by'] ? v['paid_by'] : '';
            let paid_date_time = v['paid_date_time'] ? v['paid_date_time'] : '';
            let status_billing = v['status_billing'] ? v['status_billing'] : '';
            let paid_amt = v['paid_amt'] ? v['paid_amt'] : '';
            let document_payment = v['document_payment'] ? v['document_payment'] : '';
            let type_document = v['type_document'] ? v['type_document'] : '';
            let pay_at = v['pay_at'] ? v['pay_at'] : '';
            let tranfer_method = v['tranfer_method'] ? v['tranfer_method'] : '';
            let total_payment = v['total_payment'] ? v['total_payment'] : '';
            let bank_account = v['bank_account'] ? v['bank_account'] : '';
            let payment_date = v['payment_date'] ? v['payment_date'] : '';
            let write_off_date = v['write_off_date'] ? v['write_off_date'] : '';
            let remark = v['remark'] ? v['remark'] : '';
            let ref_billing = v['ref_billing'] ? v['ref_billing'] : '';
            let bank_code = v['bank_code'] ? v['bank_code'] : '';
            let consignee_name = v['consignee_name'] ? v['consignee_name'] : '';
            let currency_start = v['currency_start'] ? v['currency_start'] : '';
            let currency_end = v['currency_end'] ? v['currency_end'] : '';
            let hanler = v['hanler'] ? v['hanler'] : '';
            let sale = v['sale'] ? v['sale'] : '';
            let job_number = v['job_number'] ? v['job_number']: '';
            let total_start = v['total_start'] ? v['total_start']: "0.00";
            let hanler_data = v['hanler_data'] ? v['hanler_data'] : '';
            let sale_data = v['sale_data'] ? v['sale_data'] : '';
            // console.log(job_number)
            // console.log(total_start)
            i++;
            let html_data = `
            <tr id_process="${id_number}" class="row_id_number${id_number}">
                <td class="text-center">${i}</td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_document_payment"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_consignee"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_writeoff_date"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_currency_start"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-end inp_total_start"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_job_number_data"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_currency_end"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-end inp_total_end"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_remark_data_list"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_handler"></td>
                <td><input style="width:100%;"class="form-control form-control-sm text-center inp_saleman"></td>
                <td class="text-center"><button class="btn btn-sm btn-warning" onclick="process_part.process_reverse(${id_number})">edit</button></td>

            </tr>
            `;


            $('.table_payment > tbody').append(html_data)

            $(`.row_id_number${id_number} > td > .inp_document_payment`).val(document_payment).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_consignee`).val(consignee_name).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_writeoff_date`).val(write_off_date).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_currency_start`).val(currency_start).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_total_start`).val(total_start).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_job_number_data`).val(job_number).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_currency_end`).val(currency_end).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_total_end`).val(paid_amt).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_remark_data_list`).val(remark).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_handler`).val(hanler_data).attr('disabled', true)
            $(`.row_id_number${id_number} > td > .inp_saleman`).val(sale_data).attr('disabled', true)
            
            // $(`.row_id_number${id_number} > td > .inp_total_start`).val(write_off_date).attr('disabled', true)
            // $(`.row_id_number${id_number} > td > .inp_job_number_data`).val(write_off_date).attr('disabled', true)
            // $(`.row_id_number${id_number} > td > .inp_currency_end`).val(write_off_date).attr('disabled', true)
            // $(`.row_id_number${id_number} > td > .inp_total_end`).val(total_payment).attr('disabled', true)
            // $(`.row_id_number${id_number} > td > .inp_remark_data_list`).val(write_off_date).attr('disabled', true)
            // $(`.row_id_number${id_number} > td > .inp_handler`).val(write_off_date).attr('disabled', true)
            // $(`.row_id_number${id_number} > td > .inp_saleman`).val(write_off_date).attr('disabled', true)
            
        })

        this.data_get_table_reverse = res_data


    },

    ajax_request_data_payment: async function (data_radio_select_type, job_number) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/get_data_process.php",
                data: {
                    data_radio_select_type: data_radio_select_type,
                    job_number: job_number,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    data_cal_sysrate: async function () {
        // console.log(1)
        let e_path = $(`.table > tbody > tr`)
        $.each(e_path, function () {

            let data_write_off = $(this).find('.inp_write_off').val()
            let data_sysrate = $(this).find('.inp_sysrate').val()

            data_write_off = parseFloat(data_write_off)
            data_sysrate = parseFloat(data_sysrate)

            let data_total = data_write_off * data_sysrate

            data_total = data_total.toFixed(2)

            $(this).find('.inp_amt_incv_write_off').val(data_total)
        })
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

        let actual_amt_total = 0;

        $.each(e_path, function () {
            let inp_unit_price = $(this).find('.inp_amt_incv_write_off').val()
            inp_unit_price = parseFloat(inp_unit_price)
            let data_radio_select_type = $(this).find(`.cbx_data`).prop("checked") ? '1' : '0';
            if (data_radio_select_type == '1') {
                actual_amt_total = actual_amt_total + inp_unit_price;
            }
        })



        $.each(e_path, function () {
            let inp_cur = $(this).find('.inp_sysrate_to').val()
            let inp_unit_price = $(this).find('.inp_amt_incv_write_off').val()
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
            let inp_cur = $(this).find('.inp_sysrate_to').val()
            let inp_unit_price = $(this).find('.inp_amt_incv_write_off').val()
            let data_check = '';
            let id_number = $(this).attr('id_number');
            // console.log(id_number)
            let data_radio_select_type = $(this).find(`.cbx_data`).prop("checked") ? '1' : '0';

            inp_unit_price = parseFloat(inp_unit_price)

            if (data_radio_select_type == '1') {
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


        $('.data_currency_usd').html('')
        $('.data_currency_thb').html('')
        $('.data_currency_rmb').html('')
        $('.data_currency_yen').html('')
        $('.data_currency_hkd').html('')
        $('.data_currency_review_usd').html('')
        $('.data_currency_review_thb').html('')
        $('.data_currency_review_rmb').html('')
        $('.data_currency_review_yen').html('')
        $('.data_currency_review_hkd').html('')

        $('.inp_actual_amt_total').val('')

        actual_amt_total = actual_amt_total.toFixed(2)
        $('.inp_actual_amt_total').val(actual_amt_total)


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



    ajax_get_bank_data: async function () {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/get_data_bank.php",
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },



    generate_inv: async function () {

        if ($('#modal_account_payment').length >= 1) {
            $('#modal_account_payment').remove()
        }
        let e_path = $('.table tbody tr')
        let html_modal_data_table = '';
        let get_total_data_incl_all = 0;
        let get_total_incl = 0;
        let arr_data_customer = []
        let arr_data_sale = []

        let arr_check_lunch = []
        $.each(e_path, function () {
            let data_check_prop = $(this).find('.cbx_data').prop("checked") ? '1' : '0';
            let id_number = $(this).attr('id_number')

            if (data_check_prop == '1') {
                arr_check_lunch.push(id_number)
            }
        })

        if (arr_check_lunch.length <= '0') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select list before save',
            })
            return;
        } else {
            let data_table_check = this.data_table['table']
            let arr_consignee_check = []
            let arr_currency_data = []
            $.each(arr_check_lunch, function (i, v) {
                $.each(data_table_check, function (i1, v1) {
                    if (v == v1['ID']) {
                        let bill_to_type = v1['bill_to_type'] ? v1['bill_to_type'] : '';
                        let bill_to = v1['bill_to'] ? v1['bill_to'] : '';
                        let currency_data = v1['currency'] ? v1['currency']: '';
                        let main_find = bill_to_type + "_" + bill_to
                        // console.log(main_find)
                        if (!arr_consignee_check !== main_find) {
                            arr_consignee_check.push(main_find)
                        }
                        if(!arr_currency_data !== currency_data){
                            arr_currency_data.push(currency_data)
                        }

                    }
                })
            })
            
            // arr_consignee_check = arr_consignee_check.unique()
            arr_consignee_check = [...new Set(arr_consignee_check)];
            //console.log(arr_consignee_check)

            arr_currency_data = [...new Set(arr_currency_data)];
            // arr_currency_data = arr_currency_data.join(',')
            // console.log(arr_currency_data)

            if (arr_consignee_check.length > 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Consignee is not duplicate please change payment',
                })
                return;
            }else if(arr_currency_data.length > 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please check currency again because currency is not same',
                })
            } else {
                i = 0;
                $.each(e_path, function () {
                    let data_check_prop = $(this).find('.cbx_data').prop("checked") ? '1' : '0';
                    if (data_check_prop == '1') {
                        i++;

                        let id_number = $(this).attr('id_number')
                        // arr_id_number_data.push(id_number)
                        let data_job_number = $(this).find('.inp_job_number').val()
                        let bill_to = $(this).find('.inp_bill_to').val()
                        let cur = $(this).find('.inp_cur').val()
                        let total_amt = $(this).find('.inp_total_amt').val()
                        let writen = $(this).find('.inp_writen').val()
                        let write_off = $(this).find('.inp_write_off').val()
                        let sysrate = $(this).find('.inp_sysrate').val()
                        let sysrate_to = $(this).find('.inp_sysrate_to').val()
                        let amt_incv_write_off = $(this).find('.inp_amt_incv_write_off').val()
                        let vat = $(this).find('.inp_vat').val()
                        let description_customer = $(this).find('.inp_description').val()
                        let data_currency_id = $(this).find('.inp_sysrate').attr('data_currency_id')
                        amt_incv_write_off = parseFloat(amt_incv_write_off)
                        write_off = parseFloat(write_off)
                        get_total_incl = get_total_incl + write_off
                        get_total_data_incl_all = get_total_data_incl_all + amt_incv_write_off
                        amt_incv_write_off = amt_incv_write_off.toFixed(2)
                        write_off = write_off.toFixed(2)
                        arr_data_sale.push(id_number)
                        arr_data_customer.push(description_customer)

                        html_modal_data_table += `
                            <tr class="text-center" data_number_id="${id_number}">
                                <td>${i}</td>
                                <td><input type="checkbox" style="zoom:150%" class="chex_box_modal" checked="" onchange="start.condition_data_on_modal()"></td>
                                <td><input class="form-control form-control-sm" readonly value="${data_job_number}"></td>
                                <td><input class="form-control form-control-sm" readonly value="${bill_to}"></td>
                                <td><input class="form-control form-control-sm text-center" readonly value="${cur}"></td>
                                <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                                <td><input class="form-control form-control-sm text-end" readonly value="${writen}"></td>
                                <td><input class="form-control form-control-sm text-end" readonly value="${write_off}"></td>
                                <td><input class="form-control form-control-sm text-center data_currency" readonly data_currency_id="${data_currency_id}" value="${sysrate}"></td>
                                <td><input class="form-control form-control-sm text-center inp_currency_to"  readonly value="${sysrate_to}"></td>
                                <td><input class="form-control form-control-sm text-end data_incv_wrute_off" readonly value="${amt_incv_write_off}"></td>
                                <td><input class="form-control form-control-sm" readonly value=""></td>
                                <td><input class="form-control form-control-sm text-center" readonly value="${vat}"></td>
                            </td>
                            `;
                    }
                })
                html = `
                        <div class="modal" id="modal_account_payment" data-bs-backdrop="true">
                            <div class="modal-dialog modal-xl ">
                                <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72); ">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Data processing</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body " >
                                        <div class="detail_description" style="zoom:80%">
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn btn-outline-primary btn-sm" onclick="start.save_data_payment()">OK</button>
                                                    <!-- <button class="btn btn-outline-primary btn-sm">Print</button> -->
                                                    <button class="btn btn-outline-primary btn-sm" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                <!-- row 1 -->
                                                <div class="row mt-2">
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">收付类型 Payment Type </label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_payment_type" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">结算单位 settlement unit</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_consignee_data_detail">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">业务员 saleman</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_sale_man">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">销账日期 write-off date</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="date" class="form-control form-control-sm inp_write_off_date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- row2 -->
                                                <div class="row mt-2">
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">收付单号 Payment receipt number</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_payment_document">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">系统销账总额 total system write-offs</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input type="text" class="form-control form-control-sm text-end inp_amount_all_write_off">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <input type="text" class="form-control form-control-sm text-center inp_currency_main_write_off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                    <!--    <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">Tranfer To Bank name</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_tranfer_to_bank_name">
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">经手人 handler</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_handler">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- row 3 -->
                                                <div class="row mt-2">
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">收付地点 payment place</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <select class="form-select form-select-sm sel_data_payment_place" onchange="start.set_payment_place()">
                                                                    <option value="TH">TH</option>
                                                                    <option value="CN">CN</option>
                                                                    <option value="HK">HK</option>
                                                                    <option value="US">US</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">实际付款总额 Actual total payment</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input type="text" class="form-control form-control-sm text-end inp_amount_all">
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <input type="text" class="form-control form-control-sm text-center inp_currency_main">
                                                                <input type="hidden" class="form-control form-control-sm text-center inp_currency_start">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <!-- <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">Tranfer to bank number</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_tranfer_to_bank_number">
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">备注 Remark</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_remark_data_modal">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- row4 -->
                                                <div class="row mt-2">
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">付款方式 payment method</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <select class="form-select form-select-sm inp_method_cash">
                                                                    <option value="tranfer">Tranfer</option>
                                                                    <option value="cash">Cash</option>
                                                                    <option value="hedge">Hedge</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">付款记录数 number of payment records</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_number_payment_record">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                    <div class="text-center">
                                                        <i class="bi bi-image" id="blah" src="" onclick="start.show_photo(this)"></i>
                                                    </div>

                                                        
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                                <div class="col-lg-5">
                                                                    <label for="">Upload file receipt</label>
                                                                </div>
                                                                <div class="col-lg-7">
                                                                    <input type="file" class="form-control form-control-sm inp_file_receipt" onchange="readURL(this)">
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <!-- row5 -->
                                                <div class="row mt-2">
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for>序号 number<label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_number_rec">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">付款日期 payment date</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="date" class="form-control form-control-sm inp_payment_date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">银行账号 bank account</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <select class="form-select form-select-sm inp_bank_account">
                                                                    <option value="">-- select bank account --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="row">
                                                            <div class="col-lg-5">
                                                                <label for="">实际付款金额 actual payment amount</label>
                                                            </div>
                                                            <div class="col-lg-7">
                                                                <input type="text" class="form-control form-control-sm inp_acual_payment">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="data_table mt-2" style="zoom:80%">
                                            <div class="table-responsive">
                                                <table class="table table-hover table_list_data_processing">
                                                    <thead >
                                                        <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>OK</th>
                                                        <th>Job</th>
                                                        <th>Fee</th>
                                                        <th>Cur</th>
                                                        <th>AR/AP Total</th>
                                                        <th>Outstanding</th>
                                                        <th>Settlement</th>
                                                        <th>actual<br>ex.rate</th>
                                                        <th>actual<br>currency</th>
                                                        <th>Curr</th>
                                                        <th>Anootated</th>
                                                        <th>vat(%)</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        ${html_modal_data_table}
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            `;
                $('body').append(html)

                let data_radio_select_type = $('input[name="radio_function_paid"]:checked').val() == "AR" ? 'Receiv' : 'Paid';
                let data_val = $(`.inp_currency_main_change`).val()


                let data_unique_customer = $.unique(arr_data_customer);
                data_unique_customer = data_unique_customer.join(',')
                // console.log(v1)
                let data_all_sale = []
                let data_all_create = []
                let data_cs_support = []
                let data_sale_support = []

                $.each(this.data_table['table'], function (i, v) {
                    $.each(arr_data_sale, function (i1, v1) {
                        if (v['ID'] == v1) {
                            let cs_support_number = v['cs_support_number'] ? v['cs_support_number'] : '';
                            let create_by_f = v['create_by_f'] ? v['create_by_f'] : '';
                            let create_by_l = v['create_by_l'] ? v['create_by_l'] : '';

                            data_all_create.push(create_by_f + ' ' + create_by_l)
                            data_cs_support.push(cs_support_number)
                        }
                        return;
                    })
                })

                // console.log(this.data_table)
                $.each(this.data_table['table'], function (i, v) {
                    $.each(arr_data_sale, function (i1, v1) {
                        if (v['ID'] == v1) {
                            let sale_support_number = v['sale_support_number'] ? v['sale_support_number'] : '';
                            let sale_support_f = v['sale_support_f'] ? v['sale_support_f'] : '';
                            let sale_support_l = v['sale_support_l'] ? v['sale_support_l'] : '';

                            data_all_sale.push(sale_support_f + ' ' + sale_support_l)
                            data_sale_support.push(sale_support_number)
                        }
                        return;
                    })
                })
                let data_sale = $.unique(data_all_sale);
                data_sale = data_sale.join(',')

                let data_create = $.unique(data_all_create);
                data_create = data_create.join(',')
                let data_cs_support_number = $.unique(data_cs_support)
                let data_sale_support_number = $.unique(data_sale_support)

                data_cs_support_number = data_cs_support_number.join(',')
                data_sale_support_number = data_sale_support_number.join(',')
                
                //inp_amount_all_write_off
                //inp_currency_main_write_off
                let path_table = $('.table_payment > tbody > tr');
                let data_all_amount = 0;
                let count_all = 0;
                $.each(path_table, function () {
                    let data_cbx = $(this).find('.cbx_data').prop('checked') ? '1' : '0';
                    if (data_cbx == '1') {
                        count_all++;
                        let data_all_amount_cal = parseFloat($(this).find('.inp_amt_incv_write_off').val())
                        data_all_amount = data_all_amount + data_all_amount_cal
                    }

                })
                data_all_amount = data_all_amount.toFixed(2)
                get_total_data_incl_all = get_total_data_incl_all.toFixed(2)



                $('.inp_acual_payment').val(get_total_incl).attr('disabled', true)// 
                $('.inp_payment_type').val(data_radio_select_type).attr('disabled', true)
                $('.inp_amount_all').val(get_total_data_incl_all).attr('disabled', true)
                $('.inp_currency_main').val(data_val).attr('disabled', true)
                $('.inp_number_payment_record').val(count_all).attr('disabled', true)
                $('.inp_sale_man').val(data_sale).attr('disabled', true).attr('data_sale',data_sale_support_number)
                $('.inp_consignee_data_detail').val(data_unique_customer).attr('disabled', true)
                $('.inp_handler').val(data_create).attr('disabled', true).attr('data_hanler',data_cs_support_number)
                $('.inp_currency_start').val(arr_currency_data[0])

                $('.inp_number_rec').val(i).attr('disabled', true)
                $('#modal_account_payment').modal('show')

                $('.inp_amount_all_write_off').val(data_all_amount).attr('disabled', true)
                $('.inp_currency_main_write_off').val(data_val).attr('disabled', true)

                let res_data_bank = await this.ajax_get_bank_data();
                let data_bank_account = '';
                if (res_data_bank['bank'] != "0 results") {
                    $.each(res_data_bank['bank'], function (i, v) {
                        if (v['bank_code'] != null) {
                            data_bank_account += `<option value="${v['ID']}">${v['bank_code']}</option>`

                        }
                    })
                    $('.inp_bank_account').append(data_bank_account)
                }
                // console.log(res_data_bank['bank'])
                await this.set_payment_place();

            }
        }
    },

    set_payment_place: async function () {
        //setting document nubmer

        let data_radio_select_type = $('input[name="radio_function_paid"]:checked').val();
        let data_payment_place = $('.sel_data_payment_place').val()

        let res_data = await this.ajax_get_last_payment(data_radio_select_type, data_payment_place);
        let number_document_auto = `${data_radio_select_type + data_payment_place + res_data}`;

        $('.inp_payment_document').val(number_document_auto).attr('disabled', true)


    },

    ajax_get_last_payment: async function (data_radio_select_type, data_payment_place) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/get_last_payment.php",
                data: {
                    data_radio_select_type: data_radio_select_type,
                    data_payment_place: data_payment_place
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },




    condition_data_on_modal: async function () {
        // console.log(8888)
        let e_path = $('.table tbody tr')
        let data_cal_currency = 0;
        let bdo = 0;
        $.each(e_path, function () {

            let data_check_prop = $(this).find('.chex_box_modal').prop("checked") ? '1' : '0';
            if (data_check_prop == '1') {
                bdo++;
                let data_incv_wrute = $(this).find('.data_incv_wrute_off').val()
                data_incv_wrute = parseFloat(data_incv_wrute)
                data_cal_currency = data_cal_currency + data_incv_wrute
            }
        })
        // console.log(data_cal_currency)
        data_cal_currency = data_cal_currency.toFixed(2)
        $('.inp_amount_all').val(data_cal_currency)
        $('.inp_number_rec').val(bdo)
        // $('.inp_amount_all').val(data_cal_currency)
        // console.log(data_cal_currency)
    },

    select_all_check: async function () {
        $('.table_payment tbody tr td .cbx_data').prop('checked', true)
    },
    un_select_all_check: async function () {
        $('.table_payment tbody tr td .cbx_data').prop('checked', false)
    },

    save_data_payment: async function () {
        let patment_document_number = $('.inp_payment_document').val()
        let customer_name = $('.inp_consignee_data_detail').val()
        let payment_place = $('.sel_data_payment_place').val()
        let method_payment = $('.inp_method_cash').val()
        let amount_payment = $('.inp_amount_all').val()
        let currency = $('.inp_currency_main').val()
        let payment_date = $('.inp_payment_date').val()
        let write_off_date = $('.inp_write_off_date').val()
        let bank_account = $('.inp_bank_account').val()
        let remark_data = $('.inp_remark_data_modal').val()
        
        let base_64_file = $('.inp_file_receipt').prop('files')[0];
        let data_currency_start = $('.inp_currency_start').val()
        let data_currency_write_off = $('.inp_currency_main_write_off').val()
        let data_hanler = $('.inp_handler').attr('data_hanler')
        let data_sale = $('.inp_sale').attr('data_sale')
        let payment_type = patment_document_number.substring(0, 2);
        // console.log(data_currency_start)
        // console.log(data_currency_write_off)
        // console.log(data_hanler)
        // console.log(data_sale)
        let Base_64_file_base = '';
        let type_data = '';
        let name_file = '';
        if (base_64_file != undefined) {
            type_data = base_64_file.type ? base_64_file.type : '';
            name_file = base_64_file.name ? base_64_file.name : '';
            Base_64_file_base = await convert_file(base_64_file);
        }

        let e_path = $('.table_list_data_processing tbody tr')

        let arr_data_get_number_check = []
        $.each(e_path, function () {
            let data_check = $(this).find('.chex_box_modal').prop('checked') ? '1' : '0';
            if (data_check == '1') {
                let data_number_id = $(this).attr('data_number_id')
                arr_data_get_number_check.push(data_number_id)
            }
        })

        // console.log(base_64_file)
        arr_data_get_number_check = arr_data_get_number_check.join(',')
        // console.log(arr_data_get_number_check)

        let arr_data_get_title = []
        let obj_data_get_title = {
            patment_document_number: patment_document_number,
            payment_place: payment_place,
            method_payment: method_payment,
            amount_payment: amount_payment,
            currency: currency,
            payment_date: payment_date,
            write_off_date: write_off_date,
            bank_account: bank_account,
            list_description: arr_data_get_number_check,
            remark_data: remark_data,
            payment_type: payment_type,
            customer_name: customer_name,
            type_data: type_data,
            name_file: name_file,
            data_currency_start : data_currency_start,
            data_currency_write_off : data_currency_write_off,
            data_hanler : data_hanler,
            data_sale : data_sale,
            Base_64_file_base: Base_64_file_base,
        }
        arr_data_get_title.push(obj_data_get_title)

        let arr_data_get_list = []
        $.each(e_path, function () {
            let data_check = $(this).find('.chex_box_modal').prop('checked') ? '1' : '0';
            let data_currency_to = $(this).find('.inp_currency_to').val()
            if (data_check == '1') {
                let data_number_id = $(this).attr('data_number_id')
                let data_currency = $(this).find('.data_currency').attr('data_currency_id')
                let amount = $(this).find('.data_incv_wrute_off').val()
                let obj_data = {
                    data_number_id: data_number_id,
                    amount: amount,
                    currency: data_currency_to,
                    data_currency: data_currency,
                }
                arr_data_get_list.push(obj_data)
            }
        })
        console.log(arr_data_get_title)
        // console.log(arr_data_get_list)

        if (arr_data_get_list.length < 1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select checked on list for save',
            })
            return;
        } else {
            if (payment_date == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter payment date',
                })
            } else if (bank_account == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please choose bank account',
                })
            } else if (write_off_date == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please enter write off date',
                })
            } else if (base_64_file == undefined) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'please choose pictrue file',
                })
            } else {
                let res_data = await this.ajax_save_data_payment(arr_data_get_title, arr_data_get_list)
                // console.log(res_data)
                if (res_data['res_detail_title'] == '1' && res_data['res_detail_list'] == '1') {
                    Swal.fire(
                        'Save it!',
                        'Your file has been save.',
                        'success'
                    )
                    await $('#modal_account_payment').modal('toggle');
                    await this.select_filter();
    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data is problem pls. contact to tech team',
                    })
                }
            }
            
        }



    },

    ajax_save_data_payment: async function (arr_data_get_title, arr_data_get_list) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/save_processing.php",
                data: {
                    arr_data_get_title: arr_data_get_title,
                    arr_data_get_list: arr_data_get_list,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    show_photo: async function (e) {

        let data_pho = $(e).attr('src')
        //  console.log($(e)
        var newTab = window.open();
        newTab.document.write('<html><body><img id="imageDisplay" src="' + data_pho + '"></body></html>');


    },




}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {

            $('#blah').attr('src', e.target.result);
            $('#blah').addClass("text-primary")
        };

        reader.readAsDataURL(input.files[0]);
    }
}

async function convert_file(data) {

    const base64String = await toBase64(data);
    return (base64String);
}

function toBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}

