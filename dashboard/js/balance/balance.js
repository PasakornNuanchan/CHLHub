const balance = {

  

    set_preview_data: async function () {
        
    
        let res_data = await balance.ajax_set_preview_data();
        console.log(res_data);
       //Petty Cash Waiting for clear
       
        $('[name = "pc_wfc_table"] tbody').html('');

        $.each(res_data['pc_wfc'], function (i, v) { 
            html_set_pc_wfc = `
            <tr class="text-center">
                <td>${v['petty_cash_number']}</td>
                <td>${v['customs_clear']}</td>
                <td>${v['total_amount']}</td>
                <td><button class="btn btn-primary rounded-pill btn-xs "><i class="bi bi-eye"></i> Check</button></td>
            </tr>
            `;

            $('[name = "pc_wfc_table"] tbody').append(html_set_pc_wfc);
           
        });
      
      
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


