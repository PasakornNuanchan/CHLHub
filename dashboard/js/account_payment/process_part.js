const process_part = {
    res_data_currency1: [],
    process_reverse: async function (e) {

        let res_data_list = await this.ajax_get_data_process_reverse(e)
        let html_data_list = ``;
        //currency sysrate
        let arr_data_sys_rate = []
        if (res_data_list['list'] != "0 results") {
            $.each(res_data_list['list'], function (i, v) {
                arr_data_sys_rate.push("'" + v['job_number_data'] + "'")
            })
        }
        arr_data_sys_rate = $.unique(arr_data_sys_rate)
        arr_data_sys_rate = arr_data_sys_rate.join(',')
        let res_data_currency = await start.ajax_setting_main_currency(arr_data_sys_rate)
        let res_data_bank = await start.ajax_get_bank_data();
        let data_bank_account = '';
        let b = 0;
        let data_arr_sale = '';
        let data_arr_cs = '';
        


        if (res_data_list['list'] != "0 results") {
            $.each(res_data_list['list'], function (i, v) {
                b++;
                let id_number = v['ID'] ? v['ID'] : '';
                let data_job_number = v['job_number_data'] ? v['job_number_data'] : '';
                let bill_to = v['billing_des'] ? v['billing_des'] : '';
                let cur = v['currency'] ? v['currency'] : '';
                let total_amt = v['amtinclvat'] ? v['amtinclvat'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                let amount_bpl = v['amount_bpl'] ? v['amount_bpl'] : '';
                let currency_bpl = v['currency_bpl'] ? v['currency_bpl'] : '';

                let lcur = cur.toLowerCase();
                let lcurrency_bpl = currency_bpl.toLowerCase();
                let sysrate_data = 0;

                var arr_cs = []
                var arr_sale = []

                let status_list = v['status_list'] == '1' ? `checked=""` : '';
                // console.log(status_list)
                $.each(res_data_currency['currency'], function (i, v) {
                    let job_number_data = v['job_number'] ? v['job_number'] : '';
                    if (job_number_data == data_job_number) {
                        sysrate_data = lcur == lcurrency_bpl ? 1 : v[`${lcur + '_' + lcurrency_bpl}`];
                        let sale_f = v['sale_f'] ? v['sale_f'] : '';
                        let sale_l = v['sale_l'] ? v['sale_l'] : '';
                        let cs_f = v['cs_f'] ? v['cs_f'] : '';
                        let cs_l = v['cs_l'] ? v['cs_l'] : '';
                        let data_sale = (sale_f + ' ' + sale_l)
                        let data_cs = (cs_f + ' ' + cs_l)

                        arr_sale.push(data_sale)
                        arr_cs.push(data_cs)
                    }

                })

                arr_sale = $.unique(arr_sale)
                arr_cs = $.unique(arr_cs)

                data_arr_sale = arr_sale.join(',')
                data_arr_cs = arr_cs.join(',')

                total_amt = parseFloat(total_amt)
                amount_bpl = parseFloat(amount_bpl)

                total_amt = total_amt.toFixed(2)
                amount_bpl = amount_bpl.toFixed(2)
                i++;
                html_data_list += `
                    <tr class="text-center data_number_id_${id_number}" data_number_id="${id_number}" hv="1">
                        <td>${i}</td>
                        <td><input type="checkbox" style="zoom:150%" class="chex_box_modal chx_as_box_modal" ${status_list} onchange="process_part.cancle_in_row(this)" onclick="process_part.cal_data('reverse')"></td>
                        <td><input class="form-control form-control-sm" readonly value="${data_job_number}"></td>
                        <td><input class="form-control form-control-sm" readonly value="${bill_to}"></td>
                        <td><input class="form-control form-control-sm text-center currency_start" readonly value="${cur}"></td>
                        <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-end inp_total inp_total${id_number}"real_data_show="${total_amt}" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-center inp_sysrate" real_data_show="${sysrate_data}" readonly value="${sysrate_data}"></td>
                        <td><input class="form-control form-control-sm text-center inp_currency_to" real_data_show="${currency_bpl}" readonly value="${currency_bpl}"></td>
                        <td><input class="form-control form-control-sm text-end data_incv_wrute_off" real_data_show="${amount_bpl}" readonly value="${amount_bpl}"></td>
                        <td><input class="form-control form-control-sm" readonly value=""></td>
                        <td><input class="form-control form-control-sm text-center" readonly value="${vat}"></td>
                    </tr>
                `;

            })
        }


        let radio_function_paid = $('input[name="radio_function_paid"]:checked').val();

        if ($('#modal_account_payment').length >= 1) {
            $('#modal_account_payment').remove()
        }

        console.log(start.data_get_table_reverse['table'])
        $.each(start.data_get_table_reverse['table'], function (i, v) {

            let id_number = v['ID'] ? v['ID'] : '';
            if (id_number == e) {
                let id_number = v['ID'] ? v['ID'] : '';
                let ref_billing_id = v['ref_billing_id'] ? v['ref_billing_id'] : '';
                let ref_job_id = v['ref_job_id'] ? v['ref_job_id'] : '';
                let paid_by = v['paid_by'] ? v['paid_by'] : '';
                let paid_date_time = v['paid_date_time'] ? v['paid_date_time'] : '';
                let status_billing = v['status_billing'] ? v['status_billing'] : '';
                let paid_amt = v['paid_amt'] ? v['paid_amt'] : '';
                let hanler_data = v['hanler_data'] ? v['hanler_data'] : '';
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
                let actual_total_payment = v['actual_total_payment'] ? v['actual_total_payment'] : '';
                let acount_payment_amount = v['acount_payment_amount'] ? v['acount_payment_amount'] : '';

                let currency_start = v['currency_start'] ? v['currency_start'] : '';
                let currency_end = v['currency_end'] ? v['currency_end'] : '';

                let number_data = v['number_data'] ? v['number_data'] : '';
                let payment_rec = v['payment_rec'] ? v['payment_rec'] : '';


                html = `
                    <div class="modal" id="modal_account_payment" id_bp="${id_number}" modal_id="${e}" data-bs-backdrop="true">
                        <div class="modal-dialog modal-xl ">
                            <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72); ">
                                <div class="modal-header">
                                    <h4 class="modal-title">Reverse processing</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body " style="zoom:90%">
                                    <div class="detail_description">
                                        <div class="row">
                                            <div class="col">
                                                <button class="btn btn-outline-primary btn-sm btn_save_data_reverse_processing" onclick="process_part.save_reverse()">OK</button>
                                                <!-- <button class="btn btn-outline-primary btn-sm">Print</button> -->
                                                <button class="btn btn-outline-primary btn-sm" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-outline-primary btn-sm" class="btn btn-danger" onclick="process_part.start_modal_add_on('${radio_function_paid}')"> Add list </button>
                                            </div>
                                            <div class="row">
                                                <div class="col m-1" >
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">收付类型 Payment Type </label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm inp_payment_type">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">收付单号 Payment receipt number</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm inp_payment_document">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">收付地点 payment place</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <select class="form-select form-select-sm sel_data_payment_place" onchange="start.set_payment_place()">
                                                                    <option value="">-- select --</option>
                                                                    <option value="TH">TH</option>
                                                                    <option value="CN">CN</option>
                                                                    <option value="HK">HK</option>
                                                                    <option value="US">US</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">收款方式 payment method</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <select class="form-select form-select-sm inp_method_cash">
                                                                    <option value="">-- select --</option>
                                                                    <option value="tranfer">Tranfer</option>
                                                                    <option value="cash">Cash</option>
                                                                    <option value="hedge">Hedge</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for>序号 number<label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm inp_number_rec">
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <!-- row 2 -->
                                                <div class="col m-1">
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">结算单位 settlement unit</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm inp_consignee_data_detail">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">系统销账总额 total system write-offs</label>
                                                            </div>
                                                            <div class="col-lg-4" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm text-end inp_amount_all_write_off">
                                                            </div>
                                                            <div class="col-lg-3" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm text-center inp_currency_main_write_off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">实际收款总额 Actual total payment</label>
                                                            </div>
                                                            <div class="col-lg-4" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm text-end inp_amount_all" onchange="start.cal_data_actual_payment(this)">
                                                            </div>
                                                            <div class="col-lg-3" style="padding:1px">
                                                                <!--<input type="text" class="form-control form-control-sm text-center inp_currency_main">-->
                                                                <select class="form-select form-select-sm text-center inp_currency_main">
                                                                    <option value="">-- select -- </option>
                                                                    <option value="THB">THB</option>
                                                                    <option value="USD">USD</option>
                                                                    <option value="RMB">RMB</option>
                                                                    <option value="YEN">YEN</option>
                                                                    <option value="HKD">HKD</option>
                                                                </select>
                                                                <input type="hidden" class="form-control form-control-sm text-center inp_currency_start">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">收款记录数 number of payment records</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm inp_number_payment_record">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">付款日期 payment date</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="date" class="form-control form-control-sm inp_payment_date">
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="col m-1">
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">业务员 saleman</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm inp_sale_man">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <br>
                                                        <br>
                                                    </div>
                                                    <div class="col">
                                                        <br>
                                                        <!-- <div class="text-center"><i class="bi bi-image bi_image_receipt" id="blah" onclick="process_part.open_pic('${id_number}')"></i></div> -->
                                                    </div>
                                                    <!-- <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">上传文件收据 Upload file receipt</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="file" class="form-control form-control-sm inp_file_receipt" onchange="readURL(this)">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">银行账号 bank account</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <select class="form-select form-select-sm inp_bank_account">
                                                                    <option value="">-- select bank account --</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="col m-1">
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">销账日期 write-off date</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="date" class="form-control form-control-sm inp_write_off_date">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">经手人 handler</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm inp_handler">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px;">
                                                                <label for="">备注 Remark</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px;">
                                                                <textarea class="form-control inp_remark_data_modal" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col" style="padding:3px;">
                                                        <div class="row">
                                                            <div class="col-lg-5" style="padding:1px">
                                                                <label for="">实际付款金额 actual payment amount</label>
                                                            </div>
                                                            <div class="col-lg-7" style="padding:1px">
                                                                <input type="text" class="form-control form-control-sm inp_acual_payment text-end">
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table_picture mt-2" style="zoom:80%">
                                            <div class="table-responsive">
                                                <table class="table table-hover table_receipt">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th>number record</th>
                                                            <th>payment date</th>
                                                            <th>Bank account</th>
                                                            <th>currency</th>
                                                            <th>acutal payment</th>
                                                            <th>upload/Re-upload</th>
                                                            <th>Receipt</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <button class="btn btn-outline-primary btn-sm" onclick="start.add_payment_modal()" style="width:100%">add payment</button>
                                            </div>
                                        </div>
                                        <div class="data_table mt-2">
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
                                                    <tbody class="body_main_add">
                                                    ${html_data_list}
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
                $('#modal_account_payment').modal('show')
                type_document = type_document == "AP" ? "Paid" : "Receiv"

                let data_number = $('.table_list_data_processing tbody tr').length

                let get_path = $('.table_list_data_processing tbody tr')
                let data_amount_all = 0;
                let arr_get_currency_data = []
                let data_total_all = 0;

                $.each(get_path, function () {
                    let data_write_off = $(this).find('.data_incv_wrute_off').val()
                    data_write_off = parseFloat(data_write_off)
                    data_amount_all = parseFloat(data_amount_all + data_write_off)
                    let currency_data_write_off = $(this).find('.inp_currency_to').val()
                    arr_get_currency_data.push(currency_data_write_off)
                    let total_amt = $('.inp_total').val()
                    total_amt = parseFloat(total_amt)
                    data_total_all = data_total_all + total_amt
                })
                data_total_all = data_total_all.toFixed(2)
                arr_get_currency_data = $.unique(arr_get_currency_data)
                arr_get_currency_data = arr_get_currency_data.join(',')
                data_amount_all = data_amount_all.toFixed(2)

                // paid_amt
                // actual_total_payment
                // acount_payment_amount
                paid_amt = parseFloat(paid_amt)
                actual_total_payment = parseFloat(actual_total_payment)
                acount_payment_amount = parseFloat(acount_payment_amount)

                paid_amt = paid_amt.toFixed(2)
                actual_total_payment = actual_total_payment.toFixed(2)
                acount_payment_amount = acount_payment_amount.toFixed(2)
                $('.inp_amount_all_write_off').val(paid_amt).attr('disabled',true)
                $('.inp_currency_main_write_off').val(currency_start).attr('disabled',true)
                $('.inp_amount_all').val(actual_total_payment)
                $('.inp_currency_main').val(currency_end)
                $('.inp_acual_payment').val(acount_payment_amount)
                // console.log(acount_payment_amount)

                $('.inp_number_rec').val(number_data)
                $('.inp_payment_type').val(type_document).attr('disabled', true)
                $('.inp_write_off_date').val(write_off_date).attr('disabled', true)
                $('.inp_payment_document').val(document_payment).attr('disabled', true)
                $('.sel_data_payment_place').val(pay_at)
                $('.inp_remark_data_modal').val(remark)
                $('.inp_method_cash').val(tranfer_method)
                $('.inp_payment_date').val(payment_date)
                $('.inp_bank_account').val(bank_account)
                $('.inp_consignee_data_detail').val(consignee_name).attr('disabled', true)
                // $('.bi_image_receipt').val()
                data_arr_sale == '' ? $('.inp_sale_man').attr('disabled', true) : $('.inp_sale_man').val(data_arr_sale).attr('disabled', true)
                data_arr_cs == '' ? $('.inp_handler').attr('disabled', true) : $('.inp_handler').val(hanler_data).attr('disabled', true)

                // inp_acual_payment
                
                // inp_amount_all

                $('.inp_number_payment_record').val(payment_rec)
                

                return;
            }
        })
        await this.cal_data('reverse')
        if (res_data_bank['bank'] != "0 results") {
            $.each(res_data_bank['bank'], function (i, v) {
                if (v['bank_code'] != null) {
                    data_bank_account += `<option value="${v['ID']}">${v['bank_code']}</option>`

                }
            })
        }

        
        if(res_data_list['receipt'] != "0 results"){
            $.each(res_data_list['receipt'],function(i,v){
                let id_number_receipt = v['ID'] ? v['ID'] : '';
                let ref_billing_payment = v['ref_billing_payment'] ? v['ref_billing_payment'] : '';
                let image_type = v['image_type'] ? v['image_type'] : '';
                let image_name = v['image_name'] ? v['image_name'] : '';
                let currency_receipt = v['currency_receipt'] ? v['currency_receipt'] : '';
                let bank_account = v['bank_account'] ? v['bank_account'] : '';
                let payment_date = v['payment_date'] ? v['payment_date'] : '';
                let actual_payment = v['actual_payment'] ? v['actual_payment'] : '';
                actual_payment = parseFloat(actual_payment)
                actual_payment = actual_payment.toFixed(2)

                let html_data_recipt = `
                <tr class="text-center id_receipt_${id_number_receipt}" id_number_data_receipt="${id_number_receipt}">
                    <td class="row_number"></td>
                    <td><input type="date" class="form-control form-control-sm inp_payment_date" style="width:100%"></td>
                    <td><select class="form-select form-select-sm inp_bank_account">
                    <option value="">-- select bank account --</option>
                    ${data_bank_account}
                    </select></td>
                    <td><select class="form-select form-select-sm text-center inp_currency_receipt" style="width:100%">
                            <option value="THB">THB</option>
                            <option value="USD">USD</option>
                            <option value="RMB">RMB</option>
                            <option value="YEN">YEN</option>
                            <option value="HKD">HKD</option>
                    </select></td>
                    <td><input type="number" class="form-control form-control-sm text-end inp_acutal_payment" style="width:100%"></td>
                    <td><input type="file" class="form-control form-control-sm inp_file_receipt" onchange="readURL(this)" style="width:100%"></td>
                    <td><i class="bi bi-image text-primary" id="blah" blah_data="1" onclick="process_part.ajax_display_img('${id_number_receipt}')"></i></td>
                    <td><button class="btn btn-sm btn-outline-danger" onclick="start.delete_payment_modal(this)"><i class="bi bi-trash text-danger"></i></button></td>
                </tr>
                `;

                $('.table_receipt tbody').append(html_data_recipt)
                $(`.id_receipt_${id_number_receipt} > td > .inp_payment_date`).val(payment_date)
                $(`.id_receipt_${id_number_receipt} > td > .inp_bank_account`).val(bank_account)
                $(`.id_receipt_${id_number_receipt} > td > .inp_currency_receipt`).val(currency_receipt)
                $(`.id_receipt_${id_number_receipt} > td > .inp_acutal_payment`).val(actual_payment)
                // $(`.id_receipt_${id_number_receipt} > td > .inp_file_receipt`).val(image_name)
                
                
            })
            
            start.cal_row_receipt();

        }



    },


    ajax_display_img: async function (e) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/get_pic.php",
                data: { data: e },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

    cancle_in_row : async function(e){
        
        let data_checked_box = $(e).closest('tr').find('.chx_as_box_modal').prop('checked') ? '1' : '0';
        if(data_checked_box == '1'){

            // inp_total
            // inp_sysrate
            // inp_currency_to
            // data_incv_wrute_off

            let settelment = $(e).closest('tr').find('.inp_total').attr('real_data_show')
            let sysrate = $(e).closest('tr').find('.inp_sysrate').attr('real_data_show')
            let currency_to = $(e).closest('tr').find('.inp_currency_to').attr('real_data_show')
            let incv_wrute_off = $(e).closest('tr').find('.data_incv_wrute_off').attr('real_data_show')

            $(e).closest('tr').find('.inp_total').val(settelment)
            $(e).closest('tr').find('.inp_sysrate').val(sysrate)
            $(e).closest('tr').find('.inp_currency_to').val(currency_to)
            $(e).closest('tr').find('.data_incv_wrute_off').val(incv_wrute_off)
        }else{
            

            $(e).closest('tr').find('.inp_total').val('0.00')
            $(e).closest('tr').find('.inp_sysrate').val('')
            $(e).closest('tr').find('.inp_currency_to').val('')
            $(e).closest('tr').find('.data_incv_wrute_off').val('0.00')
        }

        


    },


    ajax_get_data_process_reverse: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/get_data_list_reverse_process.php",
                data: {
                    data: data
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    cal_data: async function (e) {
        let path_data = $('.table_list_data_processing tbody tr')
        let data_amount_all = 0;
        let count_list = 0;
        $.each(path_data, function () {
            let data_modal = $(this).find('.chx_as_box_modal').prop('checked') ? '1' : '0';
            let data_check = e == 'reverse' ? '1' : '0';
            if (data_modal == data_check) {
                let data_amount = $(this).find('.data_incv_wrute_off').attr('real_data_show') ? $(this).find('.data_incv_wrute_off').attr('real_data_show') : '0';
                data_amount = parseFloat(data_amount)
                data_amount_all = data_amount_all + data_amount

                count_list++;
            }

        })
        data_amount_all = data_amount_all.toFixed(2)
        if(e != 'reverse'){
            $('.inp_number_rec').val(count_list)
            data_amount_all = parseFloat(data_amount_all)
            data_amount_all = data_amount_all.toFixed(2)
            $('.inp_amount_all').val(data_amount_all)
            $('.inp_acual_payment').val(data_amount_all)
        }

        if(e == 'reverse'){
            $('.inp_amount_all_write_off').val(data_amount_all)

        }
        // if(e == 'reverse'){
        //     $.each(path_data, function () {
        //         let data_modal = $(this).find('.chx_as_box_modal').prop('checked') ? '1' : '0';
        //         if (data_modal == data_check) {
        //             let data_amount = $(this).find('.data_incv_wrute_off').val()
        //             data_amount = parseFloat(data_amount)
        //             data_amount_all = data_amount_all + data_amount
        //             count_list++;
        //         }
    
        //     })
        // }
        
    },

    save_reverse: async function () {
        let path_data = $('.table_list_data_processing tbody tr')
        let arr_data_list = []
        let arr_data_list_ins = []
        let arr_data_list_upd = []
        let arr_data_list_del = []
        let arr_data_list_have = []
        let id_payment = $('#modal_account_payment').attr('modal_id');
        let actual_pay = $('.inp_amount_all').val()

        $.each(path_data, function () {
            let data_modal = $(this).find('.chx_as_box_modal').prop('checked') ? '1' : '0';
            let data_hv_check = $(this).attr('hv')
            if (data_hv_check != undefined) {
                let data_id = $(this).attr('data_number_id') ? $(this).attr('data_number_id') : '';
                let id_number = $(this).attr('data_number_id')
                let id_bp = $(this).closest('.modal').attr('id_bp')
                let currency_to = $(this).find('.inp_currency_to').val()
                let id_currency = $(this).find('.inp_currency_to').attr('id_currency')
                let incv_wrute_off = $(this).find('.data_incv_wrute_off').val()
                let obj_data = {
                    id_number : id_number,
                    data_id: data_id,
                    id_bp: id_bp,
                    data_modal: data_modal,
                }
                arr_data_list_upd.push(obj_data)
                arr_data_list_have.push(id_bp)
            }
        })
        let data_join = arr_data_list_have.join(',')
        let arr_data_title = []
        let data_payment_place = $('.sel_data_payment_place').val()
        let method_cash = $('.inp_method_cash').val()
        let currency_main = $('.inp_currency_main').val()
        let payment_date = $('.inp_payment_date').val()
        let remark_data_modal = $('.inp_remark_data_modal').val()
        let amount_all_write_off = $('.inp_amount_all_write_off').val()
        let amount_all = $('.inp_amount_all').val()
        let number_payment_rec = $('.inp_number_payment_record').val()
        let payment_document = $('.inp_payment_document').val()
        let acual_payment = $('.inp_acual_payment').val()
        
        let obj_data_title = {}

        if (data_payment_place == "") {
            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'information not found in 收付地点 payment place',
            })
            await $('.inp_number_rec').trigger('focus')
        } else {
            obj_data_title = {
                id_payment: id_payment,
                data_join: data_join,
                data_payment_place : data_payment_place,
                method_cash : method_cash,
                amount_all : amount_all,
                currency_main : currency_main,
                payment_date : payment_date,
                remark_data_modal : remark_data_modal,
                acual_payment : acual_payment,
                amount_all_write_off : amount_all_write_off,
                payment_document : payment_document,
                number_payment_rec : number_payment_rec,
                
            }
            arr_data_title.push(obj_data_title)

            let arr_recipt = []
            let arr_create = []
            const promises = $('.table_receipt > tbody > tr').map(async function (){

                let get_id_bp = $('#modal_account_payment').attr('id_bp')
                let id_number_receipt = $(this).attr('id_number_data_receipt') ? $(this).attr('id_number_data_receipt') : '';
                let payment_date = $(this).find('.inp_payment_date').val()
                let bank_account = $(this).find('.inp_bank_account').val()
                let currency = $(this).find('.inp_currency_receipt').val()
                let actaul_payment = $(this).find('.inp_acutal_payment').val()
                let blah_data = $(this).find('#blah').attr('blah_data')
                let base_64_file = $(this).find('.inp_file_receipt').prop('files')[0];
                let Base_64_file_base = '';
                let type_data = '';
                let name_file = '';

                if(blah_data == '1'){
                    if(base_64_file != undefined){
                        type_data = base_64_file.type ? base_64_file.type : '';
                        name_file = base_64_file.name ? base_64_file.name : '';
                        Base_64_file_base = await convert_file(base_64_file);
                        let obj_data = {
                            id_number_receipt : id_number_receipt,
                            bank_account : bank_account,
                            currency : currency,
                            actaul_payment : actaul_payment,
                            payment_date : payment_date,
                            type_data : type_data,
                            name_file : name_file,
                            Base_64_file_base : Base_64_file_base,
                        }
                        arr_recipt.push(obj_data)
                        // console.log('change img')
                    }else{
                        let obj_data = {
                            id_number_receipt : id_number_receipt,
                            bank_account : bank_account,
                            currency : currency,
                            payment_date : payment_date,
                            actaul_payment : actaul_payment,
                            payment_date : payment_date,
                        }
                        arr_recipt.push(obj_data)
                        // console.log('-')
                    }
                }else{
                    if(base_64_file != undefined){
                        type_data = base_64_file.type ? base_64_file.type : '';
                        name_file = base_64_file.name ? base_64_file.name : '';
                        Base_64_file_base = await convert_file(base_64_file);
                        let obj_data = {
                            get_id_bp : get_id_bp,
                            id_number_receipt : id_number_receipt,
                            bank_account : bank_account,
                            currency : currency,
                            actaul_payment : actaul_payment,
                            payment_date : payment_date,
                            type_data : type_data,
                            name_file : name_file,
                            Base_64_file_base : Base_64_file_base,
                        }
                        arr_create.push(obj_data)
                        // console.log('new create')
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please select Image ',
                        })
                        return;
                    }
                    
                }
            }).get();

            Promise.all(promises).then(async() => {
                // console.log()
                let res_data_save = await this.ajax_save_data(arr_data_title, arr_data_list_upd,arr_recipt,arr_create,start.data_del_receipt)

                if (res_data_save['billing_payment'] == '1') {
                    Swal.fire(
                        'Save it!',
                        'Your file has been save.',
                        'success'
                    )
                    await $('#modal_account_payment').modal('toggle');
                    await start.select_filter();
    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data is problem pls. contact to tech team',
                    })
                }


            })


            
        }

    },

    ajax_save_data: async function (arr_data_title, arr_data_list_upd,arr_recipt,arr_create,data_del_receipt) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/save_reverse_processing.php",
                data: {
                    arr_data_title: arr_data_title,
                    arr_data_list_upd : arr_data_list_upd,
                    arr_recipt : arr_recipt,
                    arr_create : arr_create,
                    data_del_receipt : data_del_receipt,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },


    ajax_request_data_list_add_on: function (data_consignee_find, data_payment_type, join_currenct_start, join_currenct_end) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/get_data_table_list_add_on.php",
                data: {
                    data_consignee_find: data_consignee_find,
                    data_payment_type: data_payment_type,
                    join_currenct_start: join_currenct_start,
                    join_currenct_end: join_currenct_end,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    start_modal_add_on: async function (e) {

        if ($('#modal_add_list').length >= 1) {
            $('#modal_add_list').remove()
        }

        // let data_currency = $('.inp_currency_main_write_off').val()

        let path_data = $('.table_list_data_processing tbody tr')
        let currenct_start = []
        let currenct_end = []
        let data_list_have = []
        $.each(path_data, function () {
            let data_currenct_start = $(this).find('.currency_start').val()
            let data_currenct_end = $(this).find('.inp_currency_to').val()
            let data_list = $(this).attr('data_number_id')
            currenct_start.push(data_currenct_start)
            currenct_end.push(data_currenct_end)
            data_list_have.push(data_list)
        })
        currenct_start = $.unique(currenct_start)
        currenct_end = $.unique(currenct_end)
        let join_currenct_start = currenct_start == '' ? '' : currenct_start.join(',');
        let join_currenct_end = currenct_end == '' ? '' : currenct_end.join(',');
        let data_consignee_find = $('.inp_consignee_data_detail').val()
        let data_payment_type = $('.inp_payment_type').val() == "Receiv" ? "AR" : "AP";

        let res_data = await this.ajax_request_data_list_add_on(
            data_consignee_find,
            data_payment_type,
            join_currenct_start,
            join_currenct_end);



        let data_cuurency_all = [];

        if (res_data['table'] != "0 results") {
            $.each(res_data['table'], function (i, v) {
                data_cuurency_all.push("'" + v['job_number'] + "'")
            })
        }

        arr_data_sys_rate = $.unique(data_cuurency_all)
        arr_data_sys_rate = arr_data_sys_rate.join(',')

        let res_data_currency = await start.ajax_setting_main_currency(arr_data_sys_rate)
        this.res_data_currency1 = res_data_currency;


        let html_modal_list = `
        <div class="modal" id="modal_add_list" data-bs-backdrop="true">
                <div class="modal-dialog modal-xl ">
                    <div class="modal-content" style="box-shadow: 4px 4px 12px -1px rgba(0, 0, 0, 0.72); ">
                        <div class="modal-header">
                            <h4 class="modal-title">Reverse processing</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="zoom:70%">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="row">
                                            <div class="col text-center">
                                                <label>Currency pay</label>
                                            </div>
                                            <div class="col">
                                                <select class="form-select form-select-sm sel_currency_end" onchange="process_part.change_currency_add_on_list(this)">
                                                    <option value="THB" selected>THB</option>
                                                    <option value="USD">USD</option>
                                                    <option value="RMB">RMB</option>
                                                    <option value="YEN">YEN</option>
                                                    <option value="HKD">HKD</option>
                                                </select >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-hover table_data_new_list">
                                <thead>
                                    <tr class="text-center" style="zoom:90%">
                                        <th class="sticky-column">No</th>
                                        <th class="sticky-column">select</th>
                                        <th class="sticky-column">Job#</th>
                                        <th class="sticky-top">Code</th>
                                        <th class="sticky-top">Cur</th>
                                        <th class="sticky-top">AMTINCV</th>
                                        <th class="sticky-top">Outstanding</th>
                                        <th class="sticky-top">settlement</th>
                                        <th class="sticky-top">actual
                                            <br>ex.rate
                                        </th>
                                        <th class="sticky-top">actual<br>curr.</th>
                                        <th class="sticky-top">Total</th>
                                        <th class="sticky-top">Amt</th>
                                        <th class="sticky-top">Vat(%)</th>
                                        <th class="sticky-top">WHT</th>
                                        <th class="sticky-top">Customer</th>
                                        <th class="sticky-top">Finish</th>
                                        <th class="sticky-top">Remark</th>
                                        <th class="sticky-top">Sales</th>
                                        <th class="sticky-top">billing date</th>
                                    </tr>
                                </thead>
                                <tbody class="table_add_on_data_list">
                                </tbody>
                            </table>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="process_part.select_new_list()">Add</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $('body').append(html_modal_list)

        join_currenct_end != '' ? $('.sel_currency_end').val(join_currenct_end).attr('disabled', true) : '';
        $('.table_data_new_list tbody').html('');
        let table_add_on_data_list = $('.sel_currency_end').val()
        if (res_data['table'] != "0 results") {

            $.each(res_data['table'], function (i, v) {
                let id_number = v['ID'] ? v['ID'] : '';
                let html_data_on_list = '';

                i++;
                let job_number = v['job_number'] ? v['job_number'] : '';
                let billing_description = v['billing_description'] ? v['billing_description'] : '';
                let currency = v['currency'] ? v['currency'] : '';
                let amtinclvat = v['amtinclvat'] ? v['amtinclvat'] : '';
                let sys_rate = v['sys_rate'] ? v['sys_rate'] : '';
                let currency_main = v['currency_main'] ? v['currency_main'] : '';

                let vat = v['vat'] ? v['vat'] : '';
                let with_holding_tax = v['with_holding_tax'] ? v['with_holding_tax'] : '';
                let bill_to_c = v['bill_to_c'] ? v['bill_to_c'] : '';
                let remark = v['remark'] ? v['remark'] : '';
                let sale_support_f = v['sale_support_f'] ? v['sale_support_f'] : '';
                let sale_support_l = v['sale_support_l'] ? v['sale_support_l'] : '';
                let create_data_time = v['create_data_time'] ? v['create_data_time'] : '';

                let qty = v['qty'] ? v['qty'] : '0';
                let unit_price = v['unit_price'] ? v['unit_price'] : '0';
                qty = parseFloat(qty)
                unit_price = parseFloat(unit_price)
                let data_amt_not_vat = qty * unit_price
                data_amt_not_vat = data_amt_not_vat.toFixed(2)


                // let id_number = v['ID'] ? v['ID'] : '';
                let currency_data = '';
                let id_currency = '';
                $.each(res_data_currency['currency'], function (i1, v1) {
                    let job_number_check = v1['job_number'] ? v1['job_number'] : ''
                    if (job_number_check == job_number) {
                        id_currency = v1['ID'] ? v1['ID'] : '';
                        currency_data = v1[`${currency + '_' + table_add_on_data_list}`] ? v1[`${currency + '_' + table_add_on_data_list}`] : '1'
                    }
                })
                let amt_data = amtinclvat * currency_data
                amt_data = parseFloat(amt_data)
                amt_data = amt_data.toFixed(2)
                html_data_on_list = `
                        <tr class="id_number_${id_number}" id_number="${id_number}">
                            <td class="text-center">${i}</td>
                            <td class="text-center"><input type="checkbox"  style="zoom:150%" class="data_check_box_new_list" ></td>
                            <td><input class="form-control form-control-sm inp_job_number_data" disabled value="${job_number}"></td>
                            <td><input class="form-control form-control-sm inp_description_data" disabled value="${billing_description}"></td>
                            <td><input class="form-control form-control-sm inp_currenct_start text-center" disabled value="${currency}"></td>
                            <td><input class="form-control form-control-sm text-end" disabled value="${amtinclvat}"></td>
                            <td><input class="form-control form-control-sm text-end" disabled value="${amtinclvat}"></td>
                            <td><input class="form-control form-control-sm inp_data_amtinclv text-end" disabled value="${amtinclvat}"></td>
                            <td><input class="form-control form-control-sm inp_ehx_rate text-center" id_currency="${id_currency}" disabled value="${currency_data}"></td>
                            <td><input class="form-control form-control-sm inp_currency_end text-center" disabled value="${table_add_on_data_list}"></td>
                            <td><input class="form-control form-control-sm text-end inp_data_total_data" disabled value="${amt_data}"></td>
                            <td><input class="form-control form-control-sm inp_nonvat text-end" disabled value="${data_amt_not_vat}"></td>
                            <td><input class="form-control form-control-sm inp_vat text-center" disabled value="${vat}"></td>
                            <td><input class="form-control form-control-sm inp_wht text-center" disabled value="${with_holding_tax}"></td>
                            <td><input class="form-control form-control-sm" disabled value="${bill_to_c}"></td>
                            <td><input class="form-control form-control-sm" disabled value=""></td>
                            <td><input class="form-control form-control-sm" disabled value="${remark}"></td>
                            <td><input class="form-control form-control-sm" disabled value="${sale_support_f + ' ' + sale_support_l}"></td>
                            <td><input class="form-control form-control-sm" disabled value="${create_data_time}"></td>
                        </tr>
                        `;

                $('.table_add_on_data_list').append(html_data_on_list)
            })
        }

        let data_path_new_list = $('.table_data_new_list tbody tr')
        $.each(data_path_new_list, function () {
            let data_id_number = $(this).attr('id_number')
            $.each(data_list_have, function (i, v) {
                if (v == data_id_number) {
                    $(`.table_data_new_list > tbody > .id_number_${v}`).remove()
                }
            })
        })

        $('#modal_add_list').modal('show')
    },

    select_new_list: async function () {
        let arr_data = []

        let path = $('.table_data_new_list tbody tr')

        let arr_check_currency = []
        $.each(path, function () {
            let obj_data = {}
            let data_check_box_new_list = $(this).find('.data_check_box_new_list').prop("checked") ? '1' : '0';
            if (data_check_box_new_list == '1') {
                let id_number = $(this).attr('id_number')
                let data_job_number = $(this).find('.inp_job_number_data').val()
                let bill_to = $(this).find('.inp_description_data').val()
                let cur = $(this).find('.inp_currenct_start').val()
                let total_amt = $(this).find('.inp_data_amtinclv').val()
                let sysrate_data = $(this).find('.inp_ehx_rate').val()
                let id_currency = $(this).find('.inp_ehx_rate').attr('id_currency')
                let currency_bpl = $(this).find('.inp_currency_end').val()
                arr_check_currency.push(currency_bpl)
                let amount_bpl = $(this).find('.inp_data_total_data').val()
                let vat = $(this).find('.inp_vat').val()

                obj_data = {
                    id_number: id_number,
                    data_job_number: data_job_number,
                    bill_to: bill_to,
                    cur: cur,
                    total_amt: total_amt,
                    sysrate_data: sysrate_data,
                    currency_bpl: currency_bpl,
                    amount_bpl: amount_bpl,
                    vat: vat,
                    id_currency: id_currency,
                }
                arr_data.push(obj_data)
            }
        })
        $(`#modal_add_list`).modal('hide')

        arr_check_currency = $.unique(arr_check_currency)
        arr_check_currency = arr_check_currency.length
        if (arr_check_currency > 1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select same currency',
            })
        } else {
            let html_data_list = '';

            $.each(arr_data, function (i, v) {
                let id_number = v['id_number'] ? v['id_number'] : '';
                let data_job_number = v['data_job_number'] ? v['data_job_number'] : '';
                let bill_to = v['bill_to'] ? v['bill_to'] : '';
                let cur = v['cur'] ? v['cur'] : '';
                let total_amt = v['total_amt'] ? v['total_amt'] : '';
                let sysrate_data = v['sysrate_data'] ? v['sysrate_data'] : '';
                let currency_bpl = v['currency_bpl'] ? v['currency_bpl'] : '';
                let amount_bpl = v['amount_bpl'] ? v['amount_bpl'] : '';
                let vat = v['vat'] ? v['vat'] : '';
                let id_currency = v['id_currency'] ? v['id_currency'] : '';
                // let wht = $(this).find('.inp_wht').val()

                html_data_list += `
                    <tr class="text-center" data_number_id="${id_number}">
                        <td></td>
                        <td><input type="checkbox" style="zoom:150%" class="chex_box_modal chx_as_box_modal" onchange="process_part.cancle_in_row(this)" onclick="process_part.cal_data('reverse')"></td>
                        <td><input class="form-control form-control-sm" readonly value="${data_job_number}"></td>
                        <td><input class="form-control form-control-sm" readonly value="${bill_to}"></td>
                        <td><input class="form-control form-control-sm text-center currency_start" readonly value="${cur}"></td>
                        <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-end inp_total" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-center inp_sysrate" readonly value="${sysrate_data}"></td>
                        <td><input class="form-control form-control-sm text-center inp_currency_to inp_currency_to" id_currency="${id_currency}" readonly value="${currency_bpl}"></td>
                        <td><input class="form-control form-control-sm text-end data_incv_wrute_off data_incv_wrute_off" readonly value="${amount_bpl}"></td>
                        <td><input class="form-control form-control-sm" readonly value=""></td>
                        <td><input class="form-control form-control-sm text-center" readonly value="${vat}"></td>
                    </tr>
                `;

            })
            $('.body_main_add').append(html_data_list)
            let data_row = $('.table_list_data_processing tbody tr').length
            let path_data = $('.table_list_data_processing tbody tr')
            let data_incv_all = 0;
            let data_currency_main = '';
            $.each(path_data, function () {
                let data_incv = $(this).find('.data_incv_wrute_off').val()
                data_incv = parseFloat(data_incv)
                data_incv_all = data_incv_all + data_incv
                data_currency_main = $(this).find('.inp_currency_to').val()
            })
            data_incv_all = parseFloat(data_incv_all)
            data_incv_all = data_incv_all.toFixed(2)
            $('.inp_amount_all_write_off').val(data_incv_all)
            $('.inp_number_payment_record').val(data_row)
            $('.inp_currency_main_write_off').val(data_currency_main)
            $('.inp_currency_main').val(data_currency_main)
            await this.cal_data('reverse');

        }





    },

    change_currency_add_on_list: async function (e) {
        let value_select = $(e).val()
        let path = $('.table_data_new_list tbody tr')
        $.each(path, function () {
            let job_number_data = $(this).find('.inp_job_number_data').val()
            let currenct_start = $(this).find('.inp_currenct_start').val()
            let data_amtincv = $(this).find('.inp_data_amtinclv').val()
            data_amtincv = parseFloat(data_amtincv)
            let data_sysrateyrate = '';
            let id_number = $(this).attr('id_number')
            $.each(process_part.res_data_currency1['currency'], function (i, v) {
                let job_number_data_check = v['job_number'] ? v['job_number'] : '';
                currenct_start = currenct_start.toLowerCase()
                value_select = value_select.toLowerCase()
                if (job_number_data == job_number_data_check) {
                    data_sysrateyrate = v[`${currenct_start + '_' + value_select}`] ? v[`${currenct_start + '_' + value_select}`] : '1';
                }
            })

            let data_cal = data_amtincv * data_sysrateyrate
            data_cal = data_cal.toFixed(2)
            value_select = value_select.toUpperCase()
            $(`.id_number_${id_number} > td > .inp_ehx_rate`).val(data_sysrateyrate)
            $(`.id_number_${id_number} > td > .inp_currency_end`).val(value_select)
            $(`.id_number_${id_number} > td > .inp_data_total_data`).val(data_cal)

        })
    },

    open_pic: async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/open_pic.php",
                data: { data: data },
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },


}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        // onclick="start.show_photo(this)"
        reader.onload = function (e) {
            var myElement =  $(input).closest('tr').find('#blah')
            myElement.removeAttr('onclick')
            myElement.attr('onclick','start.show_photo(this)');
            // $(input).closest('tr').find('#blah').prop('onclick', null)
            $(input).closest('tr').find('#blah').attr('src', e.target.result);
            $(input).closest('tr').find('#blah').addClass("text-primary")
        };

        reader.readAsDataURL(input.files[0]);
    }
}