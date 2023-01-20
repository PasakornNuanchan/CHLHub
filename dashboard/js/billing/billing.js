const billing = {
    
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
        let get_job_number = getUrlParameter('job_number');
        let get_action = getUrlParameter('action');

        let job_number = get_job_number == false ? null : get_job_number;
        let action = get_action == false ? null : get_action;

        console.log(action);
        
        if (action == 'preview') {
            billing.set_preview_data(job_number);
           
        } else {
        }
    },
    set_data_description: async function(){
        let html_description = '';
        let set_data = await billing.ajax_set_description();
        console.log(set_data);
        $.each(set_data['bl_description'], function (i, v) { 
            html_description += `
            <option value="${v['billing_number']}">${v['billing_item_name']}</option>
            `;  
        });
        let html_bill_to = '';
        $.each(set_data['bl_bill'],function(i,v){
            html_bill_to += `
            <option value="${v['consignee_number']}">${v['consignee_name']}</option>
            `;   
        });
        $('.sel_description_ar').append(html_description);
        $('.sel_bill_to').append(html_bill_to);
        
    },
    set_preview_data: async function (job_number) {

        
        let html_des_ar='';
        await billing.set_data_description();
        let res_data = await billing.ajax_set_preview_data(job_number);

        $('.head-of-menu').html('Billing');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-billing-list.php" target="" style="color:white;">Billing List</a></li>
        <li class="breadcrumb-item active page-item" aria-current="page">Billing (Job number ${job_number})</li>`;
        $('.bcpage').append(html_bdpage);
        $('[name = "data_table_list"] tbody').html('');

        console.log(res_data);
        let sl_des = $('.sel_description_ar').parent().html();
        
        let sl_bill = $('.db-sel-bill').parent().html();
        // account receiv
        $.each(res_data['ar'],function(i,v){
            u_price = parseFloat(v['unit_price']);
            ar_amt = parseFloat(v['amount']);
            vat = parseFloat(v['vat']);
            amtincvat = parseFloat(v['amtinclvat']);

            if(v['payble'] == 1){
                payble_ar = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Paid</span>'
                action_payble_ar = 'disabled';
                action_del_ar = 'disabled';
            }else{
                payble_ar = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Unpaid</span>'
                action_payble_ar = '';
                action_del_ar = '';
            }

            if(v['check_status'] == 1){
                check_status = 'disabled checked';
                
            }else{
                check_status = 'unchecked';
            };
            

            html_des_ar += `
            <tr class="text-center ar_des ar_des${i}">
                <td>1</td>
                <td><div class="db-sel-des">${sl_des}</div></td>
                <td>${sl_bill}</td>
                <td>${payble_ar}</td>
                <td><select name="" id="" class="form-select shadow-none sel_cur_description">
                    <option value="" selected>Plsese select currency</option>
                    <option value="THB">THB</option>
                    <option value="USD">USD</option>
                    <option value="RMB">RMB</option>
                </select></td>
                <td><input type="text" class="form-control" value="${v['qty']}"></td>
                <td><input type="text" class="form-control" value="${number_format(v['unit_price'])}"></td>
                <td align="right">${number_format(ar_amt.toFixed(2))}</td>
                <td>${vat}%</td>
                <td align="right">${number_format(amtincvat.toFixed(2))}</td>
                <td><input type="text" class="form-control" value="${v['remark']}"></td>
                <td><input type="checkbox" class="form-check-input"  ${check_status}></td>
                <td>
                    <button type="button" class="btn btn-success rounded-pill btn-xs" ${action_payble_ar} style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
                </td>
                <td onclick="billing.del_container_row(this);">
                <button type="button" class="btn btn-danger rounded-pill btn-xs" ${action_del_ar} style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
            </td>
                
            </tr>
            `;  
            $('[name = "billing-ar-tbl"] tbody').html(html_des_ar);
            $(`.ar_des${i} .sel_description`).val(v['billing_number']);
            $(`.ar_des${i} .sel_cur_description`).val(v['currency']);

        });
            
        

    }, 
    
    ajax_set_description: function (job_number){
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_billing.php",
                data:  {'job_number':job_number},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    ajax_set_preview_data: function (job_number) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing/get_preview_data.php",
                data: {'job_number':job_number},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

    addarhtml: function () {
        let html_select = $(".td-sel-conttype").html();
        html = `
        <tr class="text-center">
            <td>1</td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td><span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Unpaid</span></td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected></option>
                <option value="">THB</option>
                <option value="">USD</option>
                <option value="">RMB</option>
            </select></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="text" class="form-control"></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="checkbox" class="form-check-input"></td>
            <td onclick="billing.del_container_row(this);">
                <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
            </td>
            <td>
                <button type="button" class="btn btn-success rounded-pill btn-xs" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
            </td>
            </tr>
        `;
        $('[name="billing-ar-tbl"]>tbody').append(html);
    },
    del_container_row: function (e = null) {
        $(e).closest("tr").remove();
     },



    addaphtml: function () {
        let html_select = $(".td-sel-conttype").html();
        html = `
        <tr class="text-center">
            <td>1</td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>Plese select description</option>
                <option value=""></option>
            </select></td>
            <td><span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Unpaid</span></td>
            <td><select name="" id="" class="form-select shadow-none">
                <option value="" selected>THB</option>
                <option value="">USD</option>
                <option value="">RMB</option>
            </select></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="text" class="form-control"></td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="text" class="form-control"></td>
            <td><input type="checkbox" class="form-check-input"></td>
            <td onclick="billing.del_container_row(this);">
                <button type="button" class="btn btn-danger rounded-pill btn-xs " style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-trash"></i> Delete</button>
            </td>
            <td>
                <button type="button" class="btn btn-success rounded-pill btn-xs" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-cash-coin"></i> Paid</button>
            </td>
            </tr>
        `;
        $('[name="billing-ap-tbl"]>tbody').append(html);
    },
    del_container_row: function (e = null) {
        $(e).closest("tr").remove();
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