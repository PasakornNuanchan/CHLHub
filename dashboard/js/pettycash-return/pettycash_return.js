const pettycash_return = {
   


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
            
            pettycash_return.set_preview_data(job_doc_pt);
            
        } else {

        }
    },

    set_preview_data: async function (job_doc_pt) {
    
        let sl_des_pettycash = $(".db-select-des");

        let res_data = await pettycash_return.ajax_set_preview_data(job_doc_pt);
        console.log(res_data);
       
        
        $('.inp-pettycash_number').val(res_data['pct']['petty_cash_number']);
        $('.inp-req_by').val(res_data['pct']['rq_by_first']+' '+res_data['pct']['rq_by_last']);
        $('.inp-req_datet').val(res_data['pct']['datetime_request']);
        $('.inp-bankname').val(res_data['pct']['tranfer_bank_name']);
        $('.inp-banknumber').val(res_data['pct']['tranfer_bank_number']);
        $('.inp-tranf_by').val(res_data['pct']['tf_by_first']+' '+res_data['pct']['tf_by_last']);
        $('.inp-tranf_time').val(res_data['pct']['tranfer_datetime']);
        $('.inp-job_q').val(res_data['scd']['c_qty']);
        $('.inp-tranf_total').val(res_data['pct']['tranfer_amount']);




        $('.inp-petty_cash_return').val(res_data['pct']['tranfer_amount']);

        
        $.each(res_data['pcd'], function (i, v) { 
           $text =+ (v['job_number']);
           i++;
        });
        
        $('.inp-all_job').val($text);
        
        $('.inp-total_amount').val(res_data['pct']['total_amount_request']);
        $('.inp-total_amount_tranfer').val(res_data['pct']['total_amount_request']);


        
        $.each(res_data['pcd'], function (i, v) { 
            html = `
            <tr class="pettycash_detail">
            <td class="sel-des-pcd${i} sel-des-pcd">${sl_des_pettycash.html()}</td>
            <td><input type="input" class="form-control form-control-sm" value="${v['amount']}"></td>
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

            htmlfetech =  `
            <tr class="text-center">
                <td>1</td>
                <td><select class="form-select form-select-sm shadow-none sel-des">
                    <option value="" selected>Plese select description</option>
                    <option value=""></option>
                </select></td>
                <td><input type="input" class="form-control form-control-sm inp-amount" readonly></td>
                <td><select class="form-select form-select-sm shadow-none sel-curr">
                    <option value="" selected>THB</option>
                    <option value="">USD</option>
                    <option value="">RMB</option>
                    </select>
                </td>
                <td></td>
                <td><input type="input" class="form-control form-control-sm inp-remark"></td>
            </tr>
            `;
            


            $('[name="petty-cash-tbl"]>tbody').append(html);
            //$(`sel-des-pcd${i}>select`).val(v['job_number']);
      
            $(`td.sel-des-pcd${i} > select option[value="${v['job_number']}"]`).attr('selected', 'selected');





        });



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
