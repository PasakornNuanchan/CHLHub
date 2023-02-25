const pettycash_payment = {
   
    petty_cash_number_global : '',

    // addpthtml: function () {
    //     let html_select = $(".td-sel-conttype").html();
    //     let sl_des_pettycash = $(".db-select-des").html();
    //     html = `
    //     <tr class="pettycash_detail">
    //         <td>${sl_des_pettycash}</td>
    //     <td><input type="input" class="form-control form-control-sm"></td>
    //     <td><select name="" id="" class="form-select">
    //         <option value="" selected>THB</option>
    //         <option value="">USD</option>
    //         <option value="">RMB</option>
    //     </select></td>
    //     <td onclick="petty_cash.del_pettycash_row(this);" align="center">
    //         <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
    //     </td>
    //     </tr>
    //     `;
    //     $('[name="petty-cash-tbl"]>tbody').append(html);

    // },del_pettycash_row: function (e = null) {
    //     $(e).closest("tr").remove();
    // }, 
    
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
        pettycash_payment.petty_cash_number_global = job_doc_pt;
        console.log(action);
        
        if (action == 'preview') {
            pettycash_payment.set_preview_data(job_doc_pt);
            
        } else {

        }
    },

    set_preview_data: async function (job_doc_pt) {
        
        let sl_des_pettycash = $(".db-select-des");

        let res_data = await pettycash_payment.ajax_set_preview_data(job_doc_pt);

        $('.head-of-menu').html('Petty Cash Payment');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-PettyCash_return-list.php" target="" style="color:white;">Petty Cash payment List</a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Petty Cash Payment (Petty Cash Number ${job_doc_pt})</li>`;
        $('.bcpage').append(html_bdpage);
        


        console.log(res_data);
        
        //card 1 request petty cash
        $('.inp-req_by').val(res_data['pct']['first_name']+' '+res_data['pct']['last_name']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        // hr
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        // hr
        $('.inp-job_quantity').val(res_data['scd']['c_qty']);
        pf_total_amount = parseFloat(res_data['pct']['total_amount_request']);
        $('.inp-total_amount').val(number_format(pf_total_amount.toFixed(2)));
        $('.sel_total_amount_req').val(res_data['pct']['total_amount_request_cur']);
        
        //card 2 tranfer
        pf_total_amount_tf = parseFloat(res_data['pct']['total_amount_request']);
        
        
        
        
        var sel_description_petty_cash_cur = $('.sel_cur').parent().html();

        
        $('[name = "petty_cash_description"] tbody').html('');
         
        arr_get_am = []
        arr_get_am_temp = {}
        $.each(res_data['pcd'], function (i, v) { 

            pf_amount = parseFloat(v['amount']);
            cur_amount = v['currency'];
            
            html = `
            <tr class="pettycash_detail${i}">
            <td><input type="input" class="form-control form-control-sm" value="${v['job_number']} / ${v['consignee_name']}" readonly></td>
            <td><input type="input" class="form-control form-control-sm inp_amount" style="text-align: right;" value="${number_format(pf_amount.toFixed(2))}" readonly></td>
            <td>${sel_description_petty_cash_cur}</td>
            
            </tr>
            `;


            $('[name="petty_cash_description"]>tbody').append(html);
            $(`.pettycash_detail${i} .sel_cur`).val(cur_amount).attr('disabled', true);
            arr_get_am_temp = {
                pf_amount : pf_amount,
                cur_amount : cur_amount
            }
            //$(`sel-des-pcd${i}>select`).val(v['job_number']);
      
            // $(`td.sel-des-pcd${i} > select option[value="${v['job_number']}"]`).attr('selected', 'selected');


            // <td class="sel-des-pcd${i} sel-des-pcd">${sl_des_pettycash.html()}</td>

            arr_get_am.push(arr_get_am_temp);
        });
       
        
        
        
        $('.inp-prtload').val(res_data['port_of_loading_number']).attr('disabled',true);
        $('.inp-ts_port').val(res_data['ts_port_number']).attr('disabled',true);
        $('.inp-etd').val(res_data['etd']).attr('readonly',true);
        $('.inp-eta').val(res_data['eta']).attr('readonly',true);

        await pettycash_payment.change_amount();
        var tranfer_cur_sel = $('.sel_amt_req_tranfer').parent().html();
        var sel_amount_tranfer = $('.sel_amount_tranfer').parent().html();
        
        $('.add_card_tranfer').html('');
        html_tranfer = '';
        
        
        $.each(res_data['pcdt'],function (i, v){
            
            let amt_request = parseFloat(v['amount_all']);
            let cur_amount = v['currency'];
            
            console.log(v['amount_tranfer'])
            if(v['amount_tranfer'] == null){
                html_test = 
        `
        <div class="card card-ptn card-ptn${i}">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Tranfer</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label class="control-label col-sm-2 align-self-center">Amount Request :</label>
                    <div class="col-sm-9 col-lg-9">
                        <div class="row">
                            <div class="col-sm-3 col-lg-3">
                                <input type="text" class="form-control form-control-sm inp-amount_request" style="text-align:right;" value="${amt_request.toFixed(2)}" readonly>
                            </div>
                            <div class="col-sm-3 col-lg-2">
                                ${tranfer_cur_sel}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2 align-self-center">Amount Tranfer</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col col-sm-4 col-lg-3">
                                <input type="number" class="form-control form-control-sm inp_amount_tranfer" style="text-align:right;" value="${amt_request.toFixed(2)}">
                            </div>
                            <div class="col col-sm-2">
                                ${sel_amount_tranfer}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-2 align-self-center">Trust Receipt :</label>
                    <div class="col-sm-9 col-lg-6">
                        <input type="file" class="form-control form-control-sm inp-receipt" readonly>
                    </div>
                </div>
                <div style="float: right">
                    <button class="btn btn-success rounded-pill btn-sm " onclick="pettycash_payment.push_action_save();"><i class="bi bi-check-circle-fill"></i> Save</button>
                </div>
            </div>
        </div>
        `;
            
        $('.add_card_tranfer').append(html_test);
        $(`.card-ptn${i} .sel_amt_req_tranfer`).val(cur_amount).attr('disabled', true);
        $(`.card-ptn${i} .sel_amount_tranfer`).val(cur_amount);
            }else{
                let amt_tf = parseFloat(v['amount_tranfer']);
                let cur_tf = v['currency_tranfer'];

                html_test = 
                `
                <div class="card card-ptn card-ptn${i}">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Tranfer</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center">Amount Request :</label>
                            <div class="col-sm-9 col-lg-9">
                                <div class="row">
                                    <div class="col-sm-3 col-lg-3">
                                        <input type="text" class="form-control form-control-sm inp-amount_request" style="text-align:right;" value="${amt_request.toFixed(2)}" readonly>
                                    </div>
                                    <div class="col-sm-3 col-lg-2">
                                        ${tranfer_cur_sel}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center">Amount Tranfer</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col col-sm-4 col-lg-3">
                                        <input type="number" class="form-control form-control-sm inp_amount_tranfer" style="text-align:right;" value="${amt_tf.toFixed(2)}" readonly>
                                    </div>
                                    <div class="col col-sm-2">
                                        ${sel_amount_tranfer}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center">Trust Receipt :</label>
                            <div class="col-sm-9 col-lg-6">
                                <input type="file" class="form-control form-control-sm inp-receipt" disabled>
                            </div>
                        </div>
                        <div style="float: right">
                            <button class="btn btn-success rounded-pill btn-sm " onclick="pettycash_payment.push_action_save();"><i class="bi bi-check-circle-fill"></i> Save</button>
                        </div>
                    </div>
                </div>
                `;
                    
                $('.add_card_tranfer').append(html_test);
                $(`.card-ptn${i} .sel_amt_req_tranfer`).val(cur_amount).attr('disabled', true);
                $(`.card-ptn${i} .sel_amount_tranfer`).val(cur_tf).attr('disabled', true);
            }
        
        })
    },

    ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash-payment/get_preview_data.php",
                data: { 'petty_number': job_doc_pt },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    change_amount: async function () {
        let val_total = 0;
        var inputs = $('.inp_amount');
        var currency = $('.sel_cur');
        let thb_cur = 0;
        let usd_cur = 0;
        let rmb_cur = 0;

        $.each(arr_get_am,function(i,v){
            amount = (v['pf_amount'])
            currencyz = (v['cur_amount'])
            if (currencyz == "THB") {
                thb_cur = parseFloat(thb_cur) + parseFloat(amount)
            } else if (currencyz == "USD") {
                usd_cur = parseFloat(usd_cur) + parseFloat(amount)
            } else if (currencyz == "RMB") {
                rmb_cur = parseFloat(rmb_cur) + parseFloat(amount)
            }
        })

        now_usd = 1;
        now_thb = 34.42;
        now_rmb = 6.86;

        var rowCount = $('[name = "petty_cash_description"] tr').length;
        let count_row = (rowCount-1);

        total_val_usd = usd_cur + thb_cur / now_thb + rmb_cur / now_rmb
        total_val_thb = thb_cur + usd_cur * now_thb + (rmb_cur / now_rmb) * now_thb
        total_val_rmb = rmb_cur + usd_cur * now_rmb + (thb_cur / now_thb) * now_rmb



        $('.inp-amt-thb').val(number_format(thb_cur))
        $('.inp-amt-usd').val(number_format(usd_cur))
        $('.inp-amt-rmb').val(number_format(rmb_cur))

        $('.inp-total-amt-thb').val(number_format(total_val_thb.toFixed(2)))
        $('.inp-total-amt-usd').val(number_format(total_val_usd.toFixed(2)))
        $('.inp-total-amt-rmb').val(number_format(total_val_rmb.toFixed(2)))


        $('.inp-count').val(count_row)
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
                card_pass= '';
                $('.card-ptn').each(async function (i, e) {
                    let get_req_amount = parseFloat($('.inp-amount_request', this).val());
                    let get_req_currency = $('.sel_amt_req_tranfer', this).val();
                    let get_tf_amount = parseFloat($('.inp_amount_tranfer', this).val());
                    let get_tf_currency = $('.sel_amount_tranfer', this).val();
                    let inp_receipt = $('.inp-receipt', this).val();

                    if(get_req_amount != get_tf_amount || get_req_currency != get_tf_currency ){
                    Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data Amount or currency not match ',
                        })
                        card_pass = 1;
                        return false;
                    }
                })

                if(card_pass != 1){
                    await pettycash_payment.save_pc_payment()
                }
                
                
            }
        })
    },

    save_pc_payment : async function(){
        let arr_pc_payment = []
        let arr_pc_payment_temp = {}
        
        $('.card-ptn').each(async function (i, e) {
            let get_tf_amount = parseFloat($('.inp_amount_tranfer', this).val());
            let get_tf_currency = $('.sel_amount_tranfer', this).val();
            let inp_receipt = $('.inp-receipt', this).val();

            arr_pc_payment_temp = {
                get_tf_amount: get_tf_amount,
                get_tf_currency: get_tf_currency,
                inp_receipt: inp_receipt,
                doc_number: pettycash_payment.petty_cash_number_global
            }
            arr_pc_payment.push(arr_pc_payment_temp);
        })

        await pettycash_payment.ajax_save_pc_payment(arr_pc_payment)
        $('.inp_amount_tranfer').attr('disabled',true)
        $('.sel_amount_tranfer').attr('disabled',true)
        $('.inp-receipt').attr('disabled',true)
    },

    ajax_save_pc_payment: function (arr_pc_payment) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash-payment/save_list.php",
                data: { 'arr_pc_payment': arr_pc_payment },
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
