const pettycash_payment = {
   


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
        
        console.log(action);
        
        if (action == 'preview') {
            pettycash_payment.set_preview_data(job_doc_pt);
            
        } else {

        }
    },

    set_preview_data: async function (job_doc_pt) {
        
        let sl_des_pettycash = $(".db-select-des");

        let res_data = await pettycash_payment.ajax_set_preview_data(job_doc_pt);
        console.log(res_data);
        
        $('.inp-req_by').val(res_data['pct']['first_name']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        
        
        $('.inp-total_amount').val(res_data['pct']['total_amount_request']);
        $('.inp-total_amount_tranfer').val(res_data['pct']['total_amount_request']);

        $('.inp-job_quantity').val(res_data['scd']['c_qty']);

         

        $.each(res_data['pcd'], function (i, v) { 
            html = `
            <tr class="pettycash_detail">
            <td><input type="input" class="form-control form-control-sm" value="${v['job_number']} / ${v['consignee_name']}"></td>
            <td><input type="input" class="form-control form-control-sm" value="${v['amount']}"></td>
            <td><select name="" id="" class="form-select">
                <option value="" selected>THB</option>
                <option value="">USD</option>
                <option value="">RMB</option>
            </select></td>
            
            </tr>
            `;


            $('[name="petty_cash_description"]>tbody').append(html);
            //$(`sel-des-pcd${i}>select`).val(v['job_number']);
      
            // $(`td.sel-des-pcd${i} > select option[value="${v['job_number']}"]`).attr('selected', 'selected');


            // <td class="sel-des-pcd${i} sel-des-pcd">${sl_des_pettycash.html()}</td>


        });
       

        
        $('.inp-prtload').val(res_data['port_of_loading_number']).attr('disabled',true);
        $('.inp-ts_port').val(res_data['ts_port_number']).attr('disabled',true);
        $('.inp-etd').val(res_data['etd']).attr('readonly',true);
        $('.inp-eta').val(res_data['eta']).attr('readonly',true);

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

    
};
