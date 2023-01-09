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
        console.log(res_data);
       
        //card 1 request petty cash
        $('.inp-pettycash_number').val(res_data['pct']['petty_cash_number']);
        $('.inp-req_by').val(res_data['pct']['rq_by_first']+' '+res_data['pct']['rq_by_last']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        // hr
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        $('.inp-tranf_by').val(res_data['pct']['tf_by_first']+' '+res_data['pct']['tf_by_last']);
        $('.inp-tranf_time').val(res_data['pct']['tranfer_datetime']);
        $('.inp-job_q').val(res_data['scd']['c_qty']);
        $('.inp-all_job').val(res_data['imp_set']);

        pf_tranfer_total = parseFloat(res_data['pct']['tranfer_amount']);
        $('.inp-tranf_total').val(number_format(pf_tranfer_total.toFixed(2)));
        
        // start Description Petty cash request 
        let no_des ='1';
        $('[name = "des-req"] tbody').html('');
        let Cash_arr = [];

        $.each(res_data['pcd'], function (i, v) {
            Cash_arr[v['job_number']] = v['amount'] ;
            pf_amount = parseFloat(v['amount']);
            
            html2 = `
            <tr class="text-center des-req${i}">
            <td>${no_des}</td>
            <td><input type="input" class="form-control form-control-sm" value="${v['consignee_name']} / ${v['job_number']}" readonly></td>
            <td><input type="input" class="form-control form-control-sm td_amount_cash td_amount_cash${v['job_number']}" value="${number_format(pf_amount.toFixed(2))}" style="text-align:right;"readonly></td>
            <td><input type="input" class="form-control form-control-sm" value="${v['currency']}" readonly></td>
            </td>
        </tr>
            `;
            $('[name = "des-req"] tbody').append(html2);
            no_des++;
        });
        // end Description Petty cash request 

        // petty cash return

        // hr
        $('.sel-mt-return').val(res_data['pct']['return_payment_method']);
        $('.inp-payment-by').val(res_data['pct']['tf_by_first']+' '+res_data['pct']['tf_by_last']);
        $('.inp-payment-d-time').val(res_data['pct']['datetime_request']);

        pf_payment_re_amount = parseFloat(res_data['pct']['amount_return']);
        $('.inp-payment-re-amount').val(number_format(pf_payment_re_amount.toFixed(2)));
        $('.inp-payment-re-amount_cur').val(res_data['pct']['amount_return_cur']);
    

       



        let html = '';
        let num = 1;
        

        let no_des_petty_return ='1';
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
            let Pay = 0;
            $.each(v, function (i1, v1) {
                Pay += parseFloat(v1['amount']);
                Sum_Pay = parseFloat(Sum_Pay) + parseFloat(v1['amount']);
               
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
                                <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                                <label class="control-label col-sm-1 align-self-center fw-bold">Pay :</label>
                                <label class="control-label col-sm-2 align-self-center" align="right">${number_format(Pay.toFixed(2))}</label>
                                <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                                <label class="control-label col-sm-2 align-self-center fw-bold">Pay Return :</label>
                                <label class="control-label col-sm-2 align-self-center" align="right">${number_format((parseFloat(Cash) - parseFloat(Pay)).toFixed(2))}</label>
                                <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                            </div>
                        </div>
                </div>
                <br>
            `;
            console.log(parseFloat(Cash) - parseFloat(Pay));
            Sum_cash_return = (parseFloat(Cash) - parseFloat(Pay)) + parseFloat(Sum_cash_return);
            $('.des_pet_de_row').append(main_html);


       });
       $('.inp-petty_cash_req').val(number_format(Sum_Cash.toFixed(2)));
       $('.inp_pay').val(number_format(Sum_Pay.toFixed(2)));
       $('.inp_cash_return').val(number_format(Sum_cash_return.toFixed(2)));

       
        // $.each(res_data['dtpc'], function (i, v) { 
        //     html_check =
        //     `
        //         <tr class="text-center">
        //             <td>${no_des_petty_return}</td>
        //             <td><input type="input" class="form-control form-control-sm inp-amount" value="${v['billing_item_name']}" readonly></td>
        //             </select></td>
        //             <td><input type="input" class="form-control form-control-sm inp-amount" value="${v['amount']}" readonly></td>
        //             <td><input type="input" class="form-control form-control-sm inp-amount" value="${v['currency']}" readonly></td>
        //             </td>
        //             <td></td>
        //             <td><input type="input" class="form-control form-control-sm inp-amount" value="${v['remark']}" readonly></td>
        //         </tr>
        //     `;
        //     // $('[name = "des-check"] tbody').append(html_check);
        //     no_des_petty_return++;

        //     // $('.des_pet_de_row').append($('.des_pet_de').parent().html());
        // });
        
        



         
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

    
};


function number_format(nStr)
{
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