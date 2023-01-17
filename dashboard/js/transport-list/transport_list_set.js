const transport_list_set = {
   
    set_data_rows: async function (job_doc_pt) {
        $('.head-of-menu').html('Transport List');

        let res_data = await transport_list_set.ajax_set_preview_data(job_doc_pt);
        console.log(res_data);
        $('[name = "data_table_list"] tbody').html('');

        $.each(res_data['transport_list'], function (i, v) {         
            
            status_set = (v['status_job']);
            
            if(status_set == '1'){
                type_res = "<span class='badge rounded-pill bg-success'>Success</span>";
            }else{
                type_res = "<span class='badge rounded-pill bg-danger'>False</span>";
            }

            html_set_pct = `
            <tr>
            <td>${v['create_date']}</td>
            <td>${v['job_number']}</td>
            <td>${v['consignee_name']}</td>
            <td>${v['type_import_export']}</td>
            <td>${v['eta']}</td>
            <td>${v['location_name']},${v['country']}</td>
            <td>${type_res}</td>
            <td><button type="button" onclick="transport_list.preview('${v['job_number']}');" class="btn btn-primary rounded-pill btn-sm bg-gradient" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"><i class="bi bi-eye"></i> Preview</button></td>
        </tr>
            `;

            $('[name = "data_table_list"] tbody').append(html_set_pct);
           
        });
      
      
    }, 
    

    ajax_set_preview_data: function (job_doc_pt) {
        
        return new Promise(function (resolve, reject) {
            $.ajax({
                type: "post",
                url: "php/transport-list/get_detail.php",
                data: {},
                dataType: "json",
                success: function (response) {
                    resolve(response);
                }
            });
        });
    },

};

