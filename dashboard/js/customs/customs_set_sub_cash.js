const customs_set_sub_cash ={

    ajax_set_preview_data : function (job_number) { 
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/set_sub_cash.php",
                data: {'job_number' : job_number},
                dataType: "json",
                success: function (res) {
                    resolve(res);
                },
            });
        });
    },
    
    set_sub_cash_preview_data: async function (job_number){
        let res_data = await customs_set_sub_cash.ajax_set_preview_data(job_number);
        
        console.log(res_data);
        html_petty_cash_nubmer = $('.del_pcn').parent().html();
        $('.add_pcn').html('');
         
        
        // Petty Cash&Advance
        $('[name =cash_payment_table] tbody').html('');
        html_description_payment = '';
        let num=1;
        
        let cash_val = res_data['cbl']['cash_value']
        let cur_balance = res_data['cbl']['currency']
        let req_cash = res_data['cbl']['petty_cash_number'] 

        if(res_data['pay'] != "0 results"){
            $.each(res_data['pay'], function(i, v){
            let amount = parseFloat(v['amount']);
            let type = v['type'] || '';
            let billing_item_name = v['billing_item_name'] || '';
            let pay_to = v['pay_to'] || '';
            let first_name = v['first_name'] || '';
            let last_name = v['last_name'] || '';
            let ID = v['ID'] || '';
            html_description_payment = `
            <tr>
                <td>${num}</td>
                <td>${type}</td>
                <td>${billing_item_name}</td>
                <td>${pay_to}</td>
                <td></td>
                <td align="right">${number_format(amount.toFixed(2))}</td>
                <td>${first_name} ${last_name}</td>
                <td>
                    <button type="button" class="btn btn-danger rounded-pill btn-xs" onclick="customs_set_sub_cash.push_del_cash(${ID});"><i class="bi bi-pencil-fill"></i> Delete</button>
                </td>
            </tr>
            `;

            num++;
            $('[name =cash_payment_table] tbody').append(html_description_payment);
        });
       
        
        $('.inp-cash-balance').val(cash_val).attr('readonly',true);
        $('.sel-cur-balance').val(cur_balance).attr('disabled',true);
        $('.inp-req-cash').val(req_cash).attr('readonly',true);
        //$('.inp-shper').val(res_data['booking']['shipper_number']).attr('disabled',true);
        }else{
            $('.inp-cash-balance').val(cash_val).attr('readonly',true);
            $('.sel-cur-balance').val(cur_balance).attr('disabled',true);
            $('.inp-req-cash').val(req_cash).attr('readonly',true);
        }

    

    },

    push_del_cash: async function (del_id) {
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
                let res = await customs_set_sub_cash.ajax_del_cash(del_id)
                console.log(res);
                Swal.fire(
                    'saved!',
                    'Your file has been saved.',
                    'success'
                )
                customs_set_sub_cash.set_sub_cash_preview_data(customs.job_number_global);
            }
        })
    },

    ajax_del_cash: function (del_id) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/customs/del_cash_list.php",
                data: { 'del_id': del_id },
                dataType: "json",
                success: function (res) {
                    resolve(res);
                    
                },
            });
        });
    },

    type_change_cash : function(e){
        $('.add_pcn').html('');
        console.log(html_petty_cash_nubmer)
        let value_change = $(e).val();
        if(value_change == 1){
        $('.add_pcn').append(html_petty_cash_nubmer)
        }
        console.log(value_change)
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
