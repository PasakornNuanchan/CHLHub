const pettycash_return = {
    ptc_global: '',
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
        pettycash_return.ptc_global = job_doc_pt;

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


        


        //card 1 request petty cash
        $('.inp-pettycash_number').val(res_data['pct']['petty_cash_number']);
        $('.inp-req_by').val(res_data['pct']['freq'] + ' ' + res_data['pct']['lreq']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        // hr
        if (res_data['pct']['tranfer_method'] == "Tranfer") {
            $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
            $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        } else {
            $('.inp-bankname').val();
            $('.inp-banknumber').val();
        }
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method']);

        $('.inp-tranf_by').val(res_data['name']);
        $('.inp-tranf_time').val(res_data['pdt']);
        $('.inp-job_q').val(res_data['scd']['c_qty']);
        $('.inp-all_job').val(res_data['imp_set']);


        let cur_tran = $('.cur_tran').parent().html();
        $('.add_tranfer_tran').html('');


        // start Description Petty cash request 
        let no_des = '1';
        $('[name = "des-req"] tbody').html('');
        let Cash_arr = [];
        
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
                let html_pic = ''
                if(v1['picture'] != ""){
                   html_pic = `<div class="fs-5 mb-1 pic_show_dt"><i class="bi bi-file-earmark-image download_file" onclick="pettycash_return.download_file_detail('${v1['ID']}');"></i></div>`;
                }

                html_check +=
                    `
                        <tr class="text-center">
                            <td>${num1}</td>
                            <td><input type="input" class="form-control form-control-sm inp-amount" value="${v1['billing_item_name']}" readonly></td>
                            </select></td>
                            <td><input type="input" class="form-control form-control-sm inp-amount" value="${number_format(pf_amount.toFixed(2))}" style="text-align:right;" readonly></td>
                            <td><input type="input" class="form-control form-control-sm inp-amount" value="${v1['currency']}" readonly></td>
                            <td align="center">${html_pic}</td>
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

     

        $('.card_add_return').html('');


        let list_return = await this.ajax_get_list_return(job_doc_pt);
        

        html_by_currency = '';
        $.each(list_return['list_return'], function (i, v) {

            let val_petty_cash = parseFloat(v['amount']);
            let currency = v['currency']

            if(currency == "THB"){
                pay_val = parseFloat(dtpc_val_thb)
            }else if(currency == "USD"){
                pay_val = parseFloat(dtpc_val_usd)
            }else if(currency == "RMB"){
                pay_val = parseFloat(dtpc_val_rmb)
            }

            let fname = v['first_name'];
            let lname = v['last_name'];
            
            if(fname == null || lname == null){
                fname = '';
                lname = '';
            }

            let return_date_time = v['return_datetime']
            if(return_date_time == null){
                return_date_time = '';
            }
            
            

            let petty_cash_return = val_petty_cash - pay_val;

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
                            <input type="text" class="form-control form-control-sm  inp-petty_cash_req" style="text-align: right;" value="${number_format(val_petty_cash.toFixed(2))}" readonly>
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
                            <input type="text" class="form-control form-control-sm inp_pay" style="text-align: right;" value="${number_format(pay_val.toFixed(2))}"readonly>
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
                            <input type="text" class="form-control form-control-sm inp_cash_return" style="text-align: right;" value="${number_format(petty_cash_return.toFixed(2))}" readonly>
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
                            <select name="" id="" class="form-select form-select-sm sel-mt-return${i}">
                                <option value="">-- plese select method return amount --</option>
                                <option value="Tranfer">Tranfer</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-4 col-lg-2 align-self-center">Payment By. :</label>
                        <div class="col-sm-3 col-md-7 col-lg-3">
                            <input type="text" class="form-control form-control-sm  inp-payment-by${i}" value="${fname+" "+lname}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 col-md-4 col-lg-2 align-self-center">Payment datetime :</label>
                        <div class="col-sm-3 col-md-7 col-lg-3">
                            <input type="datetime" class="form-control form-control-sm inp-payment-d-time${i}" value="${return_date_time}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1 col-md-4 col-lg-2 align-self-center">Payment Return Amount :</label>
                        <div class="col col-md-4 col-lg-2">
                            <input type="number" class="form-control form-control-sm inp-payment-re-amount${i}" value="${(petty_cash_return.toFixed(2))}" style="text-align: right;" >
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
                            <input type="file" class="form-control form-control-sm  inp-recep-by${i}" > 
                            <div class="fs-5 mb-1 pic_show_pay"><i class="bi bi-file-earmark-image download_file" onclick="pettycash_return.download_file('${v['ID_pic']}');"></i></div> 
                        </div>
                    </div>
                </div>
                <div style="float: right">
                    <button class="btn btn-success btn-savelist${i}" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" onclick="pettycash_return.push_action_save('${i}',${v['ID']})"><i class="bi bi-check-square"></i> Save</button>
                </div>
            </div>
         </div>`;
            $('.card_add_return').append(html_by_currency)

            if(v['method_tranfer'] != null){
                $(`.sel-mt-return${i}`).val(v['method_tranfer']).attr('disabled',true)
                $(`.inp-payment-re-amount${i}`).attr('disabled',true)
                $(`.inp-recep-by${i}`).attr('disabled',true)
                $(`.btn-savelist${i}`).attr('hidden',true)
            }

            $(`.currency_val_re${i}`).val(currency)
            $(`.currency_pay_re${i}`).val(currency)
            $(`.currency_total_re${i}`).val(currency)
            $(`.currency_return_re${i}`).val(currency)
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

    push_action_save: async function (val,val_id) {
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

                
                let sel_mt_return = $(`.sel-mt-return${val}`).val();
                let inp_payment_val = $(`.inp-payment-re-amount${val}`).val();
                let sel_currency_rt = $(`.currency_return_re${val}`).val()

                if (sel_mt_return == '' || inp_payment_val == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Necessary information is missing. Please input !',
                    })
                } else {
                    let res_sv = await pettycash_return.save_petty_cash(val,val_id)
                    if(res_sv['pcd'] == '1'&&res_sv['st'] == '1'&&res_sv['up'] == '1'){
                        Swal.fire(
                                'saved!',
                                'Your file has been saved.',
                                'success'
                            )
                        await this.set_preview_data(pettycash_return.ptc_global)
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'This data save has error pleses inform to tech team !',
                        })
                    }
                }
            }
        })
    },

    save_petty_cash: async function (val,val_id) {

        arr_sv_ptc = []
        arr_sv_ptc_temp = {}

        let sel_mt_return = $(`.sel-mt-return${val}`).val();
        let inp_payment_val = $(`.inp-payment-re-amount${val}`).val();
        let sel_currency_rt = $(`.currency_return_re${val}`).val();
        //let inp_rec_by = $(`.inp-recep-by${val}`).val();

        let pic = '';
        let file = $(`.inp-recep-by${val}`).prop('files')[0];
        if(file != undefined){
            pic = await convert_file(`.inp-recep-by${val}`);
        }
        
        arr_sv_ptc_temp = {
            sel_mt_return: sel_mt_return,
            inp_payment_val: inp_payment_val,
            sel_currency_rt: sel_currency_rt,
            inp_rec_by: pic,
            petty_cash_number: pettycash_return.ptc_global,
            val_id : val_id,
            
        }

        arr_sv_ptc.push(arr_sv_ptc_temp)
        
        let val_re = await pettycash_return.ajax_sv_ptc_number(arr_sv_ptc)
        return(val_re)
    },


    ajax_sv_ptc_number: async function (arr_sv_ptc) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash-return/sv_ptc_list.php",
                data: { 'arr_sv_ptc': arr_sv_ptc },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                    return(response)
                }
            });
        });
    },

    ajax_get_list_return: async function (job_doc_pt) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash-return/get_transac_ptc.php",
                data: { 'job_doc_pt': job_doc_pt },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    download_file : function (e=null) {  

        
        let ID_req = e;
        
        let data = {
            'id_req' : ID_req
        }

        $.ajax({
            type: "post",
            url: "php/pettycash-return/download_file.php",
            data: data,
            dataType: 'json',
            success: function (response) {
                var newTab = window.open();
                newTab.document.write('<html><body><img src="' + response + '"></body></html>');
            }
        });
    },

    download_file_detail : function (e=null) {  
        let ID_req = e;
        console.log(ID_req)
        
        let data = {
            'id_req' : ID_req
        }
        $.ajax({
            type: "post",
            url: "php/pettycash-return/download_file_detail.php",
            data: data,
            dataType: 'json',
            success: function (response) {
                var newTab = window.open();
                newTab.document.write('<html><body><img src="' + response + '"></body></html>');
            }
        });
    },
}

async function convert_file(c_name) {  
    let myFile = $(c_name).prop('files')[0];
    
    const base64String = await toBase64(myFile);
    return(base64String);
}

function toBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
  });
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