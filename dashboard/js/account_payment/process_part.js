const process_part = {
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
       
        $.each(res_data_list['list'], function (i, v) {

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

            arr_sale = []
            arr_cs = []
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

            arr_sale = arr_sale.join(',')
            arr_cs = arr_cs.join(',')

            total_amt = parseFloat(total_amt)
            amount_bpl = parseFloat(amount_bpl)

            total_amt = total_amt.toFixed(2)
            amount_bpl = amount_bpl.toFixed(2)
            i++;
            html_data_list += `
                <tr class="text-center" data_number_id="${id_number}">
                    <td>${i}</td>
                    <td><input type="checkbox" style="zoom:150%" class="chex_box_modal chx_as_box_modal" checked="" onclick="process_part.cal_data()"></td>
                    <td><input class="form-control form-control-sm" readonly value="${data_job_number}"></td>
                    <td><input class="form-control form-control-sm" readonly value="${bill_to}"></td>
                    <td><input class="form-control form-control-sm text-center" readonly value="${cur}"></td>
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


        if ($('#modal_account_payment').length >= 1) {
            $('#modal_account_payment').remove()
        }

        // console.log(start.data_get_table_reverse['table'])

        $.each(start.data_get_table_reverse['table'], function (i, v) {

            let id_number = v['ID'] ? v['ID'] : '';
            if (id_number == e) {
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
            <div class="modal" id="modal_account_payment" modal_id="${e}" data-bs-backdrop="true">
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
                                        <button class="btn btn-outline-primary btn-sm">OK</button>
                                        <button class="btn btn-outline-primary btn-sm">Print</button>
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
                                        <!-- <div class="col-3">
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
                                        </div> -->
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
                                        <!-- <div class="col-3">
                                            <div class="row">
                                                <div class="col-lg-5">
                                                    <label for="">付款记录数 number of payment records</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control form-control-sm inp_number_payment_record">
                                                </div>
                                            </div>
                                        </div> -->
                                        
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
                                        <tbody>
                                           ${html_data_list}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="process_part.save_reverse()">Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
                $('.inp_sale_man').val(arr_sale).attr('disabled', true)
                $('.inp_handler').val(arr_cs).attr('disabled', true)


                // ref_job_id
                // paid_by
                // paid_date_time
                // status_billing
                // paid_amt
                // document_payment
                // type_document
                // pay_at
                // tranfer_method
                // total_payment
                // bank_account
                // payment_date
                // write_off_date
                // remark
                // ref_billing
                // bank_code
                // consignee_name


                return;
            }

        })


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
    cal_data : async function (){
        let path_data = $('.table_list_data_processing tbody tr')
        let data_amount_all = 0;
        let count_list = 0;
        $.each(path_data,function(){
            let data_modal = $(this).find('.chx_as_box_modal').prop('checked') ? '1' : '0';
            if(data_modal == '1'){
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
    },
    save_reverse: async function () {
        let path_data = $('.table_list_data_processing tbody tr')
        let arr_data_list = []
        let id_payment = $('#modal_account_payment').attr('modal_id');
        let actual_pay = $('.inp_amount_all').val()


        $.each(path_data,function(){
            let data_modal = $(this).find('.chx_as_box_modal').prop('checked') ? '1' : '0';
            if(data_modal == '1'){
                let data_id = $(this).attr('data_number_id')
                arr_data_list.push(data_id)
            }
        })
        let data_join = arr_data_list.join(',')
        let arr_data_title = []
        let obj_data_title = {
            id_payment : id_payment,
            actual_pay : actual_pay,
            data_join : data_join,
        }

        arr_data_title.push(obj_data_title)
        
        let res_data_save = await this.ajax_save_data(arr_data_title,arr_data_list)
    },

    ajax_save_data : async function (arr_data_title,arr_data_list) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/account_payment/save_reverse_processing.php",
                data: {
                    arr_data_title : arr_data_title,
                    arr_data_list : arr_data_list,
                },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
}