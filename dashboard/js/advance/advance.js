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
        
        let res = await advance_cash.get_description_sel();
        let html = '';
        
        $.each(res, function (i, v) { 
            html += `
            <option value="${v['job_number']}">${v['job_number']} / ${v['consignee_name']} </option>
            `;  
        });
        
        $('.row-of-description').append(html);
    },






    addadhtml: function () {
        let html_select = $(".td-sel-conttype").html();
        let sl_des_pettycash = $(".db-select-des").html();
        html = `
        <tr class="pettycash_detail">
            <td>${sl_des_pettycash}</td>
        <td><input type="input" class="form-control form-control-sm"></td>
        <td><select name="" id="" class="form-select">
            <option value="" selected>THB</option>
            <option value="">USD</option>
            <option value="">RMB</option>
        </select></td>
        <td onclick="petty_cash.del_pettycash_row(this);" align="center">
            <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
        </td>
        </tr>
        `;
        $('[name="advance-cash-tbl"]>tbody').append(html);
    
        },
        
    del_pettycash_row: function (e = null) {
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
        
        if (action == 'preview') {
            await advance_cash.html_description();
            await advance_cash.set_preview_data(job_doc_pt);
            await advance_cash.change_amount();
            await advance_cash.main_preview();
        } else {

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
       
        $('.inp-ac_number').val(res_data['act']['advance_cash_number']).attr('disabled',true);
        $('.sel_tranfer_mt').val(res_data['act']['tranfer_method_request']).attr('disabled',true);
        // $('.inp-bankname').val(res_data['act']['tranfer_bank_name']);
        // $('.inp-banknumber').val(res_data['act']['tranfer_bank_number']);


        let sel_des = $('.row-of-description').parent().html();
        let sel_cur = $('.sel_currency').parent().html();
        $('[name = "advance-cash-tbl"] tbody').html('');
        $.each(res_data['acd'], function (i, v) { 

            let amt = parseFloat(v['amount'])
            
            html_check =
            `
            <tr class="advance_detail advance_detail${i}">
            <td class="db-select-des ">
                 ${sel_des}</td>
            <td><input type="number" class="form-control form-control-sm inp-amount-req inp-amount" value="${amt.toFixed(2)}" style="text-align:right;" readonly></td>
            <td>${sel_cur}</td>
           <td></td>
            </tr>
            `;
            $('[name = "advance-cash-tbl"] tbody').append(html_check);
            
            $(`.advance_detail${i} .row-of-description`).val(v['job_number']).attr('disabled',true);
            $(`.advance_detail${i} .sel_currency`).val(v['currency']).attr('disabled',true);;
        });
      
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
        $('.btn-add-adhtml').html('');
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
            console.log(amount)
            console.log(currencyz)
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