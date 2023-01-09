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
            <option value="${v['ID']}">${v['job_number']} / ${v['consignee_name']} </option>
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
        let get_doc_pt = getUrlParameter('advance_cash_number');
        let get_action = getUrlParameter('action');

        let job_doc_pt = get_doc_pt == false ? null : get_doc_pt;
        let action = get_action == false ? null : get_action;
        
        if (action == 'preview') {
            
            advance_cash.set_preview_data(job_doc_pt);
           
        } else {

        }
    },
    set_preview_data: async function (job_doc_pt) {
        
        let sl_des_pettycash = $(".db-select-des");

        let res_data = await advance_cash.ajax_set_preview_data(job_doc_pt);
        console.log(res_data);
       
        $('.inp-ac_number').val(res_data['act']['advance_cash_number']);
        $('.sel_tranfer_mt').val(res_data['act']['tranfer_method']);
        $('.inp-bankname').val(res_data['act']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['act']['tranfer_bank_number']);


        let sel_des = $('.row-of-description').parent().html();
        $('[name = "advance-cash-tbl"] tbody').html('');
        $.each(res_data['acd'], function (i, v) { 
            html_check =
            `
            <tr class="advance_detail advance_detail${i}">
            <td class="db-select-des">
                 ${sel_des}</td>
            <td><input type="input" class="form-control form-control-sm" value="${v['amount']}"></td>
            <td><select name="" id="" class="form-select form-select-sm sel_currency">
                    <option value="THB" selected>THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                </select></td>
           <td></td>
            </tr>
            `;
            $('[name = "advance-cash-tbl"] tbody').append(html_check);
            $(`.advance_detail${i} .sel_description`).val(v['ID']);
            $(`.advance_detail${i} .sel_currency`).val(v['currency']);
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


   
};

$( function () {
    advance_cash.html_description();

    advance_cash.check_get();
});
