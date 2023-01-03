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
        $('.inp-req_by').val(res_data['pct']['rq_by_first']+' '+res_data['pct']['rq_by_last']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        // hr
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        $('.inp-tranf_by').val(res_data['pct']['tf_by_first']+' '+res_data['pct']['tf_by_last']);
        $('.inp-tranf_time').val(res_data['pct']['tranfer_datetime']);
        $('.inp-all_job').val(res_data['imp_set']);
        $('.inp-tranf_total').val(res_data['pct']['tranfer_amount']);
        
        // start Description Petty cash request 
        let no_des ='1';
        $('[name = "des-req"] tbody').html('');
        $.each(res_data['pcd'], function (i, v) { 
            html2 = `
            <tr class="text-center des-req${i}">
            <td>${no_des}</td>
            <td><input type="input" class="form-control form-control-sm" value="${v['consignee_name']} / ${v['job_number']}" readonly></td>
            <td><input type="input" class="form-control form-control-sm" value="${v['amount']}" readonly></td>
            <td><input type="input" class="form-control form-control-sm" value="${v['currency']}" readonly></td>
            </td>
        </tr>
            `;
            $('[name = "des-req"] tbody').append(html2);
            no_des++;
        });
        // end Description Petty cash request 

        // petty cash return
        $('.inp-advance_cash_req').val(res_data['pct']['total_amount_request']);


        // hr
        $('.sel-mt-return').val(res_data['pct']['return_payment_method']);
        $('.inp-payment-by').val(res_data['pct']['tf_by_first']+' '+res_data['pct']['tf_by_last']);
        $('.inp-payment-d-time').val(res_data['pct']['datetime_request']);
        $('.inp-payment-re-amount').val(res_data['pct']['amount_return']);
        $('.sel-payment-re-amount_cur').val(res_data['pct']['amount_return_cur']);
    

       



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


        $('.job_des_title').html('');    

        $.each(res_data['$pcdjn'],function (i,v){
            html_des = `
                <div class="form-group row">
                    <label class="control-label col-sm-2 align-self-center">Job number :</label>
                    <div class="col col-sm-3">
                        <input type="input" class="form-control form-control-sm col-sm-2" value="${v}" readonly>
                    </div>
                </div>         
                `;
            $('.job_des_title').append(html_des);
        });

        $('.main_des_table').html('');
        $.each(res_data['dtpc'],function (i,v){
            
        html_detail_table = `
        <tr class="text-center">
            <td>1</td>
            <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td><input type="input" class="form-control form-control-sm" value="${v['amount']}" readonly></td>
            <td><select name="" id="" class="form-select form-select-sm shadow-none" disabled>
                <option value="" selected>THB</option>
            <option value="">USD</option>
            <option value="">RMB</option>
            </select>
            </td>
            <td></td>
            <td></td>
        </tr>
        `;

        });

        html_table_des = `
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
               ${html_detail_table}                                     
                </tbody>
            </table>
        </div>
            `;
        $('.main_des_table').append(html_table_des);


        




        $('.cal_des_detail').html('');
            
           
        
        



         
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
