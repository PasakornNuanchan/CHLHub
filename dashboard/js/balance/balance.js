const balance = {

  

    set_preview_data: async function () {
        

        let res_data = await balance.ajax_set_preview_data();

        $('.head-of-menu').html('Balance Cash');
        $('.bcpage').html('');

        console.log(res_data);
       //Petty Cash Waiting for clear
       var petty_cash_balance = 0;
    
        $('[name = "pc_wfc_table"] tbody').html('');
        $('[name = "ad_nhc_table"] tbody').html('');
        $('[name = "ad_wfc_table"] tbody').html('');
    
        let pct_total_th = 0;
        let pct_total_us = 0;
        let pct_total_ch = 0;
    if(res_data['pc_wfc'] == 0){
        
    }else{
        $.each(res_data['pc_wfc'], function (i, v) { 
            petty_cash_balance += parseFloat(v['amount']);
            pf_ptc = parseFloat(v['amount']);
            st_clearance = v['customs_clear'];
           

            if(v['currency'] == "THB"){
                pct_total_th = parseFloat(pct_total_th) + parseFloat(v['amount'])
            }else if(v['currency'] == "USD"){
                pct_total_us = parseFloat(pct_total_us) + parseFloat(v['amount'])
            }else if(v['currency'] == "RMB"){
                pct_total_ch = parseFloat(pct_total_ch) + parseFloat(v['amount'])
            }

            html_set_pc_wfc = `
            <tr class="text-center">
                <td>${v['doc_number']}</td>
                <td style="text-align:right;">${number_format(pf_ptc.toFixed(2))}</td>
                <td>${v['currency']}</td>
                <td><button onclick="petty_cash_con.preview('${v['doc_number']}');" class="btn btn-primary rounded-pill btn-xs bg-gradient" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" ><i class="bi bi-eye"></i> Check</button></td>
            </tr>
            `;
            $('[name = "pc_wfc_table"] tbody').append(html_set_pc_wfc);
        });
    };

        console.log(pct_total_th)
        console.log(pct_total_us)
        console.log(pct_total_ch)

        result_pc_th = `${pct_total_th} THB`;
        result_pc_us = `${pct_total_us} USD`;
        result_pc_ch = `${pct_total_ch} RMB`;
        $('.txt-head-pet-th').html(number_format(result_pc_th));
        $('.txt-head-pet-us').html(number_format(result_pc_us));
        $('.txt-head-pet-ch').html(number_format(result_pc_ch));

        //advance cash waiting for clear
        var advance_cash_balance =0;

    if(res_data['ad_wfc'] == 0){
        
    }else{
        $.each(res_data['ad_wfc'], function (i, v) { 
            advance_cash_balance += parseFloat(v['total_amount']);
            pf_adw = parseFloat(v['amount']);
           
           

            html_set_ad_wfc = `
            <tr class="text-center">
                <td>${v['advance_cash_number']}</td>
                <td style="text-align:right;">${number_format(pf_adw.toFixed(2))}</td>
                <td>${v['currency']}</td>
                <td><button onclick="advance_cash_con.preview('${v['advance_cash_number']}');" class="btn btn-primary rounded-pill btn-xs bg-gradient" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Check</button></td>
            </tr>
            `;

            $('[name = "ad_wfc_table"] tbody').append(html_set_ad_wfc);
           
        });
    };

        //advance not have create 
    if(res_data['ad_hnc'] == 0){

    }else{
        $.each(res_data['ad_hnc'], function (i, v) { 
            advance_cash_balance = parseFloat(v['amount']);
            pf_adnc = parseFloat(v['amount']);

            html_set_ad_nhc = `
            <tr class="text-center">
                <td>${v['job_number']}</td>
                <td>${number_format(pf_adnc.toFixed(2))}</td>
                <td>${v['currency']}</td>
            </tr>
            `;

            $('[name = "ad_nhc_table"] tbody').append(html_set_ad_nhc);
           
        });
        result_ad = advance_cash_balance.toFixed(2);
        $('.txt-header-ad').html(number_format(result_ad));
        };
    }, 

    ajax_set_preview_data: function () {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/balance/get_preview_data.php",
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