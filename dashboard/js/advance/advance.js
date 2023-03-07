const advance_cash = {

    

    get_description_sel : async function () { 
        let res_description = await advance_cash.ajax_get_description();
        return res_description;
    },
    ajax_get_description : function () { 
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/advance/get_advancecash.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    html_description : async function (data) { 
        
        res_select = await advance_cash.get_description_sel();
        let html = '';
        console.log(res_select)
        $.each(res_select, function (i, v) { 
            html += `
            <option value="${v['job_number']}${v['currency']}">${v['job_number']}(${v['currency']}) / ${v['consignee_name']} </option>
            `;  
        });
        
        $('.row-of-description').append(html);
    },

    ajax_get_description_create : async function () { 
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/advance/get_advance_amt.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },

    html_description_for_create : async function (data) { 
        
        res_select = await advance_cash.ajax_get_description_create();
        let html = '';
        console.log(res_select)
        $.each(res_select, function (i, v) { 
            html += `
            <option value="${v['job_number']}${v['currency']}">${v['job_number']}(${v['currency']}) / ${v['consignee_name']} </option>
            `;  
        });
        
        $('.row-of-description').append(html);
    },


    addadhtml: function () {
        let sel_des = $('.row-of-description').parent().html();
        let sel_cur = $('.sel_currency').parent().html();
        html = `
        <tr class="advance_detail advance_detail">
            <td>${sel_des}</td>
        <td><input type="number" class="form-control form-control-sm inp-amount inp-amount-req" onchange="advance_cash.change_amount();" style="text-align:right;">
            <input type="hidden" class="inp_check_id" value=""></td>
        <td>${sel_cur}</td>
        <td align="center" class="td-delete">
            <button type="button" class="btn btn-danger rounded-pill btn-xs " onclick="advance_cash.del_advancecash_row(this);" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
        </td>
        </tr>
        `;
        $('[name="advance-cash-tbl"]>tbody').append(html);
    
        },
        
    del_advancecash_row: function (e = null) {
        $(e).closest("tr").remove();
     },

     check_get: async function () {
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
        let get_doc_pt = getUrlParameter('advance_cash_number');
        let get_action = getUrlParameter('action');

        let job_doc_pt = get_doc_pt == false ? null : get_doc_pt;
        let action = get_action == false ? null : get_action;
        
        if (job_doc_pt != 'undefined') {
            await advance_cash.html_description();
            await advance_cash.set_preview_data(job_doc_pt);
            await advance_cash.change_amount();
            await advance_cash.main_preview();
        } else {
            await advance_cash.html_description_for_create();
        }
    },
    set_preview_data: async function (job_doc_pt) {
        
        let sl_des_pettycash = $(".db-select-des");

        let res_data = await advance_cash.ajax_set_preview_data(job_doc_pt);

        $('.head-of-menu').html('Advance Cash');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-Advance-list.php" target="" style="color:white;">Advance Cash List</a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Advance Cash (Advance Cash Number ${job_doc_pt})</li>`;
        $('.bcpage').append(html_bdpage);

        console.log(res_data);
       if(res_data['act'] != "0 results"){
        $('.inp-ac_number').val(res_data['act']['advance_cash_number']).attr('disabled',true);
        $('.sel_tranfer_mt').val(res_data['act']['tranfer_method_request']).attr('disabled',true);
        // $('.inp-bankname').val(res_data['act']['tranfer_bank_name']);
        // $('.inp-banknumber').val(res_data['act']['tranfer_bank_number']);
        }


        let sel_des = $('.row-of-description').parent().html();
        let sel_cur = $('.sel_currency').parent().html();
        if(res_data['acd'] != "0 results"){
        $('[name = "advance-cash-tbl"] tbody').html('');
            $.each(res_data['acd'], function (i, v) { 

                let amt = parseFloat(v['amount'])
                
                html_check =
                `
                <tr class="advance_detail advance_detail${i}">
                <td class="db-select-des ">
                    ${sel_des}</td>
                <td><input type="number" class="form-control form-control-sm inp-amount-req inp-amount" value="${amt.toFixed(2)}" style="text-align:right;" readonly>
                    
                </td>
                <td>${sel_cur}</td>
            <td></td>
                </tr>
                `;
                $('[name = "advance-cash-tbl"] tbody').append(html_check);
                
                $(`.advance_detail${i} .row-of-description`).val(v['job_number']+v['currency']).attr('disabled',true);
                $(`.advance_detail${i} .sel_currency`).val(v['currency']).attr('disabled',true);;
            });
        }
      
    }, 
    ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/advance/get_preview_data.php",
                data: { 'advance_number': job_doc_pt },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    main_preview : async function(){
        $('.btn_add_new_list').html('');
        $('.btn_save_list').html('');
    },

    change_amount: async function () {
        let val_total = 0;
        var inputs = $('.inp-amount');
        var currency = $('.sel_currency');
        
        let thb_cur = 0;
        let usd_cur = 0;
        let rmb_cur = 0;

        for (var i = 0; i < inputs.length; i++) {
            let amount = $(inputs[i]).val();
            let currencyz = $(currency[i]).val();
            if(amount == "" ){
                amount = 0;
            }

            if (currencyz == "THB") {
                thb_cur = parseFloat(thb_cur) + parseFloat(amount)
            } else if (currencyz == "USD") {
                usd_cur = parseFloat(usd_cur) + parseFloat(amount)
            } else if (currencyz == "RMB") {
                rmb_cur = parseFloat(rmb_cur) + parseFloat(amount)
            }

        }

        
        now_usd = 1;
        now_thb = 34.42;
        now_rmb = 6.86;

        var rowCount = $('[name = "advance-cash-tbl"] tr').length;
        let count_row = (rowCount - 1);

        total_val_usd = usd_cur + thb_cur / now_thb + rmb_cur / now_rmb
        total_val_thb = thb_cur + usd_cur * now_thb + (rmb_cur / now_rmb) * now_thb
        total_val_rmb = rmb_cur + usd_cur * now_rmb + (thb_cur / now_thb) * now_rmb

        $('.inp-count').val(count_row)
        
        $('.inp-amt-thb').val(number_format(thb_cur))
        $('.inp-amt-usd').val(number_format(usd_cur))
        $('.inp-amt-rmb').val(number_format(rmb_cur))

        $('.inp-total-amt-thb').val(number_format(total_val_thb.toFixed(2)))
        $('.inp-total-amt-usd').val(number_format(total_val_usd.toFixed(2)))
        $('.inp-total-amt-rmb').val(number_format(total_val_rmb.toFixed(2)))


        
        
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
            let check_val = '';
            if (result.isConfirmed) {
                let check_val = 0;
                let sel_met = $('.sel_tranfer_mt').val()

                if(sel_met == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Plese select method Cash ot Tranfer',
                    })
                    return false;
                }
                
                $('[name="advance-cash-tbl"] tbody > tr').each(function (i,e){
                    let get_description = $('.row-of-description', this).val();
                    let get_amount = $('.inp-amount-req', this).val();
                    let get_currency = $('.sel_currency', this).val();
                    if(get_description == ""|| get_amount == "" || get_currency == ""){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data Description or Amount is missing ',
                        })
                        check_val = 1;
                        return false;
                    }else{
                        check_val = 0;
                    }
                })
                if(check_val == 0){
                    await advance_cash.save_advance_cash();
                }
                
            }
        })
    },

    save_advance_cash : async function(){
        let arr_adc_detail = [];
        let arr_adc_detail_temp = {};
        
        
        let arr_adc_title = [];
        let arr_adc_title_temp = {};

        get_doc = $('.inp-ac_number').val();
        get_method = $('.sel_tranfer_mt').val();

        arr_adc_title_temp = {
            get_doc : get_doc,
            get_method : get_method,
        }
        arr_adc_title.push(arr_adc_title_temp)

        $('[name="advance-cash-tbl"] tbody > tr').each(function (i, e) {
            let get_description = $('.row-of-description', this).val();
            let get_des = get_description.substr(0,10)
            let get_amount = $('.inp-amount-req', this).val();
            let get_currency = $('.sel_currency', this).val();
            let get_check_id = $('.inp_check_id', this).val();
            
            arr_adc_detail_temp = {
                get_description: get_des,
                get_amount: get_amount,
                get_currency: get_currency,
                get_check_id: get_check_id,
            }
            arr_adc_detail.push(arr_adc_detail_temp)
        });
        
       let run_doc = await advance_cash.ajax_save_list(arr_adc_title,arr_adc_detail)
        $('.sel_tranfer_mt').attr('disabled',true)
        $('.inp-ac_number').val(run_doc)
        $('.row-of-description').attr('disabled',true)
        $('.sel_currency').attr('disabled',true)
        $('.btn_add_new_list').html('');
        $('.btn_save_list').html('');
        $('.td-delete').html('');
        

    },

    ajax_save_list: async function (arr_adc_title, arr_adc_detail) {

        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/advance/save_list.php",
                data: {
                    'arr_adc_title': arr_adc_title,
                    'arr_adc_detail': arr_adc_detail,
                },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    get_advance: async function (e) {
        let val = $(e).closest('tr')
        let valjob = $(val).find('.row-of-description').val();
        var currency = valjob.substr(valjob.length - 3);
        var job = valjob.substr(0, 10);

        $.each(res_select, function (i, v) {
            if (v['job_number'] == job && v['currency'] == currency) {
                $('.inp-amount', val).val(v['amount_total']).attr('disabled', true);
                $('.sel_currency', val).val(v['currency']).attr('disabled', true);
                $('.inp_check_id', val).val(v['check_id']).attr('disabled', true);
            }
        })
        await advance_cash.change_amount();
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