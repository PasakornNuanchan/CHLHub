const quotation_list_set = {
   
    set_data_rows: async function (job_doc_pt) {
        
        $('.head-of-menu').html('Quotation List');
        let res_data = await quotation_list_set.ajax_set_preview_data(job_doc_pt);
        
        console.log(res_data);
        $('[name = "data_table_list"] tbody').html('');

        $.each(res_data['quotation_list'], function (i, v) {         
            if(v['status']==1){
                status_quo_list = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">sign</span>';
            }else{
                status_quo_list = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">unsign</span>';

            }
            sub_date_time = v['create_datetime'];
            res_date_time = sub_date_time.substring(0, 10);
            
            
            html_set_pct = `
            <tr>
            <td>${res_date_time}</td>
            <td>${v['quartation_number']}</td>
            <td>${v['first_name']} ${v['last_name']}</td>
            <td>${v['consignee_name']}</td>
            <td>${v['type']}</td>
            <td>${status_quo_list}</td>
            <td><button type="button" onclick="quartation_list.preview('${v['quartation_number']}');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
        </tr>
            `;

            $('[name = "data_table_list"] tbody').append(html_set_pct);
           
        });
      
      
    }, 
    

    ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/quotation-list/get_detail.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

};

