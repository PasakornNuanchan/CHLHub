const advance_return = {
    advance_cash_global : '',
    check_get: function () {
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
        let get_doc_ad = getUrlParameter('advance_cash_number');
        let get_action = getUrlParameter('action');

        let job_doc_ad = get_doc_ad == false ? null : get_doc_ad;
        let action = get_action == false ? null : get_action;
        
        this.advance_cash_global = job_doc_ad;
        console.log(action);

        if (action == 'preview') {

            advance_return.set_preview_data(job_doc_ad);

        } else {

        }
    },

    set_preview_data: async function (job_doc_pt) {

        let sl_des_pettycash = $(".db-select-des");

        let res_data = await advance_return.ajax_set_preview_data(job_doc_pt);

        $('.head-of-menu').html('Advance Cash Payment');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-Advance_payment-list.php" target="" style="color:white;">Advance Cash List</a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Advance Cash Payment (Advance Cash Number ${job_doc_pt})</li>`;
        $('.bcpage').append(html_bdpage);


        console.log(res_data);

        //card 1 request petty cash
        $('.inp-advance_number').val(res_data['pct']['advance_cash_number']);
        $('.inp-req_by').val(res_data['pct']['first_name'] + ' ' + res_data['pct']['last_name']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        // hr
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method_request']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        $('.inp-tranf_by').val(res_data['pct']['tf_by_first'] + ' ' + res_data['pct']['tf_by_last']);
        $('.inp-tranf_time').val(res_data['pct']['tranfer_datetime']);
        $('.inp-all_job').val(res_data['imp_set']);
        $('.inp-tranf_total').val(res_data['pct']['tranfer_amount']);

        // start Description Petty cash request 
        let no_des = '1';
        var cal_amount = 0;
        $('[name = "des-req"] tbody').html('');
        let cash_arr = [];

        let currency_th = 0;
        let currency_us = 0;
        let currency_ch = 0;

        $.each(res_data['pcd'], function (i, v) {
            cash_arr[v['job_number']] = v['amount'];
            cal_amount += parseFloat(v['amount']);

            pf_amount = parseFloat(v['amount']);

            if (v['currency'] == "THB") {
                currency_th = currency_th + parseFloat(v['amount']);
            } else if (v['currency'] == "USD") {
                currency_us = currency_us + parseFloat(v['amount']);
            } else if (v['currency'] == "RMB") {
                currency_ch = currency_ch + parseFloat(v['amount']);
            }

            html2 = `
            <tr class="text-center des-req${i}">
            <td>${no_des}</td>
            <td><input type="input" class="form-control form-control-sm" value="${v['consignee_name']} / ${v['job_number']}" readonly></td>
            <td><input type="input" class="form-control form-control-sm" value="${number_format(pf_amount.toFixed(2))}" style="text-align: right;" readonly></td>
            <td><input type="input" class="form-control form-control-sm" value="${v['currency']}" readonly></td>
            </td>
        </tr>
            `;
            $('[name = "des-req"] tbody').append(html2);
            no_des++;
        });

        console.log(currency_th)
        console.log(currency_us)
        console.log(currency_ch)
        // end Description Petty cash request 

        // petty cash return

        $('.inp-advance_cash_req').val(number_format(cal_amount.toFixed(2)));

        pf_payment_amount = parseFloat(res_data['payment']['payment_amount']);




        html_adcp = '';
        $('.card-add-advance-cash-payment').html('');
        $.each(res_data['main_return'], function (i, v) {

            let total_advance = parseFloat(v['amount']);
            let currency = v['currency'];

            html_adcp = `
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title fw-normal">Advance Cash Payment</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center">Total Advance Cash For Return :</label>
                        <div class="col col-sm-3">
                            <input type="text" class="form-control form-control-sm col-sm-2 inp-advance_cash_req${i}" style="text-align: right;" value="${number_format(total_advance.toFixed(2))}" readonly>
                        </div>
                        <div class="col col-sm-2">
                            <select name="" id="" class="form-select form-select-sm shadow-none sel-currency-total${i}" disabled>
                                <option value="THB">THB</option>
                                <option value="USD">USD</option>
                                <option value="RMB">RMB</option>
                            </select>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center">Payment medthod :</label>
                        <div class="col col-sm-3">
                            <select name="" id="" class="form-select form-select-sm sel-mt-return${i}">
                                <option value="Tranfer">Tranfer</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center">Payment By. :</label>
                        <div class="col col-sm-3">
                            <input type="text" class="form-control form-control-sm col-sm-2 inp-payment-by${i}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center">Payment datetime :</label>
                        <div class="col col-sm-3">
                            <input type="datetime" class="form-control form-control-sm col-sm-2 inp-payment-d-time${i}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center">Payment Amount :</label>
                        <div class="col col-sm-3">
                            <input type="number" class="form-control form-control-sm col-sm-2 inp-payment-re-amount${i}" style="text-align: right;" value="${total_advance.toFixed(2)}">
                        </div>
                        <div class="col col-sm-2">
                            <select name="" id="" class="form-select form-select-sm shadow-none sel-payment-re-amount_cur${i}" disabled>
                                <option value="" selected></option>
                                <option value="THB">THB</option>
                                <option value="USD">USD</option>
                                <option value="RMB">RMB</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center">Payment datetime :</label>
                        <div class="col col-sm-3">
                            <input type="file" class="form-control form-control-sm col-sm-2 inp-pic${i}" >
                        </div>
                    </div>
                </div>
                <div style="float: right">
                    <button class="btn btn-success" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="advance_return.save_list_payment('${i}',${v['ref_id']})"><i class="bi bi-check-square"></i> Save</button>
                </div>
            </div>
        </div>
        `;
            $('.card-add-advance-cash-payment').append(html_adcp)

            $(`.sel-currency-total${i}`).val(currency)
            $(`.sel-payment-re-amount_cur${i}`).val(currency)
        })


        let html = '';
        let num = 1;


        let no_des_petty_return = '1';
        $('[name = "des-check"] tbody').html('');
        $.each(res_data['dtpc'], function (i, v) {


            html_check =
                `
                <tr class="text-center">
                    <td>${no_des_petty_return}</td>
                    <td><input type="input" class="form-control form-control-sm inp-amount" value="${v['billing_item_name']}" readonly></td>
                    </select></td>
                    <td><input type="input" class="form-control form-control-sm inp-amount" value="${v['amount']}" readonly></td>
                    <td><input type="input" class="form-control form-control-sm inp-amount" value="${v['currency']}" readonly></td>
                    </td>
                    <td></td>
                    <td><input type="input" class="form-control form-control-sm inp-amount" value="${v['remark']}" readonly></td>
                </tr>
            `;
            $('[name = "des-check"] tbody').append(html_check);
            no_des_petty_return++;
        });

        $('[name = "des-check"] tbody').html('');
        $('.des_hide').html('');

        $.each(res_data['dtpc'], function (i, v) {
            let num1 = 0;
            let html_des = '';
            var Cash = parseFloat(cash_arr[i]);

            $.each(v, function (i1, v1) {
                pf_amount_dtpc_arr = parseFloat(v1['amount']);
                num1++;
                html_des +=
                    `
            <tr class="text-center">
                <td>${num1}</td>
                <td><input type="input" class="form-control form-control-sm" value="${v1['billing_item_name']}" readonly></td>
                <td><input type="input" class="form-control form-control-sm" value="${number_format(pf_amount_dtpc_arr.toFixed(2))}" style="text-align:right;" readonly></td>
                <td><input type="input" class="form-control form-control-sm" value="${v1['currency']}" readonly></td>
                <td></td>
                <td><input type="input" class="form-control form-control-sm" value="${v1['remark']}" readonly></td>
            </tr>
            `
            });
            let main_html = `
            <div class="form-group row">
                <div class="form-group row job_des_title">
                    <label class="control-label col-sm-2 align-self-center">Job number :</label>
                    <div class="col col-sm-3">
                        <input type="input" class="form-control form-control-sm col-sm-2" value="${i}" readonly>
                    </div>
                </div>
                <div class="table-responsive main_des_table">
                    <table id="table" class="table mb-0 table table-hover col-sm-12 text-center" role="grid">
                        <thead>
                            <tr style="background-color :#0D47A1; color :aliceblue;">
                                <th>No.</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Curency</th>
                                <th>Receipt</th>
                                <th>remark</th>
                            </tr>
                        </thead>
                        <tbody>
                        ${html_des}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="cal_des_detail">
                <div class="alert alert-solid col-sm-12 " style="background: #10929A; color:white; text-align:center;">
                    <div class="small">
                        <label class="control-label col align-self-center fw-bold">Total Advance Cash : &nbsp&nbsp</label>
                        <label class="control-label col align-self-center" align="right">${number_format(Cash.toFixed(2))}</label>
                        <label class="control-label col align-self-center text-center">&nbsp&nbspTHB&nbsp&nbsp</label>
                        <label class="control-label col align-self-center fw-bold">Advance Cash Return : &nbsp&nbsp</label>
                        <label class="control-label col align-self-center" align="right">${number_format(Cash.toFixed(2))}</label>
                        <label class="control-label col align-self-center text-center">&nbsp&nbspTHB&nbsp&nbsp</label>
                    </div>
                </div>
            </div>
            `;
            $('.des_ad').append(main_html);
        });

    },

    ajax_set_preview_data: function (job_doc_ad) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/advance-return/get_preview_data.php",
                data: { 'advance_number': job_doc_ad },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },


    save_list_payment : async function (val,val_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
        }).then(async (result) => {


            await this.set_arr_sv_list(val,val_id)
            if (result.isConfirmed) {
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
            }
        })
    },

    set_arr_sv_list : async function(val,val_id){

        let sel_mt = $(`.sel-mt-return${val}`).val()
        let inp_payment_amount = $(`.inp-payment-re-amount${val}`).val()
        let sel_payment_currency = $(`.sel-payment-re-amount_cur${val}`).val()
        let inp_file = $(`.inp-pic${val}`).val()

        arr_sv_list = []
        arr_sv_list_temp = {}

        arr_sv_list_temp = {
            sel_mt : sel_mt,
            inp_payment_amount : inp_payment_amount,
            sel_payment_currency : sel_payment_currency,
            inp_file : inp_file,
            advance_number : this.advance_cash_global
        }

        arr_sv_list.push(arr_sv_list_temp)
        console.log(arr_sv_list)
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