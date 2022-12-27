const petty_cash = {
   


    addpthtml: function () {
        let html_select = $(".td-sel-conttype").html();
        let sl_des_pettycash = $(".db-select-des").html();
        html = `
        <tr class="pettycash_detail">
            <td>${sl_des_pettycash}</td>
        <td><input type="input" class="form-control form-control-sm" onchange="petty_cash.amount_total();"></td>
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
        $('[name="petty-cash-tbl"]>tbody').append(html);

    },del_pettycash_row: function (e = null) {
        $(e).closest("tr").remove();
    }, 
    
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
            petty_cash.set_preview_data(job_doc_pt);
           
        } else {

        }
    },

    set_preview_data: async function (job_doc_pt) {
        
        let sl_des_pettycash = $(".db-select-des");

        let res_data = await petty_cash.ajax_set_preview_data(job_doc_pt);
        console.log(res_data);
       
        $('.inp-pt_number').val(res_data['pct']['petty_cash_number']);
        $('.sel_tranfer_mt').val(res_data['pct']['tranfer_method']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
      
    }, get_description_sel : async function () { 
        let res_description = await petty_cash.ajax_get_description();
        return res_description;
       
    },
    ajax_get_description : function () { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash/get_pettycash.php",
                data: {},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    html_description : async function (data) { 
        let res = await petty_cash.get_description_sel();
        let html = '';
        $.each(res, function (i, k) { 
            html += `
            <option value="${k['ID']}">${k['job_number']} / ${k['consignee_name']} </option>
            `;  
        });
        
        $('.sel_description').append(html);
    },




    ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/pettycash/get_preview_data.php",
                data: { 'petty_number': job_doc_pt },
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },





    amount_total : function () { 
        let sum = '';
        $('.inp-amount').each(function (e) { 
            sum += $(this).val();
        });
        console.log(sum);
     }

    
};


$( function () {
    petty_cash.html_description();

    petty_cash.check_get();
});