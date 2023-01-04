const advance_return = {
   
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
        
        console.log(action);
        
        if (action == 'preview') {
            
            advance_return.set_preview_data(job_doc_ad);
            
        } else {

        }
    },

    set_preview_data: async function (job_doc_pt) {
    
        let sl_des_pettycash = $(".db-select-des");

        let res_data = await advance_return.ajax_set_preview_data(job_doc_pt);
        console.log(res_data);
       
        //card 1 request petty cash
        $('.inp-advance_number').val(res_data['pct']['advance_cash_number']);
        $('.inp-req_by').val(res_data['pct']['first_name']+' '+res_data['pct']['last_name']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        // hr
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method_request']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        $('.inp-tranf_by').val(res_data['pct']['tf_by_first']+' '+res_data['pct']['tf_by_last']);
        $('.inp-tranf_time').val(res_data['pct']['tranfer_datetime']);
        $('.inp-all_job').val(res_data['imp_set']);
        $('.inp-tranf_total').val(res_data['pct']['tranfer_amount']);
        
        // start Description Petty cash request 
        let no_des ='1';
        var cal_amount = 0;
        $('[name = "des-req"] tbody').html('');
        let cash_arr = [];

        $.each(res_data['pcd'], function (i, v) { 
            cash_arr[v['job_number']] = v['amount'];
            cal_amount += parseFloat(v['amount']);

            pf_amount = parseFloat(v['amount']);

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
        // end Description Petty cash request 

        // petty cash return
        
        $('.inp-advance_cash_req').val(number_format(cal_amount.toFixed(2)));

        pf_payment_amount = parseFloat(res_data['payment']['payment_amount']);

        // hr
        $('.sel-mt-return').val(res_data['payment']['payment_method']);
        $('.inp-payment-by').val(res_data['payment']['first_name']+' '+res_data['payment']['last_name']);
        $('.inp-payment-d-time').val(res_data['payment']['payment_datetime']);
        $('.inp-payment-re-amount').val(number_format(pf_payment_amount.toFixed(2)));
        $('.sel-payment-re-amount_cur').val(res_data['payment']['payment_amount_cur']);
    

       



        let html = '';
        let num = 1;
        
        
        let no_des_petty_return ='1';
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
        
        $.each(res_data['dtpc'], function (i,v){
            let num1 = 0;
            let html_des = '';
            var Cash = parseFloat(cash_arr[i]);
            
            
            
            

            $.each(v, function (i1, v1){
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
                                        <div class="alert alert-solid col-sm-11 " style="background: #10929A; color:white; text-align:center;">
                                            <div class="small">
                                                <label class="control-label col-sm-0 align-self-center fw-bold">Advance Cash :</label>
                                                <label class="control-label col-sm-2 align-self-center" align="right">${number_format(Cash.toFixed(2))}</label>
                                                <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                                                <label class="control-label col-sm-4 align-self-center fw-bold">Advance Cash Return :</label>
                                                <label class="control-label col-sm-2 align-self-center" align="right">${number_format(Cash.toFixed(2))}</label>
                                                <label class="control-label col-sm-0 align-self-center text-center">THB</label>
                                            </div>
                                        </div>
                                    </div>
                                    `
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