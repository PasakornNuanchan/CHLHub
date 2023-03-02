const pettycash_return = {

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
        let get_doc_pt = getUrlParameter('petty_cash_number');
        let get_action = getUrlParameter('action');

        let job_doc_pt = get_doc_pt == false ? null : get_doc_pt;
        let action = get_action == false ? null : get_action;

        console.log(action);

        if (action == 'preview') {

            pettycash_return.set_preview_data(job_doc_pt);

        } else {

        }
    },

    set_preview_data: async function (job_doc_pt) {

        let sl_des_pettycash = $(".db-select-des");

        let res_data = await pettycash_return.ajax_set_preview_data(job_doc_pt);

        $('.head-of-menu').html('Petty Cash Return');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Petty Cash Return List</a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Petty Cash Return (Job number ${job_doc_pt})</li>`;
        $('.bcpage').append(html_bdpage);


        console.log(res_data);


        //card 1 request petty cash
        $('.inp-pettycash_number').val(res_data['pct']['petty_cash_number']);
        $('.inp-req_by').val(res_data['pct']['rq_by_first'] + ' ' + res_data['pct']['rq_by_last']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        // hr
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        $('.inp-tranf_by').val(res_data['pct']['tf_by_first'] + ' ' + res_data['pct']['tf_by_last']);
        $('.inp-tranf_time').val(res_data['pct']['tranfer_datetime']);
        $('.inp-job_q').val(res_data['scd']['c_qty']);
        $('.inp-all_job').val(res_data['imp_set']);


        let cur_tran = $('.cur_tran').parent().html();
        $('.add_tranfer_tran').html('');


        // start Description Petty cash request 
        let no_des = '1';
        $('[name = "des-req"] tbody').html('');
        let Cash_arr = [];
        let arr_ptc_return = []
        let arr_ptc_return_tmp = {}
        let thb_cur = 0;
        let usd_cur = 0;
        let rmb_cur = 0;


        $.each(res_data['pcd'], function (i, v) {
            Cash_arr[v['job_number']] = v['amount'];
            pf_amount = parseFloat(v['amount']);
            let currencyz = v['currency']
            if (currencyz == "THB") {
                thb_cur = parseFloat(thb_cur) + parseFloat(pf_amount)
            } else if (currencyz == "USD") {
                usd_cur = parseFloat(usd_cur) + parseFloat(pf_amount)
            } else if (currencyz == "RMB") {
                rmb_cur = parseFloat(rmb_cur) + parseFloat(pf_amount)
            }

            html2 = `
            <tr class="text-center des-req${i}">
            <td>${no_des}</td>
            <td><input type="input" class="form-control form-control-sm" value="${v['consignee_name']} / ${v['job_number']}" readonly></td>
            <td><input type="input" class="form-control form-control-sm td_amount_cash td_amount_cash${v['job_number']}" value="${number_format(pf_amount.toFixed(2))}" style="text-align:right;"readonly></td>
            <td><input type="input" class="form-control form-control-sm sel_cur_des" value="${currencyz}" readonly></td>
            </td>
        </tr>
            `;
            $('[name = "des-req"] tbody').append(html2);
            no_des++;
        });
        // end Description Petty cash request 




        // petty cash return

        // hr
        // $('.sel-mt-return').val(res_data['pct']['return_payment_method']);
        // $('.inp-payment-by').val(res_data['pct']['tf_by_first']+' '+res_data['pct']['tf_by_last']);
        // $('.inp-payment-d-time').val(res_data['pct']['datetime_request']);

        // pf_payment_re_amount = parseFloat(res_data['pct']['amount_return']);
        // $('.inp-payment-re-amount').val(number_format(pf_payment_re_amount.toFixed(2)));
        // $('.inp-payment-re-amount_cur').val(res_data['pct']['amount_return_cur']);


        let dtpc_val_thb = 0;
        let dtpc_val_usd = 0;
        let dtpc_val_rmb = 0;



        let html = '';
        let num = 1;


        let no_des_petty_return = '1';
        $('[name = "des-check"] tbody').html('');

        let text = $('.des_pet_de').parent().html()
        $('.des_pet_de_row').html('');
        var Sum_Cash = 0;
        var Sum_Pay = 0;
        var Sum_cash_return = 0;

        $.each(res_data['dtpc'], function (i, v) {
            let num1 = 0;
            let html_check = '';
            var Cash = parseFloat(Cash_arr[i]);

            Sum_Cash = parseFloat(Cash) + parseFloat(Sum_Cash);

            let currency = '';

            let Pay = 0;
            $.each(v, function (i1, v1) {
                Pay += parseFloat(v1['amount']);
                Sum_Pay = parseFloat(Sum_Pay) + parseFloat(v1['amount']);
                currency = v1['currency']

                pf_amount = parseFloat(v1['amount']);
                num1++;
                html_check +=
                    `
                        <tr class="text-center">
                            <td>${num1}</td>
                            <td><input type="input" class="form-control form-control-sm inp-amount" value="${v1['billing_item_name']}" readonly></td>
                            </select></td>
                            <td><input type="input" class="form-control form-control-sm inp-amount" value="${number_format(pf_amount.toFixed(2))}" style="text-align:right;" readonly></td>
                            <td><input type="input" class="form-control form-control-sm inp-amount" value="${v1['currency']}" readonly></td>
                            </td>
                            <td></td>
                            <td><input type="input" class="form-control form-control-sm inp-amount" value="${v1['remark']}" readonly></td>
                        </tr>
                    `;
            });
            let main_html = `
            <br><br>
                <div class="des_pet_de">
                    <div class="form-group row">
                        <label class="control-label col-sm-1 col-md-4 col-lg-2 align-self-center mb-0">Job number :</label>
                        <div class="col col-md-3 col-lg-3">
                            <input type="input" class="form-control form-control-sm" value=" ${i}"  readonly>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="table" class="table mb-0 table table-hover col-sm-12 text-center" name="des-check" role="grid">
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
                                ${html_check}
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <center>
                        <div class="alert alert-solid col-sm-11" style="background: #10929A; color:white;">
                            <div class="small">
                                <label class="control-label col-sm-0 align-self-center fw-bold">Petty Cash :</label>
                                <label class="control-label col-sm-2 align-self-center" align="right">${number_format(Cash.toFixed(2))}</label>
                                <label class="control-label col-sm-0 align-self-center text-center">${currency}</label>
                                <label class="control-label col-sm-1 align-self-center fw-bold">Pay :</label>
                                <label class="control-label col-sm-2 align-self-center" align="right">${number_format(Pay.toFixed(2))}</label>
                                <label class="control-label col-sm-0 align-self-center text-center">${currency}</label>
                                <label class="control-label col-sm-2 align-self-center fw-bold">Pay Return :</label>
                                <label class="control-label col-sm-2 align-self-center" align="right">${number_format((parseFloat(Cash) - parseFloat(Pay)).toFixed(2))}</label>
                                <label class="control-label col-sm-0 align-self-center text-center">${currency}</label>
                            </div>
                        </div>
                </div>
                <br>
            `;
            //console.log(parseFloat(Cash) - parseFloat(Pay));
            Sum_cash_return = (parseFloat(Cash) - parseFloat(Pay)) + parseFloat(Sum_cash_return);
            $('.des_pet_de_row').append(main_html);

            if (currency == "THB") {
                dtpc_val_thb = parseFloat(dtpc_val_thb + Pay)
            } else if (currency == "USD") {
                dtpc_val_usd = parseFloat(dtpc_val_usd + Pay)
            } else if (currency == "RMB") {
                dtpc_val_rmb = parseFloat(dtpc_val_rmb + Pay)
            }

        });


        //    $('.inp-petty_cash_req').val(number_format(Sum_Cash.toFixed(2)));
        //    $('.inp_pay').val(number_format(Sum_Pay.toFixed(2)));
        //    $('.inp_cash_return').val(number_format(Sum_cash_return.toFixed(2)));

        console.log(dtpc_val_thb)
        console.log(dtpc_val_usd)
        console.log(dtpc_val_rmb)


        arr_ptc_return_tmp = {
            val: thb_cur,
            pay: dtpc_val_thb,
            cur: "THB"
        }
        arr_ptc_return.push(arr_ptc_return_tmp)
        arr_ptc_return_tmp = {
            val: usd_cur,
            pay: dtpc_val_usd,
            cur: "USD",
        }
        arr_ptc_return.push(arr_ptc_return_tmp)
        arr_ptc_return_tmp = {
            val: rmb_cur,
            pay: dtpc_val_rmb,
            cur: "RMB",
        }
        arr_ptc_return.push(arr_ptc_return_tmp)
        console.log(arr_ptc_return)

        $('.card_add_return').html('');

        $.each(arr_ptc_return, function (i, v) {
            let val_re = (v['val'])
            let pay_re = (v['pay'])
            let cur_re = (v['cur'])

            let total = parseFloat(val_re) - parseFloat(pay_re)



            if (val_re != 0) {

                html_by_currency = `
   <div class="card card${i}">
   <div class="card-header d-flex justify-content-between">
       <div class="header-title">
           <h4 class="card-title fw-normal">Petty Cash Return</h4>
       </div>
   </div>
   <div class="card-body">
       <div class="row">
           <div class="form-group row">
               <label class="control-label col-sm-1 col-md-4 col-lg-2 align-self-center">Petty Cash :</label>
               <div class="col col-md-4 col-lg-2">
                   <input type="text" class="form-control form-control-sm  inp-petty_cash_req" style="text-align: right;" value="${number_format(val_re.toFixed(2))}" readonly>
               </div>
               <div class="col col-md-3 col-lg-1">
                   <select name="" id="" class="form-select form-select-sm shadow-none currency_val_re${i}" disabled>
                       <option value="THB">THB</option>
                       <option value="USD">USD</option>
                       <option value="RMB">RMB</option>
                   </select>
               </div>
           </div>
           <div class="form-group row">
               <label class="control-label col-sm-1 col-md-4 col-lg-2 align-self-center">Pay :</label>
               <div class="col col-md-4 col-lg-2">
                   <input type="text" class="form-control form-control-sm inp_pay" style="text-align: right;" value="${number_format(pay_re.toFixed(2))}"readonly>
               </div>
               <div class="col col-md-3 col-lg-1">
                   <select name="" id="" class="form-select form-select-sm shadow-none currency_pay_re${i}" disabled>
                       <option value="THB">THB</option>
                       <option value="USD">USD</option>
                       <option value="RMB">RMB</option>
                   </select>
               </div>
           </div>
           <div class="form-group row">
               <label class="control-label col-sm-3 col-md-4 col-lg-2 align-self-center">Petty Cash return :</label>
               <div class="col col-md-4 col-lg-2">
                   <input type="text" class="form-control form-control-sm inp_cash_return" style="text-align: right;" value="${number_format(total.toFixed(2))}" readonly>
               </div>
               <div class="col col-md-3 col-lg-1">
                   <select name="" id="" class="form-select form-select-sm shadow-none currency_total_re${i}" disabled>
                       <option value="THB">THB</option>
                       <option value="USD">USD</option>
                       <option value="RMB">RMB</option>
                   </select>
               </div>
           </div>
           <hr>
           <div class="form-group row">
               <label class="control-label col-sm-3 col-md-4 col-lg-2 align-self-center">Payment medthod :</label>
               <div class="col-sm-3 col-md-7 col-lg-3">
                   <select name="" id="" class="form-select form-select-sm sel-mt-return">
                       <option value="" selected>-- plese select method return amount --</option>
                       <option value="Tranfer">Tranfer</option>
                       <option value="Cash">Cash</option>
                   </select>
               </div>
           </div>
           <div class="form-group row">
               <label class="control-label col-sm-3 col-md-4 col-lg-2 align-self-center">Payment By. :</label>
               <div class="col-sm-3 col-md-7 col-lg-3">
                   <input type="text" class="form-control form-control-sm  inp-payment-by" readonly>
               </div>
           </div>
           <div class="form-group row">
               <label class="control-label col-sm-3 col-md-4 col-lg-2 align-self-center">Payment datetime :</label>
               <div class="col-sm-3 col-md-7 col-lg-3">
                   <input type="datetime" class="form-control form-control-sm inp-payment-d-time" readonly>
               </div>
           </div>
           <div class="form-group row">
               <label class="control-label col-sm-1 col-md-4 col-lg-2 align-self-center">Payment Return Amount :</label>
               <div class="col col-md-4 col-lg-2">
                   <input type="number" class="form-control form-control-sm inp-payment-re-amount" value="${(total.toFixed(2))}" style="text-align: right;" >
               </div>
               <div class="col col-md-3 col-lg-1">
                   <select name="" id="" class="form-select form-select-sm shadow-none inp-payment-re-amount_cur currency_return_re${i}" disabled>
                       <option value="THB" selected>THB</option>
                       <option value="USD">USD</option>
                       <option value="RMB">RMB</option>
                   </select>
               </div>
           </div>
           <div class="form-group row">
               <label class="control-label col-sm-3 col-md-4 col-lg-2 align-self-center">receipt :</label>
               <div class="col-sm-3 col-md-7 col-lg-3">
                   <input type="file" class="form-control form-control-sm  inp-recep-by" >
               </div>
           </div>
       </div>
       <div style="float: right">
           <button class="btn btn-success" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="pettycash_return.push_action_save()"><i class="bi bi-check-square"></i> Save</button>
       </div>
   </div>
</div>`;
                console.log(cur_re)
                $('.card_add_return').append(html_by_currency)
                $(`.currency_val_re${i}`).val(cur_re)
                $(`.currency_pay_re${i}`).val(cur_re)
                $(`.currency_total_re${i}`).val(cur_re)
                $(`.currency_return_re${i}`).val(cur_re)
            }
        })
    },

    ajax_set_preview_data: function (job_doc_pt) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash-return/get_preview_data.php",
                data: { 'petty_number': job_doc_pt },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    push_action_save: async function () {
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
                await pettycash_return.save_petty_cash()
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
            )}
        })
    },

    save_petty_cash: async function(){
        
    }
}




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