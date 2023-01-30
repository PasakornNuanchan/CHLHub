const petty_cash_list_set = {
   
    set_data_rows: async function () {
        
        let res_data = await petty_cash_list_set.ajax_set_preview_data(job_doc_pt);
        

        $('.head-of-menu').html('Petty Cash List');
        $('.bcpage').html('');
        html_bdpage = `
        <li class="breadcrumb-item"><a href="CHL-PettyCash-list.php" target="" style="color:white;">Petty Cash main list</a></li>`;
        $('.bcpage').append(html_bdpage);

        console.log(res_data);
        $('[name = "data_table_list"] tbody').html('');

        $.each(res_data['pct'], function (i, v) {         
            pf_amount = parseFloat(v['total_amount_request']);
            // console.log(pf_amount);
            html_set_pct = `
            <tr>
            <td>${v['datetime_request']}</td>
            <td>${v['petty_cash_number']}</td>
            <td>${v['first_name']} ${v['last_name']}</td>
            <td>${v['COUNT_job']}</td>
            <td>${number_format(pf_amount.toFixed(2))}</td>
            <td><button type="button" onclick="pettycash_list.preview('${v['petty_cash_number']}');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
        </tr>
            `;

            $('[name = "data_table_list"] tbody').append(html_set_pct);
           
        });
      
      
    }, 
    

    ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/petty-cash-list/get_detail.php",
                data: {},
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