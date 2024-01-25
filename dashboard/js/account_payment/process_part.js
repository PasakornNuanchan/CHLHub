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
        console.log(res_data_list)
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
                    <tr class="text-center" data_number_id="${id_number}">
                        <td>${i}</td>
                        <td><input type="checkbox" style="zoom:150%" class="chex_box_modal chx_as_box_modal" checked="" onchange="process_part.check_before_save()" onclick="process_part.cal_data()"></td>
                        <td><input class="form-control form-control-sm" readonly value="${data_job_number}"></td>
                        <td><input class="form-control form-control-sm" readonly value="${bill_to}"></td>
                        <td><input class="form-control form-control-sm text-center currency_start" readonly value="${cur}"></td>
                        <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-end inp_total" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-center" readonly value="${sysrate_data}"></td>
                        <td><input class="form-control form-control-sm text-center inp_currency_to" readonly value="${currency_bpl}"></td>
                        <td><input class="form-control form-control-sm text-end data_incv_wrute_off" readonly value="${amount_bpl}"></td>
                        <td><input class="form-control form-control-sm" readonly value=""></td>
                        <td><input class="form-control form-control-sm text-center" readonly value="${vat}"></td>
                    </tr>
                `;
            })
        }


        let radio_function_paid = $('input[name="radio_function_paid"]:checked').val();
        // console.log(radio_function_paid)

        if ($('#modal_account_payment').length >= 1) {
            $('#modal_account_payment').remove()
        }

        // console.log(start.data_get_table_reverse['table'])

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
                                                <button class="btn btn-outline-primary btn-sm btn_save_data_reverse_processing" onclick="process_part.save_reverse()" disabled>OK</button>
                                                <button class="btn btn-outline-primary btn-sm">Print</button>
                                                <button class="btn btn-outline-primary btn-sm" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-outline-primary btn-sm" class="btn btn-danger" onclick="process_part.start_modal_add_on('${radio_function_paid}')"> Add list </button>
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
                                                    <!-- <div class="row">
                                                        <div class="col-lg-5">
                                                            <label for="">显示总金额 Show total amount</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <input type="text" class="form-control form-control-sm">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <!-- <div class="row">
                                                        <div class="col-lg-5">
                                                            <label for="">显示总金额 Show total amount</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <input type="text" class="form-control form-control-sm">
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
                                                    <div class="text-center"><i class="bi bi-image bi_image_receipt" id="blah" onclick="process_part.open_pic('${id_number}')"></i></div>
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




                if (res_data_bank['bank'] != "0 results") {
                    $.each(res_data_bank['bank'], function (i, v) {
                        if (v['bank_code'] != null) {
                            data_bank_account += `<option value="${v['ID']}">${v['bank_code']}</option>`

                        }
                    })
                    $('.inp_bank_account').append(data_bank_account)
                }



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
                $('.inp_currency_main').val(arr_get_currency_data).attr('disabled', true)
                $('.inp_amount_all').val(data_amount_all).attr('disabled', true)
                $('.inp_number_rec').val(data_number).attr('disabled', true)
                $('.inp_payment_type').val(type_document).attr('disabled', true)
                $('.inp_consignee_data_detail').val(consignee_name).attr('disabled', true)
                $('.inp_write_off_date').val(write_off_date).attr('disabled', true)
                $('.inp_payment_document').val(document_payment).attr('disabled', true)
                $('.sel_data_payment_place').val(pay_at).attr('disabled', true)
                $('.inp_remark_data_modal').val(remark).attr('disabled', true)
                $('.inp_method_cash').val(tranfer_method).attr('disabled', true)
                $('.inp_payment_date').val(payment_date).attr('disabled', true)
                $('.inp_bank_account').val(bank_account).attr('disabled', true)
                $('.inp_consignee_data_detail').val(consignee_name).attr('disabled', true)
                $('.inp_acual_payment').val(data_total_all).attr('disabled', true)
                $('.bi_image_receipt').val()
                data_arr_sale == '' ? $('.inp_sale_man').attr('disabled', true) : $('.inp_sale_man').val(data_arr_sale).attr('disabled', true)
                data_arr_cs == '' ? $('.inp_handler').attr('disabled', true) : $('.inp_handler').val(data_arr_cs).attr('disabled', true)

                // console.log(data_arr_sale)
                // console.log(data_arr_cs)

                $('.inp_amount_all_write_off').val(data_amount_all).attr('disabled', true)
                $('.inp_currency_main_write_off').val(arr_get_currency_data).attr('disabled', true)
                $('.inp_number_payment_record').val(b).attr('disabled', true)

                return;
            }
        })
    },

    check_before_save: async function () {
        let amount_all_write_off = $('.inp_amount_all_write_off').val()
        let amount_all = $('.inp_amount_all').val()
        let number_rec = $('.inp_number_rec').val()
        let number_payment_record = $('.inp_number_payment_record').val()


        if (amount_all_write_off != amount_all && number_rec != number_payment_record) {
            $('.btn_save_data_reverse_processing').attr('disabled', false)

        } else {
            $('.btn_save_data_reverse_processing').attr('disabled', true)

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
    cal_data: async function () {
        let path_data = $('.table_list_data_processing tbody tr')
        let data_amount_all = 0;
        let count_list = 0;
        $.each(path_data, function () {
            let data_modal = $(this).find('.chx_as_box_modal').prop('checked') ? '1' : '0';
            if (data_modal == '1') {
                let data_amount = $(this).find('.data_incv_wrute_off').val()
                data_amount = parseFloat(data_amount)
                data_amount_all = data_amount_all + data_amount
                count_list++;
            }

        })
        $('.inp_number_rec').val(count_list)
        data_amount_all = parseFloat(data_amount_all)
        data_amount_all = data_amount_all.toFixed(2)
        $('.inp_amount_all').val(data_amount_all)
        $('.inp_acual_payment').val(data_amount_all)
    },

    save_reverse: async function () {
        let path_data = $('.table_list_data_processing tbody tr')
        let arr_data_list = []
        let arr_data_list_ins = []
        let arr_data_list_del = []
        let id_payment = $('#modal_account_payment').attr('modal_id');
        let actual_pay = $('.inp_amount_all').val()


        $.each(path_data, function () {
            let data_modal = $(this).find('.chx_as_box_modal').prop('checked') ? '1' : '0';
            if (data_modal == '1') {
                let data_id = $(this).attr('data_number_id') ? $(this).attr('data_number_id') : '';
                if (data_id != '') {
                    arr_data_list.push(data_id)


                    let id_bp = $(this).closest('.modal').attr('id_bp')
                    let currency_to = $(this).find('.inp_currency_to').val()
                    let id_currency = $(this).find('.inp_currency_to').attr('id_currency')
                    let incv_wrute_off = $(this).find('.data_incv_wrute_off').val()
                    let obj_data = {
                        data_id: data_id,
                        id_bp: id_bp,
                        currency_to: currency_to,
                        id_currency: id_currency,
                        incv_wrute_off: incv_wrute_off,
                    }
                    arr_data_list_ins.push(obj_data)
                }




            } else {
                let data_id = $(this).attr('data_number_id') ? $(this).attr('data_number_id') : '';
                if (data_id != '') {
                    arr_data_list_del.push(data_id)
                }
            }


        })
        let data_join = arr_data_list.join(',')
        let arr_data_title = []
        let obj_data_title = {
            id_payment: id_payment,
            actual_pay: actual_pay,
            data_join: data_join,
        }

        arr_data_title.push(obj_data_title)

        // console.log(arr_data_title)
        // console.log(arr_data_list_del)

        let res_data_save = await this.ajax_save_data(arr_data_title, arr_data_list_del, arr_data_list_ins)

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

        console.log(e)
        if ($('#modal_add_list').length >= 1) {
            $('#modal_add_list').remove()
        }




        // let data_currency = $('.inp_currency_main_write_off').val()

        let path_data = $('.table_list_data_processing tbody tr')
        // console.log(path_data)
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
        console.log(data_list_have)
        let join_currenct_start = currenct_start == '' ? '' : currenct_start.join(',');
        let join_currenct_end = currenct_end == '' ? '' : currenct_end.join(',');
        // console.log(join_currenct_start)
        // console.log(join_currenct_end)
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

        console.log(data_cuurency_all)
        arr_data_sys_rate = $.unique(data_cuurency_all)
        arr_data_sys_rate = arr_data_sys_rate.join(',')

        let res_data_currency = await start.ajax_setting_main_currency(arr_data_sys_rate)
        this.res_data_currency1 = res_data_currency;
        console.log(this.res_data_currency1)


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
        // console.log(html_data_on_list)
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
                            // console.log(8888)
                            id_currency = v1['ID'] ? v1['ID'] : '';
                            currency_data = v1[`${currency + '_' + table_add_on_data_list}`] ? v1[`${currency + '_' + table_add_on_data_list}`] : '1'
                            // console.log(currency_data)
                        }
                    })
                    // console.log(currency_data)
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

                    // console.log(html_data_on_list)
                $('.table_add_on_data_list').append(html_data_on_list)
                // console.log(html_data_on_list)
            })
        }

        let data_path_new_list = $('.table_data_new_list tbody tr')
        $.each(data_path_new_list,function(){
            let data_id_number = $(this).attr('id_number')
            // console.log(data_id_number)
            $.each(data_list_have,function(i,v){
                if(v == data_id_number){
                    console.log(888)
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
        // console.log(arr_data)
        $(`#modal_add_list`).modal('hide')

        arr_check_currency = $.unique(arr_check_currency)
        arr_check_currency = arr_check_currency.length
        if(arr_check_currency > 1){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select same currency',
            })
        }else{
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
                        <td><input type="checkbox" style="zoom:150%" class="chex_box_modal chx_as_box_modal" onchange="process_part.check_before_save()" onclick="process_part.cal_data()"></td>
                        <td><input class="form-control form-control-sm" readonly value="${data_job_number}"></td>
                        <td><input class="form-control form-control-sm" readonly value="${bill_to}"></td>
                        <td><input class="form-control form-control-sm text-center currency_start" readonly value="${cur}"></td>
                        <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-end" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-end inp_total" readonly value="${total_amt}"></td>
                        <td><input class="form-control form-control-sm text-center" readonly value="${sysrate_data}"></td>
                        <td><input class="form-control form-control-sm text-center inp_currency_to" id_currency="${id_currency}" readonly value="${currency_bpl}"></td>
                        <td><input class="form-control form-control-sm text-end data_incv_wrute_off" readonly value="${amount_bpl}"></td>
                        <td><input class="form-control form-control-sm" readonly value=""></td>
                        <td><input class="form-control form-control-sm text-center" readonly value="${vat}"></td>
                    </tr>
                `;

            })
            // console.log(html_data_list)
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
            await this.cal_data();

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
            console.log(process_part.res_data_currency1['currency'])
            $.each(process_part.res_data_currency1['currency'], function (i, v) {
                let job_number_data_check = v['job_number'] ? v['job_number'] : '';
                currenct_start = currenct_start.toLowerCase()
                value_select = value_select.toLowerCase()
                if (job_number_data == job_number_data_check) {
                    data_sysrateyrate = v[`${currenct_start + '_' + value_select}`] ? v[`${currenct_start + '_' + value_select}`] : '1';
                }
            })

            console.log(data_sysrateyrate)
            let data_cal = data_amtincv * data_sysrateyrate
            data_cal = data_cal.toFixed(2)
            value_select = value_select.toUpperCase()
            $(`.id_number_${id_number} > td > .inp_ehx_rate`).val(data_sysrateyrate)
            $(`.id_number_${id_number} > td > .inp_currency_end`).val(value_select)
            $(`.id_number_${id_number} > td > .inp_data_total_data`).val(data_cal)

        })
    },

    ajax_save_data: async function (arr_data_title, arr_data_list, arr_data_list_ins) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/save_reverse_processing.php",
                data: {
                    arr_data_title: arr_data_title,
                    arr_data_list: arr_data_list,
                    arr_data_list_ins: arr_data_list_ins,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    open_pic : async function (data) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/open_pic.php",
                data: {data  : data},
                dataType: "json",
                success: function (res) {
                    var newTab = window.open();
                    newTab.document.write('<html><body><img src="' + res + '"></body></html>');
                },
            });
        });
    },

    
}