const billing_list_set = {
   
    set_data_rows: async function (job_doc_pt) {
        

        let res_data = await billing_list_set.ajax_set_preview_data(job_doc_pt);
        console.log(res_data);
        $('[name = "data_table_list"] tbody').html('');

        $.each(res_data['billing_list'], function (i, v) {         
            
            get_ap = v['AP'];
            get_ar = v['AR'];
            
            if(get_ap == '1'){
                set_ap = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Success</span>';
            }else if(st_clearance = '0'){
                set_ap = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">fail</span>'
            }

            if(get_ar == '1'){
                set_ar = '<span class="badge rounded-pill bg-success" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">Success</span>';
            }else if(st_clearance = '0'){
                set_ar = '<span class="badge rounded-pill bg-danger" style="border-radius: 12px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">fail</span>'
            }
            

            html_set_pct = `
            <tr>
            <td>${v['create_date']}</td>
            <td>${v['job_number']}</td>
            <td>${v['first_name']} ${v['last_name']}</td>
            <td>${set_ar}</td>
            <td>${set_ap}</td>
            <td>${v['shipper_name']}</td>
            <td><button type="button" onclick="billing_list.preview('${v['job_number']}');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
        </tr>
            `;

            $('[name = "data_table_list"] tbody').append(html_set_pct);
           
        });
      
      
    }, 
    

    ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/billing-list/get_detail.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

};

